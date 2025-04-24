<x-guest-layout>
    <!-- Заголовок -->
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Регистрация</h1>
        <p class="text-lg text-gray-700">Создайте аккаунт, чтобы начать пользоваться сервисом.</p>
    </div>

    <!-- Форма регистрации -->
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Имя пользователя -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Имя пользователя</label>
            <div class="mt-1">
                <input id="name" name="name" type="text" autocomplete="name" required
                       class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       placeholder="Введите ваше имя" value="{{ old('name') }}">
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 text-sm" />
            </div>
        </div>

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
                <input id="password" name="password" type="password" autocomplete="new-password" required
                       class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       placeholder="Введите пароль">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
            </div>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Подтвердите пароль</label>
            <div class="mt-1">
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                       class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       placeholder="Подтвердите пароль">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-sm" />
            </div>
        </div>

        <!-- Кнопка регистрации -->
        <div>
            <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-md text-sm font-medium text-black bg-indigo-800 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                Зарегистрироваться
            </button>
        </div>

        <!-- Ссылка на страницу входа -->
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}"
               class="font-medium text-indigo-600 hover:text-indigo-500 text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                Уже зарегистрированы? Войти
            </a>
        </div>
    </form>
</x-guest-layout>
