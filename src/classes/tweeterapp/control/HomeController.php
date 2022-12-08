<?php

namespace theop\tweeterapp\tweeterapp\control;

use theop\tweeterapp\mf\control\AbstractController;
use theop\tweeterapp\tweeterapp\models\Tweet;
use theop\tweeterapp\tweeterapp\view\HomeView;

class HomeController extends AbstractController {

	public function __construct(){
		parent::__construct();
	}

	public function execute() : void {
		$req = Tweet::select()->with('full_author')->orderByDesc('updated_at')->get();
		$view = new HomeView($req);
		echo $view->makePage();
	}
}