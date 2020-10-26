<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->string('subject');
            $table->string('sender');
            $table->string('reciever');
            $table->date('date');
            $table->string('copy_to')->nullable();
            $table->string('image')->nullable();
            $table->enum('user_type', [0, 1, 2])->default('0');
            $table->enum('type', [0, 1])->default('0');
            $table->integer('logged_user_id')->unsigned();
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
        Schema::dropIfExists('documents');
    }
}
