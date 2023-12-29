<?php

namespace App\Services;

use App\Models\Task;
use App\Models\Util\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TaskSortingService {

    public function sort() {
        $sortOption = Session::get('sortOption');
        $offset = Session::get('offset');
        $userId = Auth::id();
        //if curent sort option != request sort option
        //offset = 0;


        switch ($sortOption) {
            case 'completed_asc':
                return $this->completedAsc($userId, $offset);
            case 'completed_desc':
                return $this->completedDesc($userId, $offset);
            case 'in_progress_asc':
                return $this->inProgressAsc($userId, $offset);
            case 'in_progress_desc':
                return $this->inProgressDesc($userId, $offset);
            case 'name_asc':
                return $this->nameAsc($userId, $offset);
            case 'name_desc':
                return $this->nameDesc($userId, $offset);
            default:
                return $this->defaultSort($userId, $offset);
        }
    }

    private function completedAsc($userId, $offset) {

        if(!Session::get('currentCount')) {
            $currentCount = Task::where('user_id', $userId)
            ->where('status', Status::COMPLETED)
            ->count();
            Session::put('currentCount', $currentCount);
        }

        return Task::where('user_id', $userId)
        ->where('status', Status::COMPLETED)
        ->orderBy('title', 'asc')
        ->limit(5)
        ->offset($offset)
        ->get();
    }

    private function completedDesc($userId, $offset) {

        if(!Session::get('currentCount')) {
            $currentCount = Task::where('user_id', $userId)
            ->where('status', 'completed')
            ->count();
            Session::put('currentCount', $currentCount);
        }

        return Task::where('user_id', $userId)
        ->where('status', 'completed')
        ->orderBy('title', 'desc')
        ->limit(5)
        ->offset($offset)
        ->get();
    }

    private function inProgressAsc($userId, $offset) {

        if(!Session::get('currentCount')) {
            $currentCount = Task::where('user_id', $userId)
            ->where('status', 'in progress')
            ->count();
            Session::put('currentCount', $currentCount);
        }

        return Task::where('user_id', $userId)
        ->where('status', 'in progress')
        ->orderBy('title', 'asc')
        ->limit(5)
        ->offset($offset)
        ->get();
    }

    private function inProgressDesc($userId, $offset) {

        if(!Session::get('currentCount')) {
            $currentCount = Task::where('user_id', $userId)
            ->where('status', 'in progress')
            ->count();
            Session::put('currentCount', $currentCount);
        }

        return Task::where('user_id', $userId)
        ->where('status', 'in progress')
        ->orderBy('title', 'desc')
        ->limit(5)
        ->offset($offset)
        ->get();
    }

    private function nameAsc($userId, $offset) {

        if(!Session::get('currentCount')) {
            $currentCount = Task::where('user_id', $userId)
            ->count();
            Session::put('currentCount', $currentCount);
        }

        return Task::where('user_id', $userId)
        ->orderBy('title', 'asc')
        ->limit(5)
        ->offset($offset)
        ->get();
    }

    private function nameDesc($userId, $offset) {

        if(!Session::get('currentCount')) {
            $currentCount = Task::where('user_id', $userId)
            ->count();
            Session::put('currentCount', $currentCount);
        }

        return Task::where('user_id', $userId)
        ->orderBy('title', 'desc')
        ->limit(5)
        ->offset($offset)
        ->get();
    }

    private function defaultSort($userId, $offset) {

        if(!Session::get('currentCount')) {
            $currentCount = Task::where('user_id', $userId)
            ->count();
            Session::put('currentCount', $currentCount);
        }
        Log::info(Session::get('currentCount'));
        return Task::where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->offset($offset)
        ->get();
    }

}