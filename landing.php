<?php
include './includes/navBar.php';
include './dbConnection.php';
?>

<!-- fetch classes -->
<?php
$selectCls = "SELECT * FROM classes LIMIT 4";
$res = mysqli_query($conn, $selectCls);

?>

<!-- fetch blogs -->
<?php
$selectBlg = "SELECT * FROM blogs LIMIT 4";
$resBlg = mysqli_query($conn, $selectBlg);
?>

<!-- fetch product -->
<?php
$selectPdc = "SELECT * FROM products LIMIT 4";
$resPdc = mysqli_query($conn, $selectPdc);
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

<div class="hero-p">
  <div class="hero-p-title">
    <img src="https://assets.website-files.com/5e87da28516d8f3eaaabbb9c/5e91e10fc0e4bbfdbd840cf8_flash-orange.svg" alt="" />
    <p>WORKOUT AT HOME WITH A VIRTUAL PERSONAL TRAINER</p>
  </div>
  <div class="hero-p-title">
    <img src="https://assets.website-files.com/5e87da28516d8f3eaaabbb9c/5e91e10fc0e4bbfdbd840cf8_flash-orange.svg" alt="" />
    <p>A TRAINING & NUTRITION PLAN PERSONALIZED TO YOUR GOALS</p>
  </div>
  <div class="hero-p-title">
    <img src="https://assets.website-files.com/5e87da28516d8f3eaaabbb9c/5e91e10fc0e4bbfdbd840cf8_flash-orange.svg" alt="" />
    <p>ACHIEVE REAL RESULTS FASTER & EASIER THAN YOU IMAGINED</p>
  </div>
</div>

<div class="sub-hero">
  <section class="sub-hero-p1">
    <p>STAY CONNECTED.</p>
    <p>STAY HEALTHY.</p>
  </section>
  <section class="sub-hero-p2">
    <p>LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT.</p>
    <p>IN DOLOR ANTE, LAOREET UT JUSTO A.</p>
  </section>
  <button class="sub-hero-btn">HIRE A VIRTUAL PERSONAL TRAINER</button>
</div>

<div class="card-container">
  <p class="title">Classes</p>
  <hr />
  <div class="card-list">
    <?php while ($row = mysqli_fetch_assoc($res)) { ?>
      <div class="cls-card">
        <img src="./uploaded_img/<?php echo $row['classImg'] ?>" alt="" />
        <div class="cls-card-about">
          <p class="cls-card-name"><?php echo $row['title'] ?></p>
          <p class="cls-card-info">
            <?php echo $row['description'] ?>
          </p>
          <section class="trainer-info">
            <section class="profile">
              <img src="./uploaded_img/<?php echo $row['coachImg'] ?>" alt="profile" />
              <p><?php echo $row['coachName'] ?></p>
            </section>
            <div class="line"></div>
            <section class="time">
              <p>20 hours</p>
              <p>4 weeks</p>
            </section>
          </section>
          <button class="join">Join</button>
        </div>
      </div>
    <?php }; ?>
    >


  </div>
</div>

<div class="free-plan">
  <section class="free-plan-img">
    <img src="https://assets.website-files.com/5e88d460ab1cf80fcb9f25d6/5e8e6d8d59bf2fc17a3e244e_SIX-WEEK-FITNESS-CHALLENGE.jpg" alt="" />
  </section>
  <section class="free-plan-form">
    <p id="fp-p1">FREE DOWNLOAD!</p>
    <p id="fp-p2">6 WEEK FITNESS CHALLENGE</p>
    <p id="fp-p3">
      Download the free Six Week Fitness Challenge to see last results in
      your health and fitness in just six weeks!
    </p>

    <form id="fp-form">
      <input type="text" placeholder="Enter your name here" />
      <input type="email" placeholder="Enter your email here" />
      <button class="sub-hero-btn">SEND MY FREE FITNESS PLAN</button>
    </form>
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
          <p class="p-card-name"><?php echo $row['title'] ?></p>
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

<div class="feedback">
  <div class="feedback-info">
    <img src="https://th.bing.com/th/id/OIP.IGNf7GuQaCqz_RPq5wCkPgAAAA?rs=1&pid=ImgDetMain" alt="" />
    <p>
      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque quis
      veniam obcaecati In veritatis eligendi dolores officiis perspiciatis.
      Ut a est nam recusandae.
    </p>
  </div>
</div>

<div class="card-container">
  <p class="title">Blogs</p>
  <hr />
  <div class="blog-list">

    <?php while ($row = mysqli_fetch_assoc($resBlg)) { ?>
      <div class="blog-card">
        <img src="./uploaded_img/<?php echo $row['blogImg'] ?>" alt="" />
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
            <img src="./uploaded_img/<?php echo $row['writerImg'] ?>" alt="profile" />
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