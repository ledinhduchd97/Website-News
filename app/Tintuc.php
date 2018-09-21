<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tintuc extends Model
{
	 protected $fillable = [
        'loaitin_id', 'tieude', 'tieudekhongdau','tomtat','noidung','hinh','noibat','user_id','soluotxem','trangthai','tinnong'
    ];
    function tintuctl(){
    	return $this->belongsto('App\Loaitin','loaitin_id');
    }
    function comment(){
    	return $this->hasMany('App\Comment','tintuc_id');
    }
    function usertintuc(){
    	return $this->belongsto('App\User','user_id');
    }
}
