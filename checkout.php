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
                              <h4>Let's decorate your house!
                              </h4>
                              <h2>Checkout</h2>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="products call-to-action">
          <div class="container">
               <ul class="list-group list-group-flush" id="bill">
               </ul>

               <br>
               <div id="cart-response">
               </div>
               <div id="cart" style="display:flex;flex-wrap:wrap;">

               </div>
               <div class="inner-content">
                    <div class="contact-form">
                         <form action="#">
                              <p style="font-sie:40px;color:tomato;font-weight:bold;">Only write down the form below if
                                   you
                                   want to give us
                                   the alternative informations</p>
                              <br>
                              <div class="row">
                                   <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                             <label class="control-label">Phone 2:</label>
                                             <input type="text" name="alter-phone" class="form-control">
                                        </div>
                                   </div>
                                   <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                             <label class="control-label">Address 2:</label>
                                             <input type="text" name="alter-address" class="form-control">
                                        </div>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                             <label class="control-label">Zip postal 2:</label>
                                             <input type="text" name="alter-postal" class="form-control">
                                        </div>
                                   </div>
                                   <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                             <label class="control-label">Payment method</label>

                                             <select class="form-control" name="method">
                                                  <option value="">-- Choose --</option>
                                                  <option value="bank">Bank account</option>
                                                  <option value="cash">Cash</option>
                                                  <option value="paypal">PayPal</option>
                                             </select>
                                        </div>
                                   </div>
                              </div>

                              <div class="row">
                                   <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                             <label class="control-label">Captcha</label>
                                             <input type="text" name="captcha" class="form-control">
                                        </div>
                                   </div>
                              </div>

                              <div class="form-group">
                                   <label class="control-label">
                                        <input type="checkbox" name="terms">
                                        I agree with the <a href="terms.php" target="_blank">Terms &amp; Conditions</a>
                                   </label>
                              </div>

                              <div class="clearfix">
                                   <button type="button" class="filled-button pull-left">Back</button>

                                   <button type="submit" class="filled-button pull-right">Finish</button>
                              </div>
                         </form>
                    </div>
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
     <script>
          var id = sessionStorage.getItem('id');
          var name = sessionStorage.getItem('name');
          if (!id || !name) {
               window.location.href = 'login.php';
          }
     </script>
     <script>
          document.addEventListener("DOMContentLoaded", function () {
               function sendPost(url, data) {
                    fetch(url, {
                         method: 'POST',
                         headers: {
                              'Content-Type': 'application/x-www-form-urlencoded',
                         },
                         body: new URLSearchParams(data),
                    })
                         .then(response => response.json())
                         .then(data => {
                              console.log(data);
                              if (data.length > 0) {
                                   let costFixed = Number((data[0].cost)).toFixed(2);
                                   let totalFixed = Number((data[0].inTotal)).toFixed(2);
                                   let billForm = document.getElementById("bill");
                                   billForm.innerHTML = `
                              <li class="list-group-item">
                         <div class="row">
                              <div class="col-6">
                                   <em>Cost</em>
                              </div>

                              <div class="col-6 text-right">
                                   <strong>$ ${costFixed}</strong>
                              </div>
                         </div>
                    </li>

                    <li class="list-group-item">
                         <div class="row">
                              <div class="col-6">
                                   <em>Shipment fee</em>
                              </div>

                              <div class="col-6 text-right">
                                   <strong>$ ${data[0].shipment_fee}</strong>
                              </div>
                         </div>
                    </li>

                    <li class="list-group-item">
                         <div class="row">
                              <div class="col-6">
                                   <em>Other fee </em>
                              </div>

                              <div class="col-6 text-right">
                                   <strong>$ ${data[0].other_fee}</strong>
                              </div>
                         </div>
                    </li>

                    <li class="list-group-item">
                         <div class="row">
                              <div class="col-6">
                                   <em>Total</em>
                              </div>

                              <div class="col-6 text-right">
                                   <strong>$ ${totalFixed}</strong>
                              </div>
                         </div>
                    </li>`;
                                   let cart = document.getElementById('cart');
                                   data.forEach(item => {
                                        let card = document.createElement('div');
                                        card.classList.add('col-md-4');
                                        let totalPrice = (item.quantity * (item.price - item.price * item.discount / 100)).toFixed(2);

                                        card.innerHTML = `
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">${item.name}</h5>
              <p class="cart-bill">Price: $${item.price}</p>
              <p class="cart-bill">Discount: ${item.discount}%</p>
              <p class="cart-bill">Quantity: ${item.quantity}</p>
              <p class="cart-bill">Total: $${totalPrice}  </p>
              <button class="btn btn-danger" onclick="removeItem('${item.productId}')">Remove</button>
            </div>
          </div>
        `;

                                        cart.appendChild(card);
                                   });
                              }
                              else {
                                   let billForm = document.getElementById("bill");
                                   billForm.innerHTML = `
                                   <li class="list-group-item">
                         <div class="row">
                              <div class="col-6">
                                   <em>Cost</em>
                              </div>

                              <div class="col-6 text-right">
                                   <strong>$ 0.00</strong>
                              </div>
                         </div>
                    </li>

                    <li class="list-group-item">
                         <div class="row">
                              <div class="col-6">
                                   <em>Shipment fee</em>
                              </div>

                              <div class="col-6 text-right">
                                   <strong>$ 0.00</strong>
                              </div>
                         </div>
                    </li>

                    <li class="list-group-item">
                         <div class="row">
                              <div class="col-6">
                                   <em>Other fee</em>
                              </div>

                              <div class="col-6 text-right">
                                   <strong>$ 0.00</strong>
                              </div>
                         </div>
                    </li>

                    <li class="list-group-item">
                         <div class="row">
                              <div class="col-6">
                                   <em>Total</em>
                              </div>

                              <div class="col-6 text-right">
                                   <strong>$ 0.00</strong>
                              </div>
                         </div>
                    </li>
`
                              }
                         })
                         .catch((error) => {
                              console.error('Error:', error);
                         });
               }
               let id = sessionStorage.getItem('id');
               let name = sessionStorage.getItem('name');
               if (id && name) {
                    let url = './modules/order/handleCheckout.php';
                    let data = { id: id, name: name };
                    sendPost(url, data);
               }
          });
     </script>
     <script>
          function removeItem(productId) {
               let userId = sessionStorage.getItem("id");
               event.preventDefault();
               let formData = new FormData();
               formData.append("userId", userId);
               formData.append("productId", productId);

               fetch('./modules/order/handleRemoveProduct.php', {
                    method: 'POST',
                    body: formData
               })
                    .then(response => {
                         if (!response.ok) {
                              throw new Error('Network response was not ok');
                         }
                         return response.json();
                    })
                    .then(data => {
                         if (data.code === "200") {
                              let resp = document.getElementById("cart-response");
                              resp.innerHTML = `<p style="color: green;">${data.message}</p>`;
                              setTimeout(() => {
                                   window.location.reload();
                              }, 4000);
                         } else {
                              let resp = document.getElementById("cart-response");
                              resp.innerHTML = `<p style="color: red;">${data.message}</p>`;
                         }

                    })
                    .catch(error => {
                         console.error("Error:", error);
                    });

               return false; // Ensure the form doesn't submit
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