<?php
function updateProduct($data, $images)
{
      require_once(__DIR__ . '/../database/conn.php');
      error_log("Received Data: " . print_r($data, true));

      try {
            $id = $data['id'];
            $productName = (isset($data['productName']) && !empty($data['productName'])) ? $data['productName'] : null;
            $productPrice = (isset($data['productPrice']) && !empty($data['productPrice'])) ? floatval($data['productPrice']) : null;
            $productDiscount = (isset($data['productDiscount']) && !empty($data['productDiscount'])) ? floatval($data['productDiscount']) : null;
            $productStock = (isset($data['productStock']) && isset($data['productStock']) && !empty($data['productStock'])) ? $data['productStock'] : null;

            $productDescription = (!empty($data['description'])) ? $data['description'] : null;

            $checkQuery = "SELECT COUNT(*) FROM product WHERE id = :id";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $checkStmt->execute();
            $productCount = $checkStmt->fetchColumn();

            if ($productCount == 0) {
                  $response = array("code" => "404", "message" => "Product not found");
                  return json_encode($response);
            }

            $setClause = "";
            $updateData = array();

            if (!is_null($productName)) {
                  $setClause .= "name = :productName, ";
                  $updateData['productName'] = $productName;
            }

            if (!is_null($productPrice)) {
                  $setClause .= "price = :productPrice, ";
                  $updateData['productPrice'] = $productPrice;
            }

            if (!is_null($productDiscount)) {
                  $setClause .= "discount = :productDiscount, ";
                  $updateData['productDiscount'] = $productDiscount;
            }

            if (!is_null($productStock)) {
                  $setClause .= "in_stock = :productStock, ";
                  $updateData['productStock'] = $productStock;
            }

            if (!is_null($productDescription)) {
                  $setClause .= "description = :productDescription, ";
                  $updateData['productDescription'] = $productDescription;
            }

            $setClause = rtrim($setClause, ', ');
            $updateQuery = "UPDATE product SET {$setClause} WHERE id = :id";

            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);

            foreach ($updateData as $key => &$value) {
                  $updateStmt->bindParam(":{$key}", $value);
            }

            $updateStmt->execute();

            if (!empty($images['productImages']['name'][0])) {
                  foreach ($images['productImages']['name'] as $key => $imageName) {
                        $imageTmpName = $images['productImages']['tmp_name'][$key];
                        $imageData = file_get_contents($imageTmpName);
                        $imageQuery = "INSERT INTO images (product_id, image) VALUES (:productId, :imageData)
                               ON DUPLICATE KEY UPDATE image = VALUES(image)";
                        $imageStmt = $conn->prepare($imageQuery);
                        $imageStmt->bindParam(':productId', $id, PDO::PARAM_INT);
                        $imageStmt->bindParam(':imageData', $imageData, PDO::PARAM_LOB);
                        $imageStmt->execute();
                  }
            }

            $response = array("code" => "200", "message" => "Product updated successfully");
            return json_encode($response);
      } catch (PDOException $e) {
            $response = array("code" => "500", "message" => "Error: " . $e->getMessage());
            return json_encode($response);
      }
}
?>