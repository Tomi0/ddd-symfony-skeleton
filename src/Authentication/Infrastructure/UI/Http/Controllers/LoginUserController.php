<?php

namespace Authentication\Infrastructure\UI\Http\Controllers;

use Authentication\Application\Services\User\LoginUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginUserController extends AbstractController
{
    private LoginUser $loginUser;

    public function __construct(LoginUser $loginUser)
    {
        $this->loginUser = $loginUser;
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'jwt' => $this->loginUser->handle(),
        ]);
    }
}