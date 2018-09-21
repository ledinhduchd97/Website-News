<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theloai extends Model
{
    //
    protected $fillable = [
        'tentheloai', 'tlkhongdau'
    ];
    function loaitin(){
    	return $this->hasMany('App\Loaitin','theloai_id');
    }
}
