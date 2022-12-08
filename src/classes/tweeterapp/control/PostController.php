<?php

namespace theop\tweeterapp\tweeterapp\control;

use theop\tweeterapp\mf\control\AbstractController;
use theop\tweeterapp\mf\router\Router;
use theop\tweeterapp\tweeterapp\auth\TweeterAuthentification;
use theop\tweeterapp\tweeterapp\models\Tweet;
use theop\tweeterapp\tweeterapp\view\PostView;

class PostController  extends AbstractController {

	public function __construct(){
		parent::__construct();
	}

	public function execute(): void {
		if ($this->request->method === 'GET') {
			$view = new PostView();
			echo $view->makePage();
		} else if ($this->request->method === 'POST') {

			if (!empty($_POST['tweet'])){

				$tweetText = htmlspecialchars($_POST['tweet']);
				Tweet::create(['text' => $tweetText, 'author' => TweeterAuthentification::connectedUser()]);
				Router::executeRoute('home');

			} else {
				$view = new PostView();
				echo $view->makePage();
			}
		}
	}
}