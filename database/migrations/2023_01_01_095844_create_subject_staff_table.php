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
        Schema::create('subject_staff', function (Blueprint $table) {
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('staff_id');

            $table->foreign('subject_id')
            ->references('id')
            ->on('subjects')
            ->onDelete('cascade');

            $table->foreign('staff_id')
            ->references('id')
            ->on('staff')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_staff');
    }
};
