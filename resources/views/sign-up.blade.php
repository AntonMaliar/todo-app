<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sign-up.css') }}">
    <title>Sign Up</title>
</head>
<body>
    <div class="full-page-container">
        <div class="content-container">
            <div class="language-switch">
                <a href="/lang?lang=en" title="Switch to English">EN</a>
                <a href="/lang?lang=ua" title="Switch to Ukrainian">UA</a>
            </div>

            <a href='/'>{{__('app.Main Page')}}</a>
            
            <h1>{{ __('app.Create an Account') }}</h1>

            <form action="/signup" method="POST" class="signup-form">
                @csrf

                <div class="form-group">
                    <label for="name">{{ __('app.Username') }}</label>
                    <input type="text" id="name" name="name" required>

                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">{{ __('app.Email') }}</label>
                    <input type="email" id="email" name="email" required>

                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('app.Password') }}</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit">{{ __('app.Signup') }}</button>
            </form>
        </div>
    </div>
</body>
</html>
