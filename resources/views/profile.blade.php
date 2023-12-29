<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>Profile</title>
</head>
<body>
    <div class="full-page-container">
        <div class="content-container">

            <div class="header">
                <div class="language-switch">
                    <a href="/lang?lang=en" title="Switch to English">EN</a>
                    <a href="/lang?lang=ua" title="Switch to Ukrainian">UA</a>
                    <a href='/logout' class="main-page-link">{{__('app.Log Out')}}</a>
                </div>
            </div>

            <h1>{{ __('app.User Profile') }}</h1>

            <div class="profile-info">
                <div class="profile-field">
                    <label for="username">{{ __('app.Username') }}:</label>
                    <span id="username">{{ $user->name }}</span>
                </div>
            </div>

            <div class="action-buttons">
                <a href="/create-task" class="action-button">{{ __('app.Create Task') }}</a>
                <a href="/edit-profile" class="action-button">{{ __('app.Edit Profile') }}</a>
            </div>

                <div class="task-list">

                <form action="/reset" method="get" class="search-form">
                        <button type="submit" class="action-button">{{ __('app.Reset everything') }}</button>
                    </form>

                    <h2>{{ __('app.Task List') }}</h2>
                    
                    @if($tasks->isNotEmpty())

                    <form action="/tasks/search" method="get" class="search-form">
                        <label id="task_search">{{__('app.Task search')}}:</label>
                        <input id="task_search" type="text" name="search_option">
                        <button type="submit" class="action-button">{{ __('app.Search') }}</button>
                    </form>

                    <form action="/tasks/sort" method="get" class="sort-form">
                        <label for="sort-option">{{ __('app.Sort By') }}:</label>
                        <select id="sort-option" name="sort_option">
                            <option value="completed_asc">{{ __('app.Completed (Ascending)') }}</option>
                            <option value="completed_desc">{{ __('app.Completed (Descending)') }}</option>
                            <option value="in_progress_asc">{{ __('app.In Progress (Ascending)') }}</option>
                            <option value="in_progress_desc">{{ __('app.In Progress (Descending)') }}</option>
                            <option value="name_asc">{{ __('app.Task Name (Ascending)') }}</option>
                            <option value="name_desc">{{ __('app.Task Name (Descending)') }}</option>
                            <option value="">{{ __('app.Creation Time') }}</option>
                        </select>
                        <button type="submit" class="action-button">{{ __('app.Sort') }}</button>
                    </form>

                    <ul class="task-ul">
                        @foreach($tasks as $task)
                            <li class="task-li">
                                <div class="task-header">
                                    <span>{{ $task->title }}</span>
                                </div>

                                <div class="task-actions">
                                    @if($task->status === 'in progress')
                                    <a href="/complete-task/{{ $task->id }}" class="action-button">{{ __('app.Complete') }}</a>
                                    @else
                                    <span class="completed">{{ __('app.Completed') }}</span>
                                    <a href="/undo-complete-task/{{ $task->id }}" class="action-button">{{ __('app.Cancel Completion') }}</a>
                                    @endif
                                    <a href="/open-task/{{$task->id}}" class="action-button">{{ __('app.Open') }}</a>
                                    <a href="/edit-task/{{$task->id}}" class="action-button">{{ __('app.Edit') }}</a>
                                    <a href="/delete-task/{{$task->id}}" class="action-button">{{ __('app.Delete') }}</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="navigation-buttons">
                    <a href="/forward" class="action-button">{{ __('app.Forward') }}</a>
                    <a href="/back" class="action-button">{{ __('app.Back') }}</a>
                </div>
            </div>
        @endif
    </div>

    <script>
        // Add or remove a class based on scroll position
        window.onscroll = function() {
            var header = document.querySelector('.header');
            if (window.pageYOffset > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        };
    </script>
</body>
</html>
