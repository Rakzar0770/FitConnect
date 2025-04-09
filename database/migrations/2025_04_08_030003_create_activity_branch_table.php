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
        Schema::create('activity_branch', function (Blueprint $table) {
            $table->foreignId('activity_id')->constrained()->onDelete('cascade'); // Связь с активностью
            $table->foreignId('branch_id')->constrained()->onDelete('cascade'); // Связь с филиалом
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_branch');
    }
};
