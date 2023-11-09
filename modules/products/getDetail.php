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
            return $result[0];
      } catch (PDOException $e) {
            echo "<script>console.log(FETCHING FAILED. Error: " . $e->getMessage() . "' );</script>";
      }
}
?>