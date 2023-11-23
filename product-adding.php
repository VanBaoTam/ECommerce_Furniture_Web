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
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                              data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                              aria-label="Toggle navigation">
                              <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarResponsive">
                              <ul class="navbar-nav ml-auto" id="nav">

                              </ul>
                        </div>
                  </div>
            </nav>
      </header>
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
      <div class="container">
            <form action="" id="order-form" class="form" method="POST" enctype="multipart/form-data"
                  onsubmit="return handleSubmit(event);">
                  <input type="hidden" name="id" id="idInput" />
                  <label>Name</label><br />
                  <input type="text" name="productName" placeholder="Product Name" required></input><br />
                  <br>
                  <label>Price</label><br />
                  <input type="number" name="productPrice" min="0" placeholder="Product Price" required />
                  <br /><br />
                  <label>Discount</label><br />
                  <input type="number" min="0" max="100" name="productDiscount" placeholder="Product Discount"
                        required />
                  <br /><br />
                  <label>Stock</label><br />
                  <input type="number" name="productStock" min="0" placeholder="Product Stock" required />
                  <br /><br />
                  <label for="productImages">Product Images</label><br />
                  <input type="file" name="productImages[]" id="productImages" accept="image/*" multiple
                        required /><br><br />
                  <textarea name="description" name="productDescription" placeholder="Product Description" rows="6"
                        class="form-control" id="description" /></textarea>

                  <br>

                  <div>
                        <div>
                              <div>
                                    <div class="col-md-12">
                                          <div style="margin-left:10rem;" id="adjust-response"></div>
                                          <div style="margin-left:10rem;" id="remove-response"></div>
                                          <button class="btn btn-primary" type="submit"
                                                style="margin-left:2rem">Add</button>
                                    </div>
                                    <div class="col-sm-8">
                                          <div id="add-response"></div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </form>
      </div>
      <script>
            function handleSubmit(event) {
                  event.preventDefault();
                  console.log("Form Data:", new FormData(event.target));
                  fetch('./modules/admin/handleAddProduct.php', {
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
                                    let resp = document.getElementById("add-response");
                                    resp.innerHTML = `<p style="color: green;">${data.message}</p>`;
                              } else {
                                    let resp = document.getElementById("add-response");
                                    resp.innerHTML = `<p style="color: red;">${data.message}</p>`;
                              }
                        })
                        .catch(error => {
                              console.error("Error:", error);
                        });
            }
      </script>
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
      <script src="utils/account/Dashboard.js"></script>

      <!-- Additional Scripts -->
      <script src="assets/js/custom.js"></script>
      <script src="assets/js/owl.js"></script>
</body>

</html>