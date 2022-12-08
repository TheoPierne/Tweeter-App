<?php

namespace theop\tweeterapp\tweeterapp\control;

use theop\tweeterapp\mf\control\AbstractController;
use theop\tweeterapp\mf\router\Router;
use theop\tweeterapp\tweeterapp\auth\TweeterAuthentification;

class LogoutController extends AbstractController {

	public function __construct(){
		parent::__construct();
	}

	public function execute() : void {
		session_destroy();
		TweeterAuthentification::logout();
		Router::executeroute('home');
	}
}