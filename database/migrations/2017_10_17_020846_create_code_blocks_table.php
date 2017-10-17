<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeBlocksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('programminglanguge_id');
            $table->integer('template_id');
            $table->string('code_file');
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
        Schema::dropIfExists('code_blocks');
    }
}