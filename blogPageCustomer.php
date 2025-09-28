<?php
include './includes/auth.php';
isLogged('customer');
include './includes/navBar.php';
include 'dbConnection.php';
?>

<!-- read blog -->
<?php
$select = "SELECT * FROM blogs";
$res = mysqli_query($conn, $select);

?>

<div class="hero">
  <img src="./assets/hero.jpg" alt="gym" id="heroImg" />
  <section class="hero-text">
    <p id="hero-p1">WORKOUT <br />AT HOME.</p>
    <p id="hero-p2">
      STAY HEALTHY WITH GROUP CLASSES AND PERSONAL<br />
      TRAINING STREAMED DIRECTLY INTO YOUR HOME.
    </p>
  </section>
</div>

<div class="card-container">
  <p class="title">Blogs</p>
  <hr />
  <div class="blog-list">

    <?php while ($row = mysqli_fetch_assoc($res)) { ?>
      <div class="blog-card">
        <img src="uploaded_img/<?php echo $row['blogImg'] ?>" alt="" />
        <div class="blog-info">
          <div style="display: flex; flex-direction: column; gap: 20px">
            <div>
              <p class="title"><?php echo $row['title'] ?></p>
              <hr />
            </div>
            <p class="description">
              <?php echo $row['description'] ?>
            </p>
          </div>
          <section class="writer">
            <img src="uploaded_img/<?php echo $row['writerImg'] ?>" alt="profile" />
            <p><?php echo $row['writerName'] ?></p>
          </section>
        </div>
      </div>
    <?php }; ?>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const heroImg = document.getElementById("heroImg");
    const imgs = ["./assets/hero.jpg", "./assets/bg.jpg", "./assets/class2.jpg", "./assets/class3.jpg"];
    let i = 0;


    function imgCarousel() {

      heroImg.src = imgs[i];
      if (i < imgs.length - 1) {
        i++;
      } else {
        i = 0;
      }
      setTimeout(imgCarousel, 3000);
    }

    window.onload = imgCarousel();
  });
</script>

<?php include './includes/footer.php'; ?>