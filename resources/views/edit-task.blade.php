<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/task.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Edit Task</title>
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
                <h1>{{__('app.Edit Task')}}</h1>

                <form action="/edit-task-put/{{$task->id}}" method="post" class="edit-task-form">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title">{{__('app.Title')}}</label>
                        <input type="text" id="title" name="title" value="{{$task->title}}">
                    </div>

                    <div>
                        <label for="description">{{__('app.Description')}}</label>
                        <textarea id="description" name="description">{{$task->description}}</textarea>
                    </div>

                    <div>
                        <label for="reminder">{{__('app.Set Reminder')}}</label>
                        <input type="datetime-local" id="reminder" name="reminder" value="{{$task->reminder}}"></input>
                    </div>

                    <button type="submit">{{__('app.Edit Task')}}</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
