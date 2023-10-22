<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <title>User Profile</title>
</head>
<body>
    <div class="container">
        <h1>User Profile</h1>
        <div class="profile-info">
            <div class="form-group">
                <label for="username">Username:</label>
                <span id="username">{{$username}}</span>
            </div>
        </div>
        <div class="task-list">
            <h2>Task List</h2>
            <ul>
                <li>Task 1</li>
                <li>Task 2</li>
                <li>Task 3</li>
            </ul>
        </div>
        <button id="add-task-button" class="add-task-button">Add Task</button>
    </div>
</body>
</html>
