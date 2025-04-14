<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitConnect - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1e40af;
            color: white;
            padding: 15px 0;
        }
        .header a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #1e40af;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="container">
        <a href="{{ route('home') }}">Главная</a>
        <a href="{{ route('bookings.view', ['branch_id' => 1]) }}">Записаться</a>
        @auth
            <a href="{{ route('users.dashboard') }}">Личный кабинет</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: white; cursor: pointer;">
                    Выйти
                </button>
            </form>
        @else
            <a href="{{ route('login') }}">Вход</a>
            <a href="{{ route('register') }}">Регистрация</a>
        @endauth
    </div>
</div>

<div class="container">

    @if (session('success'))

    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</div>

<div class="footer">
    &copy; 2025 FitConnect. Все права защищены. Серёжа будет за них драться!
</div>
</body>
</html>
