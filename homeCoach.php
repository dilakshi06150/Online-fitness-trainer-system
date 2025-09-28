<?php
include './includes/auth.php';
isLogged('coach');

include './includes/navBar.php';
include './dbConnection.php';

$coach_id = $_SESSION['user_id'];

//delete blog
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];

  $delete = mysqli_query($conn, "DELETE FROM blogs WHERE id = $id");
  header('location:homeCoach.php');
}

//delete class
if (isset($_GET['dele'])) {
  $id = $_GET['dele'];

  $delete = mysqli_query($conn, "DELETE FROM classes WHERE id = $id");
  header('location:homeCoach.php');
}
?>

<div class="home-hero">
  <div class="hero-content">
    <div class="heroText">
      <div class="clients">
        <h1>+250</h1>
        <p>Clients</p>
      </div>
      <div class="hero-text1">
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae
          doloribus, illum aspernatur harum rerum magni quo architecto non
          voluptates ex repellendus! Quos voluptas id voluptatibus et
          voluptate harum ad amet.
        </p>
      </div>
    </div>
    <div class="hero-img">
      <img src="./assets/hero.jpg" alt="hero image" />
    </div>
  </div>
</div>

<?php
$query = "SELECT * FROM classes WHERE coach_id = '$coach_id'";
$classes = mysqli_query($conn, $query);

?>

<div class="card-container">
  <div class="card-head">
    <p class="title">Classes</p>
    <a class="add-btn" href="./addClass.php">Add Class</a>
  </div>
  <hr />
  <div class="card-list">
    <?php
    if (!mysqli_num_rows($classes)) {
      echo "<div class='noItem'><h3> No Added Class</h3></div>";
    } else {
      while ($row = mysqli_fetch_assoc($classes)) { ?>
        <div class="ch-card">
          <img src="./uploaded_img/<?php echo $row['classImg'] ?>" alt="img" />
          <div class="ch-card-about">
            <p class="card-name"><?php echo $row['title']; ?></p>
            <p class="ch-card-info">
              <?php echo $row['description']; ?>
            </p>
            <section class="btns">
              <a class="del-btn" href="./homecoach.php?dele=<?php echo $row['id']; ?>">Delete</a>
              <a class="edit-btn" href="./updateClass.php?edit=<?php echo $row['id']; ?>">Edit</a>
            </section>
          </div>
        </div>
    <?php }
    }; ?>
  </div>
</div>

<!-- Blog section -->
<div class="card-container">
  <div class="card-head">
    <p class="title">My Blogs</p>
    <a class="add-btn" href="./addBlog.php">Add Blog</a>
  </div>
  <hr />
  <div class="blog-list">

    <?php
    $select = "SELECT * FROM blogs WHERE writerID = '$coach_id'";
    $res = mysqli_query($conn, $select);
    ?>

    <?php
    if (!mysqli_num_rows($res)) {
      echo "<div class='noItem'><h3> No Blogs Added</h3></div>";
    } else {
      while ($row = mysqli_fetch_assoc($res)) { ?>

        <div class="blog-card">
          <img src="./uploaded_img/<?php echo $row['blogImg']; ?>" alt="blog" />
          <div class="blog-info">
            <div style="display: flex; flex-direction: column; gap: 20px">
              <div>
                <p class="title"><?php echo $row['title']; ?></p>
                <hr />
              </div>
              <p class="description">
                <?php echo $row['description']; ?>
              </p>
            </div>
            <section class="btns">
              <a class="del-btn" href="./homecoach.php?delete=<?php echo $row['id']; ?>">Delete</a>
              <a class="edit-btn" href="./updateBlog.php?edit=<?php echo $row['id']; ?>">Edit</a>
            </section>
          </div>
        </div>
    <?php }
    }; ?>
  </div>
</div>

<!-- footer -->
<?php include './includes/footer.php'; ?>