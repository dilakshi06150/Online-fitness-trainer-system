<?php
include './includes/auth.php';
isLogged('admin');
include './dbConnection.php';

// Create store item
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
    $insert = "INSERT INTO products(img,title,description,price) VALUES('$pic','$title','$description','$price')";

    $upload = mysqli_query($conn, $insert);

    if ($upload) {
      move_uploaded_file($pic_tmp_name, $pic_folder);
    } else {
      $message[] = "Try again!";
    }
  }
}


//delete store item
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];

  $delete = mysqli_query($conn, "DELETE FROM products WHERE id = $id");
  header('location:admin.php');
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="stylesheet" href="./styles/admin.css">
  <link rel="stylesheet" href="./styles/form.css">
</head>

<body>
  <div class="admin-nav">
    <img src="./assets/logo.jpg" alt="">
    <img src="./assets/image.png" alt="">
  </div>

  <div class="sideBar-and-content">
    <div class='sidebar'>
      <div class="sidebar-item">
      <img src="./assets/online-shopping.png" alt="" />
        <p onclick="changeTab(2)">Product List</p>
      </div>
      <div class="sidebar-item">   
        <img src="./assets/add-product.png" alt="" />
        <p onclick="changeTab(1)">Add Product</p>
      </div>
    </div>

    <div class="sidebar-content">
      <div class="c1" id="tab1">
        <div class="container">
          <div class="admin-product-form-container">

            <form method="post" enctype="multipart/form-data">
              <h3>add a new product</h3>
              <input type="text" placeholder="title" name="title" class="box" />
              <textarea placeholder="description" name="description" id="" cols="30" rows="5"></textarea>
              <input type="text" placeholder="price" name="price" class="box" />
              <input type="file" accept="image/png, image/jpeg, image/jpg" name="pic" class="box" />
              <input type="submit" class="btn" name="add" value="Add Product" />
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php
    $select = "SELECT * FROM products";
    $res = mysqli_query($conn, $select);
    ?>

    <div class="c2" id="tab2">
      <div class="product-display">
        <table class="product-display-table">
          <thead>
            <tr>
              <th>product image</th>
              <th>product name</th>
              <th>product price</th>
              <th>action</th>
            </tr>
          </thead>
          <?php while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
              <td><img src="uploaded_img/<?php echo $row['img']; ?>" height="100" alt=""></td>
              <td><?php echo $row['title']; ?></td>
              <td>LKR <?php echo $row['price']; ?>/-</td>
              <td>
                <a href="updateProduct.php?edit=<?php echo $row['id'] ?>" class="btn"> edit </a>
                <a href="admin.php?delete=<?php echo $row['id'] ?>" class="btn" name='delete'> delete </a>
              </td>
            </tr>
          <?php }; ?>
        </table>
      </div>
    </div>
  </div>

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

</body>

</html>