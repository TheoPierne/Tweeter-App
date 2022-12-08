<?php

namespace theop\tweeterapp\tweeterapp\models;

use theop\tweeterapp\tweeterapp\models\User;

class Tweet extends \Illuminate\Database\Eloquent\Model {

	protected $table = 'tweet';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $guarded = ['id'];

	public function full_author() {
		return $this->belongsTo(User::class, 'author');
	}

}