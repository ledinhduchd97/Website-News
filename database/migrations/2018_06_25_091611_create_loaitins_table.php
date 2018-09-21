<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoaitinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loaitins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tenloaitin');
            $table->string('ltkhongdau');
            $table->integer('theloai_id')->unsigned(); //id của thể loại
            $table->foreign('theloai_id')->references('id')->on('theloais')->onDelete('cascade'); //khóa ngoại
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
        Schema::dropIfExists('loaitins');
    }
}
