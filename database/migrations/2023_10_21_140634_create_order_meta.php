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
        Schema::create('student_meta', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('stu_id')->unsigned()->nullable();
            $table->foreign('stu_id')->references('id')->on('students')->onDelete('cascade');

            $table->bigInteger('marks_id')->unsigned()->nullable();
            $table->foreign('marks_id')->references('id')->on('marks')->onDelete('cascade');
            
          
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
        Schema::dropIfExists('student_meta');
    }
};