<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersQuestionnairesAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_questionnaires_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usersQuizAnswer_id');
            $table->integer('questionnaire_id');
            $table->string('answer');
            $table->boolean('status');
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
        Schema::dropIfExists('users_questionnaires_answers');
    }
}
