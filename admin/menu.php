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
                <li class="active"><a href="menu.php">Menu</a></li>
		<li><a href="account.php">Accounts</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="loginsession.php?ses=1"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Menu</h2>
        <br>
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Add Menu</button>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Menu</th>
                    <th>Price</th>
                    <th>Function</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT
                menu.id,
                menu.`name`,
                menu.price,
                menu.category,
                menu.photo
                FROM
                menu                          
                ";

                $res = mysqli_query($db, $sql);
                if (mysqli_num_rows($res) > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {
                        # code...

                ?>
                        <tr>
                            <td> <?php echo $row['id'] ?> </td>
                            <td> <?php echo $row['category'] ?></td>
                            <td> <?php echo $row['name'] ?></td>
                            <td> <?php echo $row['price'] ?> </td>
                            <td>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal">
                                    <button onclick="updatemenu(<?= $row['id'] ?>,'<?= $row['category'] ?>','<?= $row['name'] ?>','<?= $row['price'] ?>')" class="btn btn-warning">Edit</button>
                                </a>
				<a href="delete.php?del=<?php echo $row['id']; ?>" class="del_btn" onclick="return confirm('Are you sure?')">
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
                    <h4 class="modal-title">Add Menu</h4>
                </div>
                <div class="modal-body">
                    <form class="user" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input name="name" id="name" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Photo:</label>
                                    <input type="file" name="image" id="menu_photo" required="required" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Price:</label>
                                    <input name="price" id="price" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Category:</label>
                                    <select name="category" id="category" class="form-control" required>
                                        <option value="N/A">Select Category</option>
                                        <option value="Appetizer">Appetizer</option>
                                        <option value="Sizzling">Sizzling</option>
                                        <option value="Fruit Tea">Fruit Tea</option>
                                        <option value="Tinola & Sinigang">Tinola & Sinigang</option>
                                        <option value="Seafood">Seafood</option>
                                        <option value="Chicken">Chicken</option>
                                        <option value="Rice">Rice</option>
                                        <option value="Other Drinks">Other Drinks</option>
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
                    <h4 class="modal-title">Edit Menu</h4>
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
                                    <label>Photo:</label>
                                    <input type="file" name="image" id="menu_photo" required="required" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Price:</label>
                                    <input name="edit_price" id="edit_price" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Category:</label>
                                    <select name="edit_category" id="edit_category" class="form-control" required>
                                        <option value="N/A">Select Category</option>
                                        <option value="Appetizer">Appetizer</option>
                                        <option value="Sizzling">Sizzling</option>
                                        <option value="Fruit Tea">Fruit Tea</option>
                                        <option value="Tinola & Sinigang">Tinola & Sinigang</option>
                                        <option value="Seafood">Seafood</option>
                                        <option value="Chicken">Chicken</option>
                                        <option value="Rice">Rice</option>
                                        <option value="Other Drinks">Other Drinks</option>
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
        function updatemenu(id, category, name, price) {
            document.getElementById("edit_id").value = id;
            document.getElementById("edit_category").value = category;
            document.getElementById("edit_name").value = name;
            document.getElementById("edit_price").value = price;
        }
    </script>

    <?php

    if (isset($_POST['button_edit_menu'])) {

        $image = $_FILES['image']['tmp_name'];
        $img = file_get_contents($image);

        $menu_photo = "../menu/" . basename($_FILES['image']['name']);


        if (move_uploaded_file($_FILES['image']['tmp_name'], $menu_photo)) {
            $stmt = $db->prepare('UPDATE menu set name=?, price=?, category=?, photo=? where id=?');
            $stmt->bind_param("sssss", $name, $price, $category, $img, $id);

            $name = $_POST['edit_name'];
            $price = $_POST['edit_price'];
            $category = $_POST['edit_category'];
            $img = basename($_FILES['image']['name']);
            $id = $_POST['edit_id'];

            $stmt->execute();
            echo '<script type="text/javascript">alert("Updated Successfully!");window.location.href="menu.php"</script>';
        } else {
            echo '<script type="text/javascript">alert("Updated Unsuccessful! Photo file format!");window.location.href="menu.php"</script>';
        }
    }

    ?>


    <?php

    if (isset($_POST['button_add_menu'])) {

        $stmt = $db->prepare('INSERT INTO menu (name,price,category,photo) VALUES (?,?,?,?)');
        $stmt->bind_param("ssss", $name, $price, $category, $img);

        $image = $_FILES['image']['tmp_name'];
        $img = basename($_FILES['image']['name']);
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        $menu_photo = "../menu/" . basename($_FILES['image']['name']);


        if (move_uploaded_file($_FILES['image']['tmp_name'], $menu_photo)) {
            $stmt->execute();
            echo '<script type="text/javascript">alert("Added Successfully!");window.location.href="menu.php"</script>';
        } else {
            echo '<script type="text/javascript">alert("Added Unsuccessful! Photo file format!");window.location.href="menu.php"</script>';
        }
    }

    ?>

</body>

</html>