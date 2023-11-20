a
<?php
if (isset($_GET["id"])) {
  require_once(__DIR__ . '/../products/getDetail.php');
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
                  
                </div>

                <div class="col-md-8 col-xs-12">
                  <form action="" id="order-form"  class="form" method="POST" onsubmit="return handleSubmit(event);">
                  <input type="hidden" name="id"  id="idInput" />
                  <input type="hidden" name="userId"  id="userIdInput" />
                  <label>Name</label><br/>
                    <input type="text"  placeholder="' . $product['name'] . '"></input><br/>
                    <br>
                    <label>Price</label><br/>
                      <input type="number" min="0" placeholder="' . $product['price'] . '"</input> <br/><br/>
                      <label>Discount</label><br/>
                      <input type="number" min="0" placeholder="' . $product['discount'] . '"</input><br/><br/>
                      <label>Stock</label><br/>
                      <input type="number" min="0" placeholder="' . $product['in_stock'] . '"</input> 
                    <br><br/>
                    <textarea name="description" placeholder="' . $product['description'] . '" rows="6" class="form-control" id="description" 
                    required=""></textarea>
                   
                    <br>
                    <div>
                      <div>
                        <div>
                          <div class="col-md-12">
                          <button class="btn btn-primary" type="submit"style="margin-left:2rem" >Apply</button>
                          <button class="btn btn-secondary" type="submit" style="margin-left:28rem">Delete</button>
                          </div>
                          <div class="col-sm-8">
                          <div id="manage-response"></div>
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