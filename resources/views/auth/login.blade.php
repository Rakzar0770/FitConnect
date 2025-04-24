<x-guest-layout>
    <!-- Заголовок -->
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Вход</h1>
        <p class="text-lg text-gray-700">Введите свои данные для входа в систему.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Форма входа -->
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <div class="mt-1">
                <input id="email" name="email" type="email" autocomplete="email" required
                       class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       placeholder="Введите ваш email" value="{{ old('email') }}">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
            <div class="mt-1">
                <input id="password" name="password" type="password" autocomplete="current-password" required
                       class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       placeholder="Введите пароль">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
            </div>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" name="remember" type="checkbox"
                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                Запомнить меня
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            <!-- Ссылка "Забыли пароль?" -->
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="font-medium text-indigo-600 hover:text-indigo-500 text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                    Забыли пароль?
                </a>
            @endif

            <!-- Кнопка "Войти" -->
            <button type="submit"
                    class="w-auto flex justify-center py-3 px-6 border border-transparent rounded-md shadow-sm text-sm font-medium  bg-indigo-50 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-50 transition duration-300">
                Войти
            </button>
        </div>
    </form>

    <!-- Разделитель и кнопка регистрации -->
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            Нет аккаунта?
            <a href="{{ route('register') }}"
               class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                Зарегистрироваться
            </a>
        </p>
    </div>
</x-guest-layout>
