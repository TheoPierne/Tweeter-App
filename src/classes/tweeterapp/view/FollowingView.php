<?php

namespace theop\tweeterapp\tweeterapp\view;

use theop\tweeterapp\mf\view\Renderer;

class FollowingView extends TweeterView implements Renderer {

	public function render() : string {
		$follows = $this->data;

		$str = '<h2>Currently following</h2>';

		if (!empty($follows)) {

			$str .= '<ul id="followees">';

			foreach ($follows as $key => $value) {
				$str .= "<li><a href='{$this->router->urlFor('user', [['id' => $value['id']]])}'>{$value['fullname']}</a></li>";
			}

			$str .= '</ul>';

		}

		return $str;
	}	

}