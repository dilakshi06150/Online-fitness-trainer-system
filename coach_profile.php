<?php
include './includes/auth.php';
isLogged('coach');

include './includes/navBar.php';
include './dbConnection.php';


if (!isset($_SESSION['user_id'])) {
    die("No user ID found in session");
}


$id = $_SESSION['user_id'];

//read data
$select = mysqli_query($conn, "SELECT * FROM coach WHERE id = $id");

//delete account
if(isset($_GET['delete'])){
    $delete = mysqli_query($conn, "DELETE FROM coach WHERE id = $id");
    header('location:./coach_registration.php');
}

//logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('location:./login.php');
}

//update details
if (isset($_POST['update'])) {
    $fName = $_POST['first_name'];
    $lName = $_POST['last_name'];
    $profile_pic = $_FILES['pp']['name'];
    $profile_pic_tmp_name = $_FILES['pp']['tmp_name'];
    $profile_pic_folder = 'uploaded_img/' . $profile_pic;
    $dob = $_POST['dob'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $pwd = $_POST['password'];

    $hashedPass = !empty($pwd) ? password_hash($pwd, PASSWORD_DEFAULT) : null;

    $update_data = "UPDATE coach SET firstName = '$fName', lastName = '$lName', ";
    if (!empty($profile_pic)) {
        $update_data .= "profileImg = '$profile_pic', ";
    }
    $update_data .= "birthday = '$dob', tele = '$contact_number', email = '$email', address = '$address' ";
    if ($hashedPass) {
        $update_data .= ", password = '$hashedPass' ";
    }
    $update_data .= "WHERE id = $id";

    $upload = mysqli_query($conn, $update_data);


    if ($upload) {

        if (!empty($profile_pic)) {
            if (move_uploaded_file($profile_pic_tmp_name, $profile_pic_folder)) {
                $_SESSION['profilePic'] = $profile_pic; 
            } else {
                echo "<script>alert('Failed to upload profile picture');</script>";
            }
        }

        echo "<script>alert('Profile updated successfully');</script>";
        header('Location:./coach_profile.php');
    } else {
        echo "<script>alert('Update failed: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!-- Profile Page Content -->
<div class="coach-container">
    <h3>Profile</h3>
    <div class="coach-sub-container">
        <div class="tabs">
            <p onclick="changeTab(1)">My Profile</p>
            <p onclick="changeTab(2)">Update profile</p>
            <p ><a href="./coach_profile.php?delete=<?php echo $id?>" class="deleAcc">Delete Account</a></p>
            <p><a href="./customer_profile.php?logout=<?php echo $id ?>">Log out</a></p>        </div>

        <!-- Display the current coach profile information -->
        <?php while ($row = mysqli_fetch_assoc($select)) { ?>
            <div class="content-1" id="tab1">
                <section class="profile-img">
                    <img src="./uploaded_img/<?php echo $row['profileImg']; ?>" alt="Profile Picture">
                    <section class="name">
                        <p><?php echo $row['firstName']; ?></p>
                        <p><?php echo $row['address']; ?></p>
                    </section>
                </section>

                <section class="coach-info">
                    <div class="coach-description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </div>
                    <div class="other-info">
                        <section class="sec-1">
                            <section>
                                <p>First Name</p>
                                <p class="value"><?php echo $row['firstName']; ?></p>
                            </section>
                            <section>
                                <p>Last Name</p>
                                <p class="value"><?php echo $row['lastName']; ?></p>
                            </section>
                            <section>
                                <p>Birthday</p>
                                <p class="value"><?php echo $row['birthday']; ?></p>
                            </section>
                        </section>

                        <section class="sec-1">
                            <section>
                                <p>Contact</p>
                                <p class="value"><?php echo $row['tele']; ?></p>
                            </section>
                            <section>
                                <p>Email</p>
                                <p class="value"><?php echo $row['email']; ?></p>
                            </section>
                            <section>
                                <p>Address</p>
                                <p class="value"><?php echo $row['address']; ?></p>
                            </section>
                        </section>
                    </div>
                </section>
            </div>

            <!-- Update Profile Form -->
            <div class="content-2" id="tab2">
                <form method="post" enctype="multipart/form-data">
                    <div class="inputs">
                        <div class="inputs-1">
                            <p>First Name:</p>
                            <input type="text" name="first_name" placeholder="First Name" value="<?php echo $row['firstName']; ?>" />

                            <p>Last Name:</p>
                            <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $row['lastName']; ?>" />

                            <p>Profile Picture:</p>
                            <input type="file" name="pp" accept="image/png, image/jpeg, image/jpg" />

                            <p>Birthday:</p>
                            <input type="date" name="dob" placeholder="Birthday" value="<?php echo $row['birthday']; ?>" />
                        </div>

                        <div class="inputs-1">
                            <p>Contact Number:</p>
                            <input type="tel" name="contact_number" placeholder="Contact Number" value="<?php echo $row['tele']; ?>" />

                            <p>Email:</p>
                            <input type="email" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" />

                            <p>Address:</p>
                            <input type="text" name="address" placeholder="Address" value="<?php echo $row['address']; ?>" />

                            <p>Password:</p>
                            <input type="password" name="password" placeholder="******" />
                        </div>
                    </div>

                    <button type="submit" name="update">Update</button>
                </form>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Footer and JavaScript -->
<?php include './includes/footer.php'; ?>

<script>
    function changeTab(index) {
        const tab1 = document.getElementById('tab1');
        const tab2 = document.getElementById('tab2');

        if (index === 1) {
            tab1.style.display = 'flex';
            tab2.style.display = 'none';
        } else {
            tab1.style.display = 'none';
            tab2.style.display = 'flex';
        }
    }
</script>