<?php
 session_start();
 require('include/header.php');
 require('include/dbh.inc.php');
?>

<?php
	
	if(isset($_GET['edit_id']))
	{
		$book_no=$_GET['edit_id'];

		$sql="SELECT * FROM book where book_no='$book_no'";

		$result=mysqli_query($con,$sql);

		$row=mysqli_fetch_assoc($result);

		$_SESSION['edit_book_no']=$book_no;
		$_SESSION['edit_book_name']=$row['book_name'];
    $_SESSION['author']=$row['author'];

	}
?>

<?php

  if(isset($_POST['book_update_submit']))
  {

  	$book_no=str_replace(' ', '', $_POST['book_no']);
  	$book_name=$_POST['book_name'];
    $author=$_POST['author'];

  	$sql="SELECT * from book where book_no='$book_no'";

  	$result=mysqli_query($con,$sql);



  	if($book_no !=$_SESSION['edit_book_no']){

  	if(mysqli_num_rows($result)>0)
  	{
  		echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
      <strong>Book no already exist</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
  	}
  	else
  	{
  		$session_book_no=$_SESSION['edit_book_no'];

  		$sql="UPDATE book set book_no='$book_no',book_name='$book_name',author='$author' where book_no='$session_book_no'";

  		if(mysqli_query($con,$sql))
  		{
        unset($_SESSION["edit_book_no"]);
        unset($_SESSION["edit_book_name"]);
        unset($_SESSION["author"]);

        $_SESSION['status']="edit_successfull";
  			header("Location:add_book.php");

  			exit();
  		}

  	}

  }
  else
  {

  
  	 $sql="UPDATE book set book_no='$book_no',book_name='$book_name',author='$author' where book_no='$book_no'";

  	if(mysqli_query($con,$sql))
  	{

  		unset($_SESSION["edit_book_no"]);
  		unset($_SESSION["edit_book_name"]);
      unset($_SESSION["author"]);


      $_SESSION['status']="edit_successfull";
      header("Location:add_book.php");

  		exit();
  	}


  }

  }

?>

<?php  
if(isset($_POST['book_update_submit'])||isset($_GET['edit_id']))
{

?>

<form class="w-25 mx-auto mt-4" action="edit_individual_book.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Book No</label>
    <input type="text" class="form-control" name="book_no" value="<?php echo $_SESSION['edit_book_no']?>">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Book Name</label>
    <input type="text" class="form-control" name="book_name" value="<?php echo $_SESSION['edit_book_name']?>">
  </div>


  <div class="form-group">
    <label for="exampleInputPassword1">Author</label>
    <input type="text" class="form-control" name="author" value="<?php echo $_SESSION['author']?>">
  </div>

  <button type="submit" class="btn btn-primary" name="book_update_submit">Update</button>
</form>

<?php
}


?>

<?php
require('include/footer.php')
?>