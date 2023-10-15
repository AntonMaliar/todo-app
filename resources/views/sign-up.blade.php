<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('css/welcome.css')}}">
    <title>User Sign Up</title>
</head>
<body>
    <header>
        <h1>User Sign Up</h1>
    </header>
    <div class="container">
        <form>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit" class="button">Sign Up</button>
        </form>
    </div>
</body>
</html>
