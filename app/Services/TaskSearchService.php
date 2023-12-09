<?php
namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Session;

class TaskSearchService {

    public function search($userId, $searchOption) {
        if(!Session::get('currentCount')) {
            $currentCount = Task::where('title', 'ilike', '%' . $searchOption . '%')
                ->count();
                
            Session::put('currentCount', $currentCount);
        }

        return Task::where('user_id', $userId)
        ->where('title', 'ilike', '%'.$searchOption.'%')
        ->limit(5)
        ->offset(Session::get('offset'))
        ->get();
    }

}