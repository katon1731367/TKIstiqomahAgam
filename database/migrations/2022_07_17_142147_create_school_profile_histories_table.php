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
            $table->integer('roomCount');
            $table->integer('teacherCount');
            $table->integer('ArchievementCount');
            $table->string('structureOrganization');
            $table->text('LandingPageInfo');
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
