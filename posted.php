<?php
session_start();

if(!isset($_SESSION['user'])){
	die("You are not allowed to enter this area!");
}

$postTitle =  $_POST['title'];
$postText = $_POST['message'];
$postUser = $_SESSION['user'];

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
 
$maxPost = "SELECT max(idPost) FROM post";
$resultMax = $conn->query($maxPost);
$nMax = $resultMax->fetch_assoc();
$nMax = (int) $nMax;
$nMax++;
 
$sql = "INSERT INTO post (idPost, author, title, posted) values ('$nMax', '$postUser', '$postTitle', '$postText')";

if ($conn->query($sql) === TRUE) {
	$result = "Post created!";
	$success = true;
} else {
	$result = "Something went wrong.";
	$success = false;
}

$conn->close(); 
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
					<?php 
						echo $result; 
						header( "refresh:60;url=index.php" );
					?>
					<br><br>
					<br><br>
			</div>
			<br>
		</article>
		<footer>
			<h6>© Marc Casals Camps, 2019</h6>
		</footer>
	</body>
</html>