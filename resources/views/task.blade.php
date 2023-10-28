<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/task.css')}}">
    <title>Task</title>
</head>
<body>
    <div class="container">
        <h1>Task</h1>
        <div class="task-details">
            <h2>Title: {{$task->title}}</h2>
            <p>Description: {{$task->description}}</p>
        </div>
        <div class="sub-tasks">
            <h2>Sub-Tasks</h2>
            <form action="/add-sub-task/{{$task->id}}">
                <button type="button" onclick="addSubTask()" class="button add-sub-task">Add Sub Task</button>
                <div id="inputContainer">
                </div>
                <input type="submit" value="Create" class="create-button">
            </form>
        </div>
    </div>
</body>
<script>
        function addSubTask() {
            const inputContainer = document.getElementById("inputContainer");
            const inputDiv = document.createElement("div"); // Create a new div element
            const input = document.createElement("input");
            input.type = "text";
            input.name = "sub-tasks[]"; // You can specify the input name
            input.placeholder = "Enter sub task";
            inputDiv.appendChild(input); // Append the input to the div
            inputContainer.appendChild(inputDiv); // Append the div to the container
        }
    </script>
</html>
