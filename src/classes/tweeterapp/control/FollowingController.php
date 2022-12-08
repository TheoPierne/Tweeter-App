<?php

namespace theop\tweeterapp\tweeterapp\control;

use theop\tweeterapp\mf\control\AbstractController;
use theop\tweeterapp\tweeterapp\models\User;
use theop\tweeterapp\tweeterapp\view\FollowingView;
use theop\tweeterapp\tweeterapp\auth\TweeterAuthentification;

class FollowingController extends AbstractController {

	public function __construct(){
		parent::__construct();
	}

	public function execute() : void {

		$idUser = TweeterAuthentification::connectedUser();
		$user = User::where('id', '=', $idUser)->first();
		$data = $user->follows()->get();

		$view = new FollowingView($data);
		echo $view->makePage();
	}
}