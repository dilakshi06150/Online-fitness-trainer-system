<?php
session_start();
include './dbConnection.php';

if (isset($_POST['register'])) {
  $role = "customer";
  $email = $_POST['email'];
  $pwd = $_POST['password'];
  $profile_pic = $_FILES['pp']['name'];
  $profile_pic_tmp_name = $_FILES['pp']['tmp_name'];
  $profile_pic_folder = 'uploaded_img/' . $profile_pic;
  $hashedPass = password_hash($pwd, PASSWORD_DEFAULT);

  $isError;

  if (empty($email) || empty($profile_pic) || empty($pwd)) {
    $isError = "Please fill all fields.!";
  } else {
    $insert = "INSERT INTO customer(role,email,password,profileImg) VALUES('$role','$email','$hashedPass','$profile_pic')";

    $upload = mysqli_query($conn, $insert);

    if ($upload) {
      move_uploaded_file($profile_pic_tmp_name, $profile_pic_folder);
      $_SESSION['user_id'] = mysqli_insert_id($conn);
      $_SESSION['profilePic'] = $profile_pic;
      $_SESSION['role'] = $role;

      header("Location:./landing.php");
    } else {
      $isError = "Try again!";
    }
  }
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width, initial-scale=1.0">
  <title>Customer Register page</title>
  <link rel="stylesheet" href="./styles/customerRegister.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>


<body>
  <!------------------------- form box ---------------------------->
  <div class="wrapper">
    <form method="post" enctype="multipart/form-data">
      <h1>Register</h1>
      <div class="input-box">
        <input type="email" placeholder="Email" name="email" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Password" name="password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      <div class="input-box">
        <input type="file" name="pp" required>
      </div>
      <button type="submit" class="btn" name="register">Register</button>

      <div class="register-link">
        <p>You have an account? <a href="./login.php">Log in</a></p>
      </div>
    </form>
  </div>


</body>

</html>