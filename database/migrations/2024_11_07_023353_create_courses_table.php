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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('duration', 100);
            $table->text('description',250); // Tipo text para descrições longas
            $table->string('mode', 50); // Limite de caracteres para 'mode' (opcional)
            $table->date('start_date'); // Tipo date para datas
            $table->date('finish_date'); // Tipo date para datas
            $table->decimal('cost'); // Tipo decimal para valores monetários
            $table->string('image', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
