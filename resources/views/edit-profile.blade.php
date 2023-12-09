<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/edit-profile.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Edit Profile</title>
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
                <h1>{{ __('app.Edit Profile') }}</h1>
                <form action="/edit-profile" method="post" class="edit-profile-form">
                    @csrf
                    @method('PUT')
                    <div class="form-field">
                        <label for="name">{{__('app.Username')}}</label>
                        <input type="text" id="name" name="name" value="{{$user->name}}">
                    </div>
                    <div class="form-field">
                        <label for="email">{{__('app.Email')}}</label>
                        <input type="email" id="email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-field">
                        <label for="password">{{__('app.Password')}}</label>
                        <input type="password" id="password" name="password" value="{{$user->password}}">
                    </div>
                    <button type="submit" class="action-button">{{__('app.Edit Profile')}}</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
