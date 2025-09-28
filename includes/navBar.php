<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start(); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/profilePages.css">
    <link rel="stylesheet" href="./styles/include.css">
    <link rel="stylesheet" href="./styles/homeCoach.css">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/addBlog.css">
    <link rel="stylesheet" href="./styles/updateBlog.css">
    <link rel="stylesheet" href="./styles/form.css">
    <link rel="stylesheet" href="./styles/productCard.css">
    <link rel="stylesheet" href="./styles/clsCard.css">
    <title>Fitness Trainer</title>

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
<header>
    <nav class="nav">
        <img src="./assets/logo.jpg" alt="logo" class='nav-logo'>
        <ul>
            <?php if (isset($_SESSION['user_id'])) {?>
                <?php if ($_SESSION['role'] === 'customer') {?>
                    <li><a href="./landing.php">Home</a></li>
                    <li><a href="./classPageCustomer.php">Class</a></li>
                    <li><a href="./blogPageCustomer.php">Blogs</a></li>
                    <li><a href="./storePageCustomer.php">Store</a></li>
                <?php } ?>
                
                <?php if ($_SESSION['role'] === 'coach') {?>
                    <li><a href="./homeCoach.php">Home</a></li>
                    <li><a href="./storePageCustomer.php">Store</a></li>
                <?php } ?>
    
                
           <?php } ?>

           <?php if (!isset($_SESSION['user_id'])) {?>
                    <li><a href="./homeCoach.php">Home</a></li>
                    <li><a href="./classPageCustomer.php">Class</a></li>
                    <li><a href="./blogPageCustomer.php">Blogs</a></li>
                    <li><a href="./storePageCustomer.php">Store</a></li>
                <?php } ?>

            <?php if (isset($_SESSION['user_id'])) { ?>
                <?php if ($_SESSION['role'] === 'customer') {?>
                <li>
                    <a href="./customer_profile.php">
                        <img class="profilePic" src="./uploaded_img/<?php echo $_SESSION['profilePic']; ?>" alt="Profile Picture">
                    </a>
                </li>
                <?php }; ?>
                <?php if ($_SESSION['role'] === 'coach') {?>
                <li>
                    <a href="./coach_profile.php">
                        <img class="profilePic" src="./uploaded_img/<?php echo $_SESSION['profilePic']; ?>" alt="Profile Picture">
                    </a>
                </li>
                <?php }; ?>
            <?php } else { ?>
                <li><a href="./login.php">Login</a></li>
                <li onclick="popup()">Sign up</li>
            <?php } ?>
        </ul>
    </nav>
</header>

<!-- Popup -->
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
