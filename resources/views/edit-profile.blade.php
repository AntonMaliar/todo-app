<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    @include('inc/header')
    @include('inc/logout')

    <div class="container">
        <h1>{{__('app.Edit Profile')}}</h1>

        <form class="edit-profile-form" action="/edit-profile" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">{{__('app.Username')}}</label>
                <input type="text" id="name" name="name" value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="email">{{__('app.Email')}}</label>
                <input type="email" id="email" name="email" value="{{$user->email}}">
            </div>

            <div class="form-group">
                <label for="password">{{__('app.Password')}}</label>
                <input type="password" id="password" name="password" value="{{$user->password}}">
            </div>

            <button type="submit" class="update-profile-button">{{__('app.Edit Profile')}}</button>

        </form>
    </div>
</body>
</html>
