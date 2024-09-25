<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: sans-serif;
        }
        a {
            color: #666;
            font-size: 14px;
            display: block;
        }
        .login-title {
            text-align: center;
        }
        #login-page {
            display: flex;
        }
        .notice {
            font-size: 13px;
            text-align: center;
            color: #666;
        }
        .login {
            width: 40%;
            height: 100vh;
            background: #FFF;
            padding: 70px;
        }
        .login a {
            margin-top: 25px;
            text-align: center;
        }
        .form-login {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            align-content: center;
        }
        .form-login label {
            text-align: left;
            font-size: 13px;
            margin-top: 10px;
            margin-left: 20px;
            display: block;
            color: #666;
        }
        .input-email,
        .input-password {
            width: 100%;
            background: #ededed;
            border-radius: 25px;
            margin: 4px 0 10px 0;
            padding: 10px;
            display: flex;
        }
        .icon {
            padding: 4px;
            color: #666;
            min-width: 30px;
            text-align: center;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            border: 0;
            background: none;
            font-size: 16px;
            padding: 4px 0;
            outline: none;
        }
        button[type="submit"] {
            width: 100%;
            border: 0;
            border-radius: 25px;
            padding: 14px;
            background: #008552;
            color: #FFF;
            display: inline-block;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
            transition: ease all 0.3s;
        }
        button[type="submit"]:hover {
            opacity: 0.9;
        }
        .background {
            width: 60%;
            padding: 40px;
            height: 100vh;
            background: linear-gradient(60deg, rgba(158, 189, 19, 0.5), rgba(0, 133, 82, 0.7)), url('https://cdn.pixabay.com/photo/2016/03/09/09/22/workplace-1245776_960_720.jpg') center no-repeat;
            background-size: cover;
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: center;
        }
        .background h1 {
            max-width: 420px;
            color: #FFF;
            text-align: right;
            padding: 0;
            margin: 0;
        }
        .created {
            margin-top: 40px;
            text-align: center;
        }
        .created p {
            font-size: 13px;
            font-weight: bold;
            color: #008552;
        }
        .created a {
            color: #666;
            font-weight: normal;
            text-decoration: none;
            margin-top: 0;
        }
        .checkbox label {
            display: inline;
            margin: 0;
        }
        .content h2 {
            color: #fff;
            font-size: 9em;
            position: absolute;
            transform: translate(-50%, -50%);
            font-weight: bold;
        }
        .content h2:nth-child(1) {
            color: transparent;
            -webkit-text-stroke: 2px #0e5d38;
        }
        .content h2:nth-child(2) {
            color: #279763;
            animation: animate 4s ease-in-out infinite;
        }
        @keyframes animate {
            0%, 100% {
                clip-path: polygon(0% 45%, 16% 44%, 33% 50%, 54% 60%, 70% 61%, 84% 59%, 100% 52%, 100% 100%, 0% 100%);
            }
            50% {
                clip-path: polygon(0% 60%, 15% 65%, 34% 66%, 51% 62%, 67% 50%, 84% 45%, 100% 46%, 100% 100%, 0% 100%);
            }
        }
        .digital {
            text-transform: uppercase;
            transform: rotate(-20deg) skew(25deg);
            animation: blur 5s ease-in-out infinite;
            font-size: 29px;
            text-align: right;
            padding: 0;
            margin: 30% 0 0 0;
            position: absolute;
            color: #2c8b5f;
            font-weight: bold;
            text-shadow: -40px 40px 0 rgba(0,0,0,.2);
        }
    </style>
</head>
<body>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div id="login-page">
    <div class="login">
        <h2 class="login-title">Login</h2>
        <p class="notice">Please login to access the system</p>
        <form class="form-login" method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">E-mail</label>
            <div class="input-email">
                <i class="fas fa-envelope icon"></i>
                <input type="email" name="email" placeholder="Enter your e-mail" required>
            </div>
            <label for="password">Password</label>
            <div class="input-password">
                <i class="fas fa-lock icon"></i>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit"><i class="fas fa-door-open"></i> Sign in</button>
        </form>
    </div>
    <div class="background">
        <div class="content">
            <h2>CanGrow</h2>
            <h2>CanGrow</h2>
        </div>
        <p class="digital"> Digital Marketing </p>
    </div>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
