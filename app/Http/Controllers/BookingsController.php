<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Branch;
use App\Models\Trainer;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function create($branch_id = null)
    {
        // Получаем все филиалы с привязанными активностями и тренерами
        $branches = Branch::with(['activities', 'trainers'])->get();

        // Если указан branch_id, находим конкретный филиал
        $selectedBranch = $branch_id ? Branch::with(['activities', 'trainers'])->findOrFail($branch_id) : null;

        return view('bookings.create', compact('branches', 'selectedBranch'));
    }

    public function store(Request $request)
    {
        // Валидация данных с кастомными сообщениями
        $validated = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'branch_id' => 'required|exists:branches,id',
            'trainer_id' => 'required|exists:trainers,id',
            'booked_at' => 'required|date',
        ], [
            'booked_at.required' => 'Вы не указали дату и время',
        ]);

        // Добавляем user_id текущего пользователя
        $validated['user_id'] = auth()->id();

        // Проверка, что выбранное время не занято
        $isTimeAvailable = !Booking::where('trainer_id', $validated['trainer_id'])
            ->where('booked_at', $validated['booked_at'])
            ->exists();

        if (!$isTimeAvailable) {
            return redirect()->back()->withErrors(['booked_at' => 'Это время уже занято. Пожалуйста, выберите другое время.']);
        }

        // Создание записи
        Booking::create($validated);

        // Перенаправление в личный кабинет с сообщением об успехе
        return redirect()->route('users.dashboard')->with('success', 'Вы успешно записались!');
    }
}
