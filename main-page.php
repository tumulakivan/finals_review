<?php
    session_start();

    if(!isset($_SESSION["user_id"])){
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION["user_id"];

    $conn = mysqli_connect("localhost","root","","db_review") or die("Unable to connect to db_review");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Inventory</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/tables.css">
    </head>
    <body>
        <div class="navbar">
            <div class="welcome-wrapper">
                welcome, <?php echo htmlspecialchars("$user_id"); ?>.
            </div>
            <div class="navbar-items-wrapper">
                <a href="main-page.php">Home</a>
                <a href="add.php">Add</a>
                <a href="order.php">Order</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
        <div class="title-text">
            SHELF
        </div>
        <div class="table-wrapper">
            <?php 
                $query = "SELECT * FROM items";
                $result = mysqli_query($conn, $query);

                if(mysqli_num_rows($result) > 0){
                    echo "<table>";
                    echo "<tr><th>Item</th><th>Quantity</th></tr>";
                    while($row = mysqli_fetch_assoc($result)){
                        $item = $row["item"];
                        $quantity = $row["quantity"];

                        echo "<tr><td>$item</td><td class='quantity-style'>$quantity</td></tr>";
                    }
                    echo "</table>";
                }
            ?>
        </div>
        <div class="title-text">
            ORDERS
        </div>
        <div class="table-wrapper">
            <?php 
                $query = "SELECT * FROM orders";
                $result = mysqli_query($conn, $query);

                if(mysqli_num_rows($result) > 0){
                    echo "<table>";
                    echo "<tr><th class='id-style'>ID</th><th>Item</th><th>User</th><th>Quantity</th></tr>";
                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row["order_id"];
                        $user = $row["user"];
                        $item = $row["item"];
                        $quantity = $row["quantity"];

                        echo "<tr><td class='id-style'>$id</td><td>$item</td><td class='user-style'>$user</td><td class='quantity-style'>$quantity</td></tr>";
                    }
                    echo "</table>";
                }
            ?>
        </div>
    </body>
</html>