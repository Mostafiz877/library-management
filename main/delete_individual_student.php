<?php
require('include/dbh.inc.php');

?>



<?php

if(isset($_GET['stud_no']))
{
  $student_no=$_GET['stud_no'];

  $student_check="SELECT * from student where stud_no='$student_no'";

  $check_result=mysqli_query($con,$student_check);

  if(mysqli_num_rows($check_result)==0)
  {
  	echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto mt-4" role="alert">
		  <strong>No student Available. Please enter correct student no.</strong>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>';
  }else
  {

  $sql_for_mem_no="SELECT membership.mem_no
                       FROM membership,student
                       WHERE student.stud_no='$student_no' AND
                        student.stud_no=membership.stud_no";



  if($result=mysqli_query($con, $sql_for_mem_no))
  {
  	$row=mysqli_fetch_assoc($result);
  	$mem_no=$row['mem_no'];

    $sql_for_iss_rec="DELETE from iss_rec where mem_no='$mem_no'";

  	if(mysqli_query($con, $sql_for_iss_rec))
  	{
          $sql_for_membership="DELETE from membership where mem_no='$mem_no'";

          if(mysqli_query($con, $sql_for_membership))
          {
          	$sql_for_student= "DELETE FROM student WHERE stud_no='$student_no'";

          	if(mysqli_query($con,$sql_for_student))
          	{
              header("Location:add_stu.php?message=successfull");
              exit();
          	}
          	else
          	{
              $error=mysqli_error($con);

          		 echo "Error deleting record: " . mysqli_error($con);
          	}
          }
          else
          {
          	echo "Connection Error3";
          }
  	}else
  	{
  		 echo "Error deleting record: " . mysqli_error($con);
  	}

  }
  else
  {
  	echo "Error deleting record: " . mysqli_error($con);
  }
}

}

	
?>



<?php
require('include/footer.php')
?>