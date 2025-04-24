@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">FitConnect</h1>
            <p class="text-lg text-gray-700">Добро пожаловать в ваш личный кабинет!</p>
        </div>

        <h2 class="text-xl font-semibold text-blue-700 mb-3">Ближайшие записи</h2>
        <div id="upcoming-bookings-container">
            @if ($upcomingBookings->isEmpty())
                <p class="text-gray-700 mb-6 no-upcoming-message">У вас пока нет ближайших записей.</p>
            @else
                <div class="swiper mySwiper mb-6" style="overflow: hidden;">
                    <div class="swiper-wrapper">
                        @foreach ($upcomingBookings as $booking)
                            <div
                                class="swiper-slide bg-white p-4 rounded-lg shadow-md flex flex-col justify-between min-w-[300px] max-w-[400px] upcoming-booking"
                                data-booked-at="{{ $booking->booked_at }}">
                                <!-- Название организации -->
                                <p class="text-sm font-medium text-gray-500 uppercase">Организация:</p>
                                <p class="font-bold text-lg mb-2">{{ $booking->branch->organization?->name ?? 'Неизвестная организация' }}</p>

                                <p class="text-sm font-medium text-gray-500 uppercase">Активность:</p>
                                <p class="text-gray-800 mb-2">{{ $booking->activity->name }}</p>

                                <p class="text-sm font-medium text-gray-500 uppercase">Адрес:</p>
                                <p class="text-gray-800 mb-2">{{ $booking->branch->address }}</p>

                                <p class="text-sm font-medium text-gray-500 uppercase">Запись к:</p>
                                <p class="text-gray-800 mb-2">{{ $booking->trainer->name }}</p>

                                <p class="text-sm font-medium text-gray-500 uppercase">Время:</p>
                                <p class="text-gray-800">
                                    <strong>{{ \Carbon\Carbon::parse($booking->booked_at)->format('d.m.Y H:i') }}</strong>
                                </p>

                                <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="mt-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full py-2 px-4 bg-white border border-red-500 text-red-500 rounded hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300"
                                            onclick="return confirm('Вы уверены, что хотите отменить эту запись?')">
                                        Отменить запись
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            @endif
        </div>

        <!-- История записей -->
        <h2 class="text-xl font-semibold text-gray-700 mb-3">История записей</h2>
        <div id="past-bookings-container">
            <ul class="space-y-4 past-bookings-list">
                @if ($pastBookings->isEmpty())
                    <p class="text-gray-700 no-past-message">У вас пока нет завершенных записей.</p>
                @else
                    @foreach ($pastBookings as $booking)
                        <li class="bg-white p-4 rounded-lg shadow-sm flex flex-col relative border border-gray-200">
                            <!-- Плашка "Завершено" -->
                            <div
                                class="absolute top-0 left-0 w-full h-8 bg-black bg-opacity-70 flex items-center justify-center text-white font-bold text-xs rounded-t-lg">
                                Завершено
                            </div>

                            <div class="flex-grow pt-8">
                                <p class="text-sm font-medium text-gray-500 uppercase">Организация:</p>
                                <p class="font-bold text-base mb-2">{{ $booking->branch->organization?->name ?? 'Неизвестная организация' }}</p>

                                <p class="text-sm font-medium text-gray-500 uppercase">Активность:</p>
                                <p class="text-gray-800 mb-2">{{ $booking->activity->name }}</p>

                                <p class="text-sm font-medium text-gray-500 uppercase">Адрес:</p>
                                <p class="text-gray-800 mb-2">{{ $booking->branch->address }}</p>

                                <p class="text-sm font-medium text-gray-500 uppercase">Запись к:</p>
                                <p class="text-gray-800 mb-2">{{ $booking->trainer->name }}</p>

                                <p class="text-sm font-medium text-gray-500 uppercase">Время:</p>
                                <p class="text-gray-800">
                                    <strong>{{ \Carbon\Carbon::parse($booking->booked_at)->format('d.m.Y H:i') }}</strong>
                                </p>
                            </div>

                            <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="mt-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full py-2 px-4 bg-white border border-red-500 text-red-500 rounded hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300">
                                    Удалить
                                </button>
                            </form>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function isTimePassed(bookedAt) {
                const now = new Date();
                const bookingTime = new Date(bookedAt);
                return bookingTime < now;
            }

            // Перемещение записей
            const upcomingBookings = document.querySelectorAll('.upcoming-booking');
            const historyList = document.querySelector('.past-bookings-list');

            upcomingBookings.forEach(booking => {
                const bookedAt = booking.dataset.bookedAt;

                if (isTimePassed(bookedAt)) {
                    const listItem = document.createElement('li');
                    listItem.className = 'bg-white p-4 rounded-lg shadow-sm flex flex-col relative border border-gray-200';

                    const completedOverlay = document.createElement('div');
                    completedOverlay.className = 'absolute top-0 left-0 w-full h-8 bg-black bg-opacity-70 flex items-center justify-center text-white font-bold text-xs rounded-t-lg';
                    completedOverlay.textContent = 'Завершено';
                    listItem.appendChild(completedOverlay);

                    const content = booking.cloneNode(true);
                    content.classList.remove('swiper-slide');
                    content.classList.add('flex', 'flex-col', 'pt-8');

                    const cancelButton = content.querySelector('form');
                    if (cancelButton) {
                        cancelButton.remove();
                    }

                    // Добавляем кнопку "Удалить"
                    const deleteButton = document.createElement('form');
                    deleteButton.action = booking.querySelector('form').action;
                    deleteButton.method = 'POST';
                    deleteButton.innerHTML = `
                        @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full py-2 px-4 bg-white border border-red-500 text-red-500 rounded hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300 mt-4"
                            onclick="return confirm('Вы уверены, что хотите удалить эту запись?')">
                        Удалить
                    </button>
`;
                    content.appendChild(deleteButton);

                    listItem.appendChild(content);

                    if (historyList) {
                        historyList.appendChild(listItem);
                        booking.remove();
                    } else {
                        booking.remove();
                    }
                }
            });

            function updateEmptyMessages() {
                const upcomingContainer = document.getElementById('upcoming-bookings-container');
                const pastContainer = document.getElementById('past-bookings-container');

                // Проверяем, есть ли ближайшие записи
                const hasUpcomingBookings = upcomingContainer.querySelector('.upcoming-booking') !== null;
                if (!hasUpcomingBookings && !upcomingContainer.querySelector('.no-upcoming-message')) {
                    const message = document.createElement('p');
                    message.className = 'text-gray-700 mb-6 no-upcoming-message';
                    message.textContent = 'У вас пока нет ближайших записей.';
                    upcomingContainer.appendChild(message);
                } else if (hasUpcomingBookings) {
                    const message = upcomingContainer.querySelector('.no-upcoming-message');
                    if (message) {
                        message.remove();
                    }
                }

                const hasPastBookings = pastContainer.querySelector('.past-bookings-list li') !== null;
                if (!hasPastBookings && !pastContainer.querySelector('.no-past-message')) {
                    const message = document.createElement('p');
                    message.className = 'text-gray-700 no-past-message';
                    message.textContent = 'У вас пока нет завершенных записей.';
                    pastContainer.querySelector('.past-bookings-list').appendChild(message);
                } else if (hasPastBookings) {
                    const message = pastContainer.querySelector('.no-past-message');
                    if (message) {
                        message.remove();
                    }
                }
            }

            updateEmptyMessages();

            const swiper = new Swiper('.mySwiper', {
                slidesPerView: 'auto',
                spaceBetween: 30,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    320: {slidesPerView: 1, spaceBetween: 20},
                    640: {slidesPerView: 1, spaceBetween: 25},
                    768: {slidesPerView: 2, spaceBetween: 20},
                    1024: {slidesPerView: 2, spaceBetween: 20},
                },
            });
        });
    </script>
@endsection
