<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('value', 255);
            $table->integer('answered_correct')->default(0);
            $table->integer('answered_false')->default(0);
            $table->softDeletes();

            $table->unsignedBigInteger('correct_answer')->nullable();
            $table->unsignedBigInteger('categories_id');

            $table->foreign('correct_answer')->references('id')->on('answers');
            $table->foreign('categories_id')->references('id')->on('categories');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
