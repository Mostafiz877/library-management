<?php

if (isset($_POST['signup-submit'])) {
	require('dbh.inc.php');

	$username=$_POST['uid'];
	$email=$_POST['mail'];
	$password=$_POST['pwd'];
	$passwordRepeat=$_POST['pwd-repeat'];

	if (empty($username) || empty($password) || empty($passwordRepeat)) {

		header("Location: ../signup.php?error=emptyfields&uid=".$username);
		exit();
	}

		else if(!preg_match("/^[a-zA-Z0-9]*$/",$username))
	{
		header("Location: ../signup.php?error=invaliduid");
		exit();
		
	}


	else if ($password!==$passwordRepeat)
	{
       	header("Location: ../signup.php?error=passwordCheck&uid=".$username);
		exit();
	}
	else 
	{
		$sql="SELECT uidUsers FROM users WHERE uidUsers=?";
		$stmt=mysqli_stmt_init($con);
		if(!mysqli_stmt_prepare($stmt,$sql))
		{

	     header("Location: ../signup.php?error=sqlerror");
		exit();

		}else
		{
			mysqli_stmt_bind_param($stmt,"s",$username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck=mysqli_stmt_num_rows($stmt);

			if($resultCheck>0)
			{
					header("Location: ../signup.php?error=usertaken");
		            exit();
			}else
			{
				$sql="INSERT INTO users(uidUsers,pwdUsers) VALUES(?,?)";
				$stmt=mysqli_stmt_init($con);

				if(!mysqli_stmt_prepare($stmt,$sql))
					{

				     header("Location: ../signup.php?error=sqlerror");
					exit();

				}else
				{

					$hashedPwd=password_hash($password,PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt,"ss",$username,$hashedPwd);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);


					     header("Location: ../main/home.php?signup=success");

					     mysqli_stmt_close($stmt);
					     mysqli_close($con);

						exit();

				}
			}
						
		}

	}




}else
{
	 header("Location: ../signup.php");
	exit();

}