<?php

namespace App\Models;

use App\Models\Util\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'reminder', 'notification_status'];
    
    protected $attributes = [
        'status' => Status::INPROGRESS,
        'notification_status' => false
    ];

    public function subTasks(): HasMany
    {
        return $this->hasMany(SubTask::class);
    }
}
