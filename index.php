<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food-Ordering-System</title>

    <link rel="stylesheet" href="css1/bootstrap.min.css"/>
    <link rel="stylesheet" href="css1/font-awesome.min.css"/>
    <link rel="stylesheet" href="css1/animate.css"/>

		<link rel="stylesheet" href="css1/style.css" />

    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZXJBVDf7R4JqmSpopVPoduIGWx1IwpBM"></script>
    <script type="text/javascript" src="js/plugins.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>
<?php include_once("dbconfig.php"); ?>
	<body>
	<div class="svg-wrap">
      <svg width="64" height="64" viewBox="0 0 64 64">
        <path id="arrow-left" d="M26.667 10.667q1.104 0 1.885 0.781t0.781 1.885q0 1.125-0.792 1.896l-14.104 14.104h41.563q1.104 0 1.885 0.781t0.781 1.885-0.781 1.885-1.885 0.781h-41.563l14.104 14.104q0.792 0.771 0.792 1.896 0 1.104-0.781 1.885t-1.885 0.781q-1.125 0-1.896-0.771l-18.667-18.667q-0.771-0.813-0.771-1.896t0.771-1.896l18.667-18.667q0.792-0.771 1.896-0.771z"></path>
      </svg>

      <svg width="64" height="64" viewBox="0 0 64 64">
        <path id="arrow-right" d="M37.333 10.667q1.125 0 1.896 0.771l18.667 18.667q0.771 0.771 0.771 1.896t-0.771 1.896l-18.667 18.667q-0.771 0.771-1.896 0.771-1.146 0-1.906-0.76t-0.76-1.906q0-1.125 0.771-1.896l14.125-14.104h-41.563q-1.104 0-1.885-0.781t-0.781-1.885 0.781-1.885 1.885-0.781h41.563l-14.125-14.104q-0.771-0.771-0.771-1.896 0-1.146 0.76-1.906t1.906-0.76z"></path>
      </svg>
    </div>


    <!-- MAIN CONTENT -->

   <div class="container-fluid">

    <!-- HEADER -->

    <section id="header">

      <!-- NAVIGATION -->
      <nav class="navbar navbar-fixed-top navbar-default bottom">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"><form method="POST">
            <button type="submit" name="order_now" class="submit">Order Now!</button>
	   </form>
          </div><!-- /.navbar-header -->

          <div class="collapse navbar-collapse" id="menu">
            <ul class="nav navbar-nav navbar-right">
		<li><a href="#header">Contact Us : </a></li>
              <li><img src="images/phone_icon.png" alt="#"></li>
		<li><a href="#">0911-222-3333</a></li>
    	  
            </ul>
          </div> <!-- /.navbar-collapse -->
        </div> <!-- /.container -->
      </nav>

      <!-- SLIDER -->
      <div class="header-slide">
        <section>
          <div id="loader" class="pageload-overlay" data-opening="M 0,0 0,60 80,60 80,0 z M 80,0 40,30 0,60 40,30 z">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
              <path d="M 0,0 0,60 80,60 80,0 Z M 80,0 80,60 0,60 0,0 Z"/>
            </svg>
          </div> <!-- /.pageload-overlay -->
          
          <div class="image-slide bg-fixed">
            <div class="overlay">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">

                    <div class="slider-content">
                      <h1></h1>
                      <p>We Serve You The Best Dishes</p>
                    </div>

                  </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
              </div> <!-- /.container -->
            </div> <!-- /.overlay -->
          </div> <!-- /.image-slide -->

         

        <script type="text/javascript">
        var dataHeader = [
                            {
                              bigImage :"images/slide-1.jpg",
                              title : "Affordable and Delicious",
				author : ""
                            },
                            {
                              bigImage :"images/slide-2.jpg",
                              title : "Take a bite out of hunger.",
                              author : ""
                            },
                            {
                              bigImage :"images/slide-3.jpg",
                              title : "Taste the rainbow",
                              author : ""
                            }
                        ],
            loaderSVG = new SVGLoader(document.getElementById('loader'), {speedIn : 600, speedOut : 600, easingIn : mina.easeinout});
            loaderSVG.show()
        </script>

      </div><!-- /.header-slide -->
    </section>

    <!-- HEADER END -->


    


   

    <section id="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <p>2021 Alright Reserved<i class="fa fa-heart"></i>asddas</a></p>
            
          </div>
        </div>
      </div>
    </section>

   </div><!-- /.container-fluid -->
    
    <!-- SCRIPT -->
    <script type="text/javascript" src="js/main.js"></script>
 
	</body>
<?php

if (isset($_POST['order_now'])) {
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d H:i:s");
    $total = "";
    $id = "";

    $stmt_transaction = $db->prepare("insert into transactions (status, total, datetime) values (?,?,?)");
    $stmt_transaction->bind_param("sss", $status, $total, $datetime);

    $status = "Ongoing";
    $total = 0;
    $datetime = $date;

    $stmt_transaction->execute();

    $get_id = "SELECT MAX(id) as id from transactions";
    $res = mysqli_query($db, $get_id);
    $row = mysqli_fetch_assoc($res);

    $id = $row['id'];

    // echo '<script type="text/javascript">alert("' . $id . '!");window.location.href="order.php"</script>';


    if ($id != "") {
        $_SESSION['transaction_id'] = $id;

        echo '<script type="text/javascript">window.location.href="order.php"</script>';

        $stmt_transaction->close();
        $db->close();
        exit();
    } else {
        echo '<script type="text/javascript">alert("insert_id!");window.location.href="index.php"</script>';
    }

    
}

?>
</html>