<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>IMAGEBOX</title>
    </head>

    <body>
		<div>
			<?php 
				session_start();
				if (isset($_SESSION['user']) && isset($_SESSION['loggedin'])){
					$user = $_SESSION['user'];
					$loggedin = $_SESSION['loggedin'];
				}
				else{
					header('Location: login.html');
				}

				if ($loggedin){
				// THE MAIN CONTET OF THE PAGE FOR LOOGED IN USERS
					echo 'Hello ' . $user . '! :)';
				}
			?>
		</div>
	</body>
</html>