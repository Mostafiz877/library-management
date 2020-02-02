

<?php
session_start();
require('include/header.php');
require('include/dbh.inc.php');

?>

<?php

if(isset($_POST['add_new_book_submit']))
{
  $book_no=$_POST['book_no'];
  $book_name=$_POST['book_name'];
  $book_author=$_POST['book_author'];



    if(!empty($book_no) && !empty($book_name) &&!empty($book_author)){

      $sql="INSERT INTO `book` (`book_no`, `book_name`,`author`) VALUES ('$book_no', '$book_name','$book_author')";

      if (mysqli_query($con, $sql)) {

          echo "<h3 align='center'>New book added successfully</h3>";
      } else {

        echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
          <strong>Book No already exist</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
      }
  }


}
  
?>


<div class="container">


  

<form class="w-50 mt-4" method="post" action="add_book.php">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Book No:</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Book No" name="book_no">
    </div> 


       <div class="form-group col-md-6">
      <label for="inputEmail4">Book Name:</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Book Name" name="book_name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Author:</label>
      <input type="text" class="form-control" id="inputPassword4" placeholder="Author" name="book_author">
    </div>
  </div>

    <button type="submit" class="btn btn-primary" name="add_new_book_submit">Add</button>

</form>

<br>
<br>

<?php 
   
   if(isset($_SESSION['status']))
   {
    if($_SESSION['status']=='edit_successfull')
    {
      echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto role="alert">
        <strong>Book updated successfully</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';

      unset($_SESSION['status']);
    }

    else if($_SESSION['status']=='deleted')
    {
       echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
         <strong>Book deleted successfully</strong>
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
      <th scope="col">Book No:</th>
      <th scope="col">Book Name</th>
      <th scope="col">Author</th>
      <th scope="col">Action</th>
    </tr>
  </thead>

  <tbody>

    <?php
      
      $sql_1="SELECT * FROM `book`";

      $result = mysqli_query($con, $sql_1);

      if (mysqli_num_rows($result) > 0) {
      
          while($row = mysqli_fetch_assoc($result)) {

      ?>

    <tr>
      <td><?php echo $row['book_no'];?></td>
      <td><?php echo $row['book_name'];?></td>
      <td><?php echo $row['author'];?></td>
      <td>
        <a href="edit_individual_book.php?edit_id=<?php echo $row['book_no'];?>" title="">Edit</a>
        <a href="delete_book.php?book_no=<?php echo $row['book_no'];?>" title="">Delete</a>
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

