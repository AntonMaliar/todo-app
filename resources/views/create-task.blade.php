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
        <h1>Create Task</h1>
        <form class="create-task-form" action="/create-task" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="create-task-button">Create Task</button>
        </form>
    </div>
</body>
</html>
