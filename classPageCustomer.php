<?php
include './includes/auth.php';
isLogged('customer');
include './includes/navBar.php';
include './dbConnection.php';
?>

<?php
$select = "SELECT * FROM classes";
$res = mysqli_query($conn, $select);

?>


<div class="hero">
  <img src="./assets/cls-4.jpeg" alt="gym" id="heroImg" />
  <section class="hero-text">
    <p id="hero-p1">WORKOUT <br />AT HOME.</p>
    <p id="hero-p2">
      STAY HEALTHY WITH GROUP CLASSES AND PERSONAL<br />
      TRAINING STREAMED DIRECTLY INTO YOUR HOME.
    </p>
  </section>
</div>

<div class="card-container">
  <p class="title">Classes</p>
  <hr />
  <div class="card-list">

    <!-- display classes -->
    <?php while ($row = mysqli_fetch_assoc($res)) { ?>
      <div class="cls-card">
        <img src="./uploaded_img/<?php echo $row['classImg']; ?>" alt="" />
        <div class="cls-card-about">
          <p class="cls-card-name"><?php echo $row['title']; ?></p>
          <p class="cls-card-info">
            <?php echo $row['description']; ?>
          </p>
          <section class="trainer-info">
            <section class="profile">
              <img src="./uploaded_img/<?php echo $row['coachImg']; ?>" alt="profile" />
              <p><?php echo $row['coachName']; ?></p>
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
  </div>
</div>

<?php include './includes/footer.php'; ?>