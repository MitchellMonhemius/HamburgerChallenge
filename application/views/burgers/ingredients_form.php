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

		<h1>Add ingredients</h1>

		<h3>Burger: </h3><?php echo $_SESSION['burger_id'];?>

	</div>

</header>

<main>

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

	<div class="ingredients-form">

		<form id="ingredients-form" name="ingredients-form" method="post" action="http://hamburger.app/index.php/burgers/update_ingredients">
		  Ingredient:<br>
		  <input type="text" name="ingredient"><br>
		      <input type="radio" name="color" value="red" checked> Red<br>
			  <input type="radio" name="color" value="green"> Green<br>
			  <input type="radio" name="color" value="yellow"> Yellow<br>
			  <input type="radio" name="color" value="brown"> Brown<br>
			  <input type="radio" name="color" value="white"> White<br>
		  <input type="submit" value="Add ingredient">
		</form>

	</div>

	<a href="http://hamburger.app/index.php/profile">My burger is done!</a>

</main>