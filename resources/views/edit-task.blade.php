<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
</head>
<body>
    @include('inc/header')
    @include('inc/logout')
    
    <div class="container">
        <h1>{{__('app.Edit Task')}}</h1>

        <form class="create-task-form" action="/edit-task-put/{{$task->id}}" method="post">
            
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">{{__('app.Title')}}</label>
                <input type="text" id="title" name="title" value="{{$task->title}}">
            </div>

            <div class="form-group">
                <label for="description">{{__('app.Description')}}</label>
                <textarea id="description" name="description">{{$task->description}}</textarea>
            </div>

            <div class="form-group">
                <label for="reminder">{{__('app.Set Reminder')}}</label>
                <input type="datetime-local" id="reminder" name="reminder" value="{{$task->reminder}}"></input>
            </div>

            <button type="submit" class="create-task-button">{{__('app.Edit Task')}}</button>

        </form>
    </div>
</body>
</html>
