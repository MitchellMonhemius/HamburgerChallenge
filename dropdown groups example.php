	<menu class="profile-menu">	

	<?php //if you have invites, show them!

	if (count($invites)>0)
	{

		foreach ($invites as $invite)
		{
			?>You have been invited by user <?php echo $invite->inviter_id; ?> to join group <?php echo $invite->group_id; ?>!<?php
			?><a href="http://hamburger.app/index.php/profile/accept_invite/<?php echo $invite->invite_id; ?>">Accept</a><?php
		}

	}
	?>
	<?php //if you have a group, select one. Else create one!

	if (count($groups)>0)
	{

	?>

		<span>Select your group:</span>

		<form name="groups-list" method="post" action="profile/select_group">	
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

		<?php
			if (isset($_SESSION['group-selected']))
			{
				?><a href="profile/group_view/<?php echo $_SESSION['group-selected']; ?>">view group</a><?php
			}
		?>

	<?php

	}
	else
	{
		echo "You dont have a group yet! Make one fast and invite all your friends!";
	}

	?>
		<a href="profile/group_form">Make new group</a>
		<a href="<?php echo $logout_url ?>">Log out</a>
	</menu>