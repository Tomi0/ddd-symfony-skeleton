<?php

namespace Authentication\Application\Services\User;

use Authentication\Domain\Models\User\UserRepository;
use SharedKernel\Application\Services\ApplicationService;

class SearchUsers implements ApplicationService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    public function handle(): array
    {
        return $this->userRepository->search();
    }
}