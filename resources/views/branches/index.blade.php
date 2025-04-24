@extends('layouts.app')

@section('title', 'Филиалы')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Заголовок -->
        <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Филиалы организации "{{ $organization->name }}"</h1>

        <!-- Список филиалов -->
        <ul class="space-y-6">
            @foreach ($branches as $branch)
                <li class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                    <!-- Адрес филиала -->
                    <h2 class="text-xl font-semibold text-gray-900">{{ $branch->address }}</h2>

                    <!-- Телефон -->
                    <p class="text-sm text-gray-600 mt-2">Телефон: {{ $branch->phone ?? 'Не указан' }}</p>

                    <!-- Активности -->
                    <h3 class="text-lg font-medium text-gray-700 mt-4">Активности:</h3>
                    <ul class="list-disc ml-5 space-y-1 text-gray-800">
                        @foreach ($branch->activities as $activity)
                            <li>{{ $activity->name }}</li>
                        @endforeach
                    </ul>

                    <!-- Тренеры -->
                    <h3 class="text-lg font-medium text-gray-700 mt-4">Тренеры:</h3>
                    <ul class="list-disc ml-5 space-y-1 text-gray-800">
                        @foreach ($branch->trainers as $trainer)
                            <li>{{ $trainer->name }}</li>
                        @endforeach
                    </ul>

                    <!-- Кнопка "Записаться" -->
                    @auth
                        <a href="{{ route('bookings.view', ['branch_id' => $branch->id]) }}"
                           class="inline-block mt-6 py-3 px-6 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                            Записаться
                        </a>
                    @endauth
                </li>
            @endforeach
        </ul>
    </div>
@endsection
