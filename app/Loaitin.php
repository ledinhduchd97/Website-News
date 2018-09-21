<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loaitin extends Model
{
    //
    protected $fillable = [
        'tenloaitin', 'ltkhongdau', 'theloai_id'
    ];
    function theloai(){
    	return $this->belongsto('App\Theloai','theloai_id');
    }
    function tintuc(){
    	return $this->hasMany('App\Tintuc','loaitin_id');
    }
}
