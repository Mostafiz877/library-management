<?php
 session_start();
 require('include/header.php');
 require('include/dbh.inc.php');
?>

<?php
  
  if(isset($_GET['edit_id']))
  {
    $mem_no=$_GET['edit_id'];

    $sql="SELECT * FROM membership where mem_no='$mem_no'";

    $result=mysqli_query($con,$sql);

    $row=mysqli_fetch_assoc($result);

    $_SESSION['edit_mem_no']=$mem_no;
    $_SESSION['edit_student_no']=$row['stud_no'];
  }
?>

<?php

  if(isset($_POST['update_submit_member']))
  {


    $member_no=str_replace(' ', '', $_POST['mem_no']);
    $student_no=$_POST['stud_no'];

     $sql_check_student="SELECT * from student  where stud_no='$student_no'";

     $result_check_student=mysqli_query($con,$sql_check_student);


    if(mysqli_num_rows( $result_check_student)==0)
     {

        echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
        <strong>Student no is not correct.No student belongs to this number.</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';

     }

     else
     {
          if($member_no !=$_SESSION['edit_mem_no']){

          $sql="SELECT * from membership where mem_no='$member_no'";

          $result=mysqli_query($con,$sql);

          if(mysqli_num_rows($result)>0)
          {
            echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
            <strong>Member no already exist</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          }

          else
          {


            if($student_no!=$_SESSION['edit_student_no']){

            $sql_check="SELECT * from membership where stud_no='$student_no'";
            $result_check=mysqli_query($con,$sql_check);

            if(mysqli_num_rows($result_check)>0){
               
                 echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
                 <strong>This roll number already member</strong>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>';
            }}else
            {

              $session_mem_no=$_SESSION['edit_mem_no'];

              $sql="UPDATE membership set mem_no='$member_no',stud_no='$student_no' where mem_no='$session_mem_no'";

              if(mysqli_query($con,$sql))
              {
                
                $_SESSION['status']='member_updated';
                header("Location:add_member.php");
              }
            }



          }

        }
        else
        {
          $sql_check="SELECT * from membership where stud_no='$student_no'";
          $result_check=mysqli_query($con,$sql_check);


           if($student_no!=$_SESSION['edit_student_no']){

          if(mysqli_num_rows($result_check)>0){

              echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
              <strong>This roll number already member</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';


          }}else 
          {

            $sql="UPDATE membership set mem_no='$member_no',stud_no='$student_no' where mem_no='$member_no'";

            if(mysqli_query($con,$sql))
            {

              unset($_SESSION["edit_mem_no"]);
              unset($_SESSION["edit_student_no"]);


              $_SESSION['status']='member_updated';
              header("Location:add_member.php");
            }

          }

        



        }

     }







  }

?>

<?php  
if(isset($_POST['update_submit_member'])||isset($_GET['edit_id']))
{

?>

<form class="w-25 mx-auto mt-4" action="edit_member.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Member No</label>
    <input type="text" class="form-control" name="mem_no" value="<?php echo $_SESSION['edit_mem_no']?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Student No</label>
    <input type="text" class="form-control" name="stud_no" value="<?php echo $_SESSION['edit_student_no']?>">
  </div>
  <button type="submit" class="btn btn-primary" name="update_submit_member">Update</button>
</form>

<?php
}


?>

<?php
require('include/footer.php')
?>