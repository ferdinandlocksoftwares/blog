<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

	public function comments()
	{
		return $this->hasMany('App\Models\Comment', 'post_id');
	}

	// returns the instance of the user who is author of that post
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}

}
