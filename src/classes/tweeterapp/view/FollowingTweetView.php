<?php

namespace theop\tweeterapp\tweeterapp\view;

use theop\tweeterapp\tweeterapp\view\TweeterView;
use theop\tweeterapp\mf\view\Renderer;
use theop\tweeterapp\tweeterapp\auth\TweeterAuthentification;
use theop\tweeterapp\tweeterapp\models\Tweet;
use theop\tweeterapp\tweeterapp\models\Follow;

class FollowingTweetView extends TweeterView implements Renderer {

	public function render(): string {

		$tweets = $this->data;

		$html = '<article class="theme-backcolor2"><h2>Derniers Tweets des Follows </h2>';

		foreach ($tweets as $tweet){

			$author = $tweet->full_author()->first();

			$html .= <<<EOL
			<div class='tweet'>
				<a href='{$this->router->urlFor('view',[['id' => $tweet->id]])}'>
					<div class='tweet-text'>$tweet->text</div>
				</a>
				<div class='tweet-footer'>
					<span class='tweet-timestamp'>$tweet->created_at</span>
					<span class='tweet-author'>
						<a href='{$this->router->urlFor('user',[['id'=> $author->id]])}'>$author->username</a>
					</span>
				</div>
			</div>
			EOL;
		}

		$html.='</article>';
		return $html;
	}
}