<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/create-task.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Create Task</title>
</head>
<body>
    <div class="full-page-container">
        <div class="content-container">
            <div class="language-switch">
                <a href="/lang?lang=en" title="Switch to English">EN</a>
                <a href="/lang?lang=ua" title="Switch to Ukrainian">UA</a>
                <a href='/profile' class="main-page-link">{{__('app.Profile')}}</a>
                <a href='/logout' class="main-page-link">{{__('app.Log Out')}}</a>
            </div>

            <div class="content">
                <h1>{{ __('app.Create Task') }}</h1>

                <form action="/create-task" method="post" class="task-form">
                    @csrf
                    <div class="form-field">
                        <label for="title">{{__('app.Title')}}</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="form-field">
                        <label for="description">{{__('app.Description')}}</label>
                        <textarea id="description" name="description" required></textarea>
                    </div>
                    <div class="form-field">
                        <label for="reminder">{{__('app.Set Reminder')}}</label>
                        <input type="datetime-local" id="reminder" name="reminder"></input>
                    </div>
                    <button type="submit" class="action-button">{{__('app.Create Task')}}</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
