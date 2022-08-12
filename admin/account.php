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
    <title>Menu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

    <link rel="stylesheet" href="template/bootstrap.min.css">
    <script src="template/jquery.min.js"></script>
    <script src="template/bootstrap.min.js"></script>
</head>

<?php include("../dbconfig.php"); ?>

<body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Food Ordering System</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="transaction.php">Transactions</a></li>
	<li><a href="stransaction.php">Success Transaction</a></li>
                <li><a href="menu.php">Menu</a></li>
 	<li class="active"><a href="account.php">Accounts</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="loginsession.php?ses=1"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Accounts</h2>
        <br>
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Add Account</button>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
		<th>Contact #</th>
                    <th>User Level</th>
		<th>Functions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT
                user_accounts.id,
                user_accounts.name,
		user_accounts.username,
                user_accounts.password,
                user_accounts.user_level,
		user_accounts.contact
                FROM
                user_accounts                          
                ";

                $res = mysqli_query($db, $sql);
                if (mysqli_num_rows($res) > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {
                        # code...

                ?>
                        <tr>
                            <td> <?php echo $row['id'] ?> </td>
			<td> <?php echo $row['name'] ?></td>
                            <td> <?php echo $row['username'] ?></td>
                            <td> <?php echo $row['password'] ?></td>
                            <td> <?php echo $row['contact'] ?> </td>
				<td> <?php echo $row['user_level'] ?> </td>
				
                            <td>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal">
                                    <button onclick="updatemenu(<?= $row['id'] ?>,'<?= $row['name'] ?>','<?= $row['username'] ?>','<?= $row['password'] ?>','<?= $row['contact'] ?>','<?= $row['user_level'] ?>')" class="btn btn-warning">Edit</button>
                                </a>
				
				<a href="delete_account.php?del=<?php echo $row['id']; ?>" class="del_btn" onclick="return confirm('Are you sure?')">
			<button style="background-color: #f44336"; class="btn btn-warning">Delete</button>
					</a>	
                            </td>
                        </tr>
                <?php

                    }
                }

                ?>
            </tbody>
        </table>
    </div>


    <!-- Modal -->
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Account</h4>
                </div>
                <div class="modal-body">
                    <form class="user" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input name="name" id="name" placeholder="Enter Name" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
			<div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Username:</label>
                                    <input name="username" id="username" placeholder="Enter Userame" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Password:</label>
                                    <input name="password" id="password" placeholder="Enter Password" type="password" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Contact Number:</label>
                                    <input name="contact" id="contact" placeholder="Enter Contact Number" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>User Level:</label>
                                    <select name="user_level" id="user_level" class="form-control" required>
                                        <option value="Admin">Admin</option>
                                        <option value="Cashier">Cashier</option>
                                        <option value="Kitchen">Kitchen</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="button_add_menu" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Account</h4>
                </div>
                <div class="modal-body">
                    <form class="user" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <input name="edit_id" id="edit_id" type="hidden" class="form-control" value="">

                                    <label>Name:</label>
                                    <input name="edit_name" id="edit_name" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Username:</label>
                                     <input name="edit_username" id="edit_username" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
		<div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Password:</label>
                                    <input name="edit_password" id="edit_password" type="password" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Contact Number:</label>
                                    <input name="edit_contact" id="edit_contact" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>User Level:</label>
                                    <select name="edit_userlevel" id="edit_userlevel" class="form-control" required>
                                        <option value="N/A">Select User Level</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Chashier">Cashier</option>
                                        <option value="Kitchen">Kitchen</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="button_edit_menu" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function updatemenu(id, name, username, password, contact, user_level) {
            document.getElementById("edit_id").value = id;
            document.getElementById("edit_userlevel").value = user_level;
            document.getElementById("edit_name").value = name;
		document.getElementById("edit_username").value = username;
            document.getElementById("edit_password").value = password;
		document.getElementById("edit_contact").value = contact;
		
        }
    </script>

    <?php

    if (isset($_POST['button_edit_menu'])) {
      
            $stmt = $db->prepare('UPDATE user_accounts set name=?, username=?, password=?, contact=?, user_level=? where id=?');
            $stmt->bind_param("ssssss", $name, $username, $password, $contact, $user_level, $id);

            $name = $_POST['edit_name'];
            $username = $_POST['edit_username'];
            $password = $_POST['edit_password'];
            $contact = $_POST['edit_contact'];
	    $user_level = $_POST['edit_userlevel'];
            $id = $_POST['edit_id'];

            $stmt->execute();
            echo '<script type="text/javascript">alert("Updated Successfully!");window.location.href="account.php"</script>';
       
    }

    ?>


    <?php

    if (isset($_POST['button_add_menu'])) {

        $stmt = $db->prepare('INSERT INTO user_accounts (name,username,password,contact,user_level) VALUES (?,?,?,?,?)');
        $stmt->bind_param("sssss", $name, $username, $password, $contact, $user_level);

  
    
         $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $contact = $_POST['contact'];
	    $user_level = $_POST['user_level'];
          

            $stmt->execute();
            echo '<script type="text/javascript">alert("Added Successfully!");window.location.href="account.php"</script>';
       
    }

    ?>

</body>

</html>