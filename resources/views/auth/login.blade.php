<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <title>Login | Parksy</title>
</head>
<body>
    <div class="login-container">
        <h1 class="heading-main">Login</h1>
        <form action="{{route('login.store')}}" method="POST" class="login-form">
            @csrf
            <div class="form-container">
                <input type="email" class="login-form-input input" name="email" placeholder="Email" required>
            </div>
            <div class="form-container">
                <input type="password" class="login-form-input input" name="password" placeholder="Password" required>
            </div>
            <div class="form-container checkbox-container">
                <input type="checkbox" class="input" name="remember">
                <label for="remember" class="remember-label">Remember me</label>
            </div>
            <div class="error-container">
                @if (session('error'))
                    {{session('error')}}
                @endif
            </div>
            <div class="form-container button-container">
                <input type="submit" value="Login" name="submit" class="submit-button input">
            </div>
        </form>
    </div>
</body>
</html>