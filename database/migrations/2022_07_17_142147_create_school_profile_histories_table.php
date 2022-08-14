<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolProfileHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_profile_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('room_count');
            $table->integer('student_count');
            $table->integer('teacher_count');
            $table->integer('achievement_count');
            $table->string('structure_organization');
            $table->text('Landing_page_info');
            $table->text('visi');
            $table->text('misi');
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
        Schema::dropIfExists('school_profile_histories');
    }
}
