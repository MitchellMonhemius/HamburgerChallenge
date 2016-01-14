<?php

require_once __DIR__ . '/vendor/autoload.php';

	$fb = new Facebook\Facebook([
	  'app_id' => '1656982164560887',
	  'app_secret' => 'fca0497ce9428d102362163f12ed8c19',
	  'default_graph_version' => 'v2.5',
	  ]);

	$helper = $fb->getRedirectLoginHelper();

	$permissions = ['email']; // Optional permissions
	$loginUrl = $helper->getLoginUrl('http://hamburger.app/fb-callback.php', $permissions);

	echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

?>