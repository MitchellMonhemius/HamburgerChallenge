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

		<h1>Voting</h1>

		<div class="new-burger-btn">
			<a href="burgers/new_burger">New Burger</a>
		</div>

	</div>

</header>

<main>

	<div class="my-burgers">

		<h1>My burgers:</h1>

	    <ul class="burger-list">

		    <?php
			    foreach($burgers as $burger)
			    {
			    	?>
			        <li><a href="burgers/view_burger<?php echo $burger->burger_id; ?>"><?php echo  $burger->name; ?></li>
			        <?php
			    }
			?>

	    </ul>

	</div>


	<div class="add-burger-link">
		<a href="burgers/new_burger">Add burger</a>
	</div>

</main>

