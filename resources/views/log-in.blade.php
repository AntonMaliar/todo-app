<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/log-in.css')}}">
    <title>User Login</title>
</head>
<body>
    <div class="container">
        <h1>User Login</h1>
        <form class="login-form" action="/login" method="post">
            @csrf
            @if ($message = Session::get('loginError'))
                <div class="error-message">
                    {{ $message }}
                </div>
            @endif
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Log In</button>
        </form>
    </div>
</body>
</html>
