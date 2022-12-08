<?php

namespace theop\tweeterapp\tweeterapp\view;

use theop\tweeterapp\mf\view\AbstractView;
use theop\tweeterapp\tweeterapp\auth\TweeterAuthentification;

abstract class TweeterView extends AbstractView {

	private function makeHeader(): string {

		return <<<EOT
		<header class="theme-backcolor1">
		<h1>MiniTweeTR</h1>  
		<nav id="navbar">
		{$this->renderTopMenu()}
		</nav> 
		</header>
		EOT;
	}

	public function renderTopMenu() : string {

		$isConnected = TweeterAuthentification::connectedUser() ? true : false;

		$followHome = '';

		$loginOrProfil = <<<EOT
		<a class="tweet-control" href="{$this->router->urlFor('login')}">
		<img alt="login" src="html/login.png">
		</a>
		EOT;
		$createOrLogout = <<<EOT
		<a class="tweet-control" href="{$this->router->urlFor('signup')}">
		<img alt="signup" src="html/signup.png">
		</a>
		EOT;

		if ($isConnected) {
			$loginOrProfil = <<<EOT
			<a class="tweet-control" href="{$this->router->urlFor('following')}">
			<img alt="login" src="html/followees.png">
			</a>
			EOT;
			$createOrLogout = <<<EOT
			<a class="tweet-control" href="{$this->router->urlFor('logout')}">
			<img alt="signup" src="html/logout.png">
			</a>
			EOT;
			$followHome = <<<EOT
			<a class="tweet-control" href="{$this->router->urlFor('following_tweet')}">
			<img alt="signup" src="html/followHome.png">
			</a>
			EOT;
		}

		return <<<EOT
		<a class="tweet-control" href="{$this->router->urlFor('default')}">
		<img alt="home" src="html/home.png">
		</a>
		{$followHome}
		{$loginOrProfil}
		{$createOrLogout}
		EOT;

	}

	public function renderBottomMenu(): string {

		$isConnected = TweeterAuthentification::connectedUser() ? true : false;

		if ($isConnected) {
			return <<<EOT
				<nav id='menu' class='theme-backcolor1'>
					<div id='nav-menu'>
						<div class='button theme-backcolor2'>
							<a href='{$this->router->urlFor('post')}'>Nouveau tweet</a>
						</div>
					</div>
				</nav>
			EOT;
		} else {
			return "";
		}

	}

	public function makeBody(): string {
		return <<<EOT
		{$this->makeHeader()}
		<section>
		<article class="theme-backcolor2">
		{$this->render()}
		</article>
		{$this->renderBottomMenu()}
		</section>
		<footer class="theme-backcolor1">
		La super app créée en Licence Pro &copy;2022
		</footer>
		EOT;
	}

}