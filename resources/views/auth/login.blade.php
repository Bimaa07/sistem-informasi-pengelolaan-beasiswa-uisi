<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

@vite(['resources/js/app.js'])

<body>
    <a href="{{ route('google.login') }}" class="btn btn-danger">
        <i class="fab fa-google"></i> Login dengan Google
    </a>

</body>

</html>
