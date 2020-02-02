<?php
session_start();
require('include/header.php');
require('include/dbh.inc.php');

?>


<?php

if(isset($_POST['delete_book_submit']))
{
  $book_no=$_POST['book_no'];

  if(!empty($book_no))
  {

    $sql="SELECT * from book where book_no='$book_no'";

    $result=mysqli_query($con,$sql);

    if(mysqli_num_rows($result)==0)
    {
          echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
           <strong>Please enter correct book no.No data found.</strong>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
    }
    else
    {

      $sql_for_iss_rec="DELETE FROM iss_rec where book_no='$book_no'";

      if(mysqli_query($con,$sql_for_iss_rec))
      {
        $sql_for_book="DELETE FROM book where book_no='$book_no'";

        if(mysqli_query($con,$sql_for_book))
        {
          $_SESSION['status']="deleted";
          header("Location:add_book.php");
        }

      }


    }



  // $sql = "DELETE FROM book WHERE book_no='$book_no'";

  // if (mysqli_query($con, $sql)) {
  //     echo "<h3 align='center'>Book deleted successfully</h3>";
  // } else {
  //     echo "Error deleting record: " . mysqli_error($con);
  // }
}

}


if(isset($_GET['book_no']))
{
  $book_no=$_GET['book_no'];

  $sql_for_iss_rec="DELETE FROM iss_rec where book_no='$book_no'";

  if(mysqli_query($con,$sql_for_iss_rec))
  {
    $sql_for_book="DELETE FROM book where book_no='$book_no'";

    if(mysqli_query($con,$sql_for_book))
    {
      $_SESSION['status']="deleted";
      header("Location:add_book.php");
    }

  }

}
	
?>


<div class="container mt-4">


   <div align="center">
	<form method="post" action="delete_book.php">
	  <div class="form-group w-50">
	    <label for="exampleInputEmail1">Book No:</label>
	    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Book No" name="book_no">
	  </div>
	  <button type="submit" class="btn btn-primary" name="delete_book_submit">Delete</button>
	</form>

	</div>

</div>



<?php
require('include/footer.php')
?>