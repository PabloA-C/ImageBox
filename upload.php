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
				
			
			  	$user_id = $_POST['user_id'];
				$url = $_POST['url'];
				$title = $_POST['title'];
				$description = $_POST['description'];
				
				$password = sha1($password);

				$dbc = mysqli_connect("127.0.0.1:3306","root","","imagebox")
				or die('Error connecting to MySQL server.');
				
				$query = "INSERT INTO image (image_title, image_description, image_url, image_votes, user_id) VALUES ('$title', '$description', '$url','0','$user_id')";
					$result = mysqli_query($dbc, $query) or die ('Error querying database.2');
					mysqli_close($dbc);
					header('Location: index.php');
				
			?>


            </div>


    </body>
</html>