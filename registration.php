<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="style1.css" />
        <title>IMAGEBOX</title>
    </head>
    <body>

            <div id="startpanel">
			<?php

				$name = $_POST['name'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				
				$password = sha1($password);

				$dbc = mysqli_connect("127.0.0.1:3306","root","","imagebox")
				or die('Error connecting to MySQL server.');
			
				$query1 = "SELECT * from user where user_email = '$email'";
				$result1 = mysqli_query($dbc, $query1) or die('Error querying database1.');
				$row1=mysqli_fetch_object($result1);

				if($row1 == NULL){
					$query = "INSERT INTO user (user_name, user_email, user_password) VALUES ('$name', '$email', '$password')";
					$result = mysqli_query($dbc, $query) or die ('Error querying database.2');
					mysqli_close($dbc);
					header('Location: index.php');
				}

				else{
					echo 'The email is already in database' ;
				}
			?>


            </div>


    </body>
</html>