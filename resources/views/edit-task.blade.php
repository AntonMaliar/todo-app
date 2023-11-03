<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/create-task.css')}}">
    <title>Create Task</title>
</head>
<body>
    <div class="container">
        <h1>Edit Task</h1>
        <form class="create-task-form" action="/edit-task-put/{{$task->id}}" method="post">
            
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{$task->title}}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description">{{$task->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="reminder">Set Reminders</label>
                <input type="datetime-local" id="reminder" name="reminder" value="{{$task->reminder}}"></input>
            </div>
            <button type="submit" class="create-task-button">Edit Task</button>
        </form>
    </div>
</body>
</html>
