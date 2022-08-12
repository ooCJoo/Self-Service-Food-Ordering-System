<?php
session_start();
$transaction_id = $_SESSION["user_id"];
//  echo '<script type="text/javascript">alert("' . $transaction_id . ' order.php!");window.location.href="order.php"</script>';

if ($transaction_id == "") {
    echo '<script type="text/javascript">window.location.href="../login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
 <style>
        .btn {
            border: 2px solid black;
            background-color: white;
            color: black;
            padding: 14px 28px;
            font-size: 16px;
            cursor: pointer;
        }

        /* Green */
        .success {
            border-color: #4CAF50;
            color: green;
        }

        .success:hover {
            background-color: #4CAF50;
            color: white;
        }
</style>
<head>
    <title>Transactions</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

    <link rel="stylesheet" href="template/bootstrap.min.css">
    <script src="template/jquery.min.js"></script>
    <script src="template/bootstrap.min.js"></script>
</head>

<?php include_once("../dbconfig.php"); ?>

<body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Food Ordering System</a>
            </div>
           <ul class="nav navbar-nav">
                <li><a href="transaction_user_kitchen.php">Ongiong Transactions</a></li>
	<li class="active"><a href="transaction_user_kitchen_s.php">Success Transactions</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="loginsession.php?ses=1"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Kitchen Transactions</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Orders</th>
                   
                    <th>Date and Time</th>
		<th>Food Status</th>

                   
	
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT
                transactions.id as tid,
                transactions.`status` as tstatus,
                transactions.total as ttotal,
                transactions.datetime as dt,
		transactions.paymentstatus as payments,
		transactions.foodserve as served
                FROM
                transactions              
                ";
       
                $res = mysqli_query($db, $sql);
                if (mysqli_num_rows($res) > 0) {

                    while ($rowTrans = mysqli_fetch_assoc($res)) {
                        # code...

                ?>
           <?php if ($rowTrans['served'] == 'Served'){ ?>
                        <tr>
                            <td> <?php echo $rowTrans['tid'] ?> </td>
                            <td>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $orders = "
                                        SELECT
                                        menu.id as s_mid,
                                        menu.`name` as mname,
                                        menu.price as mprice,
                                        menu.category,
                                        menu.photo,
                                        orders.id as s_oid,
                                        orders.transaction_id,
                                        orders.menu_id,
                                        orders.quantity as oquantity
                                        FROM
                                        menu
                                        INNER JOIN orders ON orders.menu_id = menu.id WHERE orders.transaction_id = " . $rowTrans['tid'] . " AND  orders.quantity != 0          
                                        ";



                                        $result = mysqli_query($db, $orders);
                                        if (mysqli_num_rows($result) > 0) {

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                # code...

 						?>
						
                                                <tr>
                                                    <td> <?php echo $row['mname'] ?> </td>
                                                    <td> <?php echo $row['mprice'] ?></td>
                                                    <td> <?php echo $row['oquantity'] ?> </td>
                                                </tr>
                                        <?php
				}

                                            
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </td>
                            
                            <td> <?php echo $rowTrans['dt'] ?> </td>
				<td> <?php echo $rowTrans['served'] ?></td>
				
  
<?php
 				if($rowTrans['served'] == 'Ongoing') {  ?>   


			<td><a href="payment.php?serv=<?php echo $rowTrans['tid'] ?>" class="del_btn"><button class="btn btn-success" name="button_confirmation" type="submit">Done!</button></a></td>
			<?php	}   ?>
                        </tr>
                <?php
}
                    }
                } else {
                    echo '<script>alert("No data found!")</script>';
                }
		
                ?>
            </tbody>
        </table>
    </div>

</body>


</html>