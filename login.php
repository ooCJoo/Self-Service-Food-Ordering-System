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
</head>
<!-- body -->

<?php include_once("dbconfig.php"); ?>


<body>
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="" /></div>
    </div>

    <div class="wrapper">
        <!-- end loader -->

        <div id="content">
            <!-- footer -->
            <fooetr>
                <div class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class=" col-md-12">
                                <h2>Login Page</h2>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                                <form class="main_form" method="POST">
                                    <div class="row">

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <input class="form-control" placeholder="Username" type="text" name="username" id="username">
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <input class="form-control" placeholder="Password" type="password" name="password" id="password">
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                            <button type="submit" name="button_login" class="send">Login</button>
                                        </div>
                                    </div>
                                </form>
                            <!-- </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="img-box">
                                    <figure><img src="images/indexfood.png" alt="img" /></figure>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="copyright">
                        <div class="container">
                            <p>© 2021 All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </fooetr>
            <!-- end footer -->

        </div>
    </div>
    <div class="overlay"></div>
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

    <script src="js/jquery-3.0.0.min.js"></script>


    <?php

	$id = "";
    if (isset($_POST['button_login'])) {

        $stmt = $db->prepare("SELECT *
        FROM user_accounts WHERE username = ? AND  password = ?");
        $stmt->bind_param("ss", $username, $password);
	
        $username = $_POST['username'];
        $password = $_POST['password'];
	
        if ($stmt->execute()) {
	$result = $stmt->get_result()->fetch_assoc();
	 $userid = $result['id'];
	if ($result['user_level'] == 'Admin'){
	session_start();
	$_SESSION["user_id"] = $userid;
	echo '<script type="text/javascript">alert("Login Successful!");window.location.href="admin/transaction.php"</script>';	
		
}
	else if ($result['user_level'] == 'Kitchen'){
	session_start();
	$_SESSION["user_id"] = $userid;
	echo '<script type="text/javascript">alert("Login Successful!");window.location.href="admin/transaction_user_kitchen.php"</script>';
	
       
 } 
	else if ($result['user_level'] == 'Cashier'){
	session_start();
	$_SESSION["user_id"] = $userid;
	echo '<script type="text/javascript">alert("Login Successful!");window.location.href="admin/transaction_user_cashier.php"</script>';
}    
	else {
               echo '<script type="text/javascript">alert("Please try again!");window.location.href="login.php"</script>';
            }
        } else {
            echo  '<script type="text/javascript">alert("Please try again!");window.location.href="login.php"</script>';
        }

    }

    ?>

</body>

</html>