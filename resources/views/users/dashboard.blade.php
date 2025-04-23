@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Заголовок с названием организации -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">FitConnect</h1>
            <p class="text-lg text-gray-700">Добро пожаловать в ваш личный кабинет!</p>
        </div>

        <!-- Ближайшие записи -->
        <h2 class="text-xl font-semibold text-blue-700 mb-3">Ближайшие записи</h2>
        @if ($upcomingBookings->isEmpty())
            <p class="text-gray-700 mb-6">У вас пока нет ближайших записей.</p>
        @else
            <div class="swiper mySwiper mb-6" style="overflow: hidden;">
                <div class="swiper-wrapper">
                    @foreach ($upcomingBookings as $booking)
                        <div class="swiper-slide bg-white p-4 rounded-lg shadow-md flex flex-col justify-between min-w-[300px] max-w-[400px]">
                            <!-- Название организации -->
                            <p class="text-sm font-medium text-gray-500 uppercase">Организация:</p>
                            <p class="font-bold text-lg mb-2">{{ $booking->branch->organization?->name ?? 'Неизвестная организация' }}</p>

                            <!-- Активность -->
                            <p class="text-sm font-medium text-gray-500 uppercase">Активность:</p>
                            <p class="text-gray-800 mb-2">{{ $booking->activity->name }}</p>

                            <!-- Адрес -->
                            <p class="text-sm font-medium text-gray-500 uppercase">Адрес:</p>
                            <p class="text-gray-800 mb-2">{{ $booking->branch->address }}</p>

                            <!-- Запись к -->
                            <p class="text-sm font-medium text-gray-500 uppercase">Запись к:</p>
                            <p class="text-gray-800 mb-2">{{ $booking->trainer->name }}</p>

                            <!-- Время -->
                            <p class="text-sm font-medium text-gray-500 uppercase">Время:</p>
                            <p class="text-gray-800"><strong>{{ \Carbon\Carbon::parse($booking->booked_at)->format('d.m.Y H:i') }}</strong></p>

                            <!-- Кнопка отмены записи -->
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

        <!-- История записей -->
        <h2 class="text-xl font-semibold text-gray-700 mb-3">История записей</h2>
        @if ($pastBookings->isEmpty())
            <p class="text-gray-700">У вас пока нет завершенных записей.</p>
        @else
            <ul class="space-y-4">
                @foreach ($pastBookings as $booking)
                    <li class="bg-white p-4 rounded-lg shadow-sm flex justify-between items-center">
                        <div>
                            <!-- Название организации -->
                            <p class="text-sm font-medium text-gray-500 uppercase">Организация:</p>
                            <p class="font-bold text-lg mb-2">{{ $booking->branch->organization?->name ?? 'Неизвестная организация' }}</p>

                            <!-- Активность -->
                            <p class="text-sm font-medium text-gray-500 uppercase">Активность:</p>
                            <p class="text-gray-800 mb-2">{{ $booking->activity->name }}</p>

                            <!-- Адрес -->
                            <p class="text-sm font-medium text-gray-500 uppercase">Адрес:</p>
                            <p class="text-gray-800 mb-2">{{ $booking->branch->address }}</p>

                            <!-- Запись к -->
                            <p class="text-sm font-medium text-gray-500 uppercase">Запись к:</p>
                            <p class="text-gray-800 mb-2">{{ $booking->trainer->name }}</p>

                            <!-- Время -->
                            <p class="text-sm font-medium text-gray-500 uppercase">Время:</p>
                            <p class="text-gray-800"><strong>{{ \Carbon\Carbon::parse($booking->booked_at)->format('d.m.Y H:i') }}</strong></p>
                        </div>

                        <!-- Кнопка удаления записи -->
                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-500 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300"
                                    onclick="return confirm('Вы уверены, что хотите удалить эту запись?')">
                                Удалить
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- JavaScript для инициализации Swiper -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiper = new Swiper('.mySwiper', {
                slidesPerView: 'auto', // Автоматическая ширина для корректного отображения
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
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    // when window width is >= 640px
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    // when window width is >= 768px
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    // when window width is >= 1024px
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 40,
                    },
                },
            });
        });
    </script>
@endsection
