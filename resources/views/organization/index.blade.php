@extends('layouts.app')

@section('title', 'Организации')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Организации для занятий</h1>

        <ul class="space-y-4">
            @foreach ($organizations as $organization)
                <a href="{{ route('branches.index', $organization) }}" class="block">
                    <li class="bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <h2 class="text-xl font-semibold text-gray-900">{{ $organization->name }}</h2>

                        <p class="text-sm text-gray-600 mt-2">Телефон: {{ $organization->phone ?? 'Не указан' }}</p>
                    </li>
                </a>
            @endforeach
        </ul>
    </div>
@endsection
