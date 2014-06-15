<?php
// Create connection
$con=mysqli_connect("127.0.0.1:3306","root","","imagebox");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//else echo "All is good fellas!";
	//get data

?>