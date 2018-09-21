<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->integer('user_id')->unsigned(); //id của user
            $table->foreign('user_id')->references('id')->on('users'); //khóa ngoại
            $table->integer('tintuc_id')->unsigned(); //id của loaitin
            $table->foreign('tintuc_id')->references('id')->on('tintucs')->onDelete('cascade');; //khóa ngoại
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
        Schema::dropIfExists('comments');
    }
}
