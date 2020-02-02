<?php
require('include/header.php');
require('include/dbh.inc.php');



    $sql="SELECT student.stud_no,student.stud_name, COUNT(iss_rec.Book_no) AS total_book_number 
FROM student,membership,iss_rec 
WHERE student.Stud_no=membership.Stud_no 
AND membership.Mem_no=iss_rec.Mem_no 
GROUP BY student.Stud_no";

    $result=mysqli_query($con, $sql);




?>


<div class="container mt-4">


   <div align="center">
   	<table class="table">
   	  <thead>
   	    <tr>
   	      <th scope="col">Stuent No</th>
   	      <th scope="col">Student Name</th>
   	      <th scope="col">Book Number</th>

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
   	      <td><?php echo $row['total_book_number'];?></td>
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