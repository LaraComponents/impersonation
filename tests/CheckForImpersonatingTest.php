<?php

namespace LaraComponents\Impersonation\Test;

use LaraComponents\Impersonation\Middleware\CheckForImpersonating;

class CheckForImpersonatingTest extends TestCase
{
    protected $middleware;
    protected $otherUser;

    public function setUp()
    {
        parent::setUp();

        $this->be($this->testUser);

        $this->app['request']->setUserResolver(function ($guard = null) {
            return $this->app['auth']->user();
        });

        $this->middleware = new CheckForImpersonating($this->app['auth']);
        $this->otherUser = TestUser::find(2);
    }

    /** @test */
    public function it_user_impersonate()
    {
        $this->otherUser->impersonate();
        $user = $this->handleMiddleware();

        $this->assertEquals($this->otherUser, $user);
        $this->assertNotEquals($this->testUser, $user);

        $this->assertEquals($this->otherUser->getKey(), $user->getKey());
        $this->assertNotEquals($this->testUser->getKey(), $user->getKey());
    }

    /** @test */
    public function it_user_without_impersonate()
    {
        $user = $this->handleMiddleware();

        $this->assertEquals($this->testUser, $user);
        $this->assertNotEquals($this->otherUser, $user);

        $this->assertEquals($this->testUser->getKey(), $user->getKey());
        $this->assertNotEquals($this->otherUser->getKey(), $user->getKey());
    }

    protected function handleMiddleware()
    {
        return $this->middleware->handle($this->app['request'], function ($request) {
            return $request->user();
        });
    }
}
