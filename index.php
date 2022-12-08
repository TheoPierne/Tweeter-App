<?php

session_start();

require 'vendor/autoload.php';

use theop\tweeterapp\tweeterapp\models\User;
use theop\tweeterapp\tweeterapp\models\Tweet;
use theop\tweeterapp\tweeterapp\auth\TweeterAuthentification;
use theop\tweeterapp\mf\view\AbstractView;

$configFile = parse_ini_file('./config/config.ini');

$config = [ 
	'driver'    => 'mysql',
	'host'      => $configFile['host'],
	'database'  => $configFile['base'],
	'username'  => $configFile['username'],
	'password'  => $configFile['password'],
	'charset'   => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix'    => ''
];

$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();

AbstractView::addStyleSheet('html/style.css');

$router = new theop\tweeterapp\mf\router\Router();

$router->addRoute('home', 'list_tweets', '\theop\tweeterapp\tweeterapp\control\HomeController');
$router->addRoute('view', 'view_tweet', '\theop\tweeterapp\tweeterapp\control\TweetController', TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('user', 'view_user_tweets', '\theop\tweeterapp\tweeterapp\control\UserController', TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('signup', 'signup', '\theop\tweeterapp\tweeterapp\control\SignupController');
$router->addRoute('post', 'post_tweet', '\theop\tweeterapp\tweeterapp\control\PostController', TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('login', 'login', '\theop\tweeterapp\tweeterapp\control\LoginController');
$router->addRoute('logout', 'logout', '\theop\tweeterapp\tweeterapp\control\LogoutController', TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('following', 'view_following', '\theop\tweeterapp\tweeterapp\control\FollowingController', TweeterAuthentification::ACCESS_LEVEL_USER);
$router->addRoute('following-tweet', 'view_following_tweet', '\theop\tweeterapp\tweeterapp\control\FollowingTweetController', TweeterAuthentification::ACCESS_LEVEL_USER);

$router->setDefaultRoute('list_tweets');

$router->run();
