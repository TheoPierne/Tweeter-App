<?php

namespace theop\tweeterapp\tweeterapp\view;

use theop\tweeterapp\mf\view\Renderer;

class FollowingView extends TweeterView implements Renderer {

	public function render() : string {
		$user = $this->data;

        $follows = $user->follows()->get();
        $followers = $user->followedBy()->get();
        $followersCount = $followers->count();


        $html = <<<EOL
        	<article class='theme-backcolor2'>
                <h2>Nombre de follower : $followersCount</h2>
                <div class='list_follow'>
            	    <div>
                		<h3>Liste des follows :</h3>
                    	<ul id='followees'>
        EOL;

        foreach ($follows as $follow){
            $username = $follow->username;
            $html .= "<li><a href='{$this->router->urlFor('user',[['id',$follow->id]])}'>$username</a></li>";
        }

        $html .= "</ul></div><div><h3>Liste des followers :</h3><ul id='followers'>";

        foreach ($followers as $follower){
            $username = $follower->username;
            $html .= "<li><a href='{$this->router->urlFor('user',[['id',$follower->id]])}'>$username</a></li>";
        }

		$html .= "</ul></div></div></article>";
        return $html;
	}	

}