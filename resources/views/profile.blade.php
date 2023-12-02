<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    @include('inc/header')
    @include('inc/logout')

    <div class="container">
        <h1>{{__('app.User Profile')}}</h1>

        <div class="profile-info">
            <div class="form-group">
                <label for="username">{{__('app.Username')}}:</label>
                <span id="username">{{$user->name}}</span>
            </div>
        </div>

        <a href="/create-task" class="button create-task-button">{{__('app.Create Task')}}</a>
        <a href="/edit-profile" class="button edit-profile-button">{{__('app.Edit Profile')}}</a>

        @if($tasks)
        <div class="task-list">
            <h2>{{__('app.Task List')}}</h2>
            
            <form action="/tasks/sort" method="get">

                <label for="sort-option">{{__('app.Sort By')}}:</label>
                
                <select id="sort-option" name="sort_option">
                    <option value="completed_asc">{{__('app.Completed (Ascending)')}}</option>
                    <option value="completed_desc">{{__('app.Completed (Descending)')}}</option>
                    <option value="in_progress_asc">{{__('app.In Progress (Ascending)')}}</option>
                    <option value="in_progress_desc">{{__('app.In Progress (Descending)')}}</option>
                    <option value="name_asc">{{__('app.Task Name (Ascending)')}}</option>
                    <option value="name_desc">{{__('app.Task Name (Descending)')}}</option>
                    <option value="">{{__('app.Creation Time')}}</option>
                </select>
                
                <button type="submit">{{__('app.Sort')}}</button>
            </form>
            
            <form action="/tasks/search" method="get">
                <input type="text" name="search_option">
                <button type="submit">{{__('app.Search')}}</button>
            </form>

            <ul>
            @foreach($tasks as $task)
                <li class="{{ $task->status === 'in progress' ? 'in-progress-task' : 'completed-task' }}">
                    <span class="task-title">{{ $task->title }}</span>
                        <div class="status-buttons">
                            
                            @if($task->status === 'in progress')
                            <a href="/complete-task/{{ $task->id }}" class="button complete-task-button">{{__('app.Complete')}}</a>
                            
                            @else
                            <span>{{__('app.Completed')}}</span>
                            <a href="/undo-complete-task/{{ $task->id }}" class="button complete-task-button">{{__('app.Cancel Completion')}}</a>
                            
                            @endif
                            <a href="/open-task/{{$task->id}}" class="button open-task-button">{{__('app.Open')}}</a>
                            <a href="/edit-task/{{$task->id}}" class="button edit-task-button">{{__('app.Edit')}}</a>
                            <a href="/delete-task/{{$task->id}}" class="button delete-task-button">{{__('app.Delete')}}</a>
                    </div>
                </li>
            @endforeach
            </ul>

        </div>

        <a href="/forward" class="button open-task-button">{{__('app.Forward')}}</a>
        <a href="/back" class="button open-task-button">{{__('app.Back')}}</a>
        @endif
    </div>
</body>
</html>
