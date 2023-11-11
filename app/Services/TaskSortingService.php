<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class TaskSortingService {

    public static function sort() {
        $sortOption = session('sortOption');
        $offset = session('offset');
        $userId = auth()->id();

        switch ($sortOption) {
            case 'completed_asc':
                return self::completedAsc($userId, $offset);
            case 'completed_desc':
                return self::completedDesc($userId, $offset);
            case 'in_progress_asc':
                return self::inProgressAsc($userId, $offset);
            case 'in_progress_desc':
                return self::inProgressDesc($userId, $offset);
            case 'name_asc':
                return self::nameAsc($userId, $offset);
            case 'name_desc':
                return self::nameDesc($userId, $offset);
            default:
                return self::defaultSort($userId, $offset);
        }
    }

    private static function completedAsc($userId, $offset) {
    return Task::where('user_id', $userId)
        ->where('status', 'completed')
        ->orderBy('title', 'asc')
        ->limit(5)
        ->offset($offset)
        ->get();
    }

    private static function completedDesc($userId, $offset) {
    return Task::where('user_id', $userId)
        ->where('status', 'completed')
        ->orderBy('title', 'desc')
        ->limit(5)
        ->offset($offset)
        ->get();
    }

    private static function inProgressAsc($userId, $offset) {
    return Task::where('user_id', $userId)
        ->where('status', 'in progress')
        ->orderBy('title', 'asc')
        ->limit(5)
        ->offset($offset)
        ->get();
    }

    private static function inProgressDesc($userId, $offset) {
    return Task::where('user_id', $userId)
        ->where('status', 'in progress')
        ->orderBy('title', 'desc')
        ->limit(5)
        ->offset($offset)
        ->get();
    }

    private static function nameAsc($userId, $offset) {
    return Task::where('user_id', $userId)
        ->orderBy('title', 'asc')
        ->limit(5)
        ->offset($offset)
        ->get();
    }

    private static function nameDesc($userId, $offset) {
    return Task::where('user_id', $userId)
        ->orderBy('title', 'desc')
        ->limit(5)
        ->offset($offset)
        ->get();
    }

    private static function defaultSort($userId, $offset) {
    return Task::where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->offset($offset)
        ->get();
    }

}