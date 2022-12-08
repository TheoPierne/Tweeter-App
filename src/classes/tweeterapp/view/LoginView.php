<?php

namespace theop\tweeterapp\tweeterapp\view;

use theop\tweeterapp\tweeterapp\view\TweeterView;
use theop\tweeterapp\mf\view\Renderer;
use theop\tweeterapp\tweeterapp\models\User;

class LoginView extends TweeterView implements Renderer {

	public function render() : string {
        $loginUrl = $this->router->urlFor('login');
		$inputValue = (empty($this->data) ? ['username' => ''] : (isset($this->data['inputValue']) ? $this->data['inputValue'] : ['username' => '']));
        return <<<EOL
        <article class='theme-backcolor2'>
            <form class="forms" action='$loginUrl' method='post'>
                <input class='forms-text' type='text' name='username' placeholder='Pseudo' value='{$inputValue["username"]}'>
                <input class='forms-text' type='password' name='password' placeholder='Mot de passe'>
                
                <button class='forms-button' name='login_button' type='submit'>Se connecter</button>
            </form>
       </article>
       EOL;
	}	

}