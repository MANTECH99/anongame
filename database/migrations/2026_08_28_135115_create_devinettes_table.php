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
        Schema::create('devinettes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->text('question');
            $table->string('answer');
            $table->string('category')->default('general');
            $table->string('slug', 100)->unique();
            $table->string('hint')->nullable();
            $table->boolean('is_public')->default(true);
            $table->unsignedInteger('challenges')->default(0);
            $table->unsignedInteger('successes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devinettes');
    }
};
