<?php

namespace theop\tweeterapp\mf\utils;

use theop\tweeterapp\mf\utils\AbstractHttpRequest;

class HttpRequest extends AbstractHttpRequest {

	public function __construct(){
		$this->script_name = $_SERVER['SCRIPT_NAME'];
		$this->path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : null;
		$this->root = isset($_SERVER['SCRIPT_NAME']) ? dirname($_SERVER['SCRIPT_NAME']) : null;
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->get = $_GET;
		$this->post = $_POST;
	}

}