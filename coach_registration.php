<?php
  session_start();
  include './dbConnection.php';

  if (isset($_POST['register'])) {
    $role ="coach";
    $fName = $_POST['first_name'];
    $lName = $_POST['last_name'];
    $profile_pic= $_FILES['pp']['name'];
    $profile_pic_tmp_name = $_FILES['pp']['tmp_name'];
    $profile_pic_folder = 'uploaded_img/'.$profile_pic;
    $dob = $_POST['dob'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $pwd = $_POST['password'];
    $hashedPass = password_hash($pwd,PASSWORD_DEFAULT);

    $isError;

    if (empty($fName)||empty($lName)||empty($profile_pic)||empty($dob)||empty($contact_number)||empty($address)||empty($pwd)) {
      $isError[] = "Please fill all";
    }
    else{
      $insert = "INSERT INTO coach(role,firstName,lastName,profileImg,birthday,tele,email,password,address) VALUES('$role','$fName','$lName','$profile_pic','$dob','$contact_number','$email','$hashedPass','$address')";

       $upload = mysqli_query($conn,$insert);

       if ($upload) {
            move_uploaded_file($profile_pic_tmp_name, $profile_pic_folder);
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['profilePic'] = $profile_pic;
            $_SESSION['name'] = $fName;
            $_SESSION['role'] = $role;
        header("Location:./homeCoach.php");
       }
       else{
        $isError[] ="Try again!";
       }
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Coach registration Form</title>
    <link rel="stylesheet" type="text/css" href="./styles/coach_registration.css" />
  </head>
  <body>
    <div class="container">
      <div class="img-slide">
        <img src="./assets/bg.jpg" alt="" id="img" />
      </div>
      <div class="coach_registration">
        <h1>Coach registration</h1>
        <form method="post"  enctype="multipart/form-data">
          
          <div class="inputs">
            <div>
              <p>First Name:</p>
              <input type="text" name="first_name" placeholder="First Name" required/>
              <p>Last Name:</p>
              <input type="text" name="last_name" placeholder="Last Name" required/>
              <p>Profile Picture:</p>
              <input type="file" name="pp"  accept="image/png, image/jpeg, image/jpg" required/>
              <p>Birthday:</p>
              <input type="date" name="dob" placeholder="Name" required/>
            </div>
            <div>
              <p>Contact Number:</p>
              <input
                type="tel"
                name="contact_number"
                placeholder="Contact Number"
                required
              />
              <p>Email:</p>
              <input type="email" name="email" placeholder="Email" required/>
              <p>Address:</p>
              <input type="address" name="address" placeholder="Address" required/>
              <p>Password:</p>
              <input type="password" name="password" placeholder="Password" required/>
            </div>
          </div>
          <button type="submit" name="register">Register</button>
        </form>
        <p>Already you have an account <a href="./login.php">login</a></p>
      </div>
    </div>

    <script>
      const imgTag = document.getElementById("img");
      const imgs = ["./assets/bg.jpg", "./assets/hero.jpg"];
      let i = 0;

      function imgCarousel() {
        imgTag.src = imgs[i];
        if (i < imgs.length - 1) {
          i++;
        } else {
          i = 0;
        }
        setTimeout(imgCarousel, 3000);
      }

      window.onload = imgCarousel();
    </script>
  </body>
</html>
