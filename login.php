<?php
include './dbConnection.php';

session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    if (empty($email) || empty($pwd)) {
        echo "<script>alert('fill all fields.!')</script>";
    } elseif (!empty($email) && !empty($pwd)) {
        $query = "SELECT id,role,profileImg,email,password FROM coach WHERE email = '$email'";
        $isCoach = mysqli_query($conn, $query);

        $adminQuery = "SELECT id,role,profileImg,email,password FROM admin WHERE email = '$email'";
        $isAdmin = mysqli_query($conn, $adminQuery);

        $select = "SELECT id,role,profileImg,email,password FROM customer WHERE email = '$email'";
        $isCustomer = mysqli_query($conn, $select);

        if (mysqli_num_rows($isCoach)) {
            while ($row = mysqli_fetch_assoc($isCoach)) {
                if (password_verify($pwd, $row['password']) && $row['email'] == $email) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['profilePic'] = $row['profileImg'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['name'] = $row['firstName'];
                    header("Location:./homeCoach.php");
                }
            }
        } elseif (mysqli_num_rows($isAdmin)) {
            while ($row = mysqli_fetch_assoc($isAdmin)) {
                if ($pwd == $row['password'] && $row['email'] == $email) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['profilePic'] = $row['profileImg'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['name'] = $row['firstName'];
                    header("Location:./admin.php");
                }
            }
        } elseif (mysqli_num_rows($isCustomer)) {
            while ($row = mysqli_fetch_assoc($isCustomer)) {
                if (password_verify($pwd, $row['password']) && $row['email'] == $email) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['profilePic'] = $row['profileImg'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['name'] = $row['firstName'];
                    header("Location:./landing.php");
                }
            }
        } else {
            $message[] = 'Invalid user number or password!';
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./styles/login.css">
    <script>
        function popup() {
           const popup = document.getElementById('popup');
           const pc = document.getElementById('pc');

           pc.style.transform ='scale(1)';
           popup.style.display ='inline-flex';

        }
        function closePopup() {
           const popup = document.getElementById('popup');
           const pc = document.getElementById('pc');
           pc.style.transform ='scale(0)';
           popup.style.display ='none';

        }
    </script>
</head>

<body>
    <div class="loginPage">
        <div class="loginImg">
            <img src="https://th.bing.com/th/id/R.afc69f44efaed4daa999fa8a7dc28cf9?rik=4I%2fdKZTrmQShtg&pid=ImgRaw&r=0" alt="gym" />
        </div>
        <div class="login-details">
            <div class="login-logo">
                <img src="./assets/logo.jpg" alt="logo" />
            </div>
            <?php if (isset($message)) {
                foreach ($message as $message) {
                    echo '<span class="err">' . $message . '</span>';
                }
            }
            ?>
            <form method="post">
                <div class="login">
                    <h2>LOGIN</h1>
                        <form action="">
                            <div class="l-input">
                                <label>Email</label>
                                <input type="email" name="email" placeholder="Example@gmail.com">
                            </div>
                            <div class="l-input">
                                <label>Password</label>
                                <input type="password" name="pwd">
                            </div>
                            <div class="password">
                                <div class="remember">
                                    <input type="checkbox">
                                    <p>Remember Me</p>
                                </div>
                                <a href="">Forget Password</a>
                            </div>
                            <div class="btn">
                                <button type="submit" name="login">Login</button>
                            </div>
                        </form>
                        <p>Don't have an account? <span href="" onclick="popup()">Register</span></p>
                </div>
            </form>
        </div>
    </div>



    <div class="popup" id="popup" onclick="closePopup()">
    <div class="popup-container" id='pc'>
        <section>
            <a href="./customer_register.php">
                <img src="./assets/member.jpeg" alt="">
                <span>Register as a customer</span>
            </a>
        </section>
        <section>
            <a href="./coach_registration.php">
                <img src="./assets/coach.jpeg" alt="">
                <span>Register as a coach</span>
            </a>
        </section>
    </div>
</div>

</body>

</html>