<?php

namespace theop\tweeterapp\tweeterapp\models;

class Like extends \Illuminate\Database\Eloquent\Model {

	protected $table = 'like';
	protected $primaryKey = 'id';
	public $timestamps = false;

}