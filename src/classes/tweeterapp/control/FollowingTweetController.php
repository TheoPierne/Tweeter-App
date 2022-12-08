<?php

namespace theop\tweeterapp\tweeterapp\control;

use theop\tweeterapp\mf\control\AbstractController;
use theop\tweeterapp\tweeterapp\models\User;
use theop\tweeterapp\tweeterapp\models\Tweet;
use theop\tweeterapp\tweeterapp\view\FollowingTweetView;
use theop\tweeterapp\tweeterapp\auth\TweeterAuthentification;

class FollowingTweetController extends AbstractController {

	public function __construct(){
		parent::__construct();
	}

	public function execute() : void {
		$idUser = TweeterAuthentification::connectedUser();
        $user = User::where('id', '=', $idUser)->first();

        $follows = $user->follows()->get();
        $allFollowsId = [];
        foreach ($follows as $follow){
            $allFollowsId[] = $follow['id'];
        }

        $reqGetAllTweets = Tweet::select()->whereIn('author', $allFollowsId)->orderByDesc('updated_at')->get();

        $view = new FollowingTweetView($reqGetAllTweets);
        echo $view->makePage();
	}
}