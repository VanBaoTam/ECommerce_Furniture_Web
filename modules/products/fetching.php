<?php
require_once(__DIR__ . '/../database/conn.php');

try {
  $query = "SELECT * FROM product JOIN images ON product.id = images.product_id";
  $stmt = $conn->query($query);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $ele) {
    $imageData = base64_encode($ele['image']);
    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
    $discount = $ele["discount"] * $ele["price"] / 100;
    echo '<div class="col-md-4">
        <div class="product-item">
          <a href="product-details.php"><img src="' . $imageSrc . '" alt=""></a>
          <div class="down-content">
            <a href="product-details.php">
              <h4>' . $ele['name'] . '</h4>
            </a>
            <h6><small><del>$' . $ele['price'] . '</del></small> $' . $discount . '</h6>
            <p>' . $ele['description'] . '</p>
          </div>
        </div>
      </div>';
  }

} catch (PDOException $e) {
  echo "<script>console.log('[$timestamp]: DB CONNECTION FAILED. Error: " . $e->getMessage() . "' );</script>";
}
?>