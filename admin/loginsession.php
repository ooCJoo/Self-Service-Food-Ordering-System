
<?php include("../dbconfig.php"); ?>
<?php 
if ($_GET['ses']==1) {
	session_start();
	session_unset();
    session_destroy();
	 echo '<script type="text/javascript">alert("Log Out Successfully!");window.location.href="../login.php"</script>';
}

  ?>