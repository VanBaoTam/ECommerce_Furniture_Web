{
  const hasId = sessionStorage.getItem("id") !== null;
  const hasName = sessionStorage.getItem("name") !== null;
  let resp = document.getElementById("nav");
  let nav = "";
  if (hasId && hasName) {
    nav = `
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">More</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="about-us.php">About Us</a>
              <a class="dropdown-item" href="terms.php">Terms</a>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
          <li class="nav-item"><a class="nav-link" href="#" onclick="Logout()">Logout</a></li>
        `;
  } else {
    nav = `
          <li class="nav-item ">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">More</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="about-us.php">About Us</a>
              <a class="dropdown-item" href="terms.php">Terms</a>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        `;
  }
  resp.innerHTML = nav;
}
