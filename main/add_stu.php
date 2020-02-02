<?php
session_start();
require('include/header.php');
require('include/dbh.inc.php');


if(isset($_SESSION['flag']))
{
  unset($_SESSION['flag']);
  header("Location:add_stu.php");
  exit();
}


if(isset($_POST['add_student_submit']))
{
  $student_no=str_replace(' ', '', $_POST['stud_no']);
  $student_name=$_POST['stud_name'];

  if(empty($student_no) && empty($student_name) ){

        echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto mt-4" role="alert">
          <strong>Field can\'t be empty</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
  }

  else{

  if(preg_match("/^c|^C[a-zA-Z]*/",$student_no))
  {



    $sql_check="SELECT * from student where stud_no='$student_no'";
    $result_check=mysqli_query($con,$sql_check);

    if(mysqli_num_rows($result_check)>0)
    {

      echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto mt-4" role="alert">
                <strong>Student already exist</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';

    }else

    {

      $sql="INSERT INTO `student` (`stud_no`, `stud_name`) VALUES ('$student_no', '$student_name')";

      if (mysqli_query($con, $sql)) {

       echo' <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
              <strong>New student added successfully</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';

    }

    else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

  }







  }else
  {
    echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto mt-4" role="alert">
      <strong>Please Enter student no started with c</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
  }
}


}
?>

<div class="container">

<form class="w-50 mt-4" method="post" accept="home.php">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Student No</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Student No" name="stud_no">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Student Name</label>
      <input type="text" class="form-control" id="inputPassword4" placeholder="Student Name" name="stud_name">
    </div>
  </div>

    <button type="submit" class="btn btn-primary" name="add_student_submit">Add</button>
</form>

<br>
<br>
<br>




<?php 

   if (isset($_GET['message']))
   {

    if($_GET['message']=='successfull')
    {
    echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto mt-4" role="alert">
      <strong>Student deleted successfully</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';

    $_SESSION['flag']='executed';
     }

     else if($_GET['message']=='edit_successfull')
     {
        echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto mt-4" role="alert">
          <strong>Record updated successfully</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';

      $_SESSION['flag']='executed';
     }


   }

 ?>




<table class="table">
  <thead>
    <tr>
      <th scope="col">Serial</th>
      <th scope="col">Stuent No</th>
      <th scope="col">Student Name</th>
      <th scope="col">Action</th>





    </tr>
  </thead>
  <tbody>

    <?php
      
      $sql_1="SELECT * FROM `student`";
      $result = mysqli_query($con, $sql_1);

      if (mysqli_num_rows($result) > 0) {
        $count=1;
      
          while($row = mysqli_fetch_assoc($result)) {

      ?>
      
    <tr>
      <th scope="row"><?php echo $count;?></th>
      <td><?php echo $row['stud_no'];?></td>
      <td><?php echo $row['stud_name'];?></td>
      <td>
        <div class="btn-group" role="group" aria-label="Second group">
          <a href="edit_individual_student.php?edit_id=<?php echo $row['stud_no'];?>" title="" class="btn btn-sm btn-warning">Edit</a>
          <a href="delete_individual_student.php?stud_no=<?php echo $row['stud_no'];?>" title="" class="btn btn-sm btn-danger">Delete</a>
        </div>
      </td>
    </tr> 

      <?php

      $count++;
      }}
    ?>

  </tbody>
</table>


</div>


<?php
require('include/footer.php')
?>

