<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FocusMate</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }
        body {
            margin: 0;
            padding: 0;
            background: #f4f6f9;
            color: #333;
        }
        header {
            background: #3498db;
            color: white;
            padding: 20px;
            text-align: center;
        }
        nav {
            margin-top: 10px;
            text-align: center;
        }
        nav a {
            margin: 0 15px;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            padding: 40px;
            max-width: 1000px;
            margin: auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        footer {
            text-align: center;
            padding: 20px;
            background: #ecf0f1;
            color: #555;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <h1>🧠 FocusMate</h1>
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ url('/tasks') }}">Tasks</a>
            <a href="{{ url('/moods') }}">Moods</a>
            <a href="{{ url('/journals') }}">Journal</a>
            <a href="{{ route('motivation.index') }}">Daily Quote</a>
            <a href="{{ route('videos.index') }}">Motivational Video</a>
            <a href="{{ route('inspirational-image.index') }}">Inspirational Image</a>
            <a href="{{ route('habits.index') }}">Habit Tracker</a>
            <a href="{{ route('focus_music.index') }}">🎶 Focus Music</a>
            <a href="{{ route('focus.index') }}"> Set Focus</a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               Logout
            </a>
        </nav>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} FocusMate — All rights reserved.
    </footer>
</body>
</html>