<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/log-in.css') }}">
    <title>User Login</title>
</head>
<body>
    <div class="full-page-container">
        <div class="login-container">
            <div class="language-switch">
                <a href="/lang?lang=en" title="Switch to English">EN</a>
                <a href="/lang?lang=ua" title="Switch to Ukrainian">UA</a>
            </div>

            <a href='/' class="main-page-link">{{__('app.Main Page')}}</a>
            
            <h1>{{ __('app.User Login') }}</h1>

            <form class="login-form" action="/login" method="post">
                @csrf
                @if ($message = Session::get('loginError'))
                    <div class="login-message">
                        {{ $message }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="name">{{ __('app.Username') }}</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="password">{{ __('app.Password') }}</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit">{{ __('app.Login') }}</button>
            </form>
        </div>
    </div>
</body>
</html>
