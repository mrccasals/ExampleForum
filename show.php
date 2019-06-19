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
			<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "foro";
				
				$thisID = $_GET['post'];
				
				if(!isset($thisID)){
					die("Invalid post");
				}
				
				$conn = new mysqli($servername, $username, $password, $dbname);
				
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT idPost, title, posted, author  FROM post WHERE idPost = '$thisID'";
				
				
				$result = $conn->query($sql);
				
				if($result->num_rows == 0){
					die("Invalid post");
				}
				
				$row = $result->fetch_assoc();
				
				$thisTitle = $row['title'];
				$thisText = $row['posted'];
				$thisAutor = $row['author'];
				
			?>
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
				?>
			</ul>
		</nav>
		<article>
			<h3 class="titleList"><?php echo $thisTitle; ?></h3>
			<?php
				if(isset($_SESSION['user'])){
					echo "<div class='buttonPost'>
						<a href='new_reply.php?post=" .$thisID . "'><b>Comment</b></a></div><br>";
				}
				
				echo "<div class='postTitle'><i>" . $thisAutor . " says:</i><br><br>
						" . $thisText . "
							</div><br>";
					

					$sql = "SELECT idComment ,author, posted FROM comment WHERE idPost = '$thisID' ORDER BY idPost DESC";
					$result = $conn->query($sql);
					
					while($row = $result->fetch_assoc()){
						echo "<div class='postTitle'><i>" . $row['author'] . " says:</i><br><br>
						" . $row['posted'] . "
							</div><br>";
					}
				?>
		</article>
		<footer>
			<h6>© Marc Casals Camps, 2019</h6>
		</footer>
	</body>
</html>