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

	<h1>Group</h1>

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

	<div class="current-group">
		<h2>group: <?php echo $_SESSION['group-selected']; ?></h2>
	</div>

	<section class="invite-members">
		<?php

			echo "<h3>Invite friends!</h3>";

			if ( $group->moderator_id = $user )
			{
				?><form id="members-form" method="post" action="http://hamburger.app/index.php/profile/add_member/<?php echo $group->group_id; ?>"><?php

				?><select type="text" name="members-form">"<?php

			    foreach($friends as $friend)
			    {
			    	?><option value="<?php echo $friend->id; ?>"><?php
			        echo $friend->name;
			        echo "</option>";

			    }
			
			echo "</select>";?>

			<input type="submit" value="send group request">
			</form><?php

			}
		?>
	</section>

	<section class="members">
		<ul class="members-list">
			<?php
				if (count($members>0))
				{
				    foreach($members as $member)
				    {
				    	?><li><?php
				        echo $member->first_name;
				        ?></li><?php
				    }
				}
			?>
		</ul>
	</section>

</main>