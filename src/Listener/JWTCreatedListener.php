<?php

namespace App\Listener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTCreatedListener
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly int $refreshTTL
    ) {}

    public function __invoke(JWTCreatedEvent $event): void
    {
        $request = $this->requestStack->getCurrentRequest();

        $payload = $event->getData();
        if (isset($payload['access'])) {
            $this->updatedAccessToken($request, $event);
        }

        if (isset($payload['refresh'])) {
            $this->updateRefreshToken($request, $event);
        }
    }

    private function updatedAccessToken(Request $request, JWTCreatedEvent $JWTCreatedEvent): void
    {
        $payload = $this->updatePayload($request, $JWTCreatedEvent->getData());

        $JWTCreatedEvent->setData($payload);
    }

    private function updateRefreshToken(Request $request, JWTCreatedEvent $JWTCreatedEvent): void
    {
        $payload = $this->updatePayload($request, $JWTCreatedEvent->getData());
        $payload['exp'] = (new \DateTime())
            ->modify('+' . $this->refreshTTL . ' seconds')
            ->format('U');

        $JWTCreatedEvent->setData($payload);
    }

    private function updatePayload(Request $request, array $payload): array
    {
        $payload['ip'] = $request->getClientIp();
        $payload['user-agent'] = $request->headers->get('user-agent');

        return $payload;
    }
}
