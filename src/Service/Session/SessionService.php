<?php

namespace App\Service\Session;

use App\Model\Session;
use App\Model\User;
use App\Repository\Session\SessionRepositoryInterface;
use App\Service\Session\Data\UpsertSessionInput;
use App\Service\Session\Data\UpsertSessionOutput;
use App\Service\Session\Data\GetSessionInput;
use App\Service\Session\Data\GetSessionOutput;

class SessionService implements SessionServiceInterface
{

    public function __construct(
        private readonly SessionRepositoryInterface $sessionRepository
    )
    {}

    public function upsertSession(UpsertSessionInput $input): UpsertSessionOutput
    {
        $session = $this->sessionRepository->findOneBy([
            'user' => $input->getUser()->getUUID(),
            'ip' => $input->getIp(),
            'userAgent' => $input->getUserAgent(),
            'fingerprint' => $input->getFingerprint(),
        ]);

        if ($session === null) {
            $session = new Session();
            $session->setUser($input->getUser())
                ->setIp($input->getIp())
                ->setFingerprint($input->getFingerprint())
                ->setIsActive(true)
                ->setIsBlocked(false)
                ->setUserAgent($input->getUserAgent());

            /** @var Session $session */
            $session = $this->sessionRepository->saveAndCommit($session);
        }

        if ($session->getIsBlocked()) {
            return new UpsertSessionOutput(null, true);
        }

        if ($session->getIsActive() === false) {
            $session->setIsActive(true);
            $this->sessionRepository->saveAndCommit($session);
        }

        return new UpsertSessionOutput($session, false);
    }

    public function getSession(GetSessionInput $input): GetSessionOutput
    {
        $session = $this->sessionRepository->findOneBy([
            'user_uuid' => $input->getUserUUID()
        ]);

        return new GetSessionOutput(null);
    }
}
