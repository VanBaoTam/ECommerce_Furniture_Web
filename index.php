<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="assets/images/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
    rel="stylesheet">

  <title>Chairable</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <?php
  session_start();
  ?>
</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="preloader">
    <div class="jumper">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- Header -->
  <header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <h2>Chairable <em>Website</em></h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
          aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto" id="nav">

          </ul>

        </div>
      </div>
    </nav>
  </header>

  <!-- Page Content -->
  <!-- Banner Starts Here -->
  <div class="banner header-text">
    <div class="owl-banner owl-carousel">
      <div class="banner-item-01">
        <div class="text-content">
          <h4>Let's decorate your house!</h4>
          <h2>Chairable</h2>
          <h2> The Best Furniture's Shop</h2>
        </div>
      </div>
      <div class="banner-item-02">
        <div class="text-content">
          <h4>Let's decorate your house!</h4>
          <h2>Chairable</h2>
          <h2> The Best Furniture's Shop</h2>
        </div>
      </div>
      <div class="banner-item-03">
        <div class="text-content">
          <h4>Let's decorate your house!</h4>
          <h2>Chairable</h2>
          <h2> The Best Furniture's Shop</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner Ends Here -->

  <div class="latest-products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Featured Products</h2>
            <a href="products.php">view more <i class="fa fa-angle-right"></i></a>
          </div>
        </div>
        <?php
        include("./modules/products/fetching.php");
        ?>

      </div>
    </div>
  </div>
  <div class="best-features">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>About Us</h2>
          </div>
        </div>
        <div class="col-md-6">
          <div class="left-content">
            <p>With over 30 years of experience in the furniture industry, <a href="#">We, "Chairable" </a> has firmly
              established itself as a leading name in the world of decorative furniture. Our specialization lies in
              crafting an array of chairs that not only serve functional purposes but also elevate the aesthetics of
              your living spaces.</p>
            <ul class="featured-list">
              <li><a href="#">30 years of experience.</a></li>
              <li><a href="#">Guarantee quality of products.</a></li>
              <li><a href="#">Having a group of expert in decoration.</a></li>
              <li><a href="#">Customer's services 24/24.</a></li>
            </ul>
            <a href="about-us.php" class="filled-button">Read More</a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="right-image">
            <img src="assets/images/about-1-570x350.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="call-to-action">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner-content">
            <div class="row">
              <div class="col-md-8">
                <h4>Got any problem? Want to have inspiration for your house's decoration?</h4>
                <p>We provide 24/24 Customer's services and host daily meeting with our experts in decoration.
                  <br />Feel free to contact us for more information.
                </p>
              </div>
              <div class="col-lg-4 col-md-6 text-right">
                <a href="contact.php" class="filled-button">Contact Us</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner-content">
            <p>Copyright © 2023 Chairable Company </p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="utils/account/Logout.js"></script>
  <script src="utils/account/Navbar.js"></script>
  <!-- Additional Scripts -->
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/owl.js"></script>

</body>

</html>