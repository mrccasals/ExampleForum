<?php
session_start();
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
			<h3 class="titleList">Post list</h3>
			<?php
				if(isset($_SESSION['user'])){
					echo "<div class='buttonPost'><a href='new_post.php'><b>Create Post</b></a></div><br>";
				}
			?>
			<?php
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "foro";
					
					$conn = new mysqli($servername, $username, $password, $dbname);
					
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					$sql = "SELECT idPost, title FROM post ORDER BY idPost DESC";
					$result = $conn->query($sql);
					
					while($row = $result->fetch_assoc()){
						echo "<div class='postTitle'>
				
								<a href='show.php?post=". $row['idPost'] ."'><b>". htmlentities($row['title']) ."</b></a>
							</div><br>";
					}
				?>
		</article>
		<footer>
			<h6>© Marc Casals Camps, 2019</h6>
		</footer>
	</body>
</html>