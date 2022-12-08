<?php

namespace theop\tweeterapp\tweeterapp\models;

use theop\tweeterapp\tweeterapp\models\Tweet;
use theop\tweeterapp\tweeterapp\models\User;

class User extends \Illuminate\Database\Eloquent\Model {

	protected $table = 'user';
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $guarded = ['id'];

	public function tweets() {
		return $this->hasMany(Tweet::class, 'author');
	}

	public function followedBy() {
        return $this->belongsToMany(User::class, 'follow', 'followee', 'follower');
    }

    public function follows() {
        return $this->belongsToMany(User::class, 'follow', 'follower', 'followee');
    }
	
}