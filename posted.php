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

$maxPost = "SELECT MAX(idPost) AS max_post FROM post";

if($conn->query($maxPost) == FALSE) die("Error picking max");
$resultMax = $conn->query($maxPost);

$row = $resultMax->fetch_assoc();
$nMax = (int) $row['max_post'];
$nMax++;


$postUser =  mysqli_real_escape_string($conn, $postUser);
$postTitle = mysqli_real_escape_string($conn, $postTitle);
$postText = mysqli_real_escape_string($conn, $postText);

$sql = "INSERT INTO post (idPost, author, title, posted) values ('$nMax', '$postUser','$postTitle','$postText')";

if ($conn->query($sql) === TRUE) {
	$result = "Post created!";
	$success = true;
} else {
	$result = "Something went wrong.";
	echo "Error: " . $sql . "<br>" . $conn->error;
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
				<?php
				if(isset($_SESSION['user'])){
					echo "<li><a href='user.php'>". htmlentities($_SESSION['user']) ."</a></li>
					<li><a href='disconnect.php'>Disconnect</a></li>";
				}
				else{
					echo "<li><a href='login.php'>Login</a></li>
						<li><a href='register.php'>Register</a></li>";
				}
				?>
			</ul>
		</nav>
		<article>
			<h3 class="titleList">Success!</h3>
			<div id="login">
					<br>
					<?php 
						echo $result; 
						header( "refresh:1;url=index.php" );
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