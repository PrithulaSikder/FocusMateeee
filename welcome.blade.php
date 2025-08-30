<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to FocusMate</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f5f7fa;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background: white;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.5rem;
            color: #2c3e50;
        }
        p {
            margin-top: 10px;
            font-size: 1.1rem;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            background: #3498db;
            color: white;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 8px;
        }
        a:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to FocusMate 👋</h1>
        <p>Your personal productivity and mental wellness companion</p>
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}" style="margin-left: 10px;">Register</a>
    </div>
</body>
</html>
