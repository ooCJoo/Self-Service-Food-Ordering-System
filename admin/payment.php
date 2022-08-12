<?php include("../dbconfig.php"); ?>
<?php 
if (isset($_GET['pays'])) {
	$id = $_GET['pays'];
	session_start(); 
	$id1 = $_SESSION['user_id'];
	$stmt = $db->prepare("UPDATE transactions set paymentstatus='Payment Received', status='Success', user_id=$id1 where id=$id");
	 if ($stmt->execute()) {
	$stmt = $db->prepare("UPDATE transactions set foodserve='Ongoing' where id=$id");
	$stmt->execute();
	 echo '<script type="text/javascript">alert("Transacted Successfully!");window.location.href="transaction_user_cashier.php"</script>';
	
}
  
}


if (isset($_GET['serv'])) {
	$id = $_GET['serv'];

	$stmt = $db->prepare("UPDATE transactions set foodserve='Served' where id=$id");
	 if ($stmt->execute()) {	
	 echo '<script type="text/javascript">alert("Served Successfully!");window.location.href="transaction_user_kitchen.php"</script>';
	
}
   
}

  ?>