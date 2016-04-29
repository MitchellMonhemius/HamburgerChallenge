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

		<h1>Group</h1>

	</div>

</header>

<main>

<?php //if you have a group, select one. Else create one!

if (count($groups)>0)
{

?>

<menu class="profile-menu">	
	<span>You need to first select a group:</span>

	<form name="groups-list" method="post" action="http://hamburger.app/index.php/profile/select_group">	
		<select type="text" name="group-select">

			    <?php
				    foreach($groups as $group)
				    {
				    	?>
				        <option

				        	<?php
				        		if (isset($_SESSION['group-selected']))
				        		{
				        			if( $group->group_id == $_SESSION['group-selected'] )
					        		{
					        			echo 'selected="selected"';
					        		};
				        		};
			
				        	?>

				        	value="<?php echo  $group->group_id; ?>"><?php echo $group->name; ?>

				        </option>
				        <?php
				    }
				?>

		</select>
		<input type="submit" name="Submit" value="Submit!" />
	</form>
</menu>

<?php

}
else
{

	echo "You dont have a group yet. Make one fast and invite your friends!"

?>

<a href="http://hamburger.app/index.php/profile/group_form">Make new group</a>

<?php

}

?>

</main>