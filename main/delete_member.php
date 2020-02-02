
<?php
require('include/header.php');
require('include/dbh.inc.php');

?>



<?php

if(isset($_POST['delete_member_submit']))
{




  $member_no=$_POST['mem_no'];


  if(!empty($member_no))
  {


    $sql_check="SELECT * from membership where mem_no='$member_no'";
    $result=mysqli_query($con,$sql_check);
    if(mysqli_num_rows($result)==0)
    {

        echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
        <strong>Enter valid member no</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';

    }else
    {


      $sql_issrec="DELETE FROM iss_rec where mem_no='$member_no'";

      if(mysqli_query($con,$sql_issrec))
      {
         $sql_mem="DELETE FROM membership where mem_no='$member_no'";

         if(mysqli_query($con,$sql_mem))
         {

              echo '<div class="alert alert-warning alert-dismissible fade show w-50 mx-auto" role="alert">
              <strong>Member delete successfully</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
         }

    }

  }


}

}


?>
	


<div class="container mt-4">


   <div align="center">
	<form method="post" action="delete_member.php">
	  <div class="form-group w-50" >
	    <label for="exampleInputEmail1">Enter member No:</label>
	    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Member No" name="mem_no">
	  </div>
	  <button type="submit" class="btn btn-primary" name="delete_member_submit">Delete</button>
	</form>

	</div>

</div>



<?php
require('include/footer.php')
?>