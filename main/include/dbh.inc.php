<?php
$servername="localhost";
$dbUsername="root";
$password="";
$dbName="rlibrary";

$con=mysqli_connect($servername,$dbUsername,$password,$dbName);


if (!$con) {

	die("Connection Failed:".mysqli_connect_error());
}