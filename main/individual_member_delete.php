<?php 

 session_start();
 require('include/dbh.inc.php');



if(isset($_GET['delete_mem_no']))
{
  $member_no=$_GET['delete_mem_no'];

  $sql_issrec="DELETE FROM iss_rec where mem_no='$member_no'";

  if(mysqli_query($con,$sql_issrec))
  {
  	 $sql_mem="DELETE FROM membership where mem_no='$member_no'";

  	 if(mysqli_query($con,$sql_mem))
  	 {
         $_SESSION['status']='member_deleted';
         header("Location:add_member.php");
  	 }
  }
}


 ?>