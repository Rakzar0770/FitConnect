@extends('layouts.app')

@section('title', 'Запись на занятие')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Заголовок с названием организации -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-indigo-900">FitConnect</h1>
            <p class="text-lg text-gray-700">Запишитесь на занятие прямо сейчас!</p>
        </div>

        <!-- Форма записи -->
        <form action="{{ route('bookings.view') }}" method="POST" class="bg-white p-8 rounded-2xl shadow-xl transition-all hover:shadow-2xl">
            @csrf

            <!-- Адрес -->
            <div class="mb-5">
                <label for="branch_id" class="block text-sm font-medium text-gray-700 mb-1">Адрес:</label>
                <select name="branch_id" id="branch_id" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300">
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}"
                                data-activities='@json($branch->activities)'
                                data-trainers='@json($branch->trainers)'
                            {{ isset($selectedBranch) && $selectedBranch->id == $branch->id ? 'selected' : '' }}>
                            {{ $branch->organization?->name ?? 'Неизвестная организация' }} ({{ $branch->address }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Активности -->
            <div class="mb-5">
                <label for="activity_id" class="block text-sm font-medium text-gray-700 mb-1">Активность:</label>
                <select name="activity_id" id="activity_id" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"></select>
            </div>

            <!-- Тренеры -->
            <div class="mb-5">
                <label for="trainer_id" class="block text-sm font-medium text-gray-700 mb-1">Запись к:</label>
                <select name="trainer_id" id="trainer_id" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"></select>
            </div>

            <!-- Дата -->
            <div class="mb-5">
                <label for="booked_at" class="block text-sm font-medium text-gray-700 mb-1">Дата и время:</label>
                <input type="datetime-local" name="booked_at" id="booked_at" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" required>
            </div>

            <!-- Кнопка отправки -->
            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-3 px-6 rounded-md hover:from-indigo-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-102">
                Записаться
            </button>
        </form>
    </div>

    <!-- JavaScript для динамического обновления активностей и тренеров -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const branchSelect = document.getElementById('branch_id');
            const activitySelect = document.getElementById('activity_id');
            const trainerSelect = document.getElementById('trainer_id');
            const bookedAtInput = document.getElementById('booked_at');

            // Функция для обновления списка активностей
            function updateActivities(activities) {
                activitySelect.innerHTML = ''; // Очищаем список
                activities.forEach(activity => {
                    const option = document.createElement('option');
                    option.value = activity.id;
                    option.textContent = activity.name;
                    activitySelect.appendChild(option);
                });
            }

            // Функция для обновления списка тренеров
            function updateTrainers(trainers) {
                trainerSelect.innerHTML = ''; // Очищаем список
                trainers.forEach(trainer => {
                    const option = document.createElement('option');
                    option.value = trainer.id;
                    option.textContent = trainer.name;
                    trainerSelect.appendChild(option);
                });
            }

            // Обработчик изменения филиала
            branchSelect.addEventListener('change', function () {
                const selectedOption = branchSelect.options[branchSelect.selectedIndex];
                const activities = JSON.parse(selectedOption.dataset.activities);
                const trainers = JSON.parse(selectedOption.dataset.trainers);

                updateActivities(activities);
                updateTrainers(trainers);
            });

            // Инициализация при загрузке страницы
            if (branchSelect.options.length > 0) {
                const initialOption = branchSelect.options[branchSelect.selectedIndex];
                const activities = JSON.parse(initialOption.dataset.activities);
                const trainers = JSON.parse(initialOption.dataset.trainers);

                updateActivities(activities || []);
                updateTrainers(trainers || []);
            }

            // Установка минимального времени для поля "booked_at"
            function setMinDateTime() {
                const now = new Date();
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0'); // Месяцы начинаются с 0
                const day = String(now.getDate()).padStart(2, '0');
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');

                bookedAtInput.min = `${year}-${month}-${day}T${hours}:${minutes}`;
            }

            // Вызываем функцию при загрузке страницы
            setMinDateTime();

            // Также можно обновлять минимальное время при изменении поля
            bookedAtInput.addEventListener('focus', setMinDateTime);
        });
    </script>
@endsection
