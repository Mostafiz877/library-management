<?php
require('include/header.php');
require('include/dbh.inc.php');

error_reporting(0);

$result="";


if(isset($_POST['author_submit']))
{
  $author=$_POST['author'];


  if(!empty($author)){


    $sql="SELECT student.stud_no,student.stud_name 
FROM student,membership,book,iss_rec 
WHERE student.stud_no = membership.stud_no 
AND membership.mem_no=iss_rec.mem_no 
AND iss_rec.book_no = book.book_no 
AND book.author='$author'
group BY student.stud_no";

    $result=mysqli_query($con, $sql);


          }
}


?>


<div class="container mt-4">


   <div align="center">
	<form method="post" action="list_by_author.php">
	  <div class="form-group w-50">
	    <label for="exampleInputEmail1">Enter Author Name :</label>
	    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="author">
	  </div>
	  <button type="submit" class="btn btn-primary" name="author_submit">Show</button>
	</form>

	</div>


	   <table class="table mt-4">
   	  <thead>
   	    <tr>
   	      <th scope="col">Stuent No</th>
   	      <th scope="col">Student Name</th>
   	      <th scope="col">Author Name</th>

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
   	      <td><?php echo $author;?></td>

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