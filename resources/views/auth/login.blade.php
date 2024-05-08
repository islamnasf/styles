<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e1e1e1;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
        }
        .form-group input[type="checkbox"] {
            margin-right: 5px;
        }
        .form-group button {
            padding: 12px 20px;
            background-color: #388e3c;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }
        .form-group button:hover {
            background-color: #2e7d32;
        }
        .form-group .error {
            color: red;
            font-size: 14px;
        }
        @media only screen and (max-width: 600px) {
            .container {
                max-width: 100%;
                padding: 10px;
            }
            .form-group button {
                padding: 12px 10px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top: 50px;">
        <h2 style="text-align: center; color: #388e3c;">Login</h2>
        <!-- Session Status -->
        <div class="status" style="text-align: center;">
            <!-- Display Session Status -->
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-group">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Remember me</label>
            </div>

            <div class="form-group">
                <button type="submit">Log in</button>
            </div>
        </form>
        @if (Route::has('password.request'))
            <!-- <a href="{{ route('password.request') }}" style="text-align: center; display: block; color: #388e3c;">Forgot your password?</a> -->
        @endif
    </div>
</body>
</html>
