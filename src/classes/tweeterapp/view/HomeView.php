<?php

namespace theop\tweeterapp\tweeterapp\view;

use theop\tweeterapp\tweeterapp\view\TweeterView;
use theop\tweeterapp\mf\view\Renderer;
use theop\tweeterapp\tweeterapp\models\User;

class HomeView extends TweeterView implements Renderer {

	public function render() : string {
		$str = '<h2>Latest Tweets</h2>';
		foreach ($this->data as $value) {
			$str .= "<div class='tweet'><a href='{$this->router->urlFor('view', [['id' => $value->id]])}'><div class='tweet-text'>$value->text</div></a><div class='tweet-footer'><span class='tweet-timestamp'>$value->created_at</span><span class='tweet-author'><a href='{$this->router->urlFor('user', [['id' => $value->author]])}'>{$value->full_author->username}</a></span></div></div>";
		}
		return $str;
	}	

}