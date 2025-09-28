<?php
include './includes/auth.php';
isLogged("customer");
include './includes/navBar.php';
include './dbConnection.php';
?>

<!-- fetch product -->
<?php
$selectPdc = "SELECT * FROM products";
$resPdc = mysqli_query($conn, $selectPdc);
?>

<div class="hero">
  <img src="./assets/st.jpeg" alt="gym" id="heroImg" />
  <section class="hero-text">
    <p id="hero-p1">WORKOUT <br />AT HOME.</p>
    <p id="hero-p2">
      STAY HEALTHY WITH GROUP CLASSES AND PERSONAL<br />
      TRAINING STREAMED DIRECTLY INTO YOUR HOME.
    </p>
  </section>
</div>


<div class="card-container">
  <p class="title">Products</p>
  <hr />
  <div class="card-list">
    <?php while ($row = mysqli_fetch_assoc($resPdc)) { ?>
      <div class="p-card">
        <img src="./uploaded_img/<?php echo $row['img'] ?>" alt="" />
        <div class="p-card-about">
          <p class="card-name"><?php echo $row['title'] ?></p>
          <p class="p-card-info">
            <?php echo $row['description'] ?>
          </p>
          <section class="price">
            <p>LKR <?php echo $row['price'] ?></p>
            <button>Buy</button>
          </section>
        </div>
      </div>
    <?php }; ?>
  </div>
</div>



<script>
  document.addEventListener("DOMContentLoaded", function() {
    const heroImg = document.getElementById("heroImg");
    const imgs = ["./assets/st.jpeg", "./assets/bg.jpg", "./assets/store-1.jpeg", "./assets/class3.jpg"];
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