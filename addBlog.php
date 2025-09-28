   <?php
    include './includes/auth.php';
    isLogged('coach');
    include './includes/navBar.php';
    include './dbConnection.php';

    $coach_id = $_SESSION['user_id'];
    $profile_pic = $_SESSION['profilePic'];
    $name = $_SESSION['name'];

    if (isset($_POST['add_blog'])) {
      $writer_id = $coach_id;
      $title = $_POST['title'];
      $description = $_POST['description'];
      $writer_name = $name;
      $writer_img = $profile_pic;
      $pic = $_FILES['pic']['name'];
      $pic_tmp_name = $_FILES['pic']['tmp_name'];
      $pic_folder = 'uploaded_img/' . $pic;

      $message;

      if (empty($title) || empty($pic) || empty($description)) {
        $message[] = "Please fill all fields.!";
      } else {
        $insert = "INSERT INTO blogs(writerID,title,description,blogImg,writerName,writerImg) VALUES('$writer_id','$title','$description','$pic','$name','$writer_img')";

        $upload = mysqli_query($conn, $insert);

        if ($upload) {
          move_uploaded_file($pic_tmp_name, $pic_folder);
          $message[] = 'new blog added successfully';
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
        }
        ?>
       <form method="post" enctype="multipart/form-data">
         <h3>add a new blog</h3>
         <input type="text" placeholder="title" name="title" class="box" />
         <textarea placeholder="description" name="description" id="" cols="30" rows="5"></textarea>
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="pic" class="box" />
         <input type="submit" class="btn" name="add_blog" value="Add Blog" />
       </form>
     </div>
   </div>

   <?php include './includes/footer.php'; ?>