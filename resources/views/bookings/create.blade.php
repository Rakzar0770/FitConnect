@extends('layouts.app')

@section('title', 'Запись на занятие')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Запись на занятие</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bookings.view') }}" method="POST" class="bg-white p-6 rounded shadow-sm">
        @csrf

        <!-- Филиал -->
        <div class="mb-4">
            <label for="branch_id" class="block text-gray-700 font-medium mb-2">Филиал:</label>
            <select name="branch_id" id="branch_id" class="w-full p-2 border rounded">
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}"
                            data-activities='@json($branch->activities)'
                            data-trainers='@json($branch->trainers)'
                        {{ isset($selectedBranch) && $selectedBranch->id == $branch->id ? 'selected' : '' }}>
                        {{ $branch->address }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Активности -->
        <div class="mb-4">
            <label for="activity_id" class="block text-gray-700 font-medium mb-2">Активность:</label>
            <select name="activity_id" id="activity_id" class="w-full p-2 border rounded"></select>
        </div>

        <!-- Тренеры -->
        <div class="mb-4">
            <label for="trainer_id" class="block text-gray-700 font-medium mb-2">Тренер:</label>
            <select name="trainer_id" id="trainer_id" class="w-full p-2 border rounded"></select>
        </div>

        <!-- Время -->
        <div class="mb-4">
            <label for="booked_at" class="block text-gray-700 font-medium mb-2">Время:</label>
            <input type="datetime-local" name="booked_at" id="booked_at" class="w-full p-2 border rounded" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Записаться
        </button>
    </form>

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
