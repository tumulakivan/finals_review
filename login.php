<?php
    session_start();

    if(isset($_SESSION["user_id"])) {
        header("Location: main-page.php");
        exit;
    }

    $conn = mysqli_connect("localhost","root","","db_review") or die("Unable to connect to db_review");

    if(isset($_POST["btn_login"])) {
        $user = $_POST["user"];
        $pass = $_POST["pass"];

        $query = "SELECT * FROM users WHERE user = '$user'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) == 0) {
            echo "<script>alert('User does not exist');</script>";
        } else {
            $row = mysqli_fetch_array($result);
            if($pass == $row["pass"]) {
                $_SESSION["user_id"] = $user;
                header("Location: main-page.php");
                exit();
            } else {
                echo "<script>alert('Invalid password.');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/forms.css">
    </head>
    <body>
        <div class="title-text">
            Login
        </div>
        <div class="form-wrapper">
            <form method="post">
                <div class="user-wrapper">
                    <label for="user">User</label>
                    <input type="text" name="user" id="user" required>
                </div>
                <div class="pass-wrapper">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" id="pass" required>
                </div>
                <div class="btn-wrapper">
                    <input type="submit" name="btn_login" class="btn" value="Login">
                    <div class="register-redir">
                        <a href="register.php">Don't have an account yet? Register now.</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>