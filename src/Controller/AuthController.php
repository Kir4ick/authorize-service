<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Request\LoginRequest;
use App\Response\LoginResponse;
use App\Service\Auth\AuthServiceInterface;
use App\Service\Auth\Data\LoginInput;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{

    public function __construct(
        private readonly AuthServiceInterface $authService,
        private readonly AuthenticationSuccessHandler $successHandler
    )
    {}

    #[Route('/login', 'login', methods: Request::METHOD_POST)]
    public function login(#[RequestBody] LoginRequest $request): JsonResponse
    {
        $input = new LoginInput(
            $request->getLogin(), $request->getPassword(), $request->getFingerprint()
        );

        $user = $this->authService->login($input);

        return $this->successHandler->handleAuthenticationSuccess($user->getUser());
    }

}
