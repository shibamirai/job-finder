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
        Schema::create('job_finders', function (Blueprint $table) {
            $table->id();
            $table->string('avatar');
            $table->string('name');
            $table->integer('gender')->default(0);
            $table->integer('age');
            $table->boolean('has_certificate')->default(false);
            $table->date('use_from');
            $table->foreignId('occupation_id')->constrained();
            $table->string('description')->nullable();
            $table->date('hired_at');
            $table->integer('employment_pattern');
            $table->boolean('is_handicaps_opened');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_finders');
    }
};
