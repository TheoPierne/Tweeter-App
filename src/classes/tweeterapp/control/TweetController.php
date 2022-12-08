<?php

namespace theop\tweeterapp\tweeterapp\control;

use theop\tweeterapp\mf\control\AbstractController;
use theop\tweeterapp\tweeterapp\models\Tweet;
use theop\tweeterapp\tweeterapp\view\TweetView;

class TweetController extends AbstractController {

	public function __construct(){
		parent::__construct();
	}

	public function execute() : void {
		if (isset($_GET['id'])) {
			$req = Tweet::select()->where('id', '=', $_GET['id'])->with('full_author')->first();
			$view = new TweetView($req);
			echo $view->makePage();
		}
	}

}