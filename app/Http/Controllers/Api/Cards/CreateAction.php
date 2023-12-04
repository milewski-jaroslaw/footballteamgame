<?php

namespace App\Http\Controllers\Api\Cards;

use App\Exceptions\Cards\UserCanNotDrawCardException;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\User;
use App\Repositories\CardRepository;
use App\Repositories\DuelHistoryRepository;
use App\Repositories\UserRepository;
use App\Services\CacheService;
use App\Services\Cards\AssignCardToUserService\AssignCardToUser;
use App\Services\Cards\CheckCardDrawAvailabilityService\CheckCardDrawAvailability;
use App\Services\Cards\DrawCardService\DrawCardStrategyFactory;
use App\Services\Users\GetLoggedUserDataService\GetLoggedUserData;
use App\Services\Users\GetUserLevelPointsService\GetUserLevelPoints;
use App\Services\Users\GetUserLevelService\GetUserLevel;
use Exception;

class CreateAction extends Controller
{
    public function __construct(
        private readonly CheckCardDrawAvailability $checkCardDrawAvailability,
        private readonly GetUserLevel              $getUserLevel,
        private readonly CardRepository            $cardRepository,
        private readonly GetUserLevelPoints        $getUserLevelPoints,
        private readonly GetLoggedUserData         $getLoggedUserData,
        private readonly DuelHistoryRepository     $duelHistoryRepository,
        private readonly DrawCardStrategyFactory   $drawCardStrategyFactory,
        private readonly UserRepository            $userRepository,
        private readonly CacheService              $cacheService,
        private readonly AssignCardToUser          $assignCardToUser,
    )
    {
    }

    public function __invoke(): string
    {
        try {
            $loggedUserData  = $this->getLoggedUserData->perform();
            $userId          = $loggedUserData->getId();
            $userWinsCount   = $this->duelHistoryRepository->getUserWins($userId)->count();
            $userLevelPoints = $this->getUserLevelPoints->perform($userWinsCount);
            $userLevel       = $this->getUserLevel->perform($userLevelPoints);
            $this->checkUserCanDrawCard($userId, $userLevel);

            $newCard = $this->drawNewCard();

            /**
             * @var User $user
             */
            $user = $this->userRepository->getById($loggedUserData->getId())->first();
            $this->assignCardToUser->perform($newCard, $user, $userLevel);

            $this->cacheService->delete("get-data-user-{$loggedUserData->getId()}");

            return response()->json($newCard->only([
                'id',
                'name',
                'power',
                'image',
            ]));
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }

    /**
     * @throws UserCanNotDrawCardException
     */
    private function checkUserCanDrawCard(int $userId, int $userLevel): bool
    {
        $numberOfCardsDrawnByUser = $this->cardRepository->getAllDrawnByUserId($userId)->count();

        return $this->checkCardDrawAvailability->perform($userLevel, $numberOfCardsDrawnByUser)
            ?: throw new UserCanNotDrawCardException();
    }

    /**
     * @return Card
     */
    private function drawNewCard(): Card
    {
        return $this->drawCardStrategyFactory->getStrategy()->perform();
    }
}
