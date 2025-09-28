<?php
include './includes/auth.php';
isLogged('coach');
include './includes/navBar.php';
include './dbConnection.php';

$id = $_GET['edit'];
?>

<!-- update blog -->
<?php

if (isset($_POST['update'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $pic = $_FILES['pic']['name'];
  $pic_tmp_name = $_FILES['pic']['tmp_name'];
  $pic_folder = 'uploaded_img/' . $pic;

  $message;

  if (empty($title) && empty($pic) && empty($description)) {
    $message[] = "Please fill  field.!";
  } else {
    $update = "UPDATE blogs SET ";

    if (!empty($title)) {
      $update .= "title = '$title'";
    }

    if (!empty($description)) {
      $update .= ", description = '$description'";
    }

    if (!empty($pic)) {
      $update .= ", blogImg = '$pic'";
    }

    $update .= "WHERE id =$id";
    $upload = mysqli_query($conn, $update);

    if ($upload) {
     
      $message[] = 'Updated successfully';
    }
  }
}

?>

<?php
$select = "SELECT * FROM blogs WHERE id = '$id'";
$res = mysqli_query($conn, $select);
?>

<div class="container">
  <div class="admin-product-form-container">

    <?php if (isset($message)) {
      foreach ($message as $message) {
        echo '<span class="message">' . $message . '</span>';
      }
    } ?>

    <?php while ($row = mysqli_fetch_assoc($res)) { ?>
      <form method="post" enctype="multipart/form-data">
        <h3>add a update blog</h3>
        <input type="text" placeholder="title" name="title" class="box" value="<?php echo $row['title']; ?>" />
        <textarea placeholder="description" name="description" id="" cols="30" rows="5"><?php echo $row['description']; ?></textarea>
        <input type="file" accept="image/png, image/jpeg, image/jpg" name="pic" class="box" />
        <input type="submit" class="btn" name="update" value="Update" />
      </form>
    <?php }; ?>
  </div>
</div>

<?php include './includes/footer.php'; ?>