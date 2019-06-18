<?php
$userLogin =  $_POST['user'];
$passwordLogin = $_POST['passw'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foro";

$conn = new mysqli($servername, $username, $password, $dbname);
$success = true;

if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
$sql = "SELECT user, passw FROM users WHERE user = '$userLogin' and passw = '$passwordLogin'";
$result = $conn->query($sql);
if($result->num_rows != 1){
	$result = "Invalid credentials, try again.";
	$success = false;
}
else{
	$result = "Welcome back " . $userLogin . "!";
	$_SESSION["user"] = $userLogin;
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
					<?php echo $result; ?>
					<br><br>
					<?php
					if($success){
						echo "Redirecting you in 3 seconds.</a>";
						header( "refresh:3;url=index.php" );
					}
					else{
						echo "<a href='login.php'>Go back</a>";
						header( "refresh:20;url=login.php" );
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