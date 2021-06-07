<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'procurementsystem';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ( !isset($_POST['username'], $_POST['password']) ) {
	exit('Please fill both the username and password fields!');
}


if ($stmt = $con->prepare('SELECT username, password FROM employee WHERE username = username')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

	$sessionName = mysqli_query($con, "SELECT employeeID FROM employee WHERE username = '$username' AND password = '$password'");
	$_SESSION["eName"] = mysqli_fetch_row($sessionName)[0];

	if ($stmt->num_rows > 0) {
	$stmt->bind_result($employeeID, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if ($_POST['password'] === $password) {
		//session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		//$_SESSION['eName'] = $employeeName;
		$_SESSION['id'] = $employeeID;
		header('Location: request.php');
		//echo 'Welcome ' . $_SESSION['name'] . '!';
	} else {
		echo 'Incorrect username and/or password!';
	}
	} else {

		echo 'Incorrect username and/or password!';
	}

	$stmt->close();
}
?>