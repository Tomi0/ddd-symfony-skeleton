<?php

namespace Authentication\Infrastructure\UI\Http\Controllers;

use Authentication\Application\Services\User\SearchUsers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginUserController extends AbstractController
{
    private SearchUsers $searchUsers;

    public function __construct(SearchUsers $loginUser)
    {
        $this->searchUsers = $loginUser;
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            $this->searchUsers->handle()
        );
    }
}