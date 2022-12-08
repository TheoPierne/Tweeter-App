<?php

namespace theop\tweeterapp\tweeterapp\auth;

use theop\tweeterapp\mf\auth\AbstractAuthentification;
use theop\tweeterapp\mf\exceptions\AuthentificationException;
use theop\tweeterapp\tweeterapp\models\User;

class TweeterAuthentification extends AbstractAuthentification {

	const ACCESS_LEVEL_USER = 100;
	const ACCESS_LEVEL_ADMIN = 200;

	public static function register(string $username, string $password,	string $fullname, $level=self::ACCESS_LEVEL_USER): void {
		$user = User::where('username', '=', $username)->first();

		if (isset($user)) {
			throw new AuthentificationException("Le pseudo est déjà utilisé.");
		} else {
			$hash = self::makePassword($password);
			$username = htmlspecialchars($username);
			$fullname = htmlspecialchars($fullname);
			User::create(['fullname' => $fullname, 'username' => $username, 'level' => $level, 'password' => $hash]);
		}
	}

	public static function login(string $username, string $password): void {
		$user = User::where('username', '=', $username)->first();

		if (!isset($user)) {
			throw new AuthentificationException("Aucun compte n'a été trouvé.");
		} else {
			self::checkPassword($password, $user['password'], $user['id'], $user['level']);
		}
	}

}