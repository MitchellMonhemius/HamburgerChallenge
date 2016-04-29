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

	<h1>Select group</h1>

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

	<section class="groups">

		<h2>Select a group:</h2>

	    <ul class="group-list">

		    <?php
			    foreach($groups as $group)
			    {
			    	?>
			        <li

			        	<?php
			        		if (isset($_SESSION['group-selected']))
			        		{
			        			if( $group->group_id == $_SESSION['group-selected'] )
				        		{
				        			echo 'class="selected"';
				        		};
			        		};
		
			        	?>

			        	id="<?php echo  $group->group_id; ?>"><?php echo $group->name; ?>

			        </li>
			        <?php
			    }
			?>

	    </ul>

	    <button class="continue">
	    	Continue
	    </button>
	    
	</section>

</main>
