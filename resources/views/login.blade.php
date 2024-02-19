<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login Page</title>

</head>

<body>
    <div class="login-container">
        <div class="login-left">
            <img src="assets/images/login.jpg" alt="Background" />
        </div>
        <div class="login-right">
            <div class="login-form">
                <h2>Login</h2>
                @if ($errors->any)
                <ul style="width: 100%; padding: 10px">
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif
                @if (Session('errorLogin'))
                <div style="width: 100%; padding: 10px">
                    <ul class="alert alert-success" role="alert">{{ session('errorLogin') }}</ul>
                </div>
                <!-- bisa pake Session::get('successAdd') kalo pake :: itu class, jadi harus kapital awalnya-->
                @endif
                <form action="{{route('auth')}}" method="post">
                    @csrf
                    <input type="email" name="email" placeholder="email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>