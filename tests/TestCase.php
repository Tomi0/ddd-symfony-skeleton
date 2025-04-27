<?php

namespace Tests;

use Exception;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

class TestCase extends WebTestCase
{
    private static bool $migrated = false;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->migrateDatabase();
    }

    protected function loadFixtures(array $fixturesClassNames): void
    {
        foreach ($fixturesClassNames as $fixturesClassName) {
            $fixture = new $fixturesClassName();
            $fixture->load(static::getContainer()->get('doctrine')->getManager());
        }
    }

    protected function getDependency(string $class): mixed
    {
        return static::getContainer()->get($class);
    }

    /**
     * @throws Exception
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