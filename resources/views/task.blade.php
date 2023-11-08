<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/task.css') }}">
    <title>Task</title>
</head>
<body>
    @include('inc/header')
    <div class="container">
        <h1 class="task-title">{{ $task->title }}</h1>
        <div class="task-details">
            <h2 class="detail-description">Description: {{ $task->description }}</h2>
        </div>

        @if($task->subTasks())
            <div class="sub-tasks">
                <h2 class="sub-tasks-title">Sub-Tasks</h2>
                @foreach($task->subTasks as $st)
                    <div class="sub-task-item">
                        <span class="sub-task-text">{{ $st->description }}</span>
                        @if($st->status === 'in progress')
                            <a href="/complete-sub-task/{{$task->id}}/{{$st->id}}">Complete</a>
                        @else
                            <span>Completed</span>
                        @endif
                        <a href="/delete-sub-task/{{$task->id}}/{{$st->id}}" class="button delete-sub-task-button">Delete</a>
                    </div>
                @endforeach
            </div>
        @endif

        <button type="button" onclick="addSubTask()" class="button add-sub-button">Add Sub Task</button>
        
        <form action="/add-sub-task/{{$task->id}}" method="POST">
            @csrf
            <div id="inputContainer"></div>
            <button type="submit" class="button create-button">Create Sub Task</button>
        </form>

    </div>

    <script>
        function addSubTask() {
        const inputContainer = document.getElementById("inputContainer");
        const inputDiv = document.createElement("div");
        const input = document.createElement("input");
        inputDiv.classList.add("sub-task-item");
        input.type = "text";
        input.name = "sub_tasks[]";
        input.placeholder = "Enter sub task";
    
    // Create a delete button and add it to the sub-task item
        const deleteButton = document.createElement("button");
        deleteButton.type = "button";
        deleteButton.textContent = "Delete";
        deleteButton.classList.add("button", "delete-sub-task-button");
        deleteButton.addEventListener("click", function() {
        inputContainer.removeChild(inputDiv);
        });

        inputDiv.appendChild(input);
        inputDiv.appendChild(deleteButton);
        inputContainer.appendChild(inputDiv);
}

    </script>
</body>
</html>
