<?php
 session_start();
 require('include/header.php');
 require('include/dbh.inc.php');
?>

<?php

  if(isset($_GET['iss_no']))
  {
    $iss_no=$_GET['iss_no'];

    $sql="SELECT * from iss_rec where iss_no='$iss_no'";
    $result=mysqli_query($con,$sql);

    $row=mysqli_fetch_assoc($result);

    $member_no=$row['mem_no'];
    $book_no=$row['book_no'];

    $_SESSION['mem_no']=$member_no;
    $_SESSION['book_no']=$book_no;
    $_SESSION['iss_no']=$iss_no;

  }
?>

<?php

  if(isset($_POST['issue_update_submit']) && !empty($_POST['mem_no']) && !empty($_POST['book_no']))
  {
    $mem_no_form=$_POST['mem_no'];
    $book_no_form=$_POST['book_no'];

    $sql="SELECT * from membership where mem_no='$mem_no_form'";
    $result=mysqli_query($con,$sql);

    if(mysqli_num_rows($result)==0){

      echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto role="alert">
        <strong>Please enter valid mem no!!!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';



    }
    else
    {

    $sql="SELECT * from book where book_no='$book_no_form'";
    $result=mysqli_query($con,$sql);

          if(mysqli_num_rows($result)==0)
          {

            echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto role="alert">
              <strong>Please enter valid book no</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';

          }
          else
          {
            $sql="SELECT * from iss_rec where mem_no='$mem_no_form'";
            $result=mysqli_query($con,$sql);

            if(mysqli_num_rows($result)>=3)
            {

              echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto role="alert">
                <strong>This member already borrow 3 books!!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';

            }
            else
            {
              $iss_no=$_SESSION['iss_no'];
              $sql="UPDATE iss_rec set mem_no='$mem_no_form',book_no='$book_no_form' where iss_no='$iss_no'";

             if(mysqli_query($con,$sql))
             {

              unset($_SESSION['mem_no']);
              unset($_SESSION['book_no']);
              unset($_SESSION['iss_no']);

              $_SESSION['status']='iss_rec_updated';
              header("location:book_issue.php");






              echo "Data updted successfully";

             }else
             {
              echo "Connection Peoblem";
             }

            }

          }

    }











  }

?>

<?php  

  if(isset($_POST['issue_update_submit'])||isset($_GET['iss_no']))
{

?>

<form class="w-25 mx-auto mt-4" action="edit_iss_rec.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Member No</label>
    <input type="text" class="form-control" name="mem_no" value="<?php echo $_SESSION['mem_no']?>">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Book No</label>
    <input type="text" class="form-control" name="book_no" value="<?php echo $_SESSION['book_no']?>">
  </div>

  <button type="submit" class="btn btn-primary" name="issue_update_submit">Update</button>
</form>

<?php
}


?>

<?php
require('include/footer.php')
?>