<?php

namespace theop\tweeterapp\tweeterapp\view;

use theop\tweeterapp\tweeterapp\view\TweeterView;
use theop\tweeterapp\mf\view\Renderer;
use theop\tweeterapp\tweeterapp\models\User;

class PostView extends TweeterView implements Renderer {

	public function render(): string {
		return <<<EOT
		<form action="{$this->router->urlFor('post')}" method="post">
			<textarea id="tweet-form" name="tweet" placeholder="Enter your tweet..." maxlength="140"></textarea>
			<div>
				<input id="send_button" type="submit" name="send" value="Send">
			</div>
		</form>
		EOT;
	}

}