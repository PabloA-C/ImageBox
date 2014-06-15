<!DOCTYPE html>
<html lang="en">
	<head>
		<title>ImageBOX</title>
		<meta charset="utf-8">
		<meta name="author" content="pixelhint.com">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/modal.css" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/main.js"></script>

		</script>
	</head>
	<body>

		<header>
			<div class="logo">
				<a href="index.php"><img src="img/logo.png" alt="ImageBox"></a>
			</div>

			<div id="menu_icon"></div>

			<nav id="nav_menu">
				<ul>

					<li><div>
					<?php
					if (session_id() == '') {
						session_start();
						if (isset($_SESSION['user']) && isset($_SESSION['loggedin']) & isset($_SESSION['user_id'])) {
							$user = $_SESSION['user'];
							$loggedin = $_SESSION['loggedin'];
							$user_id = $_SESSION['user_id'];

							echo '
<li class="selected">
<a href="#">Hello ' . $user . '! :)</a>
</li>';

							echo '
<li>
<a href="logout.php">Logout</a>

<li><a href="#upload_form" id="upload_pop">Upload image</a> </li>
</li>';

						} else {
							echo '<a href="#login_form" id="login_pop">Login</a>
<li><a href="#register_form" id="register_pop">Register</a> </li>';
						}
					}
					?>

					</div></li>

					<li>
						<a href="#team_form" id="team_pop">Our team</a>
					</li>

				</ul>
			</nav>

			<div class="social_widget">
				<div class="sm">
					<ul>
						<li>
							<a href="https://www.facebook.com/groups/668543863211792/" target="_blank" class="fb"><i></i></a>
						</li>
						<li>
							<a href="http://twitter.com/" target="_blank" class="t"><i></i></a>
						</li>
						<li>
							<a href="https://plus.google.com/" target="_blank" class="g"><i></i></a>
						</li>
						<li>
							<a href="mailto:pablo_pelusa@hotmail.com" target="_blank" class="mail"><i></i></a>
						</li>
					</ul>
				</div>
			</div>

		</header><!-- End header  -->

		<section class="main">

			<?php
			include "php/connection.php";
			//get data
			$query = sprintf("SELECT * FROM image ORDER BY image_votes DESC");
			$result = mysqli_query($con, $query);
			if (!$result) {
				exit("Invalid query: " . mysql_error());
			}
			while ($data = mysqli_fetch_array($result)) {

				$displayButtons = false;
				$logged = false;
				if (isset($_SESSION['user']) && isset($_SESSION['loggedin']) & isset($_SESSION['user_id'])) {
					$user = $_SESSION['user'];
					$loggedin = $_SESSION['loggedin'];
					$user_id = $_SESSION['user_id'];

					$dbc = mysqli_connect("127.0.0.1:3306", "root", "", "imagebox") or die('Error connecting to MySQL server.');
					$query1 = "SELECT * from vote where user_id = '$user_id' AND image_id = '$data[0]'";

					$result1 = mysqli_query($dbc, $query1) or mysqli_error($dbc);

					$alreadyVoted = mysqli_fetch_object($result1);

					$commentquery = "SELECT text from comment where user_id = '$user_id' AND image_id = '$data[0]'";
					$resultcomment = mysqli_query($dbc, $commentquery);

					if ($alreadyVoted == NULL) {

						$displayButtons = true;

					}

					if ($user != NULL) {

						$logged = true;

					}

				}

				if ($displayButtons == true) {

					echo("
			<div class='item'>
			<a href='#$data[1]' class='work'> <img class='media' src=$data[3]/>
			<div class='content'>
			<h2 class='title'>$data[1]</h2>
			</div> </a>

			</div>

			<a href='#' class='overlay' id='$data[1]'></a>
			<div class='popup'>

			<div id='startpanel'>

			<div class='imagePop'>
			<h2 class='title'>$data[1]</h2>
			<img class='media' src=$data[3]/>
			<BR>
			<h3 class='title'>$data[2]</h3>

			<form method='post' action='upvote.php'>

			<input type='hidden' name='user_id' value='$user_id' >
			<input type='hidden' name='image_id' value='$data[0]' >
			<input type='submit' value='I like this picture!' name='like'>

			</form>

			<form method='post' action='downvote.php'>
			<input type='hidden' name='user_id' value='$user_id' >
			<input type='hidden' name='image_id' value='$data[0]' >
			<input type='submit' value='I do not like it!' name='dislike''>
			</form>
			
			<form method='post' action='comments.php'>
			<input type='hidden' name='user_id' value='$user_id' >
			<input type='hidden' name='image_id' value='$data[0]' >
			<input type='hidden' name='image' value='$data[3]' >
			<input type='hidden' name='image_title' value='$data[1]' >
			<input type='submit' value='Comments' name='Comments''>
			</form>
		
			</div>

			</div>
			</div>

			");

				} else if ($logged == true) {

					echo("
			<div class='item'>
			<a href='#$data[1]' class='work'> <img class='media' src=$data[3]/>
			<div class='content'>
			<h2 class='title'>$data[1]</h2>
			</div> </a>

			</div>

			<a href='#' class='overlay' id='$data[1]'></a>
			<div class='popup'>

			<div id='startpanel'>

			<div class='imagePop'>
			<h2 class='title'>$data[1]</h2>
			<img class='media' src=$data[3]/>
			<BR>
			<h3 class='title'>$data[2]</h3>
			
			
			<form method='post' action='comments.php'>
			<input type='hidden' name='user_id' value='$user_id' >
			<input type='hidden' name='image_id' value='$data[0]' >
			<input type='hidden' name='image' value='$data[3]' >
			<input type='hidden' name='image_title' value='$data[1]' >
			<input type='submit' value='Comments' name='Comments''>
			</form>

			</div>

			</div>
			</div>

			");

				} else {

					echo("
			<div class='item'>
			<a href='#$data[1]' class='work'> <img class='media' src=$data[3]/>
			<div class='content'>
			<h2 class='title'>$data[1]</h2>
			</div> </a>

			</div>

			<a href='#' class='overlay' id='$data[1]'></a>
			<div class='popup'>

			<div id='startpanel'>

			<div class='imagePop'>
			<h2 class='title'>$data[1]</h2>
			<img class='media' src=$data[3]/>
			<BR>
			<h3 class='title'>$data[2]</h3>
			
			
			

			</div>

			</div>
			</div>

			");

				}

			}
			?>

			<a href="#" class="overlay" id="login_form"></a>
			<div class="popup">
			<div id="startpanel">
			<BR>
			Login:
			<BR>
			<BR>
			<form method="post" action="login.php">
			e-mail:
			<Br>
			<input type="text" id="email" name="email">
			<BR>
			Password:
			<BR>
			<input type="password" id="password" name="password">
			<BR>
			<BR>
			<input type="submit" value="Login" name="submit">
			</form>
			</div>
			</div>

			<a href="#" class="overlay" id="register_form"></a>
			<div class="popup">

			<div id="startpanel">
			<BR>
			Registration:
			<BR>
			<BR>
			<form method="post" action="registration.php">
			e-mail:
			<BR>
			<input type="text" id="email" name="email">
			<BR>
			Name:
			<BR>
			<input type="text" id="name" name="name">
			<BR>
			Password:
			<BR>
			<input type="password" id="password" name="password">
			<BR>
			<BR>
			<input type="submit" value="Zarejestruj" name="submit">
			</form>
			</div>
			</div>

			<a href="#" class="overlay" id="upload_form"></a>
			<div class="popup">

			<div id="startpanel">
			<BR>
			Registration:
			<BR>
			<BR>
			<form method="post" action="upload.php">
			<BR>
			URL:
			<BR>
			<input type="text" id="url" name="url">
			<BR>
			Title:
			<BR>
			<input type="text" id="title" name="title">
			<BR>
			Desription:
			<BR>
			<input type="textarea" id="description" name="description">
			<BR>
			<BR>
			<?php

			echo(" <input type='hidden' name='user_id' value='$user_id' > ");
			?>

			<input type="submit" value="upload" name="upload">
			</form>
			</div>
			</div>

			<a href="#" class="overlay" id="team_form"></a>
			<div class="popup">

			<div id="startpanel">

			<div class='content'>

			<h2 class='title'>Pablo Arjonilla</h2>
			<h2 class='title'>Paweł Gonciarek </h2>
			<h2 class='title'>Madzia Sobczyńska</h2>
			<h2 class='title'>Jakub Matusiak</h2>
			<h2 class='title'>Julio Valverde</h2>
			<h2 class='title'>Maciej Kraśkiewicz</h2>

			</div>

			</div>
			</div>

		</section><!-- End main  -->

	</body>
</html>