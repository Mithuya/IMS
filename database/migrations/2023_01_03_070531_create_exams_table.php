<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('subjects')->cascadeOnDelete();
            $table->string('title');
            $table->string('description');
            $table->integer('duration');
            $table->foreignId('examiner_id')->nullable()->constrained('staff')->nullOnDelete();
            $table->foreignId('invigilator_id')->nullable()->constrained('staff')->nullOnDelete();
            $table->dateTime('date_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
};
