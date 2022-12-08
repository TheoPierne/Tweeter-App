<?php

namespace theop\tweeterapp\tweeterapp\control;

use theop\tweeterapp\mf\control\AbstractController;
use theop\tweeterapp\mf\exceptions\AuthentificationException;
use theop\tweeterapp\mf\router\Router;
use theop\tweeterapp\tweeterapp\models\Tweet;
use theop\tweeterapp\tweeterapp\view\SignupView;
use theop\tweeterapp\tweeterapp\auth\TweeterAuthentification;

class SignupController extends AbstractController {

	public function __construct(){
		parent::__construct();
	}

	public function execute() : void {

		if ($this->request->method === 'GET') {

			$view = new SignupView();
			echo $view->makePage();

		} else if ($this->request->method === 'POST') {

			['fullname' => $fullname, 'username' => $username, 'password' => $password, 'password_verify' => $password_verify] = $_POST;

			try {

				if (empty($fullname) || empty($username) || empty($password) || empty($password_verify)) {
					throw new AuthentificationException("Vous n'avez pas fourni toutes les informations demandées dans le formulaire d'inscription.");
				}

				if ($password !== $password_verify) {
					throw new AuthentificationException("Les deux mot de passe ne sont pas identiques.");
				}

				TweeterAuthentification::register($username, $password, $fullname);
				Router::executeRoute('login');

			} catch(AuthentificationException $e) {
				echo $e->getMessage();
				$view = new SignupView(['inputValues' => ['fullname' => $fullname, 'username' => $username]]);
				echo $view->makePage();
			}
		}
	}
}