<?php

namespace theop\tweeterapp\mf\router;

use theop\tweeterapp\tweeterapp\auth\TweeterAuthentification;

class Router extends AbstractRouter {

	public function __construct(){
		parent::__construct();
	}

	public function addRoute(string $name, string $action, string $ctrl, int $level = TweeterAuthentification::ACCESS_LEVEL_NONE): void {
		self::$routes[$action] = [$ctrl, $level];
		self::$aliases[$name] = $action;
	}

	public function setDefaultRoute($action): void {
		self::$aliases['default'] = $action;
	}

	public function run(): void {
		if (isset($_GET['action'])) {
			$action = $_GET['action'];
			if (isset(self::$routes[$action])) {
				$level = self::$routes[$action][1];
				if (TweeterAuthentification::checkAccessRight($level)) {
					$ctrl = new self::$routes[$action][0];
					$ctrl->execute();
				} else {
					$ctrl = new self::$routes[self::$aliases['default']][0];
					$ctrl->execute();
				}
			} else {
				$ctrl = new self::$routes[self::$aliases['default']][0];
				$ctrl->execute();
			}
		} else {
			$ctrl = new self::$routes[self::$aliases['default']][0];
			$ctrl->execute();
		}
	}

	public function urlFor(string $name, array $params=[]): string {
		$act = isset(self::$aliases[$name]) ? self::$aliases[$name] : self::$aliases['default'];

		array_unshift($params, ['action' => $act]);
		$params = array_merge(...$params);

		$queryStr = http_build_query($params);
		$queryStr = strlen($queryStr) == 0 ? "" : "?".$queryStr;

		return $_SERVER['SCRIPT_NAME'].$queryStr;
	}

	static public function executeRoute(string $alias) {
		if (isset(self::$aliases[$alias])) {
			$ctrl = new self::$routes[self::$aliases[$alias]][0];
			$ctrl->execute();
		} else {
			$ctrl = new self::$routes[self::$aliases['default']][0];
			$ctrl->execute();
		}
	}

}