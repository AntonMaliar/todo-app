<?php

namespace App\Models;

use App\Models\Util\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'status'];
    protected $attributes = [
        'status' => Status::INPROGRESS
    ];
}
