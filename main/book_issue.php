
<?php
session_start();
require('include/header.php');
require('include/dbh.inc.php');

?>

<?php

if(isset($_POST['new_book_issue']))
{
  $mem_no=$_POST['mem_no'];
  $book_no=$_POST['book_no'];

   date_default_timezone_set("Asia/Dhaka");
   $date=date('m/d/Y h:i:s', time());




    if(!empty($mem_no) && !empty($book_no)){

      $sql_check="SELECT * from iss_rec where mem_no='$mem_no'";
      $result=mysqli_query($con, $sql_check);

      if(mysqli_num_rows($result)==3)
      {

        echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto role="alert">
          <strong>One Student can\'t borrow more than 3 books!!!!!!!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';

        echo "<h3 align='center'></h3>";
      }
      else
      {




        $sql="INSERT INTO `iss_rec` (`mem_no`, `book_no`) VALUES ('$mem_no','$book_no')";

        if (mysqli_query($con, $sql)) {


          echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto role="alert">
            <strong>New book issued successfully</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }


      }


  }


}
  
?>


<div class="container">


  

<form class="w-50 mt-4" method="post" action="book_issue.php">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Member No:</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="mem_no" name="mem_no">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Book No:</label>
      <input type="text" class="form-control" id="inputPassword4" placeholder="book no" name="book_no">
    </div>
  </div>

    <button type="submit" class="btn btn-primary" name="new_book_issue">Issue</button>

</form>

<br>
<br>

<?php
    
    if(isset($_SESSION['status']))
    {
      if($_SESSION['status']="issue_rec_deleted")
      {
        echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto role="alert">
          <strong>Book issue record deleted successfully</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';

        unset($_SESSION['status']);
      }
      else if($_SESSION['status']="iss_rec_updated")
      {
       

       echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto role="alert">
         <strong>Record updated successfully</strong>
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
      <th scope="col">Member No</th>
      <th scope="col">Stuent No</th>
      <th scope="col">Student Name</th>
      <th scope="col">Book No</th>
      <th scope="col">Book Name</th>
      <th scope="col">Book Author</th>
      <th scope="col">Date</th>
      <th scope="col">Action</th>

    </tr>



 

  </thead>
  <tbody>


    <?php
      
      $sql_1="SELECT iss_rec.iss_no,iss_rec.mem_no,iss_rec.iss_date,membership.stud_no,student.stud_name,iss_rec.book_no,book.book_name,book.author
           FROM iss_rec,student,book,membership
           WHERE iss_rec.mem_no=membership.mem_no AND
           membership.stud_no=student.stud_no AND
           iss_rec.book_no=book.book_no";

      $result = mysqli_query($con, $sql_1);

      if (mysqli_num_rows($result) >0) {
      
          while($row = mysqli_fetch_assoc($result)) {

      ?>

    <tr>

      <td><?php echo $row['mem_no'];?></td>
      <td><?php echo $row['stud_no'];?></td>
      <td><?php echo $row['stud_name'];?></td>
      <td><?php echo $row['book_no'];?></td>
      <td><?php echo $row['book_name'];?></td>
      <td><?php echo $row['author'];?></td>

      <td><?php echo $row['iss_date'];?></td>
      <td>
        <div class="btn-group" role="group" aria-label="Second group">
          <a href="edit_iss_rec.php?iss_no=<?php echo $row['iss_no'];?>" title="" class="btn btn-sm btn-warning">Edit</a>
          <a href="delete_iss_rec.php?iss_no=<?php echo $row['iss_no'];?>" title="" class="btn btn-sm btn-danger">Delete</a>
        </div>
      </td>
      </tr>
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

