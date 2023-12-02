<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    @include('inc/header')
    <a href='/'>{{__('app.Main Page')}}</a>
    
    <div class="container">
        <h1>{{ __('app.Create an Account') }}</h1>

        <form class="signup-form" action="/signup" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">{{ __('app.Username') }}</label>
                <input type="text" id="name" name="name" required>

                @if ($errors->has('name'))
                    <p class="error-message">{{$errors->first('name')}}</p>
                @endif

            </div>

            <div class="form-group">
                <label for="email">{{ __('app.Email') }}</label>
                <input type="email" id="email" name="email" required>

                @if ($errors->has('email'))
                    <p class="error-message">{{$errors->first('email')}}</p>
                @endif

            </div>

            <div class="form-group">
                <label for="password">{{ __('app.Password') }}</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="signup-button">{{ __('app.Signup') }}</button>

        </form>
    </div>
</body>
</html>
