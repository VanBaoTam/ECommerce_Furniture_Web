<?php
function removeProduct($id)
{
      require_once(__DIR__ . '/../database/conn.php');
      try {
            if (!is_numeric($id) || $id <= 0) {
                  $response = array("code" => "400", "message" => "Invalid product ID");
                  return json_encode($response);
            }
            $checkQuery = "SELECT COUNT(*) FROM product WHERE id = :id";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $checkStmt->execute();
            $productCount = $checkStmt->fetchColumn();

            if ($productCount == 0) {
                  $response = array("code" => "404", "message" => "Product not found");
                  return json_encode($response);
            }
            $deleteMappingQuery = "DELETE FROM productordermapping WHERE product_id = :id";
            $deleteMappingStmt = $conn->prepare($deleteMappingQuery);
            $deleteMappingStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $deleteMappingStmt->execute();
            $deleteMappingQuery = "DELETE FROM images WHERE product_id = :id";
            $deleteMappingStmt = $conn->prepare($deleteMappingQuery);
            $deleteMappingStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $deleteMappingStmt->execute();
            $deleteProductrQuery = "DELETE FROM product WHERE id = :id";
            $deleteProductrStmt = $conn->prepare($deleteProductrQuery);
            $deleteProductrStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $deleteProductrStmt->execute();
            $affectedRows = $deleteProductrStmt->rowCount();

            if ($affectedRows > 0) {
                  $response = array("code" => "200", "message" => "Product deleted successfully");
                  return json_encode($response);
            } else {
                  $response = array("code" => "400", "message" => "Product not found");
                  return json_encode($response);
            }
      } catch (PDOException $e) {
            $response = array("code" => "500", "message" => "Error deleting product: " . $e->getMessage());
            return json_encode($response);
      }
}
?>