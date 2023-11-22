<?php

declare(strict_types=1);

namespace App\Services\Users\GetLoggedUserDataService;

final class GetLoggedUserData
{
    private GetLoggedUserDataOutput $getLoggedUserDataOutput;

    public function __construct(GetLoggedUserDataOutput $getLoggedUserDataDTO)
    {
        $this->getLoggedUserDataOutput = $getLoggedUserDataDTO;
    }

    public function perform(): GetLoggedUserDataOutput
    {
        $sanctumUser = auth('sanctum')->user();

        $this->getLoggedUserDataOutput->setId($sanctumUser['id']);
        $this->getLoggedUserDataOutput->setUsername($sanctumUser['username']);

        return $this->getLoggedUserDataOutput;
    }
}
