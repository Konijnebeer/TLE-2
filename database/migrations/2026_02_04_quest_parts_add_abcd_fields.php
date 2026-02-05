<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('parts', function (Blueprint $table) {
            $table->string('type')->default('text');
            $table->text('question_text')->nullable();
            $table->json('options')->nullable();
            $table->string('correct_answer')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('parts', function (Blueprint $table) {
            $table->dropColumn(['type', 'question_text', 'options', 'correct_answer']);
        });
    }
};

