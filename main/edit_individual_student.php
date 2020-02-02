<?php
 session_start();
 require('include/header.php');
 require('include/dbh.inc.php');
?>

<?php
	
	if(isset($_GET['edit_id']))
	{
		$stud_no=$_GET['edit_id'];

		$sql="SELECT * FROM student where stud_no='$stud_no'";

		$result=mysqli_query($con,$sql);

		$row=mysqli_fetch_assoc($result);

		$_SESSION['edit_student_no']=$stud_no;
		$_SESSION['edit_student_name']=$row['stud_name'];
	}
?>

<?php

  if(isset($_POST['update_submit']))
  {

  	$student_no=str_replace(' ', '', $_POST['stud_no']);
  	$student_name=$_POST['stud_name'];

  	$sql="SELECT * from student where stud_no='$student_no'";

  	$result=mysqli_query($con,$sql);



  	if($student_no !=$_SESSION['edit_student_no']){

  	if(mysqli_num_rows($result)>0)
  	{
  		echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
      <strong>Student no already exist</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
  	}
  	else
  	{
  		$session_student_no=$_SESSION['edit_student_no'];
  		$sql="UPDATE student set stud_no='$student_no',stud_name='$student_name' where stud_no='$session_student_no'";

  		if(mysqli_query($con,$sql))
  		{
  			header("Location:add_stu.php?message=edit_successfull");
  			exit();
  		}

  	}

  }
  else
  {

  
  	 $sql="UPDATE student set stud_no='$student_no',stud_name='$student_name' where stud_no='$student_no'";

  	if(mysqli_query($con,$sql))
  	{

  		unset($_SESSION["edit_student_no"]);
  		unset($_SESSION["edit_student_name"]);
  		header("Location:add_stu.php?message=edit_successfull");
  		exit();
  	}


  }

  }

?>

<?php  
if(isset($_POST['update_submit'])||isset($_GET['edit_id']))
{

?>

<form class="w-25 mx-auto mt-4" action="edit_individual_student.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Student No</label>
    <input type="text" class="form-control" name="stud_no" value="<?php echo $_SESSION['edit_student_no']?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Student Name</label>
    <input type="text" class="form-control" name="stud_name" value="<?php echo $_SESSION['edit_student_name']?>">
  </div>
  <button type="submit" class="btn btn-primary" name="update_submit">Update</button>
</form>

<?php
}


?>

<?php
require('include/footer.php')
?>