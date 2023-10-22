<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as BaseUser;

class User extends BaseUser
{
    protected $fillable = ['name', 'password'];
}
