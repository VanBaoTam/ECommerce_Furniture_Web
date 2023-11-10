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
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
    document.addEventListener('DOMContentLoaded', function () {

      let loginForm = document.getElementById('order-form');

      loginForm.addEventListener('submit', function (event) {
        event.preventDefault();

      });
    });
  </script>

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
  <div class="page-heading about-heading header-text" style="background-image: url(assets/images/heading.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>Let's decorate your house!</h4>
            <h2>Product Details</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include("./modules/products/handleGetDetail.php");
  ?>

  <div class="latest-products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Similar Products</h2>
            <a href="products.php">view more <i class="fa fa-angle-right"></i></a>
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

  <script>
    function handleSubmit(event) {
      let url = new URL(window.location.href);
      let id = url.searchParams.get("id")
      let userId = sessionStorage.getItem('id');
      if (!id || !userId) {
        window.location.href = 'login.php';
      }
      document.getElementById('idInput').value = id;
      document.getElementById('userIdInput').value = userId;
      fetch('./modules/order/handleAddProduct.php', {
        method: 'POST',
        body: new FormData(event.target)
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          if (data.code === "200") {
            let resp = document.getElementById("order-response");
            resp.innerHTML = `<p style="color: green;">${data.message}</p>`;
          } else {
            let resp = document.getElementById("order-response");
            resp.innerHTML = `<p style="color: red;">${data.message}</p>`;
          }
        })
        .catch(error => {
          console.error("Error:", error);
        });

      return false; 
    }
  </script>

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