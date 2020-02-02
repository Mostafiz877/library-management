<?php
require('include/header.php');
require('include/dbh.inc.php');



    $sql="SELECT student.stud_no,student.stud_name,COUNT(*) as 'number of books' FROM student, book,membership, iss_rec where iss_rec.Mem_no IN ( SELECT iss_rec.Mem_no FROM iss_rec GROUP BY iss_rec.Mem_no HAVING COUNT(iss_rec.Mem_no) = 3) AND student.stud_no=membership.stud_no AND membership.mem_no=iss_rec.Mem_no AND iss_rec.book_no=book.book_no group by student.Stud_name";

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
            <td><?php echo $row['number of books'];?></td>
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