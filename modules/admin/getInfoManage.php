<?php
function GetDetail($id)
{
      require_once(__DIR__ . '/../database/conn.php');
      try {
            $query = "SELECT * FROM product JOIN images ON product.id = images.product_id WHERE product.id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) > 0) {
                  return $result[0];
            } else {
                  return null;
            }
      } catch (PDOException $e) {
            echo '<script>console.log("FETCHING FAILED. Error: Internal Server Error");</script>';
      }
}
?>