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

	<h1>New group</h1>

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

	<div class="group-form">

		<form id="group-form" name="group-form" method="post" action="http://hamburger.app/index.php/profile/new_group">

		  <h2>Name your group:</h2><br>
		  <input type="text" name="group-name"><br>

		  <a href="#">Add friends</a>

		  <input type="submit" value="Create group">
		</form>

	</div>

</main>