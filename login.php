<?php session_start();
$string = "";
$email = $_POST['email'];
$password = $_POST['password'];

$password = sha1($password);

$dbc = mysqli_connect("127.0.0.1:3306","root","","imagebox") or die('Error connecting to MySQL server.');
$query1 = "SELECT * from user where user_email = '$email'";
$result1 = mysqli_query($dbc, $query1) or die('Error querying database1.');
$user = mysqli_fetch_object($result1);

if ($user != NULL) {
	if ($user -> user_password == $password) {
		setcookie('visit', $email, time() + 60 * 60 * 24 * 30);
		$_SESSION["loggedin"] = true;
		$_SESSION['user'] = $user -> user_name;
		$_SESSION['user_id'] = $user -> user_id;
		header('Location: index.php');
	} else {
		$string = 'Wrong password! <BR><BR><a href="login.html">Return to login page</a> ';
	}
} else {
	$string = 'The user with e-mail ' . $email . ' does not exist.<BR><BR><a href="login.html">Return to login page</a> ';
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	</head>
	<body>

		<?php
		echo $string;
		?>

		</div>
	</body>
</html>
