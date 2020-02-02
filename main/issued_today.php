<?php
require('include/header.php');
require('include/dbh.inc.php');

date_default_timezone_set("Asia/Dhaka");
$date=date("Y-m-d");



    $sql="SELECT student.stud_no,student.stud_name, book.book_name, book.author,iss_rec.iss_date 
FROM student, book,iss_rec, membership 
WHERE membership.mem_no =iss_rec.mem_no 
AND student.stud_no = membership.stud_no 
AND book.book_no = iss_rec.book_no 
AND date(iss_rec.iss_date) ='$date'";

    $result=mysqli_query($con, $sql);




?>

<div class="container mt-4">

    <h3 align="center" class="mb-4">Today Issued Book List</h3>


   <div align="center">
   	<table class="table">
   	  <thead>
   	    <tr>
   	      <th scope="col">Stuent No</th>
   	      <th scope="col">Student Name</th>
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
   	      <td><?php echo $row['stud_no'];?></td>
   	      <td><?php echo $row['stud_name'];?></td>
   	      <td><?php echo $row['book_name'];?></td>
            <td><?php echo $row['author'];?></td>
            <td><?php echo $row['iss_date'];?></td>
   	    </tr>  

          <?php
           
               }}
             ?>

   	  </tbody>
   	</table>

	</div>

</div>



<?php
require('include/footer.php')
?>