<?php

namespace LaraComponents\Impersonation\Test;

use LaraComponents\Impersonation\Test\TestCase;

class ImpersonableTest extends TestCase
{
    /** @test */
    public function it_user_impersonate()
    {
    	$this->assertFalse($this->testUser->isImpersonating());
    	$this->testUser->impersonate();
    	$this->assertTrue($this->testUser->isImpersonating());
    	$this->assertEquals(1, $this->testUser->getImpersonatingId());
    	$this->testUser->unimpersonate();
    	$this->assertFalse($this->testUser->isImpersonating());
    	$this->assertEquals(null, $this->testUser->getImpersonatingId());
    }
}