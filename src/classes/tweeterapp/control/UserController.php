<?php

namespace theop\tweeterapp\tweeterapp\control;

use theop\tweeterapp\mf\control\AbstractController;
use theop\tweeterapp\tweeterapp\models\Tweet;
use theop\tweeterapp\tweeterapp\models\User;
use theop\tweeterapp\tweeterapp\view\UserView;

class UserController extends AbstractController {

	public function __construct(){
		parent::__construct();
	}

	public function execute() : void {
		if (isset($_GET['id'])) {
			$req = User::select()->where('id', '=', $_GET['id'])->with('tweets')->first();
			$view = new UserView($req);
			echo $view->makePage();
		}
	}

}