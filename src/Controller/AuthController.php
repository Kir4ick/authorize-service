<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Request\LoginRequest;
use App\Response\LoginResponse;
use App\Service\Auth\AuthServiceInterface;
use App\Service\Auth\Data\LoginInput;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{

    public function __construct(
        private readonly AuthServiceInterface $authService
    )
    {}

    #[Route('/login', 'login', methods: Request::METHOD_POST)]
    public function login(#[RequestBody] LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login(new LoginInput());

        $response = new LoginResponse('assadasdasd', 'asdasdsda');

        return $this->json($response);
    }

}
