<?php

	include 'config.php';

	session_start();

	$eUsername = "";
	$password = "";
	if (isset($_POST["btnSubmit"])) {

		$eUsername = $_POST["username"];
		$ePassword = $_POST["password"];

		$sessionID = mysqli_query($con, "SELECT username FROM employee WHERE username = '$eUsername' AND password = '$ePassword'");
		$_SESSION["username"] = mysqli_fetch_row($sessionID)[0];

		$sessionEmpID = mysqli_query($con, "SELECT employeeID FROM employee WHERE username = '$eUsername' AND password = '$ePassword'");
		$_SESSION["eID"] = mysqli_fetch_row($sessionEmpID)[0];

		$sqlEmployeeName = mysqli_query($con, "SELECT employeeName FROM employee WHERE employeeID = {$_SESSION['eID']} ");
		$_SESSION["eName"] = mysqli_fetch_row($sqlEmployeeName)[0];

		header("Location: home.php");
		exit();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>RYCK Construction</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="login">
		<img src="images/logo.png" width="400px">
		<p>&nbsp; Please fill in your credentials to login.</p>
		<form method="post">
			<label for="username">
				<i class="fas fa-user"></i>
			</label>
			<input type="text" name="username" placeholder="Username" required>
			<label for="password">
				<i class="fas fa-lock"></i>
			</label>
			<input type="password" name="password" placeholder="Password" required>
			<input type="submit" value="Login" name="btnSubmit">
			<input type="submit" value="Forgot Password">
		</form>
	</div>
</header>
</body>
</html>