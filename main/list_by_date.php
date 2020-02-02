<?php
require('include/header.php');
require('include/dbh.inc.php');

error_reporting(0);

$result="";


if(isset($_POST['date_show_submit']))
{
  $date=$_POST['date'];

  if(!empty($date)){


    $sql="SELECT student.stud_name, book.book_name, book.author 
FROM student,book,membership,iss_rec 
WHERE student.stud_no = membership.stud_no 
AND membership.mem_no = iss_rec.mem_no 
AND book.book_no = iss_rec.book_no 
AND date(iss_rec.iss_date)='$date'";

    $result=mysqli_query($con, $sql);


          }
}


?>


<div class="container mt-4">


   <div align="center">
     
	<form method="post" action="list_by_date.php">
	  <div class="form-group w-50">
	    <label for="exampleInputEmail1">Enter date:</label>
	    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example-2019-08-30" name="date">
	  </div>
	  <button type="submit" class="btn btn-primary" name="date_show_submit">Show</button>
	</form>

	</div>


	   <table class="table mt-4">
   	  <thead>
   	    <tr>
   	      <th scope="col">Stuent Name</th>
   	      <th scope="col">Book Name</th>
   	      <th scope="col">Author</th>
            <th scope="col">Date</th>

   	    </tr>
   	  </thead>
   	  <tbody>


         <?php

           
           if (mysqli_num_rows($result) >0) {
           
               while($row = mysqli_fetch_assoc($result)) {

           ?>

   	    <tr>
   	      <td><?php echo $row['stud_name'];?></td>
   	      <td><?php echo $row['book_name'];?></td>
   	      <td><?php echo $row['author'];?></td>
            <td><?php echo $date;?></td>

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
