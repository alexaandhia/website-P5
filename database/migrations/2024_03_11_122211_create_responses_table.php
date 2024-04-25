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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            // $table->text('kesimpulan');
            // $table->text('jawaban');
            $table->timestamps();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
