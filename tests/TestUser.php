<?php

namespace LaraComponents\Impersonation\Test;

use Illuminate\Foundation\Auth\User as Authenticatable;
use LaraComponents\Impersonation\Traits\Impersonable;

class TestUser extends Authenticatable
{
    use Impersonable;

    protected $table = 'test_users';

    protected $guarded = [];

    public $timestamps = false;
}
