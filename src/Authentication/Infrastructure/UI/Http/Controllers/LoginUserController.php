<?php

namespace Authentication\Infrastructure\UI\Http\Controllers;
use Authentication\Application\Services\User\LoginUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LoginUserController
{
    private LoginUser $loginUser;

    public function __construct(LoginUser $loginUser)
    {
        $this->loginUser = $loginUser;
    }

    #[Route('/login', name: 'login', methods: ['POST'])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'jwt' => $this->loginUser->handle()
        ]);
    }
}