<?php

namespace theop\tweeterapp\tweeterapp\view;

use theop\tweeterapp\tweeterapp\view\TweeterView;
use theop\tweeterapp\mf\view\Renderer;
use theop\tweeterapp\tweeterapp\models\Tweet;

class TweetView extends TweeterView implements Renderer {

	public function render() : string {
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
			</div>
		</div>"
		EOL;
	}

}