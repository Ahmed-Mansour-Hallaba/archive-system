<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableBranch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('master_id')->nullable()->unsigned();
            $table->foreign('master_id')->references('id')->on('masters');
            $table->timestamps();

            // $table->integer('document_id')->nullable()->unsigned();
            // $table->foreign('document_id')->references('id')->on('documents');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch');
    }
}
