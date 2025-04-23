@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center text-gray-900 mb-6">Добро пожаловать в FitConnect!</h1>
        <p class="text-lg text-center text-gray-700 mb-8">Выберите занятие из списка ниже:</p>

        <!-- Список активностей -->
        <ul class="space-y-6">
            @foreach ($activities as $activity)
                <li class="block">
                    <!-- Оборачиваем весь блок в ссылку -->
                    <a href="{{ route('activities.show', $activity) }}"
                       class="block bg-gradient-to-br from-white to-gray-50 p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">{{ $activity->name }}</h2>
                        <p class="text-gray-600">{{ $activity->description }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
