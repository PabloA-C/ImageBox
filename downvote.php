﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="style1.css" />
        <title>IMAGEBOX</title>
    </head>
    <body>

            <div id="startpanel">
			<?php
				
			
			  	$user_id = $_POST['user_id'];
				$image_id = $_POST['image_id'];
				
			
				$dbc = mysqli_connect("127.0.0.1:3306","root","","imagebox")
				or die('Error connecting to MySQL server.');
				
				
				$query = "INSERT INTO vote (user_id, image_id) VALUES ('$user_id','$image_id')";
					$result = mysqli_query($dbc, $query) or die ('Error querying database.2');
					mysqli_close($dbc);
					header('Location: index.php');
				
			
			
				$dbc = mysqli_connect("127.0.0.1:3306","root","","imagebox")
				or die('Error connecting to MySQL server.');
				
				
			
				$query = "UPDATE image SET image_votes = image_votes - 1 WHERE image_id= $image_id";	
					$result = mysqli_query($dbc, $query) or die ('Error querying database.2');
					mysqli_close($dbc);
					header('Location: index.php');
					
					
					
				
				
				
			?>


            </div>


    </body>
</html>