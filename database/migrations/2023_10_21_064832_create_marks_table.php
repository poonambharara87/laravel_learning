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
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stu_id')->unsigned()->nullable();
            $table->foreign('stu_id')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedInteger('hindi')->nullable();
            $table->unsignedInteger('english')->nullable();
            $table->unsignedInteger('math')->nullable();
            $table->unsignedInteger('drawing')->nullable();
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
        Schema::dropIfExists('marks');
    }
};
