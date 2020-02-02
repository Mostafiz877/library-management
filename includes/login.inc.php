<?php

if (isset($_POST['login-submit'])) {

	require('dbh.inc.php');

	$mailuid=$_POST['mailuid'];
	$password=$_POST['pwd'];

	if(empty($mailuid) || empty($password))
	{
		     header("Location: ../index.php?error=emptyfields");
			exit();
	}else
	{
		$sql="SELECT * FROM users where uidUsers=?";
		$sql2="SELECT * FROM users where uidUsers='$mailuid'";
		$result=mysqli_query($con,$sql2);


		if(mysqli_num_rows($result)==0)
		{
            header("Location: ../index.php?error=incorrect_username");
           exit();
		}



		$stmt=mysqli_stmt_init($con);

		if(!mysqli_stmt_prepare($stmt,$sql))
		{
			 header("Location: ../index.php?error=sqlerror");
			exit();
           
		}
		else
		{
			mysqli_stmt_bind_param($stmt,"s",$mailuid);
			mysqli_stmt_execute($stmt);
			$result=mysqli_stmt_get_result($stmt);

			if($row=mysqli_fetch_assoc($result))
			{


				$pwdCheck=password_verify($password,$row['pwdUsers']);
				if($pwdCheck==false)
				{

					 header("Location: ../index.php?error=wrongpassword");
					exit();

				}

			else if($pwdCheck==true)
			{
               session_start();
               $_SESSION['userId']=$row['idUsers'];
               $_SESSION['userUid']=$row['uidUsers'];
                

                 header("Location: ../main/home.php?login=success");
                exit();


			}

			else
			{
				 header("Location: ../index.php?error=wrongpassword");
				exit();
			}
       
		}
	}
}
}
else
{
	     header("Location: ../index.php");
		exit();
}