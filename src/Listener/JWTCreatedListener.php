<?php

namespace App\Listener;

use App\Service\Session\Data\GetSessionInput;
use App\Service\Session\SessionServiceInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{

    public function __construct(
        private readonly SessionServiceInterface $sessionService
    )
    {}

    public function __invoke(JWTCreatedEvent $event): void
    {
        $user = $event->getUser();
        $session = $this->sessionService->getSession(
            new GetSessionInput($user->getUserIdentifier())
        );

        $payload['user_uuid'] = $user->getUserIdentifier();

    }
}
