<?php
function removeOrder($id)
{
      require_once(__DIR__ . '/../database/conn.php');
      try {
            if (!is_numeric($id) || $id <= 0) {
                  $response = array("code" => "400", "message" => "Invalid order ID");
                  return json_encode($response);
            }
            $checkQuery = "SELECT COUNT(*) FROM orders WHERE id = :id";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $checkStmt->execute();
            $orderCount = $checkStmt->fetchColumn();

            if ($orderCount == 0) {
                  $response = array("code" => "404", "message" => "Order not found");
                  return json_encode($response);
            }
            $deleteMappingQuery = "DELETE FROM productordermapping WHERE order_id = :id";
            $deleteMappingStmt = $conn->prepare($deleteMappingQuery);
            $deleteMappingStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $deleteMappingStmt->execute();
            $deleteOrderQuery = "DELETE FROM orders WHERE id = :id";
            $deleteOrderStmt = $conn->prepare($deleteOrderQuery);
            $deleteOrderStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $deleteOrderStmt->execute();
            $affectedRows = $deleteOrderStmt->rowCount();

            if ($affectedRows > 0) {
                  $response = array("code" => "200", "message" => "Order deleted successfully");
                  return json_encode($response);
            } else {
                  $response = array("code" => "400", "message" => "Order not found");
                  return json_encode($response);
            }
      } catch (PDOException $e) {
            $response = array("code" => "500", "message" => "Error: Internal Server Error");
            return json_encode($response);
      }
}
?>