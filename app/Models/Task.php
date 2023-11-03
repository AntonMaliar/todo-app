<?php

namespace App\Models;

use App\Models\Util\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'status', 'reminder'];
    
    protected $attributes = [
        'status' => Status::INPROGRESS
    ];

    public function subTasks(): HasMany
    {
        return $this->hasMany(SubTask::class);
    }
}
