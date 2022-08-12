<?php 

$db = mysqli_connect("localhost", "root123", "1234", "fos");

if($db == ""){
	echo '<script type="text/javascript">alert("Check database connection");window.location.href="404.html";</script>';
}

 ?>
