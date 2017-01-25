<?php

namespace LaraComponents\Impersonation\Test;

use Illuminate\Database\Eloquent\Model;
use LaraComponents\Impersonation\Traits\Impersonable;

class TestUser extends Model
{
    use Impersonable;

    protected $table = 'test_users';

    protected $guarded = [];

    public $timestamps = false;
}