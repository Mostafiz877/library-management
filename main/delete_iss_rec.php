<?php 

 session_start();
 require('include/dbh.inc.php');



if(isset($_GET['iss_no']))
{
  $iss_no=$_GET['iss_no'];

  $sql_issrec="DELETE FROM iss_rec where iss_no='$iss_no'";

  if(mysqli_query($con,$sql_issrec))
  {

         $_SESSION['status']='iss_rec_deleted';
         header("Location:book_issue.php");
  }
}


 ?>