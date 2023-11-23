<?php
require_once(__DIR__ . '/../database/conn.php');

try {
  $query = "SELECT 
                product.id, 
                product.name, 
                product.price, 
                product.discount, 
                product.in_stock, 
                product.description, 
                MIN(images.image) AS image
            FROM 
                product
            LEFT JOIN 
                images ON product.id = images.product_id
            GROUP BY 
                product.id";

  $stmt = $conn->query($query);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($result as $ele) {
    $imageData = base64_encode($ele['image']);
    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
    $discount = $ele['price'] - ($ele['discount'] * $ele['price'] / 100);

    echo '<div class="col-md-4">
        <div class="product-item">
          <a href="product-details.php?id=' . $ele['id'] . '"><img src="' . $imageSrc . '" alt=""></a>
          <div class="down-content">
            <a href="product-details.php?id=' . $ele['id'] . '">
              <h4>' . $ele['name'] . '</h4>
            </a>
            <h6><small><del>$' . $ele['price'] . '</del></small> $' . $discount . '</h6>
            <p>' . $ele['description'] . '</p>
          </div>
        </div>
      </div>';
  }

} catch (PDOException $e) {
  echo '<script>console.log("FETCHING FAILED. Error: Internal Server Error");</script>';
}
?>