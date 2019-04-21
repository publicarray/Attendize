<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnswerOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('answer_id')->index();
            $table->unsignedInteger('options_id')->index();
            $table->decimal('amount', 13, 2)->default(0.00);
            $table->foreign('answer_id')->references('id')->on('question_answers');
            $table->foreign('options_id')->references('id')->on('question_options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answer_options');
    }
}
