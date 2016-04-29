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

	<button class="back-btn">back</button>

	<h1>Burger</h1>

	<button class="dropdown-btn">menu</button>

</header>

<main>

	<nav class="dropdown">

		<ul>
			<li><a href="#">Ranking</a></li>
			<li><a href="#">Profile</a></li>
			<li><a href="#">New Burger</a></li>
		</ul>

	</nav>

	<section class="burger-info">

		<h2><?php echo $burger->name; ?>:</h2>

		<div class="info-wrapper">
			<span class="burger-score">7,5</span>
			<img class="burger-img-big" src="http://hamburger.app/uploads/hamburger<?php echo $burger->burger_id; ?>.jpg" height="140" width="140">
			<button class="vote-burger">Vote now</button>
		</div>

		<h2>Ingredients:</h2>

	    <ul class="ingredients-list">
		    <?php
			    foreach($ingredients as $ingredient)
			    {
			    	?>
			        <li><span style="color:<?php echo $ingredient->color;?>;"><?php echo $ingredient->name; ?></span></li>
			        <?php
			    }
			?>
	    </ul>	

	</section>

	<section class="burger-votes">
		
		<h2>Votes:</h2>

	    <ul class="votes-list">
		    <?php
			    foreach($members as $member)
			    {
			    	if ($member->vote>0)
			    	{
				    	?>
				        <li><span><?php echo $member->first_name; ?>: <?php echo $member->vote; ?></span></li>
				        <?php
				    }
			    }
			?>
	    </ul>

	</section>

</main>