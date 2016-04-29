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

	<div class="burger-form">

		<h3><?php echo $burger->name; ?></h3>

		<form id="burger-form" name="burger-form" method="post" action="http://hamburger.app/index.php/burgers/update_vote/<?php echo $burger->burger_id; ?>">

			<?php
			foreach($vote_types as $vote_type)
		    {

		    	?>
			    <span><?php echo $vote_type->type_name; ?>:</span>
				    <select type="text" name="<?php echo $vote_type->type_id; ?>">
				  	<option value="1">1</option>
				  	<option value="2">2</option>
				  	<option value="3">3</option>
				  	<option value="4">4</option>
				  	<option value="5">5</option>
				  	<option value="6">6</option>
				  	<option value="7">7</option>
				  	<option value="8">8</option>
				  	<option value="9">9</option>
				  	<option value="10">10</option>
			  	</select>
			  	<?php

		    }
		    ?>

		  <input type="submit" value="Submit vote!">
		</form>

	</div>


</main>