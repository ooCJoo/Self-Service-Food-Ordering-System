<?php
session_start();
$transaction_id = $_SESSION['transaction_id'];
//  echo '<script type="text/javascript">alert("' . $transaction_id . ' order.php!");window.location.href="order.php"</script>';

if ($transaction_id == "") {
    echo '<script type="text/javascript">window.location.href="index.php"</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Food Ordering System</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- owl css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- awesome fontfamily -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<!-- body -->
<?php include_once("dbconfig.php"); ?>


<body class="main-layout">

    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="" /></div>
    </div>

    <div class="wrapper">

        <div id="content">

            <header>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="full">
                                <!-- <a class="logo" href="index.html"><img src="images/logo.png" alt="#" /></a> -->
                                <form method="POST">
                                    <button type="submit" name="back" class="send">Back</button>
                                </form>
                                <div class="right_header_info">
                                    <ul>
                                        <li class="dinone">*Note: If you press the back button, all of your orders will be cancelled!</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="full">
                                <div class="right_header_info">
                                    <ul>
                                        <li class="dinone">Contact Us : <img style="margin-right: 15px;margin-left: 15px;" src="images/phone_icon.png" alt="#"><a href="#">0911-222-3333</a></li>
                                        <li class="dinone"><img style="margin-right: 15px;" src="images/mail_icon.png" alt="#"><a href="#">restaurant@gmail.com</a></li>
                                        <li class="dinone"><img style="margin-right: 15px;height: 21px;position: relative;top: -2px;" src="images/location_icon.png" alt="#"><a href="#">Koronadal City, South Cotabato, Philippines</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- blog -->
            <div class="blog">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="title">
                                <i><img src="images/title.png" alt="#" /></i>
                                <h2>Our Menu</h2>
                                <span>We serve the best food for you.</span>
                                <!-- <a href="#" data-toggle="modal" data-target="#viewModal">
                                    <button class="send" style="border: 2px solid black;">View Orders</button>
                                </a> -->
                            </div>
                        </div>
                        <div class="col-md-9">
                            <!-- table view order list -->
                            <h3>Order List</h3>
                            <div class="col-md-12 pr-1">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Transaction No.</th>
                                            <th>Orders</th>
                                            <th>Total Amount</th>
                                            <th>Function</th>
                                            <!-- <th>Date and Time</th> -->
                                            <!-- <th>Status</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT
                                    transactions.id as tid,
                                    transactions.`status` as tstatus,
                                    transactions.total as ttotal,
                                    transactions.datetime as dt
                                    FROM
                                    transactions where id=" . $_SESSION['transaction_id'] . "           
                                    ";

                                        $res = mysqli_query($db, $sql);
                                        if (mysqli_num_rows($res) > 0) {

                                            while ($rowTrans = mysqli_fetch_assoc($res)) {
                                                # code...

                                        ?>
                                                <tr>
                                                    <!-- transaction id -->
                                                    <td> <?php echo $rowTrans['tid'] ?> </td>
                                                    <!-- orders -->
                                                    <td>
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Price</th>
                                                                    <th>Quantity</th>
                                                                    <th>Function</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $orders = "SELECT
                                                            menu.id as s_mid,
                                                            menu.`name`,
                                                            menu.price,
                                                            menu.category,
                                                            menu.photo,
                                                            orders.id as s_oid,
                                                            orders.transaction_id,
                                                            orders.menu_id,
                                                            orders.quantity
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
                                                                            <td> <?php echo $row['name'] ?> </td>
                                                                            <td> <?php echo $row['price'] ?></td>
                                                                            <td> <?php echo $row['quantity'] ?> </td>
                                                                            <td>
                                                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#removeMenu">
                                                                                    <button onclick="remove_menu(<?= $row['s_oid'] ?>)" class="btn danger">Remove Menu</button>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                <?php

                                                                    }
                                                                }

                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <!-- total -->
                                                    <td> <?php echo $rowTrans['ttotal'] ?> </td>
                                                    <td>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#checkoutOrder">
                                                            <button onclick="checkout_order(<?php $rowTrans['tid'] ?>)" class="btn success">Checkout Order</button>
                                                        </a>
                                                    </td>
                                                    <!-- <td> <?php echo $rowTrans['dt'] ?> </td> -->
                                                    <!-- <td> <?php echo $rowTrans['tstatus'] ?> </td> -->
                                                </tr>
                                        <?php

                                            }
                                        } else {
                                            echo '<script>alert("No data found!")</script>';
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

<script>
$(document).ready(function(){
    $('#select1').on('change', function() {
      if ( this.value == '1')
      {
        $("#appetizers").show();
	$("#sizzling").show();
	$("#fruittea").show();
	$("#tinolasinigang").show();
	$("#seafood").show();
	$("#chicken").show();
	$("#rice").show();
	$("#otherdrinks").show();
      }
	else if ( this.value == '2')
      {
        $("#appetizers").show();

	
	$("#sizzling").hide();
	$("#fruittea").hide();
	$("#tinolasinigang").hide();
	$("#seafood").hide();
	$("#chicken").hide();
	$("#rice").hide();
	$("#otherdrinks").hide();

      }
else if ( this.value == '3')
      {
	$("#sizzling").show();

	$("#appetizers").hide();
	$("#fruittea").hide();
	$("#tinolasinigang").hide();
	$("#seafood").hide();
	$("#chicken").hide();
	$("#rice").hide();
	$("#otherdrinks").hide();
      }
else if ( this.value == '4')
      {
        
	$("#fruittea").show();

	$("#appetizers").hide();
	$("#sizzling").hide();
	$("#tinolasinigang").hide();
	$("#seafood").hide();
	$("#chicken").hide();
	$("#rice").hide();
	$("#otherdrinks").hide();
	
      }
else if ( this.value == '5')
      {
         
	$("#tinolasinigang").show();

	$("#appetizers").hide();
	$("#sizzling").hide();
	$("#fruittea").hide();
	$("#seafood").hide();
	$("#chicken").hide();
	$("#rice").hide();
	$("#otherdrinks").hide();
	
      }
else if ( this.value == '6')
      {
         
	$("#seafood").show();

	$("#appetizers").hide();
	$("#sizzling").hide();
	$("#fruittea").hide();
	$("#tinolasinigang").hide();
	$("#chicken").hide();
	$("#rice").hide();
	$("#otherdrinks").hide();
	
      }
else if ( this.value == '7')
      {
        
	$("#chicken").show();

	$("#appetizers").hide();
	$("#sizzling").hide();
	$("#fruittea").hide();
	$("#tinolasinigang").hide();
	$("#seafood").hide();
	$("#rice").hide();
	$("#otherdrinks").hide();
	
      }
else if ( this.value == '8')
      {
         
	$("#rice").show();
	
	$("#appetizers").hide();
	$("#sizzling").hide();
	$("#fruittea").hide();
	$("#tinolasinigang").hide();
	$("#seafood").hide();
	$("#chicken").hide();
	$("#otherdrinks").hide();
	
      }
else if ( this.value == '9')
      {
         
	$("#otherdrinks").show();

	$("#appetizers").hide();
	$("#sizzling").hide();
	$("#fruittea").hide();
	$("#tinolasinigang").hide();
	$("#seafood").hide();
	$("#chicken").hide();
	$("#rice").hide();
      }
      
    });
});

</script>




<div>
<h2 class="line1">Category:</h2><select id='select1' class="send1" style="border: 2px solid black;">
 <option value = '1'>All</option>
 <option value = '2'>Appetizers</option>
 <option value = '3'>Sizzling</option>
 <option value = '4'>Fruit Tea</option>
 <option value = '5'>Tinola & Sinigang</option>
 <option value = '6'>Seefood</option>
 <option value = '7'>Chicken</option>
 <option value = '8'>Rice</option>
 <option value = '9'>Other Drinks</option>
</select>

</div>

		<div id='appetizers'>
                    <h2>Appetizers</h2>

                    <div class="row">
                        <?php
                        $sql = "SELECT
                        menu.id,
                        menu.`name`,
                        menu.price,
                        menu.category,
                        menu.photo
                        FROM
                        menu where category = 'Appetizer'                   
                        ";

                        $res = mysqli_query($db, $sql);
                        if (mysqli_num_rows($res) > 0) {

                            while ($row = mysqli_fetch_assoc($res)) {
                                # code...

                        ?>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mar_bottom">
                                    <div class="blog_box">
                                        <div class="blog_img_box">
                                            <figure>
                                                <?php echo '<img src="menu/' . $row['photo'] . '" alt="#">' ?>
                                                <!-- <img src="menu/coke.jpg" alt="#" /> -->
                                                <span><?php echo "PHP " . $row['price'] ?></span>
                                            </figure>
                                        </div>
                                        <h3><?php echo $row['name'] ?></h3>
                                        <td>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addModal">
                                                <button onclick="addmenu(<?= $row['id'] ?>,'<?= $row['name'] ?>','<?= $row['price'] ?>')" class="send" style="border: 2px solid black;">Add to order list</button>
                                            </a>
                                        </td>
                                    </div>
                                </div>
                        <?php

                            }
                        }

                        ?>
                    </div>

			</div>
			<div id='sizzling'>
                    <h2>Sizzling</h2>

                    <div class="row">
                        <?php
                        $sql = "SELECT
                        menu.id,
                        menu.`name`,
                        menu.price,
                        menu.category,
                        menu.photo
                        FROM
                        menu where category = 'Sizzling'                   
                        ";

                        $res = mysqli_query($db, $sql);
                        if (mysqli_num_rows($res) > 0) {

                            while ($row = mysqli_fetch_assoc($res)) {
                                # code...

                        ?>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mar_bottom">
                                    <div class="blog_box">
                                        <div class="blog_img_box">
                                            <figure>
                                                <?php echo '<img src="menu/' . $row['photo'] . '" alt="#">' ?>
                                                <!-- <img src="menu/coke.jpg" alt="#" /> -->
                                                <span><?php echo "PHP " . $row['price'] ?></span>
                                            </figure>
                                        </div>
                                        <h3><?php echo $row['name'] ?></h3>
                                        <td>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addModal">
                                                <button onclick="addmenu(<?= $row['id'] ?>,'<?= $row['name'] ?>','<?= $row['price'] ?>')" class="send" style="border: 2px solid black;">Add to order list</button>
                                            </a>
                                        </td>
                                    </div>
                                </div>
                        <?php

                            }
                        }

                        ?>
                    </div>


			</div>
			<div id='fruittea'>


                    <h2>Fruit Tea</h2>

                    <div class="row">
                        <?php
                        $sql = "SELECT
                        menu.id,
                        menu.`name`,
                        menu.price,
                        menu.category,
                        menu.photo
                        FROM
                        menu where category = 'Fruit Tea'                   
                        ";

                        $res = mysqli_query($db, $sql);
                        if (mysqli_num_rows($res) > 0) {

                            while ($row = mysqli_fetch_assoc($res)) {
                                # code...

                        ?>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mar_bottom">
                                    <div class="blog_box">
                                        <div class="blog_img_box">
                                            <figure>
                                                <?php echo '<img src="menu/' . $row['photo'] . '" alt="#">' ?>
                                                <!-- <img src="menu/coke.jpg" alt="#" /> -->
                                                <span><?php echo "PHP " . $row['price'] ?></span>
                                            </figure>
                                        </div>
                                        <h3><?php echo $row['name'] ?></h3>
                                        <td>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addModal">
                                                <button onclick="addmenu(<?= $row['id'] ?>,'<?= $row['name'] ?>','<?= $row['price'] ?>')" class="send" style="border: 2px solid black;">Add to order list</button>
                                            </a>
                                        </td>
                                    </div>
                                </div>
                        <?php

                            }
                        }

                        ?>
                    </div>

			</div>
			<div id='tinolasinigang'>

                    <h2>Tinola & Sinigang</h2>

                    <div class="row">
                        <?php
                        $sql = "SELECT
                        menu.id,
                        menu.`name`,
                        menu.price,
                        menu.category,
                        menu.photo
                        FROM
                        menu where category = 'Tinola & Sinigang'                   
                        ";

                        $res = mysqli_query($db, $sql);
                        if (mysqli_num_rows($res) > 0) {

                            while ($row = mysqli_fetch_assoc($res)) {
                                # code...

                        ?>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mar_bottom">
                                    <div class="blog_box">
                                        <div class="blog_img_box">
                                            <figure>
                                                <?php echo '<img src="menu/' . $row['photo'] . '" alt="#">' ?>
                                                <!-- <img src="menu/coke.jpg" alt="#" /> -->
                                                <span><?php echo "PHP " . $row['price'] ?></span>
                                            </figure>
                                        </div>
                                        <h3><?php echo $row['name'] ?></h3>
                                        <td>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addModal">
                                                <button onclick="addmenu(<?= $row['id'] ?>,'<?= $row['name'] ?>','<?= $row['price'] ?>')" class="send" style="border: 2px solid black;">Add to order list</button>
                                            </a>
                                        </td>
                                    </div>
                                </div>
                        <?php

                            }
                        }

                        ?>
                    </div>

		</div>
			<div id='seafood'>

                    <h2>Seafood</h2>

                    <div class="row">
                        <?php
                        $sql = "SELECT
                        menu.id,
                        menu.`name`,
                        menu.price,
                        menu.category,
                        menu.photo
                        FROM
                        menu where category = 'Seafood'                   
                        ";

                        $res = mysqli_query($db, $sql);
                        if (mysqli_num_rows($res) > 0) {

                            while ($row = mysqli_fetch_assoc($res)) {
                                # code...

                        ?>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mar_bottom">
                                    <div class="blog_box">
                                        <div class="blog_img_box">
                                            <figure>
                                                <?php echo '<img src="menu/' . $row['photo'] . '" alt="#">' ?>
                                                <!-- <img src="menu/coke.jpg" alt="#" /> -->
                                                <span><?php echo "PHP " . $row['price'] ?></span>
                                            </figure>
                                        </div>
                                        <h3><?php echo $row['name'] ?></h3>
                                        <td>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addModal">
                                                <button onclick="addmenu(<?= $row['id'] ?>,'<?= $row['name'] ?>','<?= $row['price'] ?>')" class="send" style="border: 2px solid black;">Add to order list</button>
                                            </a>
                                        </td>
                                    </div>
                                </div>
                        <?php

                            }
                        }

                        ?>
                    </div>

			</div>
			<div id='chicken'>

                    <h2>Chicken</h2>

                    <div class="row">
                        <?php
                        $sql = "SELECT
                        menu.id,
                        menu.`name`,
                        menu.price,
                        menu.category,
                        menu.photo
                        FROM
                        menu where category = 'Chicken'                   
                        ";

                        $res = mysqli_query($db, $sql);
                        if (mysqli_num_rows($res) > 0) {

                            while ($row = mysqli_fetch_assoc($res)) {
                                # code...

                        ?>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mar_bottom">
                                    <div class="blog_box">
                                        <div class="blog_img_box">
                                            <figure>
                                                <?php echo '<img src="menu/' . $row['photo'] . '" alt="#">' ?>
                                                <!-- <img src="menu/coke.jpg" alt="#" /> -->
                                                <span><?php echo "PHP " . $row['price'] ?></span>
                                            </figure>
                                        </div>
                                        <h3><?php echo $row['name'] ?></h3>
                                        <td>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addModal">
                                                <button onclick="addmenu(<?= $row['id'] ?>,'<?= $row['name'] ?>','<?= $row['price'] ?>')" class="send" style="border: 2px solid black;">Add to order list</button>
                                            </a>
                                        </td>
                                    </div>
                                </div>
                        <?php

                            }
                        }

                        ?>
                    </div>

			</div>
			<div id='rice'>

                    <h2>Rice</h2>

                    <div class="row">
                        <?php
                        $sql = "SELECT
                        menu.id,
                        menu.`name`,
                        menu.price,
                        menu.category,
                        menu.photo
                        FROM
                        menu where category = 'Rice'                   
                        ";

                        $res = mysqli_query($db, $sql);
                        if (mysqli_num_rows($res) > 0) {

                            while ($row = mysqli_fetch_assoc($res)) {
                                # code...

                        ?>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mar_bottom">
                                    <div class="blog_box">
                                        <div class="blog_img_box">
                                            <figure>
                                                <?php echo '<img src="menu/' . $row['photo'] . '" alt="#">' ?>
                                                <!-- <img src="menu/coke.jpg" alt="#" /> -->
                                                <span><?php echo "PHP " . $row['price'] ?></span>
                                            </figure>
                                        </div>
                                        <h3><?php echo $row['name'] ?></h3>
                                        <td>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addModal">
                                                <button onclick="addmenu(<?= $row['id'] ?>,'<?= $row['name'] ?>','<?= $row['price'] ?>')" class="send" style="border: 2px solid black;">Add to order list</button>
                                            </a>
                                        </td>
                                    </div>
                                </div>
                        <?php

                            }
                        }

                        ?>
                    </div>

			</div>
			<div id='otherdrinks'>

                    <h2>Other Drinks</h2>

                    <div class="row">
                        <?php
                        $sql = "SELECT
                        menu.id,
                        menu.`name`,
                        menu.price,
                        menu.category,
                        menu.photo
                        FROM
                        menu where category = 'Other Drinks'                   
                        ";

                        $res = mysqli_query($db, $sql);
                        if (mysqli_num_rows($res) > 0) {

                            while ($row = mysqli_fetch_assoc($res)) {
                                # code...

                        ?>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mar_bottom">
                                    <div class="blog_box">
                                        <div class="blog_img_box">
                                            <figure>
                                                <?php echo '<img src="menu/' . $row['photo'] . '" alt="#">' ?>
                                                <!-- <img src="menu/coke.jpg" alt="#" /> -->
                                                <span><?php echo "PHP " . $row['price'] ?></span>
                                            </figure>
                                        </div>
                                        <h3><?php echo $row['name'] ?></h3>
                                        <td>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addModal">
                                                <button onclick="addmenu(<?= $row['id'] ?>,'<?= $row['name'] ?>','<?= $row['price'] ?>')" class="send" style="border: 2px solid black;">Add to order list</button>
                                            </a>
                                        </td>
                                    </div>
                                </div>
                        <?php

                            }
                        }

                        ?>
                    </div>
		</div>
                </div>
            </div>
            <!-- end blog -->

            <!-- footer -->
            <fooetr>
                <div class="footer">
                    <div class="copyright">
                        <div class="container">
                            <p>© 2021 All Rights Reserved</p>
                        </div>
                    </div>
            </fooetr>
            <!-- end footer -->
        </div>
    </div>

    <!-- Modal -->
    <div id="checkoutOrder" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Checkout Order</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Please click the button "Confirm" to proceed!</label>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button type="submit" name="button_checkout" class="btn btn-success">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="removeMenu" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Remove Menu</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <input name="r_id" id="r_id" type="hidden" class="form-control" value="" required>
                                    <label>Are you sure?</label>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                    <button type="submit" name="button_remove_menu" class="btn btn-success">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Menu</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="user" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <input name="addid" id="addid" type="hidden" class="form-control" value="" required>
                                    <label>Food:</label>
                                    <input name="addname" id="addname" type="text" class="form-control" value="" disabled>
                                    <label>Price:</label>
                                    <input name="add_price" id="add_price" type="text" class="form-control" value="" disabled>
                                    <input name="addprice" id="addprice" type="hidden" class="form-control" value="">
                                    <label>Quantity:</label>
                                    <!-- <input name="name" id="name" type="text" class="form-control" value="" required> -->
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quantity">
                                                <span class="glyphicon glyphicon-minus"></span>
                                            </button>
                                        </span>
                                        <input type="text" id="quantity" name="quantity" class="form-control input-number" min="1" max="10" required style="height: 55px;">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quantity">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="button_add_order_list" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function addmenu(id, name, price) {
            document.getElementById("addid").value = id;
            document.getElementById("addname").value = name;
            document.getElementById("add_price").value = price;
            document.getElementById("addprice").value = price;
        }

        function remove_menu(s_oid) {
            document.getElementById("r_id").value = s_oid;
        }

        function checkout_order(tid) {
            document.getElementById("trans_id").value = tid;
        }
    </script>

    <div class="overlay"></div>
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

    <script src="js/jquery-3.0.0.min.js"></script>

    <script>
        //plugin bootstrap minus and plus
        //http://jsfiddle.net/laelitenetwork/puJ6G/
        $('.btn-number').click(function(e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function() {
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
        $(".input-number").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });






$(function() {
  $('#select').filterByValues( $('.filterElements') );
  $('.filterElements').change();
});  


jQuery.fn.filterByValues = function(masterSelects) {
  return this.each(function() {
    var select = this;
    var options = [];
    $(select).find('option').each(function() {
      options.push({value: $(this).val(), text: $(this).text()});
    });
    $(select).data('options', options);
    
    masterSelects.bind('change', function() {
      var options = $(select).empty().scrollTop(0).data('options');
      var vals=[];
      $(masterSelects).each(function(i,e){
        vals.push('^'+$.trim($(e).val())+'$' );
       });
      var search = vals.join('|');
      var regex = new RegExp(search,'gi');

      $.each(options, function(i) {
        var option = options[i];
        if(option.value.match(regex) !== null) {
          $(select).append(
             $('<option>').text(option.text).val(option.value)
          );
        }
      });
    });
    
  });
};




    </script>

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

        /* Blue */
        .info {
            border-color: #2196F3;
            color: dodgerblue;
        }

        .info:hover {
            background: #2196F3;
            color: white;
        }

        /* Orange */
        .warning {
            border-color: #ff9800;
            color: orange;
        }

        .warning:hover {
            background: #ff9800;
            color: white;
        }

        /* Red */
        .danger {
            border-color: #f44336;
            color: red;
        }

        .danger:hover {
            background: #f44336;
            color: white;
        }

        /* Gray */
        .default {
            border-color: #e7e7e7;
            color: black;
        }

        .default:hover {
            background: #e7e7e7;
        }

	 .send1 {

     font-family: poppins;
     display:inline-block;
     background: #fff;
     color: #000;
     max-width: 180px;
     padding: 13px 0px;
     width: 100%;
     font-size: 18px;
}
 .send1:hover {
     background: #000;
     color: #fff;
}
	.line1{
	display:inline-block;
}


    </style>

</body>

<?php

if (isset($_POST['back'])) {

    $stmt_transaction = $db->prepare("UPDATE transactions set status=? where id=?");
    $stmt_transaction->bind_param("ss", $status, $id);

    $status = "Cancelled Order";
    $id = $_SESSION['transaction_id'];


    $stmt_transaction->execute();

    session_unset();
    session_destroy();

    echo  '<script type="text/javascript">window.location.href="index.php"</script>';
}

?>

<?php

if (isset($_POST['button_checkout'])) {

    $stmt_transaction = $db->prepare("UPDATE transactions set status=?, paymentstatus=? where id=?");
    $stmt_transaction->bind_param("sss", $status, $paymentstatus, $id);
    $paymentstatus = "Waiting for Payment";	
    $status = "Order Success";
    $id = $_SESSION['transaction_id'];


    $stmt_transaction->execute();

    session_unset();
    session_destroy();

    echo  '<script type="text/javascript">alert("Your transaction number will be no: \"'.$id.'\"\nThank you and enjoy your order!");window.location.href="index.php"</script>';
}

?>

<?php

if (isset($_POST['button_remove_menu'])) {

    //order details
    $order_id = $_POST['r_id'];
    $order_details = "SELECT * from orders where id=$order_id";
    $result_order_details = mysqli_query($db, $order_details);
    $row_order_details = mysqli_fetch_assoc($result_order_details);

    //menu details
    $menu_id = $row_order_details['menu_id'];
    $menu_details = "SELECT * from menu where id=$menu_id";
    $result_menu_details = mysqli_query($db, $menu_details);
    $row_menu_details = mysqli_fetch_assoc($result_menu_details);

    //transaction details
    $transaction_id = $row_order_details['transaction_id'];
    $transaction_details = "SELECT * from transactions where id=$transaction_id";
    $result_transaction_details = mysqli_query($db, $transaction_details);
    $result_transaction_details = mysqli_fetch_assoc($result_transaction_details);

    $order_id = $order_id;
    $total = $result_transaction_details['total'];
    $price = $row_menu_details['price'];
    $quantity = $row_order_details['quantity'];

    $price = (float)$price;
    $quantity = (float)$quantity;
    $total = (float)$total;

    $product = $price * $quantity;
    $total = $total - $product;

    $stmt_transactions = $db->prepare("UPDATE transactions set total=? WHERE id=?");
    $stmt_transactions->bind_param("ss", $total, $transaction_id);

    $total = $total;
    $transaction_id = $transaction_id;

    if ($stmt_transactions->execute()) {

        $stmt_delete_order = $db->prepare("DELETE FROM orders WHERE id=? AND transaction_id=? AND menu_id=?");
        $stmt_delete_order->bind_param("sss", $id, $transaction_id, $menu_id);

        $id = $order_id;
        $transaction_id = $transaction_id;
        $menu_id = $menu_id;

        if ($stmt_delete_order->execute()) {
            echo  '<script type="text/javascript">window.location.href="order.php"</script>';
        } else {
            echo  '<script type="text/javascript">alert("Error in deleting order!");window.location.href="order.php"</script>';
        }


        echo  '<script type="text/javascript">window.location.href="order.php"</script>';
    } else {
        echo  '<script type="text/javascript">alert("Error in calculating total");window.location.href="order.php"</script>';
    }
}

?>

<?php

if (isset($_POST['button_add_order_list'])) {

    $price = $_POST['addprice'];

    $stmt_add_order = $db->prepare("INSERT INTO orders (transaction_id,menu_id,quantity) VALUES (?,?,?)");
    $stmt_add_order->bind_param("sss", $transaction_id, $menu_id, $quantity);

    $transaction_id = $_SESSION['transaction_id'];
    $menu_id = $_POST['addid'];
    $quantity = $_POST['quantity'];

    if ($stmt_add_order->execute()) {

        $get_total = "SELECT total from transactions where id=$transaction_id";

        $res = mysqli_query($db, $get_total);

        $row = mysqli_fetch_assoc($res);
        $total_price = $row['total'];

        //menu price
        $price = (float)$price;
        $quantity = (float)$quantity;
        $price = $price * $quantity;

        //total order price
        $total_price = (float)$total_price;
        $total = $price + $total_price;

        $stmt_total = $db->prepare("UPDATE transactions set total=? WHERE id=?");
        $stmt_total->bind_param("ss", $total, $transaction_id);

        $total = $total;
        $transaction_id = $transaction_id;

        if ($stmt_total->execute()) {
            echo  '<script type="text/javascript">window.location.href="order.php"</script>';
        } else {
            echo  '<script type="text/javascript">alert("Error in calculating total");window.location.href="order.php"</script>';
        }
    } else {
        echo  '<script type="text/javascript">alert("Error in adding");window.location.href="order.php"</script>';
    }
}

?>








</html>