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
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Register</a></li>
			</ul>
		</nav>
		<article>
			<h3 class="titleList">Register</h3>
			<div id="login">
			<br><br>
				<form action="register_connect.php" method="post">
					<b>Username:</b><br>
					<input type="text" name="user"><br>
					<b>Password:</b><br>
					<input type="password" name="passw"><br><br>
					<input type="submit" name="Login" value="Register"><br>
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