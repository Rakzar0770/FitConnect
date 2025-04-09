<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Связь с пользователем
            $table->foreignId('activity_id')->constrained()->onDelete('cascade'); // Связь с занятием
            $table->foreignId('branch_id')->constrained()->onDelete('cascade'); // Связь с филиалом
            $table->foreignId('trainer_id')->constrained()->onDelete('cascade'); // Связь с тренером
            $table->dateTime('booked_at'); // Дата и время записи
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
