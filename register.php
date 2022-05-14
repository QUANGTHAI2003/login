<?php

include 'config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die(header('location:register.php'));

    if (mysqli_num_rows($select) > 0) {
        $message[] = 'User already exist!';
    } elseif (empty($name) || empty($email) || empty($pass) || empty($cpass)) {
        $message[] = 'Please fill all the fields!';
    } else {
        mysqli_query($conn, "INSERT INTO `user_form`(name, email, password) VALUES('$name', '$email', '$pass')") or die(header('location:register.php'));
        $message[] = 'Registered successfully!';
        header('location:login.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="./css/register.css">

</head>

<body>

    <?php
        // if (isset($message)) {
        //     foreach ($message as $message) {
        //         echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
        //     }
        // }
        ?>
    <div class="container">
        <form action="" method="post">
            <h1>Create Account</h1>
            <div class="form-control">
                <input id="username" type="text" placeholder="Username" name="name" class="box" />
                <small></small>
                <span></span>
            </div>
            <div class="form-control">
                <input id="email" type="email" name="email" placeholder="Email" class="box" />
                <small></small>
                <span></span>
            </div>
            <div class="form-control">
                <input id="password" class="input box" type="password" placeholder="Password" name="password" />
                <small></small>
                <span></span>
            </div>
            <div class="form-control">
                <input id="confirm-password" type="password" placeholder="Comfirm password" class="box"
                    name="cpassword" />
                <small></small>
                <span></span>
                <?php
                    if (isset($message)) {
                        foreach ($message as $message) {
                            echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
                        }
                    }
                ?>
            </div>
            <button type="submit" class="btn-submit btn" name="submit">Sign in</button>
            <div class="signup-link">
                Already have an account?<a href="./login.php">Sign up</a>
            </div>
        </form>
    </div>

</body>

</html>