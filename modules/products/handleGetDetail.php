<?php
if (isset($_GET["id"])) {
  require_once("getDetail.php");
  $result = getDetail($_GET["id"]);

  if (!empty($result)) {
    $product = $result;
    echo '<div class="products">
            <div class="container">
              <div class="row">
                <div class="col-md-4 col-xs-12">
                  <div>
                    <img src="data:image/jpeg;base64,' . base64_encode($product['image']) . '" alt="" class="img-fluid wc-image">
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-4 col-xs-6">
                      <div>
                        <img src="data:image/jpeg;base64,' . base64_encode($product['image']) . '" alt="" class="img-fluid">
                      </div>
                      <br>
                    </div>
                  </div>
                </div>

                <div class="col-md-8 col-xs-12">
                  <form action="#" method="post" class="form">
                    <h2>' . $product['name'] . '</h2>
                    <br>
                    <p class="lead">
                      <small><del>$' . $product['price'] . '</del></small><strong class="text-primary">$' . ($product['price'] - ($product['discount'] * $product['price'] / 100)) . '</strong>
                      <span class="text-muted">In Stock: ' . $product['in_stock'] . '</span>
                    </p>
                    <br>
                    <p class="lead">' . $product['description'] . '</p>
                    <br>
                    <div class="row">
                      <div class="col-sm-4">
                        <label class="control-label">Color</label>
                        <div class="form-group">
                          <select class="form-control">
                            <option value="0">Creamy</option>
                            <option value="1">Midnight</option>
                            <option value="2">Sky</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-8">
                        <label class="control-label">Quantity</label>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <input type="number" class="form-control" placeholder="1" min="1" max="' . $product['in_stock'] . '">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <a href="#" class="btn btn-primary btn-block">Add to Cart</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>';
  } else {
    echo '<div class="products">
            <div class="container">
              <div class="row">
                <div class="col-md-4 col-xs-12">
                  <div>
                    <img src="assets/images/product-1-370x270.jpg" alt="" class="img-fluid wc-image">
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-4 col-xs-6">
                      <div>
                        <img src="assets/images/product-1-370x270.jpg" alt="" class="img-fluid">
                      </div>
                      <br>
                    </div>
                  </div>
                </div>
                <div class="col-md-8 col-xs-12">
                  <form action="#" method="post" class="form">
                    <h2>Product Not Found</h2>
                  </form>
                </div>
              </div>
            </div>
          </div>';
  }
} else {
  // Your existing code for when id is not set
  echo '<div class="products">...</div>';
}
?>