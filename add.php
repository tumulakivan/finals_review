<?php
    session_start();

    if(!isset($_SESSION["user_id"])){
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION["user_id"];

    $conn = mysqli_connect("localhost","root","","db_review") or die("Unable to connect to db_review");

    if(isset($_POST["btn_add"])){
        $item = $_POST["item"];
        $quantity = $_POST["quantity"];

        $query = "SELECT item FROM items WHERE item = '$item'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            echo "<script>alert('Item already exists.');</script>";
        } else {
            $query = "INSERT INTO items(item, quantity) VALUES('$item', '$quantity')";

            mysqli_query($conn, $query) or die("Unable to add item.");

            echo "<script>alert('$quantity $item items added.');</script>";
        }        
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Add Items</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/forms.css">
    </head>
    <body>
        <div class="navbar">
            <div class="welcome-wrapper">
                <?php echo htmlspecialchars("$user_id"); ?>
            </div>
            <div class="navbar-items-wrapper">
                <a href="main-page.php">Home</a>
                <a href="add.php">Add</a>
                <a href="order.php">Order</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
        <div class="title-text">
            Populate Shelf
        </div>
        <div class="form-wrapper">
            <form method="post">
                <div class="item-wrapper">
                    <label for="item">Item</label>
                    <input type="text" name="item" id="item" required>
                </div>
                <div class="quantity-wrapper">
                    <label for="quantity">Quantity</label>
                    <input type="text" name="quantity" id="quantity" required>
                </div>
                <div class="btn-wrapper">
                    <input type="submit" name="btn_add" class="btn" value="Add">
                </div>
            </form>
        </div>
    </body>
</html>