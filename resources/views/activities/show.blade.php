@extends('layouts.app')

@section('title', 'Информация о занятии')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Заголовок -->
        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $activity->name }}</h1>
        <p class="mb-6 text-gray-700">{{ $activity->description }}</p>

        <!-- Организации -->
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Организации, предлагающие это занятие:</h2>
        <ul class="space-y-4">
            @foreach ($organizations as $organization)
                <li>
                    <!-- Оборачиваем весь блок в ссылку -->
                    <a href="{{ route('branches.index', $organization) }}"
                       class="block bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <!-- Название организации -->
                        <h3 class="text-lg font-medium text-gray-900">{{ $organization->name }}</h3>

                        <!-- Телефон -->
                        <p class="text-sm text-gray-600 mt-2">Телефон: {{ $organization->phone ?? 'Не указан' }}</p>
                    </a>
                </li>
            @endforeach
        </ul>

        <!-- Кнопка "Вернуться на главную" -->
        <a href="{{ route('home') }}"
           class="inline-block mt-6 py-3 px-6 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
            Вернуться на главную
        </a>
    </div>
@endsection
