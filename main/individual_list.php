<?php
require('include/header.php');
require('include/dbh.inc.php');

error_reporting(0);

$result="";


if(isset($_POST['individual_submit']))
{
  $stud_no=$_POST['stud_no'];


  if(!empty($stud_no)){


    $sql="SELECT student.stud_no,student.stud_name,book.book_no, book.book_name, book.author 
FROM student,book,membership,iss_rec 
WHERE student.Stud_no = membership.Stud_no 
AND book.Book_no = iss_rec.Book_no 
AND membership.Mem_no = iss_rec.Mem_no 
AND student.Stud_no = '$stud_no'";

    $result=mysqli_query($con, $sql);


          }
}


?>


<div class="container mt-4">


   <div align="center">
	<form method="post" action="individual_list.php">
	  <div class="form-group w-50">
	    <label for="exampleInputEmail1">Enter Student No:</label>
	    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="stud_no">
	  </div>
	  <button type="submit" class="btn btn-primary" name="individual_submit">Show</button>
	</form>

	</div>


	   <table class="table mt-4">
   	  <thead>
   	    <tr>
   	      <th scope="col">Stuent No</th>
            <th scope="col">Stuent Name</th>
            <th scope="col">Book No</th>
   	      <th scope="col">Book Name</th>
            <th scope="col">Author</th>

   	    </tr>
   	  </thead>
   	  <tbody>


         <?php

           
           if (mysqli_num_rows($result) >0) {
           
               while($row = mysqli_fetch_assoc($result)) {

           ?>

   	    <tr>
   	      <td><?php echo $row['stud_no'];?></td>
   	      <td><?php echo $row['stud_name'];?></td>
            <td><?php echo $row['book_no'];?></td>
            <td><?php echo $row['book_name'];?></td>
            <td><?php echo $row['author'];?></td>

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