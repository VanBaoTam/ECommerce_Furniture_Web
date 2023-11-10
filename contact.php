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

      let loginForm = document.getElementById('contact-form');

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
  <div class="page-heading contact-heading header-text" style="background-image: url(assets/images/heading.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>Let's decorate your house!
            </h4>
            <h2>Contact Us</h2>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="find-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Our Location on Maps</h2>
          </div>
        </div>
        <div class="col-md-8">
          <div id="map">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15679.928017210861!2d106.66412269124748!3d10.735870179965488!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1698589078892!5m2!1svi!2s"
              width="100%" height="330px" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-md-4">
          <div class="left-content">
            <h4>About our office</h4>
            <p style="text-align: justify;">Address: 108 Cao Lỗ, Quận 8, TP.HCM
              <br />Phone number: 012 . 312 . 3123 <br />
              Other contacts:
            </p>
            <ul class="social-icons">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="send-message">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Send us a Message</h2>
          </div>
        </div>
        <div class="col-md-12">
          <div class="contact-form">
            <form id="contact-form" action="" method="post" onsubmit="return handleSubmit(event);">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <fieldset>
                    <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject"
                      required="">
                  </fieldset>
                  <input type="hidden" name="id" id="idInput" />
                  <input type="hidden" name="name" id="nameInput" />
                </div>
                <div class="col-lg-12">
                  <fieldset>
                    <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your Message"
                      required=""></textarea>
                  </fieldset>
                </div>
                <div class="col-lg-12">
                  <div id="contact-response">
                  </div>
                  <button class="btn btn-primary" type="submit">Send Message</button>
                </div>
              </div>
            </form>

            <script>
              let id = sessionStorage.getItem('id');
              let name = sessionStorage.getItem('name');
              if (!id || !name) {
                window.location.href = 'login.php';
              }
              document.getElementById('idInput').value = id;
              document.getElementById('nameInput').value = name;
            </script>

          </div>
        </div>
        <script>
          function handleSubmit(event) {
            event.preventDefault();
            fetch('./modules/contact/handleContact.php', {
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
                  let resp = document.getElementById("contact-response");
                  resp.innerHTML = `<p style="color: green;">${data.message}</p> <br>`;
                } else {
                  let resp = document.getElementById("contact-response");
                  resp.innerHTML = `<p style="color: red;">${data.message}</p> <br>`;
                }
              })
              .catch(error => {
                console.error("Error:", error);
              });

            return false; 
          }
        </script>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner-content">
            <p>
              Copyright © 2023 Chairable Company </p>
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