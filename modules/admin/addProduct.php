<?php
function addProduct($productName, $productPrice, $productDiscount, $productStock, $productImages, $productDescription)
{
      require_once(__DIR__ . '/../database/conn.php');

      if (
            !preg_match('/^[a-zA-Z0-9\s]{4,30}$/', $productName) ||
            !preg_match('/^\d*\.?\d+$/', $productPrice) ||
            !filter_var($productDiscount, FILTER_VALIDATE_FLOAT, array('options' => array('min_range' => 0, 'max_range' => 100))) ||
            !preg_match('/^\d+$/', $productStock)
      ) {
            $response = array("code" => "400", "message" => "Invalid input data");
            return json_encode($response);
      }

      try {
            $checkQuery = "SELECT COUNT(*) FROM product WHERE name = :name";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bindParam(':name', $productName);
            $checkStmt->execute();
            $productCount = $checkStmt->fetchColumn();

            if ($productCount > 0) {
                  $response = array("code" => "400", "message" => "Product already exists");
                  return json_encode($response);
            }
            $query = "INSERT INTO product (name, price, discount, in_stock, description) VALUES (:name, :price, :discount, :stock, :description)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':name', $productName);
            $stmt->bindParam(':price', $productPrice);
            $stmt->bindParam(':discount', $productDiscount);
            $stmt->bindParam(':stock', $productStock);
            $stmt->bindParam(':description', $productDescription);
            $stmt->execute();

            $checkQuery = "SELECT id FROM product WHERE name = :name";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bindParam(':name', $productName);
            $checkStmt->execute();
            $productId = $checkStmt->fetchColumn();


            if (!empty($productImages['productImages']['name'][0])) {
                  foreach ($productImages['productImages']['name'] as $key => $imageName) {
                        $imageTmpName = $productImages['productImages']['tmp_name'][$key];
                        $imageData = file_get_contents($imageTmpName);
                        $imageQuery = "INSERT INTO images (product_id, image) VALUES (:productId, :imageData)";
                        $imageStmt = $conn->prepare($imageQuery);
                        $imageStmt->bindParam(':productId', $productId, PDO::PARAM_INT);
                        $imageStmt->bindParam(':imageData', $imageData, PDO::PARAM_LOB);
                        $imageStmt->execute();
                  }
            }

            $response = array("code" => "200", "message" => "Product added successfully");
            return json_encode($response);
      } catch (PDOException $e) {
            $response = array("code" => "500", "message" => "Error: Internal Server Error");
            return json_encode($response);
      }
}
?>