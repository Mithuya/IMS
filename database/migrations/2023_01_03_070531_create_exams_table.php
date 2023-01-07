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
            $table->increments('id');
            $table->unsignedInteger('subject_id');
            $table->string('title');
            $table->string('description');
            $table->integer('duration');
            $table->unsignedInteger('examiner_id')->nullable();
            $table->unsignedInteger('invigilator_id')->nullable();
            $table->dateTime('date_time');
            $table->timestamps();


            $table->foreign('subject_id')
            ->references('id')
            ->on('subjects')
            ->onDelete('cascade');   //cascade if you delete subject, all exam related to that subject will delete

            $table->foreign('examiner_id')
            ->references('id')
            ->on('staff')
            ->nullOnDelete();

            $table->foreign('invigilator_id')
            ->references('id')
            ->on('staff')
            ->nullOnDelete();
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
