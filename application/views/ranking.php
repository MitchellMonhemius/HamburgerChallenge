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

	<h1>Ranking</h1>

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

	<section class="switch-ranking">
		<h2>Burgers of Chefs?</h2>
		<ul>
			<li>Burgers</li>
			<li>Chefs</li>
		</ul>
	</section>


	<div class="current-group">
		<h2>group: <?php echo $_SESSION['group-selected']; ?></h2>
	</div>


	<section class="users">

	    <ul class="users-list">
		    <?php

			    foreach($registered_users as $name)
			    {
			    	?><li><?php

			    		//THIS IS YOU
			    		if($user_id == $name->user_id)
			    		{
			    			?><span class="rank">x</span><?php

			    			?><span class="ranked-name"><?php
			    				echo  $name->first_name;
			    			?><span class="ranked-name"><?php

			    			?><img class="profile-pic" src="//graph.facebook.com/<?php echo $name->facebook_id; ?>/picture"><?php
			    		}
			    		//THESE ARE OTHER MEMBERS, THEY REQUIRE A LINK
			    		else
			    		{
			    			?><span class="rank">x</span><?php

			    			?><span class="ranked-name"><?php
			    				?><a href="user/view_user/<?php echo $name->user_id; ?>"><?php echo  $name->first_name; ?></a><?php
			    			?><span class="ranked-name"><?php

			    			?><img class="profile-pic" src="//graph.facebook.com/<?php echo $name->facebook_id; ?>/picture"><?php
			    		}
			        	

			        ?></li><?php
			    }
			?>
	    </ul>

	</section>

	<section class="burgers">

	    <ul class="burgers-list">
		    <?php

			function cmp($a, $b)
			{
			    return strcmp($b->score, $a->score);
			}

			usort($burgers, "cmp");



			    if (count($burgers)>0)
			    {
				    foreach($burgers as $burger)
				    {
				    	?>
				        <li>
				        	<a href="burgers/view_burger/<?php echo $burger->burger_id; ?>"><?php echo  $burger->name; ?></a><br>
				       
				        	<?php

				        	//vote check
				        	if (!isset($votes[$burger->burger_id]) && $burger->user_id != $user_id)
				        	{
				        		?><a href="burgers/vote_burger/<?php echo $burger->burger_id; ?>">Vote!</a><?php
				        	}

				        	?>

				        Score: <h2>
				        <?php
				        	if ($burger->score>0)
				        	{
				        		echo $burger->score;
				        	}
				        	else
				        	{
				        		echo "no votes yet";
				        	}
				        ?></h2>

				        </li>
				        <?php
				    }
				}
				else
				{
					echo "There are no burgers in this group. Go cook some delicious burgers, fast!";
				}

			?>

	    </ul>

	</section>

	<h1><?php ?></h1>

</main>