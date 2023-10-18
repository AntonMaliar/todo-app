<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'password'];

    public function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
    }
}
