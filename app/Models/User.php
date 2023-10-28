<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as BaseUser;

class User extends BaseUser
{
    protected $fillable = ['name', 'password'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
