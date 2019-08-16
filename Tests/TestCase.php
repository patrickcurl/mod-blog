<?php

namespace Modules\Blog\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Blog\BlogServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use ReflectionClass;
use ReflectionException;

abstract class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    /**
     * @param Application $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            BlogServiceProvider::class,
        ];
    }

    /**
     * @param Application $app
     * @return void
     */
    protected function resolveApplicationCore($app)
    {
        parent::resolveApplicationCore($app);

        $app->detectEnvironment(function () {
            return 'testing';
        });
    }

    /**
     * @param Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app): void
    {
        $config = $app->get('config');

        $config->set('database.default', 'sqlite');

        $config->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $config->set('view.paths', [module_path('Blog').'/Resources/views']);

        $config->set('auth.providers.users.model', User::class);
    }

    /**
     * @param Application $app
     * @return void
     */
    protected function setUpDatabase($app): void
    {
        $this->loadLaravelMigrations();

        $this->loadMigrationsFrom(module_path('Blog') . '/Database/migrations');

        $this->artisan('migrate');
    }

    /**
     * Call the protected or private methods of a class.
     *
     * @param $object
     * @param string $method
     * @param array $parameters
     * @throws ReflectionException
     * @return mixed
     */
    protected function invokeMethod(&$object, string $method, array $parameters = [])
    {
        $reflection = new ReflectionClass(get_class($object));
        $method     = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
