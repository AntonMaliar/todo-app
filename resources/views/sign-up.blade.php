<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/sign-up.css')}}">
    <title>Sign Up</title>
</head>
<body>
    <div class="container">
        <h1>Create an Account</h1>
        <form class="signup-form" action="/sign-up" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
                @if ($errors->has('username'))
                    <p class="error-message">{{$errors->first('username')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <!-- Add a similar block for password error if needed -->
            </div>
            <button type="submit" class="signup-button">Sign Up</button>
        </form>
    </div>
</body>
</html>
