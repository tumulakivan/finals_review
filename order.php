<?php
    session_start();

    if(!isset($_SESSION["user_id"])){
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION["user_id"];

    $conn = mysqli_connect("localhost","root","","db_review") or die("Unable to connect to db_review");

    if(isset($_POST["btn_order"])){
        $item = $_POST["item"];
        $quantity = $_POST["quantity"];

        $query = "SELECT quantity FROM items WHERE item = '$item'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) == 0){
            echo "Item $item does not exist.";
        } else {
            $row = mysqli_fetch_array($result);
            $item_quantity = $row["quantity"];

            if($item_quantity < $quantity) {
                echo "<script>alert('Not enough of item $item to order.');</script>";
            } else {
                $new_quantity = $item_quantity - $quantity;
                $query = "UPDATE items SET quantity = '$new_quantity' WHERE item = '$item'";
                mysqli_query($conn, $query);

                $query = "INSERT INTO orders(user, item, quantity) VALUES('$user_id', '$item', '$quantity')";
                echo "<script>alert('An order for $quantity of $item by $user_id has been recorded.');</script>";
                mysqli_query($conn, $query);
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Order Items</title>
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
            Order Items From Shelf
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
                    <input type="submit" name="btn_order" class="btn" value="Order">
                </div>
            </form>
        </div>
    </body>
</html>