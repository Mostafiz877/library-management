<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <title>Rental Library Project</title>
</head>
<body>
	<br>
<div class="container">
	

	<ul class="nav" >
		<li class="nav-item">
			<a class="nav-link" href="home.php">Home</a>
		</li>		

		<li class="nav-item">
			<a class="nav-link" href="add_stu.php">Add Stu.</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="delete_stu.php">Delete Stu.</a>
		</li>

		<li class="nav-item dropdown">
		  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Operation</a>
		  <div class="dropdown-menu">
		    <a class="dropdown-item" href="list_by_date.php">3| List By a Specific date</a>
		    <a class="dropdown-item" href="list_by_author.php">4| List By Specific Author Name</a>
		    <a class="dropdown-item" href="each_stu_borrow_book.php">5| Each Student borrowed book</a>
		    <a class="dropdown-item" href="3_book.php">6| 3 book borrowed Student</a>
		    <a class="dropdown-item" href="individual_list.php">7| Individual Student Book List</a>
		    <a class="dropdown-item" href="issued_today.php">8| Today Issued</a>
		  </div>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="add_book.php">Add New Book</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="delete_book.php">Delete Book</a>
		</li>	

        <li class="nav-item">
			<a class="nav-link" href="add_member.php">Add Mem</a>
		</li>

		 <li class="nav-item">
					<a class="nav-link" href="delete_member.php">Delete Mem</a>
	     </li>

		 <li class="nav-item">
					<a class="nav-link" href="book_issue.php">Issue Book</a>
	      </li>


	      <li class="nav-item">
					<a class="nav-link" href="include/logout.inc.php">Logout</a>
	      </li>

	</ul>

	<hr>

	</div>