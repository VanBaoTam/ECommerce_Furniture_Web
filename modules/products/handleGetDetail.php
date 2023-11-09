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
                  <form action="./modules/order/handleAddProduct.php" id="order-form"  class="form" method="POST">
                  <input type="hidden" name="id" value="1" id="idInput" />
                  <input type="hidden" name="userId" value="1" id="nameInput" />
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
                      <div class="col-sm-8">
                        <label class="control-label">Quantity</label>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <input type="number" name = "quantity" class="form-control" placeholder="1" value="1" min="1" max="' . $product['in_stock'] . '">
                            </div>
                          </div>
                          <div class="col-sm-6">
                          <div id="order-response"></div>
                          <button class="btn btn-primary" type="submit">Add to Cart</button>
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
                  <br>
                  <div class="row">
                    <div class="col-sm-4 col-xs-6">
                      <br>
                    </div>
                  </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <h2>Product Not Found</h2>
                  <br>
                  <a href="products.php" style="font-size:30px">Go back</a>
                </div>
              </div>
            </div>
          </div>';
  }
} else {
  echo '<script> window.location.href = "products.php";</script>';
}
?>