<?php
session_start();
require('include/header.php');
require('include/dbh.inc.php');


if(isset($_POST['add_member_submit']))
{
  $mem_no=$_POST['mem_no'];
  $student_no=$_POST['stud_no'];

  if(!empty($mem_no) && !empty($student_no) ){

    $check_sql="SELECT * from student where stud_no='$student_no'";

    $result=mysqli_query($con,$check_sql);

    if(mysqli_num_rows( $result)==0)
    {
       echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
         <strong>Incorrect student no</strong>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';

    }
    else
    {


      $sql_echck2="SELECT * from membership where stud_no='$student_no'";

      $result=mysqli_query($con,$sql_echck2);

      if(mysqli_num_rows( $result)>0)
      {
         echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
           <strong>Already Member!!!!!!</strong>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';

      }

      else
      {



        $sql="INSERT INTO `membership` (`mem_no`, `stud_no`) VALUES ('$mem_no', '$student_no')";

        if (mysqli_query($con, $sql)) {

          echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
           <strong>Member added successfully</strong>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';

        } else {
           

           echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
             <strong>Member No already can\'t be duplicate</strong>
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>';

        }



      }



    }





}

}
?>

<div class="container">


  

<form class="w-50 mt-4" method="post" action="add_member.php">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Member No:</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Member No" name="mem_no">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Student No:</label>
      <input type="text" class="form-control" id="inputPassword4" placeholder="Student No" name="stud_no">
    </div>
  </div>

    <button type="submit" class="btn btn-primary" name="add_member_submit">Add</button>

</form>

<br>
<br>
<br>

<?php
  if(isset($_SESSION['status']))
  {
    if($_SESSION['status']=='member_deleted')
    {
          echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
          <strong>Member Deleted</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';

        unset($_SESSION['status']);
    }
  }
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Member  No</th>
      <th scope="col">Student   No</th>
      <th scope="col">Student Name</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>

    <?php
      
      $sql_1="SELECT mem_no,membership.stud_no,stud_name FROM membership,student WHERE membership.stud_no=student.stud_no";

      $result = mysqli_query($con, $sql_1);

      if (mysqli_num_rows($result) >0) {
      
          while($row = mysqli_fetch_assoc($result)) {

      ?>

      <tr>

      <td><?php echo $row['mem_no'];?></td>
      <td><?php echo $row['stud_no'];?></td>
      <td><?php echo $row['stud_name'];?></td>
      <td>
        <div class="btn-group" role="group" aria-label="Second group">
          <a href="edit_member.php?edit_id=<?php echo $row['mem_no'];?>" title="" class="btn btn-sm btn-warning">Edit</a>
          <a href="individual_member_delete.php?delete_mem_no=<?php echo $row['mem_no'];?>" title="" class="btn btn-sm btn-danger">Delete</a>
        </div>
      </td>

    </tr>


      <?php

      }}
    ?>


  </tbody>
</table>


</div>


<?php
require('include/footer.php')
?>

