<?php

namespace App\Models;

use App\Models\Util\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'status'];

    protected $attributes = [
        'status' => Status::INPROGRESS
    ];
}
