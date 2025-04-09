@extends('layouts.app')

@section('title', 'Филиалы')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Филиалы организации "{{ $organization->name }}"</h1>

    <ul class="space-y-3">
        @foreach ($branches as $branch)
            <li class="bg-white p-4 rounded shadow-sm">
                <h2 class="text-xl font-semibold">{{ $branch->address }}</h2>
                <p class="text-gray-600">Телефон: {{ $branch->phone ?? 'Не указан' }}</p>

                <h3 class="text-lg font-medium mt-3">Активности:</h3>
                <ul class="list-disc ml-5">
                    @foreach ($branch->activities as $activity)
                        <li>{{ $activity->name }}</li>
                    @endforeach
                </ul>

                <h3 class="text-lg font-medium mt-3">Тренеры:</h3>
                <ul class="list-disc ml-5">
                    @foreach ($branch->trainers as $trainer)
                        <li>{{ $trainer->name }}</li>
                    @endforeach
                </ul>

                <!-- Кнопка "Записаться" -->
                <a href="{{ route('bookings.create.with-branch', ['branch_id' => $branch->id]) }}"
                   class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Записаться
                </a>
            </li>
        @endforeach
    </ul>
@endsection
