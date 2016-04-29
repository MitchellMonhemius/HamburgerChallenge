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

		<h1>New burger</h1>

	</div>

</header>

<main>

	<div class="burger-form">

		<?php echo $error;?>

			<?php echo form_open_multipart('http://hamburger.app/index.php/burgers/update_burger');?>

			Name:<br>
		  	<input type="text" name="burger-name"><br>

		  	Picture:<br>
			<input type="file" name="userfile" size="20" />

			<br /><br />
			<input type="submit" value="Create burger">

		</form>

	</div>

</main>