<?php include("../dbconfig.php"); ?>
<?php 
if (isset($_GET['del'])) {
	$id = $_GET['del'];

	$stmt = $db->prepare("DELETE FROM user_accounts WHERE id = $id");
	 if ($stmt->execute()) {
	
	 echo '<script type="text/javascript">alert("Deleted Successfully!");window.location.href="account.php"</script>';
}
   else {
            echo '<script type="text/javascript">alert("Delete Unsuccessful!");window.location.href="account.php"</script>';
        }
}
  ?>