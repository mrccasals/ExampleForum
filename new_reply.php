<?php
session_start();

if(!isset($_SESSION['user'])){
	die("You are not allowed to enter this area!");
}
?>

<!DOCTYPE html>
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
					echo "<li><a href='user.php'>". $_SESSION['user'] ."</a></li>
					<li><a href='disconnect.php'>Disconnect</a></li>";
				}
				else{
					echo "<li><a href='login.php'>Login</a></li>
						<li><a href='register.php'>Register</a></li>";
				}
				
				$thisID = $_GET['post'];
				$thisID = (int) $thisID;
				?>
			</ul>
		</nav>
		<article>
			<h3 class="titleList">New Comment</h3>
				<div id="login">
					<br><br>
					<form action="commented.php" method="post">
						<textarea name="message" rows="20" cols="100"></textarea><br><br>
						<input type='hidden' name='thisID' value='<?php echo "$thisID";?>'/>
						<input type="submit" name="enterText" value="Send"><br>
					</form>
				<br><br>
			</div>
			<br>
		</article>
		<footer>
			<h6>© Marc Casals Camps, 2019</h6>
		</footer>
	</body>
</html>