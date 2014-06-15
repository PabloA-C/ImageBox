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
				$image_id = $_POST['image_id'];
				$image = $_POST['image'];
				$title = $_POST['image_title'];
				
			
				$dbc = mysqli_connect("127.0.0.1:3306","root","","imagebox")
				or die('Error connecting to MySQL server.');
				
				
				//$query = "SELECT * from comment where image_id = '$image_id'";
				$query = "SELECT user.user_name, comment.text, comment.sended from user INNER JOIN comment ON user.user_id=comment.user_id where image_id = '$image_id' ORDER BY comment.comment_id DESC";
				//$query2 = "SELECT user_name from user where image_id = '$image_id'";
					$result = mysqli_query($dbc,$query);
					echo "<center><h2>'$title'</h2>";
					echo "<img class='media' src=$image/></center>";
    echo "<center><table border='1'><tr><th>User</th><th>Comment</th><th>Date</th></tr>";

while($row    = mysqli_fetch_assoc($result))
  {
  echo "<tr>";
  echo "<td>" . $row['user_name'] . "</td>";
  echo "<td>" . $row['text'] . "</td>";
    echo "<td>" . $row['sended'] . "</td>";
  echo "</tr>";
  }
echo "</table></center>";
	mysqli_close($dbc);
	echo "<div id='startpanel'>
		<center>
			<form method='post' action='addcomment.php'>
				Add a comment: <Br> <input type='text' id='comment' name='comment'>
				<input type='hidden' name='user_id' value='$user_id' >
			<input type='hidden' name='image_id' value='$image_id' >
				<BR><BR><input type='submit' value='add' name='submit'>
			</form>
        </div>";
	echo "<center><a href='index.php'>Back</a> </center>";
					//header('Location: index.php');
				
			
			
				$dbc = mysqli_connect("127.0.0.1:3306","root","","imagebox")
				or die('Error connecting to MySQL server.');
				
				
			
				$query = "UPDATE image SET image_votes = image_votes + 1 WHERE image_id= $image_id";	
					
					//header('Location: index.php');
					
					
					
				
				
				
			?>


            </div>


    </body>
</html>