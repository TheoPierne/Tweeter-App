<?php

namespace theop\tweeterapp\tweeterapp\view;

use theop\tweeterapp\tweeterapp\view\TweeterView;
use theop\tweeterapp\mf\view\Renderer;
use theop\tweeterapp\tweeterapp\models\User;

class UserView extends TweeterView implements Renderer {

	public function render() : string {
		$str = "<h2>Tweets from {$this->data->username}</h2>";
		if ($this->data->followers > 0) {
			$follower = "follower" . ($this->data->followers > 1 ? 's' : '');
			$str .= "<h3>{$this->data->followers} {$follower}</h3>";
		}
		foreach ($this->data->tweets as $value) {
			$str .= "<div class='tweet'><a href='{$this->router->urlFor('view', [['id' => $value->id]])}'><div class='tweet-text'>$value->text</div></a><div class='tweet-footer'><span class='tweet-timestamp'>$value->created_at</span><span class='tweet-author'><a href='{$this->router->urlFor('user', [['id' => $value->author]])}'>{$this->data->username}</a></span></div></div>";
		}
		return $str;
	}

}