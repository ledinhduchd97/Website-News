<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{
	protected $fillable = [
        'user_id', 'tintuc_id', 'content'
    ];
    function tintuccmt(){
    	return $this->belongsto('App\Tintuc','tintuc_id');
    }
    function user(){
    	return $this->belongsto('App\User','user_id');
    }
    function isAuth(){
    	return $this->user_id==Auth::user()->id;
    }
}
