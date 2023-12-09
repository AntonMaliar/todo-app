<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Todo App</title>
</head>
<body>
    <div class="full-page-container">
        <div class="content-container">
            <div class="language-switch">
                <a href="/lang?lang=en" title="Switch to English">EN</a>
                <a href="/lang?lang=ua" title="Switch to Ukrainian">UA</a>
            </div>
            <div class="content">
                <h1>{{ __('app.Welcome to the Todo App') }}</h1>
                <div class="action-buttons">
                    <a href="/login">{{ __('app.Login') }}</a>
                    <a href="/signup">{{ __('app.Signup') }}</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
