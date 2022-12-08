<?php

namespace theop\tweeterapp\tweeterapp\control;

use theop\tweeterapp\mf\control\AbstractController;
use theop\tweeterapp\mf\exceptions\AuthentificationException;
use theop\tweeterapp\mf\router\Router;
use theop\tweeterapp\tweeterapp\view\LoginView;
use theop\tweeterapp\tweeterapp\auth\TweeterAuthentification;

class LoginController extends AbstractController {

	public function __construct(){
		parent::__construct();
	}

	public function execute() : void {

		if ($this->request->method === 'GET') {

			$view = new LoginView();
			echo $view->makePage();

		} else if ($this->request->method === 'POST') {

			['username' => $username, 'password' => $password ] = $_POST;

			try {

				if (empty($username) || empty($password)) {
					throw new AuthentificationException("Vous n'avez pas fourni toutes les informations demandées dans le formulaire d'inscription.");
				}

				TweeterAuthentification::login($username, $password);
				Router::executeroute('following');

			} catch(AuthentificationException $e) {
				echo $e->getMessage();
				$view = new LoginView(['inputValue' => ['username' => $username]]);
				echo $view->makePage();
			}
		}
	}
}