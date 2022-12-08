<?php

namespace theop\tweeterapp\tweeterapp\view;

use theop\tweeterapp\tweeterapp\view\TweeterView;
use theop\tweeterapp\mf\view\Renderer;
use theop\tweeterapp\tweeterapp\models\User;

class SignupView extends TweeterView implements Renderer {

	public function render() : string {
		$signupUrl = $this->router->urlFor('signup');
		$inputValues = (empty($this->data) ? ['fullname' => '', 'username' => ''] : (isset($this->data['inputValues']) ? $this->data['inputValues'] : ['fullname' => '', 'username' => '']));
		return <<<EOL
        <article class='theme-backcolor2'>
            <form class='forms' action='$signupUrl' method='post'>
                <input class='forms-text' type='text' name='fullname' placeholder='Nom et Prénom' value='{$inputValues['fullname']}'>
                <input class='forms-text' type='text' name='username' placeholder='Pseudo' value='{$inputValues['username']}'>
                <input class='forms-text' type='password' name='password' placeholder='Mot de passe (6 caractères minimum)'>
                <input class='forms-text' type='password' name='password_verify' placeholder='Réécrire le mot de passe'>
                
                <button class='forms-button' name='login_button' type='submit'>S'inscrire</button>
            </form>
       </article>
       EOL;
	}	

}