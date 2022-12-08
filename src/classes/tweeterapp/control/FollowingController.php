<?php

namespace theop\tweeterapp\tweeterapp\control;

use theop\tweeterapp\mf\control\AbstractController;
use theop\tweeterapp\tweeterapp\models\User;
use theop\tweeterapp\tweeterapp\models\Follow;
use theop\tweeterapp\tweeterapp\view\FollowingView;
use theop\tweeterapp\tweeterapp\auth\TweeterAuthentification;

class FollowingController extends AbstractController {

	public function __construct(){
		parent::__construct();
	}

	public function execute() : void {
		if (isset($_GET['isFollowing'])) {

			['id' => $id, 'isFollowing' => $isFollowing] = $_GET;

			$flw = Follow::where('followee', '=', $id)->where('follower', '=', TweeterAuthentification::connectedUser())->first();

			if ($isFollowing == false) {
				if (!$flw) {

					Follow::create(['follower' => TweeterAuthentification::connectedUser(), 'followee' => $id]);

					$usr = User::where('id', '=', $id)->first();
					$nb = $usr['followers'];
					$usr['followers'] = $nb + 1;
					$usr->save();
				}
			} else if ($isFollowing == true) {
				$flw->delete();

				$usr = User::where('id', '=', $id)->first();
				$nb = $usr['followers'];
				$usr['followers'] = $nb - 1;
				$usr->save();
			}
		}
		$idUser = TweeterAuthentification::connectedUser();
		$user = User::where('id', '=', $idUser)->first();

		$view = new FollowingView($user);
		echo $view->makePage();
	}
}