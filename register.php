<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","db_review") or die("Unable to connect to db_review");

    if(isset($_POST['btn_submit'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $conf_pass = $_POST['conf_pass'];

        if($pass != $conf_pass) {
            echo "<script>alert('Passwords do not match.');</script>";
        } else {
            $query = "INSERT INTO users(user, pass) VALUES('$user', '$pass');";
            
            if(mysqli_query($conn, $query)) {
                echo "<script>alert('User $user registered successfully.');</script>";
            } else {
                echo "<script>alert('Failed to register user $user');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Register</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/forms.css">
    </head>
    <body>
        <div class="title-text">
            Register
        </div>
        <div class="form-wrapper">
            <form method="post" id="reg-form">
                <div class="user-wrapper">
                    <label for="user">User</label>
                    <input type="text" name="user" id="user" required>
                </div>
                <div class="pass-wrapper">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" id="pass" required>
                </div>
                <div class="confirm-wrapper">
                    <label for="conf_pass">Confirm Password</label>
                    <input type="password" name="conf_pass" id="conf_pass" required>
                </div>
                <div class="btn-wrapper">
                    <input type="submit" name="btn_submit" class="btn" value="Register">
                    <div class="login-redir">
                        <a href="login.php">Already have an account? Login now.</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>