<!doctype html>
<html class="no-js" lang="">
<head>      
    <meta charset="utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="initial-scale=1,minimum-scale=1,maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- styles -->
    <link rel="stylesheet" type="text/css" href="../../css/main.css" />
</head>

<body>

<header>

	<div class="header-title">

		<h1><?php echo $user->first_name; ?>'s profile</h1>

		<div class="new-burger-btn">
			<a href="burgers/new_burger">New Burger</a>
		</div>

	</div>

</header>

<main>

	<div class="user-info">
		<div class="user-description">

		</div>
		<div class="user-photo">
			<img class="profile-pic" src="//graph.facebook.com/<?php echo $user->facebook_id; ?>/picture?type=large">
		</div>
	</div>


	<div class="users-burgers">

		<h3><?php echo $user->first_name; ?>'s burgers:</h3>

	    <ul class="burger-list">

		    <?php

		    if (count($burgers)>0)
		    {
			    foreach($burgers as $burger)
			    {
			    	?>
			        <li><a href="burgers/view_burger/<?php echo $burger->burger_id; ?>"><?php echo  $burger->name; ?></li>
			        <?php
			    }
			}
			else
			{
				echo "This user has no burgers yet!";
			}
			?>

	    </ul>

	</div>


</main>
