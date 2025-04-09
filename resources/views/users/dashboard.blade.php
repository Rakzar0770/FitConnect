@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
    <h1 class="text-2xl font-bold mb-4">История записей</h1>

    <!-- Вывод флеш-сообщений -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($bookings->isEmpty())
        <p class="text-gray-700">У вас пока нет записей.</p>
    @else
        <ul class="space-y-3">
            @foreach ($bookings as $booking)
                <li class="bg-white p-4 rounded shadow-sm">
                    <p><strong>Занятие:</strong> {{ $booking->activity->name }}</p>
                    <p><strong>Филиал:</strong> {{ $booking->branch->address }}</p>
                    <p><strong>Тренер:</strong> {{ $booking->trainer->name }}</p>
                    <p><strong>Время:</strong> {{ $booking->booked_at }}</p>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
