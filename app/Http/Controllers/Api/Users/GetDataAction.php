<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\GetDataRequest;
use App\Repositories\CardRepository;
use App\Repositories\DuelHistoryRepository;
use App\Services\CacheService;
use App\Services\Cards\CheckCardDrawAvailabilityService\CheckCardDrawAvailability;
use App\Services\Users\GetLoggedUserDataService\GetLoggedUserData;
use App\Services\Users\GetPointsCountForNextLevelService\GetPointsCountForNextLevel;
use App\Services\Users\GetUserLevelPointsService\GetUserLevelPoints;
use App\Services\Users\GetUserLevelService\GetUserLevel;

class GetDataAction extends Controller
{
    private GetLoggedUserData $getLoggedUserData;
    private GetUserLevel $getUserLevel;
    private GetUserLevelPoints $getUserLevelPoints;
    private GetPointsCountForNextLevel $getPointsCountForNextLevel;
    private CacheService $cacheService;
    private CheckCardDrawAvailability $checkCardDrawAvailability;
    private DuelHistoryRepository $duelHistoryRepository;
    private CardRepository $cardRepository;

    public function __construct(
        GetLoggedUserData          $getLoggedUserData,
        GetUserLevel               $getUserLevel,
        GetUserLevelPoints         $getUserLevelPoints,
        GetPointsCountForNextLevel $getPointsCountForNextLevel,
        CheckCardDrawAvailability  $checkCardDrawAvailability,
        CacheService               $cacheService,
        DuelHistoryRepository      $duelHistoryRepository,
        CardRepository             $cardRepository
    )
    {
        $this->getLoggedUserData          = $getLoggedUserData;
        $this->getUserLevel               = $getUserLevel;
        $this->getUserLevelPoints         = $getUserLevelPoints;
        $this->getPointsCountForNextLevel = $getPointsCountForNextLevel;
        $this->cacheService               = $cacheService;
        $this->checkCardDrawAvailability  = $checkCardDrawAvailability;
        $this->duelHistoryRepository      = $duelHistoryRepository;
        $this->cardRepository             = $cardRepository;
    }

    public function __invoke(GetDataRequest $request)
    {
        $loggedUserData = $this->getLoggedUserData->perform();

        return $this->cacheService->perform(
            "get-data-user-{$loggedUserData->getId()}",
            24,
            function () use ($loggedUserData) {
                $userId                   = $loggedUserData->getId();
                $userWinsCount            = $this->duelHistoryRepository->getUserWins($userId)->count();
                $userLevelPoints          = $this->getUserLevelPoints->perform($userWinsCount);
                $userLevel                = $this->getUserLevel->perform($userLevelPoints);
                $numberOfCardsDrawnByUser = $this->cardRepository->getAllDrawnByUserId($userId)->count();
                $userCards                = $this->cardRepository->getAllByUserId($userId)
                    ->select(['id', 'name', 'power', 'image'])->get();

                return response()->json([
                    'id' => $userId,
                    'username' => $loggedUserData->getUsername(),
                    'level' => $userLevel,
                    'level_points' => $this->getLevelPointsProgress($userLevelPoints),
                    'cards' => $userCards->toArray(),
                    'new_card_allowed' => $this->checkCardDrawAvailability->perform($userLevel, $numberOfCardsDrawnByUser),
                ]);
            }
        );
    }

    private function getLevelPointsProgress(int $levelPoints): string
    {
        return $levelPoints . '/' . $this->getPointsCountForNextLevel->perform($levelPoints);
    }
}
