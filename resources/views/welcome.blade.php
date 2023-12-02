<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
</head>
<body>
    <div class="container">
        @include('inc/header')
        <h1>{{ __('app.Welcome to the Todo App') }}</h1>
        <div class="btn-container">
            <a href="/login" class="btn">{{ __('app.Login') }}</a>
            <a href="/signup" class="btn">{{ __('app.Signup') }}</a>
        </div>
    </div>
</body>
</html>
