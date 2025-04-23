<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitConnect - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <style>
        /* Общие стили */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Минимальная высота страницы */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            flex: 1; /* Контент растягивается, чтобы заполнить доступное пространство */
        }

        /* Шапка */
        .header {
            background-color: #1e40af;
            color: white;
            padding: 15px 0;
        }

        .header a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .header a:hover {
            color: #b6c1ff; /* Светло-синий при наведении */
        }

        .header form button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .header form button:hover {
            color: #b6c1ff; /* Светло-синий при наведении */
        }

        /* Уведомления */
        .notification {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .notification.success {
            background-color: #d1fae5;
            border: 1px solid #10b981;
            color: #059669;
        }

        .notification.error {
            background-color: #fee2e2;
            border: 1px solid #fca5a5;
            color: #b91c1c;
        }

        /* Подвал */
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #1e40af;
            color: white;
        }
    </style>
</head>
<body>
<!-- Шапка -->
<div class="header">
    <div class="container">
        <a href="{{ route('home') }}">Главная</a>
        @auth
            <a href="{{ route('bookings.view') }}">Записаться</a>
            <a href="{{ route('users.dashboard') }}">Личный кабинет</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Выйти</button>
            </form>
        @else
            <a href="{{ route('login') }}">Вход</a>
            <a href="{{ route('register') }}">Регистрация</a>
        @endauth
    </div>
</div>

<!-- Основной контент -->
<div class="container">
    <!-- Уведомления -->
    @if (session('success'))
        <div class="notification success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="notification error">
            {{ session('error') }}
        </div>
    @endif

    <!-- Основной контент страницы -->
    @yield('content')
</div>

<!-- Подвал -->
<div class="footer">
    &copy; 2025 FitConnect. Все права защищены.
</div>
</body>
</html>
