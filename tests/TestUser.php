<?php

namespace LaraComponents\Impersonation\Test;

use LaraComponents\Impersonation\Traits\Impersonable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TestUser extends Authenticatable
{
    use Impersonable;

    protected $table = 'test_users';

    protected $guarded = [];

    public $timestamps = false;
}
