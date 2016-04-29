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

	<button class="settings-btn">settings</button>

	<h1>Profile</h1>

	<button class="dropdown-btn">menu</button>

</header>

<main>

	<menu class="settings">

		<ul>
			<li><a href="#">Log out</a></li>
		</ul>

	</menu>

	<nav class="dropdown">

		<ul>
			<li><a href="#">Ranking</a></li>
			<li><a href="#">Profile</a></li>
			<li><a href="#">New Burger</a></li>
		</ul>

	</nav>

	<section class="invites">
		<h3>2 pending invites!</h3>
	</section>

	<section class="info">
		
		<figure class="portrait">portrait</figure>

		<div class="info-wrapper">
			<h2>Welcome, user!</h2>
			<button class="new group">
				New group
			</button>
		</div>

	</section>

	<section class="burgers">

		<h2>Burgers:</h2>

	    <ul class="burger-list">

		    <?php
			    foreach($burgers as $burger)
			    {
			    	?>
			        <li><a href="burgers/view_burger/<?php echo $burger->burger_id; ?>"><?php echo  $burger->name; ?></li>
			        <?php
			    }
			?>

	    </ul>
	</section>

</main>
