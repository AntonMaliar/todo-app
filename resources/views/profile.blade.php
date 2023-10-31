<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>User Profile</title>
</head>
<body>
    <div class="container">
        <h1>User Profile</h1>

        <div class="profile-info">
            <div class="form-group">
                <label for="username">Username:</label>
                <span id="username">{{$user->name}}</span>
            </div>
        </div>

        <a href="/create-task" class="button create-task-button">Create Task</a>
        <a href="/edit-profile" class="button edit-profile-button">Edit Profile</a>

        @if($tasks)
        <div class="task-list">
            <h2>Task List</h2>
            
            <form action="/tasks/sort" method="get">

                <label for="sort-option">Sort By:</label>
                
                <select id="sort-option" name="sort_option">
                    <option value="completed_asc">Completion Status (Ascending)</option>
                    <option value="completed_desc">Completion Status (Descending)</option>
                    <option value="in_progress_asc">In Progress Status (Ascending)</option>
                    <option value="in_progress_desc">In Progress Status (Descending)</option>
                    <option value="name_asc">Task Name (Ascending)</option>
                    <option value="name_desc">Task Name (Descending)</option>
                </select>
                
                <button type="submit">Sort</button>
            </form>
            
            <form action="/tasks/search" method="get">
                <input type="text" name="search_option">
                <button type="submit">Search</button>
            </form>

            <ul>
            @foreach($tasks as $task)
                <li class="{{ $task->status === 'in progress' ? 'in-progress-task' : 'completed-task' }}">
                    <span class="task-title">{{ $task->title }}</span>
                    <div class="status-buttons">
                        @if($task->status === 'in progress')
                        <a href="/complete-task/{{ $task->id }}" class="button complete-task-button">Complete</a>
                        @else
                        <span>Completed</span>
                        @endif
                        <a href="/open-task/{{$task->id}}" class="button open-task-button">Open</a>
                        <a href="/edit-task/{{$task->id}}" class="button edit-task-button">Edit</a>
                        <a href="/delete-task/{{$task->id}}" class="button delete-task-button">Delete</a>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
        @endif
    </div>
</body>
</html>
