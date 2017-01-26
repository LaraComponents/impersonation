<?php

namespace LaraComponents\Impersonation\Test;

use Illuminate\Database\Schema\Blueprint;
use LaraComponents\Impersonation\Test\TestUser;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * @var \LaraComponents\Impersonation\Test\TestUser
     */
    protected $testUser;

    public function setUp()
    {
        parent::setUp();
        $this->setUpDatabase($this->app);
        $this->testUser = TestUser::find(1);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('auth.providers.users.model', TestUser::class);
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('app.key', '6rE9Nz59bGRbeMATftriyQjrpF7DcOQm');
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('test_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        TestUser::create(['id' => 1, 'name' => 'user 1']);
        TestUser::create(['id' => 2, 'name' => 'user 2']);
    }
}
