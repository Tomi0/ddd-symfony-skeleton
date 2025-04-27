<?php

namespace Tests;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

class TestCase extends KernelTestCase
{
    private static bool $migrated = false;

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
        $this->migrateDatabase();
    }

    protected function getDependency(string $class): mixed
    {
        return static::getContainer()->get($class);
    }

    /**
     * @throws \Exception
     */
    private function migrateDatabase(): void
    {
        if (self::$migrated) {
            return; // Ya migramos, no repetir
        }

        $kernel = static::createKernel();
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $kernel->boot();

        $application->run(new ArrayInput([
            'command' => 'doctrine:migrations:migrate',
            '--no-interaction' => true,
        ]), new NullOutput());

        self::$migrated = true;
    }
}