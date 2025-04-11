@extends('layouts.app')

@section('title', 'Организации')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Организации для занятий</h1>

    <ul class="space-y-3">
        @foreach ($organizations as $organization)
            <li class="bg-white p-4 rounded shadow-sm">
                <h2 class="text-xl font-semibold"><a href="{{ route('branches.index', $organization) }}">{{ $organization->name }}</a></h2>
                <p class="text-gray-600">Телефон: {{ $organization->phone ?? 'Не указан' }}</p>
            </li>
        @endforeach
    </ul>
@endsection
