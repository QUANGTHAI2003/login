<?php

include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die(header('location:login.php'));

    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];
        header('location:index.php');
    } elseif (empty($email) || empty($pass)) {
        $message[] = 'Please enter your email and password!';
    } elseif (mysqli_num_rows($select) !== $_POST['email'] && mysqli_num_rows($select) !== $_POST['password']) {
        $message[] = 'Incorrect email or password!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="./css/login.css">

</head>

<body>
    <div class="container">
        <form action="" method="post">
            <h1>Login Form</h1>
            <div class="form-control">
                <input type="email" id="username" class="box" placeholder="Email" name="email" />
                <small></small>
                <span></span>
            </div>
            <div class="form-control">
                <input type="password" id="password" class="input box" type="password" placeholder="Password"
                    name="password" />
                <small></small>
                <span></span>
                <?php
                    if (isset($message)) {
                        foreach ($message as $message) {
                            echo '<div class="message" onclick="this.remove();">'. $message .'</div>';
                        }
                    }
                    ?>
            </div>
            <button type="submit" class="btn-submit btn" name="submit">Sign up</button>
            <div class="signup-link">
                <div class="more">
                    <div class="remember">
                        <div class="rememberpass">
                            <input type="checkbox" />
                            <span>Remember me</span>
                        </div>
                    </div>
                    <a href="#">Forgot password?</a>
                </div>
                <div class="or">
                    <div class="first"></div>
                    <span class="hoac">Hoặc</span>
                    <div class="second"></div>
                </div>
                <div class="order-login">
                    <div class="type-login">
                        <img src="https://img.icons8.com/color/48/000000/facebook-new.png" width="38" height="38" />
                        <span>Facebook</span>
                    </div>
                    <div class="type-login">
                        <img src="https://img.icons8.com/color/48/000000/google-logo.png" width="32"
                            height="32" /><span>Google</span>
                    </div>
                </div>
                Not a member?
                <a href="./register.php"> Sign in</a>
            </div>
        </form>
    </div>
</body>

</html>