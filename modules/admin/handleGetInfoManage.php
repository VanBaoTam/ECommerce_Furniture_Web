<?php
if (isset($_GET["id"])) {
  require_once(__DIR__ . '/../products/getDetail.php');
  $result = getDetail($_GET["id"]);
  if (!empty($result)) {
    $product = $result[0];
    $images = array_slice($result, 1); // Extracting images from the result

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
    echo '</div>';

    echo '</div>
                    <div class="col-md-8 col-xs-12">
                        <form action="" id="order-form"  class="form" method="POST" enctype="multipart/form-data" onsubmit="return handleSubmit(event);">
                            <input type="hidden" name="id"  id="idInput" />
                            <label>Name</label><br/>
                            <input type="text" name="productName"  placeholder="' . $product['name'] . '"></input><br/>
                            <br>
                            <label>Price</label><br/>
                            <input type="number" name="productPrice" min="0" placeholder="' . $product['price'] . '"></input> <br/><br/>
                            <label>Discount</label><br/>
                            <input type="number" min="0" max="100" name="productDiscount" placeholder="' . $product['discount'] . '"></input><br/><br/>
                            <label>Stock</label><br/>
                            <input type="number" name="productStock" min="0" placeholder="' . $product['in_stock'] . '"></input> 
                            <br/><br/>
                            <label for="productImages">Product Images</label><br/>
                            <input type="file" name="productImages[]" id="productImages" accept="image/*" multiple /><br><br/>
                            <textarea name="description" name="productDescription" placeholder="' . $product['description'] . '" rows="6" class="form-control" id="description" 
                            ></textarea>

                            <br>
                            <div>
                                <div>
                                    <div>
                                        <div class="col-md-12">
                                            <div style="margin-left:10rem;" id="adjust-response"></div>
                                            <div style="margin-left:10rem;" id="remove-response"></div>
                                            <button class="btn btn-primary" type="submit" style="margin-left:2rem">Apply</button>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="manage-response"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <button class="btn btn-secondary" type="button" style="margin-left:3rem; margin-top:1rem;" onClick="handleSubmitDelete(event)" id="deleteBtn">DELETE</button>
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