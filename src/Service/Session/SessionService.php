<?php

namespace App\Service\Session;

use App\Entity\Session;
use App\Repository\Session\SessionRepositoryInterface;
use App\Service\Session\Data\CreateSessionInput;
use App\Service\Session\Data\CreateSessionOutput;
use App\Service\Session\Data\GetSessionInput;
use App\Service\Session\Data\GetSessionOutput;

class SessionService implements SessionServiceInterface
{

    public function __construct(
        private readonly SessionRepositoryInterface $sessionRepository
    )
    {}

    public function createSession(CreateSessionInput $input): CreateSessionOutput
    {
        try {
            $sessionModel = $this->sessionRepository->create();
        } catch (\Exception $exception) {
            return new CreateSessionOutput(null, 'Cannot create new session');
        }

        $sessionEntity = new Session();
        $sessionEntity->setUuid($sessionModel->getUuid());

        return new CreateSessionOutput($sessionEntity);
    }

    public function getSession(GetSessionInput $input): GetSessionOutput
    {
        $session = $this->sessionRepository->findOneBy([
            'user_uuid' => $input->getUserUUID()
        ]);

        return new GetSessionOutput(null);
    }
}
