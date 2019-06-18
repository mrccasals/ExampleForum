<?php
session_start();
session_unset(); 
session_destroy();
header( "refresh:0;url=index.php" );
?>
<html lang='en'>
	<header>
		<title>Disconnected</title>
	</header>
	<body style="background-color=#91d1d8;">
	</body>
</html>