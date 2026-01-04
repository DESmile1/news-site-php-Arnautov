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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');            // Заголовок новини
            $table->text('short_text');       // Короткий опис
            $table->text('full_text');        // Повний текст
            $table->string('category');       // Категорія
            $table->string('image')->nullable(); // Шлях до фото
            $table->timestamps();             // Створює поля created_at та updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};