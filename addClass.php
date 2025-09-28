<?php
include './includes/auth.php';
isLogged('coach');
include './includes/navBar.php';
include './dbConnection.php';

$coach_id = $_SESSION['user_id'];
$coach_img = $_SESSION['profilePic'];
$name = $_SESSION['name'];

if (isset($_POST['add'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $pic = $_FILES['pic']['name'];
  $pic_tmp_name = $_FILES['pic']['tmp_name'];
  $pic_folder = 'uploaded_img/' . $pic;

  $message;

  if (empty($title) || empty($pic) || empty($description) || empty($price)) {
    $message[] = "Please fill all fields.!";
  } else {
    $insert = "INSERT INTO classes(coach_id,title,description,classImg,coachName,coachImg,price) VALUES('$coach_id','$title','$description','$pic','$name','$coach_img','$price')";

    $upload = mysqli_query($conn, $insert);

    if ($upload) {
      move_uploaded_file($pic_tmp_name, $pic_folder);
      $message[] = 'new class added successfully';
    } else {
      $message[] = "Try again!";
    }
  }
}
?>

<div class="container">
  <div class="admin-product-form-container">
    <?php if (isset($message)) {
      foreach ($message as $message) {
        echo '<span class="message">' . $message . '</span>';
      }
    } ?>
    <form method="post" enctype="multipart/form-data">
      <h3>add a new class</h3>
      <input type="text" placeholder="title" name="title" class="box" />
      <textarea placeholder="description" name="description" id="" cols="30" rows="5"></textarea>
      <input type="file" accept="image/png, image/jpeg, image/jpg" name="pic" class="box" />
      <input type="text" placeholder="price" name="price" class="box" />
      <input type="submit" class="btn" name="add" value="Add Class" />
    </form>
  </div>
</div>

<?php include './includes/footer.php'; ?>