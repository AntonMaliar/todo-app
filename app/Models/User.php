<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;

class User extends BaseUser {
    use Notifiable;
    use HasFactory;
    
    protected $fillable = ['name', 'password', 'email'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
