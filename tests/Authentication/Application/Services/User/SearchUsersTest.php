<?php

namespace Tests\Authentication\Application\Services\User;

use Authentication\Application\Services\User\SearchUsers;
use Tests\TestCase;

class SearchUsersTest extends TestCase
{
    private SearchUsers $searchUsers;

    protected function setUp(): void
    {
        parent::setUp();
        $this->searchUsers = $this->getDependency(SearchUsers::class);
    }

    public function testReturnIsAnArray(): void
    {
        $result = $this->searchUsers->handle();
        $this->assertIsArray($result);
    }
}