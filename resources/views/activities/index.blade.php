@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Добро пожаловать в FitConnect!</h1>
    <p class="mb-6 text-gray-700">Выберите занятие из списка ниже:</p>

    <ul class="space-y-3">
        @foreach ($activities as $activity)
            <li class="bg-white p-4 rounded shadow-sm">
                <h2 class="text-xl font-semibold"><a href="{{ route('activities.show', $activity) }}">{{ $activity->name }}</a></h2>
                <p class="text-gray-600">{{ $activity->description }}</p>
            </li>
        @endforeach
    </ul>
@endsection
