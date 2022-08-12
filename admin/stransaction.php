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
	
                <li><a href="transaction.php">Transactions</a></li>
		<li class="active"><a href="stransaction.php">Success Transaction</a></li>
                <li><a href="menu.php">Menu</a></li>
		<li><a href="account.php">Accounts</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="loginsession.php?ses=1"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Transactions</h2>
        <table class="table">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Orders</th>
                  <th>Total Amount</th>
                  <th>Date and Time</th>
		<th>Transacted By</th>
		
                    
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
		transactions.user_id as userid
                FROM
                transactions              
                ";

                $res = mysqli_query($db, $sql);
                if (mysqli_num_rows($res) > 0) {

                    while ($rowTrans = mysqli_fetch_assoc($res)) {
                        # code...

                ?>
<?php if ($rowTrans['tstatus'] == 'Success'){ ?>
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
                            <td> <?php echo $rowTrans['ttotal'] ?> </td>
                            <td> <?php echo $rowTrans['dt'] ?> </td>
                            
				 <td>StaffNo.<?php echo $rowTrans['userid'] ?></td>
				
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