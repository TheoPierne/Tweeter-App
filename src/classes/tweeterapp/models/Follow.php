<?php

namespace theop\tweeterapp\tweeterapp\models;

class Follow extends \Illuminate\Database\Eloquent\Model {

	protected $table = 'follow';
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $guarded = ['id'];

}