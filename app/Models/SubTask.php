<?php

namespace App\Models;

use App\Models\Util\Status;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    protected $fillable = ['description', 'status'];

    protected $attributes = [
        'status' => Status::INPROGRESS
    ];
}
