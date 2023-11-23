<?php
if (isset($_GET["id"])) {
  require_once(__DIR__ . '/../products/getDetail.php');
  $result = getDetail($_GET["id"]);
  if (!empty($result)) {
    $product = $result[0];
    $images = array_slice($result, 1);

    echo '<div class="products" style="margin-top:50px">
                <div class="container"> 
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div>
                                <img src="data:image/jpeg;base64,' . base64_encode($product['image']) . '" alt="" class="img-fluid wc-image">
                            </div>
                            <br>';
    echo '<div class="d-flex flex-row align-items-center">';
    foreach ($images as $subImage) {
      echo '<div class="col-md-4 col-xs-12">
                    <div>
                        <img src="data:image/jpeg;base64,' . base64_encode($subImage['image']) . '" alt="" class="img-fluid wc-image">
                    </div>
                    <br>
                </div>';
    }
    echo '</div></div>
     <div class="col-md-8 col-xs-12">';
    if ($product['in_stock'] <= 0) {
      echo '
                      <form action="" id="order-form"  class="form" method="POST" onsubmit="return handleSubmit(event);">
                      <input type="hidden" name="id"  id="idInput" />
                      <input type="hidden" name="userId"  id="userIdInput" />
                        <h2>' . $product['name'] . '</h2>
                        <br>
                        <p class="lead">
                          <small><del>$' . $product['price'] . '</del></small><strong class="text-primary">$' . ($product['price'] - ($product['discount'] * $product['price'] / 100)) . '</strong>
                          <span class="text-muted">In Stock: OUT OF STOCK</span>
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
                                  <input type="number" name = "quantity" class="form-control" disabled placeholder="0" value="0" min="0" max="0">
                                </div>
                              </div>
                              <div class="col-sm-6">
                              <button class="btn btn-primary" type="submit" disabled>Add to Cart</button>
                              </div>
                              <div class="col-sm-8">
                              <div id="order-response"></div>
                              </div>
                             
                            </div>
                          </div>
                        </div>
                      </form>';
    } else {
      echo '   <form action="" id="order-form"  class="form" method="POST" onsubmit="return handleSubmit(event);">
                    <input type="hidden" name="id"  id="idInput" />
                    <input type="hidden" name="userId"  id="userIdInput" />
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
                            <button class="btn btn-primary" type="submit">Add to Cart</button>
                            </div>
                            <div class="col-sm-8">
                            <div id="order-response"></div>
                            </div>
                           
                          </div>
                        </div>
                      </div>
                    </form>';
      echo '
                    </div>
                </div>
            </div>
        </div>';
    }
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
                            <a href="product-management.php" style="font-size:30px">Go back</a>
                        </div>
                    </div>
                </div>
            </div>';
  }
} else {
  echo '<script> window.location.href = "product-management.php";</script>';
}
?>