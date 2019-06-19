<?php
session_start();
if(isset($_SESSION['user'])){
	die("You are not allowed to enter this area!");
}

$userRegister =  $_POST['user'];
$passwordRegister = $_POST['passw'];

$success = true;
if(strlen($userRegister)>30){
	$result = "Invaid username, max lenght is 30 characters.";
	$success = false;
}
if(strlen($passwordRegister>50)){
	$result = "Invaid password, max lenght is 50 characters.";
	$success = false;
}
if($success){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "foro";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
$userRegister =  mysqli_real_escape_string($conn, $userRegister);
$passwordRegister = mysqli_real_escape_string($conn, $passwordRegister);

	$sql = "INSERT INTO users (user, passw)
	values ('$userRegister', '$passwordRegister')";

	if ($conn->query($sql) === TRUE) {
		$result = "User registered successfully";
		$success = true;
	} else {
		$result = "Error: User already exists!";
		$success = false;
	}

	$conn->close(); 
}
?>
<html lang="en">
	<head>
		<title>Example Forum</title>
		<link rel="stylesheet" href="style.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
	</head>
	
	<body style="background-color:#91d1d8;">
		
		<header>
			<h1>Example Forum</h1>
		</header>
		<nav>
			<ul>
				<li><a href="index.php">Index</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Register</a></li>
			</ul>
		</nav>
		<article>
			<h3 class="titleList">Register</h3>
			<div id="login">
					<br>
					<?php echo $result; ?>
					<br><br>
					<?php
					if($success){
						echo "You may login now, <a href='login.php'>click here.</a>";
					}
					else{
						echo "<a href='register.php'>Go back</a>";
					}
					?>
					<br><br>
			</div>
			<br>
		</article>
		<footer>
			<h6>© Marc Casals Camps, 2019</h6>
		</footer>
	</body>
</html>
