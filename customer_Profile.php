<?php
include './includes/auth.php';
include './includes/navBar.php';
include './dbConnection.php';

isLogged('customer');



if (!isset($_SESSION['user_id'])) {
    die("No user ID found in session");
}

$id = $_SESSION['user_id'];

$select = mysqli_query($conn, "SELECT * FROM customer WHERE id = $id");

//delete account
if (isset($_GET['delete'])) {
    $delete = mysqli_query($conn, "DELETE FROM customer WHERE id = $id");
    session_destroy();
    header('location:./customer_register.php');
}

//logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('location:./login.php');
}

if (isset($_POST['update'])) {
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $profile_pic = $_FILES['pp']['name'];
    $profile_pic_tmp_name = $_FILES['pp']['tmp_name'];
    $profile_pic_folder = 'uploaded_img/' . $profile_pic;


    $hashedPass = !empty($pwd) ? password_hash($pwd, PASSWORD_DEFAULT) : null;

    if (empty($email) && empty($pwd) && empty($profile_pi)) {
        echo "<script>alert('not updated info.!');</script>";
    } else {
        $update_data = "UPDATE customer SET email = '$email' ";

        if (!empty($profile_pic)) {
            $update_data .= ", profileImg = '$profile_pic'";
        }

        if (!empty($hashedPass)) {
            $update_data .= ", password = '$hashedPass'";
        }

        $update_data .= " WHERE id = $id";


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
            header('Location:./customer_profile.php');
        } else {
            echo "<script>alert('Update failed: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>
<div class="coach-container">
    <h3>Profile</h3>
    <div class="coach-sub-container">
        <div class="tabs">
            <p onclick="changeTab(1)">My Profile</p>
            <p onclick="changeTab(2)">Update profile</p>
            <p><a href="./customer_profile.php?delete=<?php echo $id ?>" class="deleAcc">Delete Account</a></p>
            <p><a href="./customer_profile.php?logout=<?php echo $id ?>">Log out</a></p>
        </div>

        <?php while ($row = mysqli_fetch_assoc($select)) { ?>
            <div class="content-1" id="tab1">
                <section class="cus-info">
                    <img src="./uploaded_img/<?php echo $row['profileImg']; ?>" alt="Profile Picture">
                    <section>
                        <p>Email</p>
                        <p class="value"><?php echo $row['email'] ?></p>
                        <p>Password</p>
                        <p class="value">*******</p>
                    </section>

                </section>
            </div>
            <div class="content-2" id="tab2">
                <form method="post" enctype="multipart/form-data">
                    <div class="inputs-1">
                        <p>Email:</p>
                        <input type="email" name="email" placeholder="Email" value=<?php echo $row['email'] ?> />
                        <p>Password:</p>
                        <input type="password" name="password" placeholder="*******" />
                        <p>Profile image:</p>
                        <input type="file" name="pp" accept="image/png, image/jpeg, image/jpg" />
                    </div>
                    <button type="submit" name="update">Update</button>
                </form>
            </div>
        <?php }; ?>
    </div>
</div>

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