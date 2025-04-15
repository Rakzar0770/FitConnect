@extends('layouts.app')

@section('title', 'Информация о занятии')

@section('content')
{{--    <h1 class="text-2xl font-bold mb-4">{{ $activity->name }}</h1>--}}
{{--    <p class="mb-6 text-gray-700">{{ $activity->description }}</p>--}}

    <h2 class="text-xl font-semibold mb-3">Организации, предлагающие это занятие:</h2>
    <ul class="space-y-3">
        @foreach ($organizations as $organization)
            <li class="bg-white p-4 rounded shadow-sm">
                <h3 class="text-lg font-medium"><a href="{{ route('branches.index', $organization) }}">{{ $organization->name }}</a></h3>
                <p class="text-gray-600">Телефон: {{ $organization->phone ?? 'Не указан' }}</p>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('home') }}" class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Вернуться на главную
    </a>
@endsection
