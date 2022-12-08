<?php

namespace theop\tweeterapp\tweeterapp\view;

use theop\tweeterapp\tweeterapp\view\TweeterView;
use theop\tweeterapp\mf\view\Renderer;
use theop\tweeterapp\tweeterapp\auth\TweeterAuthentification;
use theop\tweeterapp\tweeterapp\models\Tweet;
use theop\tweeterapp\tweeterapp\models\Follow;

class TweetView extends TweeterView implements Renderer {

	public function render() : string {

		$flw = Follow::where('followee', '=', $this->data->author)->where('follower', '=', TweeterAuthentification::connectedUser())->first();
		$isConnected = TweeterAuthentification::connectedUser() ? true : false;

		$isFollowing = $flw ? true : false;
		$imgFollow = $isFollowing ? 'unfollow' : 'follow';

		$followButton = '';

		if ($isConnected) {
			$followButton = <<<EOL
				<a class="tweet-control" href="{$this->router->urlFor('following', [['id' => $this->data->author], ['isFollowing' => $isFollowing]])}">
					<img alt="Follow" src="html/{$imgFollow}.png">
				</a>
			EOL;
		}

		return <<<EOL
		<div class='tweet'>
			<a href='{$this->router->urlFor('view', [['id' => $this->data->id]])}'>
				<div class='tweet-text'>
					{$this->data->text}
				</div>
			</a>
			<div class='tweet-footer'>
				<span class='tweet-timestamp'>{$this->data->created_at}</span>
				<span class='tweet-author'>
					<a href='{$this->router->urlFor('user', [['id' => $this->data->author]])}'>{$this->data->full_author->username}</a>
				</span>
			</div>
			<div class='tweet-footer'>
				<hr>
				<span class='tweet-score tweet-control'>{$this->data->score}</span>
				{$followButton}
			</div>
		</div>
		EOL;
	}

}