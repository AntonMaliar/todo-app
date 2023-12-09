<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/task.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Task</title>
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
                <h1>{{ $task->title }}</h1>
                <div>
                    <h2>{{ __('app.Description') }}: {{ $task->description }}</h2>
                </div>

                @if($task->subTasks->isNotEmpty())
                    <div class="sub-tasks-container">
                        <h2>{{ __('app.Sub-Tasks List') }}</h2>

                        @foreach($task->subTasks as $st)
                            <div class="sub-task-item">
                                <span class="sub-task-description">{{ $st->description }}</span>

                                <div class="button-container">
                                    @if($st->status === 'in progress')
                                        <form action="/complete-sub-task/{{$task->id}}/{{$st->id}}" method="get" class="action-form">
                                            <button type="submit" class="action-button complete-button">{{ __('app.Complete') }}</button>
                                        </form>
                                    @else
                                        <span class="completed">{{ __('app.Completed') }}</span>
                                    @endif

                                    <form action="/delete-sub-task/{{$task->id}}/{{$st->id}}" method="get" class="action-form">
                                        <button type="submit" class="action-button delete-button">{{ __('app.Delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <button type="button" onclick="addSubTask()">{{ __('app.Add Sub Task') }}</button>

                <form action="/add-sub-task/{{$task->id}}" method="POST" class="add-sub-task-form">
                    @csrf

                    <div id="inputContainer" class="sub-task-container"></div>

                    <button type="submit" class="action-button">{{ __('app.Create Sub Task') }}</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addSubTask() {
            const inputContainer = document.getElementById("inputContainer");
            const inputDiv = document.createElement("div");
            const input = document.createElement("input");
            inputDiv.classList.add("sub-task-item");
            input.type = "text";
            input.name = "sub_tasks[]";
            input.placeholder = "{{ __('app.Enter sub task') }}";

            // Create a delete button and add it to the sub-task item
            const deleteButton = document.createElement("button");
            deleteButton.type = "button";
            deleteButton.textContent = "{{ __('app.Delete') }}";
            deleteButton.classList.add("button", "delete-sub-task-button");
            deleteButton.addEventListener("click", function () {
                inputContainer.removeChild(inputDiv);
            });

            inputDiv.appendChild(input);
            inputDiv.appendChild(deleteButton);
            inputContainer.appendChild(inputDiv);
        }

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
