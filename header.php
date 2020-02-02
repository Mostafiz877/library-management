<?php
 session_start();
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Rental Library Project</title>
	<link rel="stylesheet" href="">
</head>
<body>

	<header>
		<nav>
					<a href="" title="">
						<img src="img/1.webp" alt="" height="100px" width="100px">
					</a>
		</nav>

		<ul>
			<li>
				<a href="index.php">Home</a>
				<a href="">Portfolio</a>
				<a href="">About me</a>
				<a href="">Contact</a>
			</li>
		</ul>

		<div>
         <?php
          if(!isset($_SESSION['userId']))

			echo '<a href="signup.php" title="">SignUp</a>';


			?> <br><br>

			<?php

			if (isset($_SESSION['userId'])) {

				echo '<form action="includes/logout.inc.php" method="post" accept-charset="utf-8">
				<input type="submit" name="logout-submit" value="Logout">
			      </form>';
			}
			else
			{
				echo '<form action="includes/login.inc.php" method="post" accept-charset="utf-8">

				<input type="text" name="mailuid"  placeholder="User Name or Email"> <br><br>
				<input type="password" name="pwd"  placeholder="Password"> <br><br>
				<input type="submit" name="login-submit" value="Login"> <br><br>

			</form>';
			}


			?>


		</div>
	</header>
