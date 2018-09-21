<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTintucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tintucs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tieude');
            $table->string('tieudekhongdau');
            $table->text('tomtat');
            $table->longText('noidung');
            $table->string('hinh');
            $table->tinyInteger('noibat');
            $table->tinyInteger('tinnong');
            $table->integer('soluotxem');
            $table->tinyInteger('trangthai');
            $table->integer('user_id')->unsigned(); //id của user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //khóa ngoại
            $table->integer('loaitin_id')->unsigned(); //id của user
            $table->foreign('loaitin_id')->references('id')->on('loaitins')->onDelete('cascade'); //khóa ngoại
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
        Schema::dropIfExists('tintucs');
    }
}
