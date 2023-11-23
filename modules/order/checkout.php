<?php

function fetchingCart($id, $name)
{
      require_once(__DIR__ . '/../database/conn.php');

      if (!preg_match('/^[1-9]\d*$/', $id) || !preg_match('/^.{6,30}$/', $name)) {
            $response = array("code" => "400", "message" => "Invalid Credentials");
            return json_encode($response);
      }
      try {

            $query = "SELECT id, name FROM user WHERE id = :id and name = :name and status ='activated'";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                  $response = array("code" => "404", "message" => "User not exist");
                  return json_encode($response);
            }

            $orderQuery = "SELECT product.id as productId, cost, inTotal, shipment_fee, other_fee, product.name,product.price, product.discount, productordermapping.quantity  
            FROM orders 
            JOIN productordermapping ON orders.id = productordermapping.order_id 
            JOIN user ON user.id = orders.user_id
            JOIN product ON productordermapping.product_id = product.id
            WHERE orders.user_id = :id AND paid = 0";

            $orderStmt = $conn->prepare($orderQuery);
            $orderStmt->bindParam(':id', $id);
            $orderStmt->execute();
            $result = $orderStmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($result);


      } catch (PDOException $e) {
            $response = array("code" => "500", "message" => "Error: Internal Server Error");
            return json_encode($response);
      }

}

?>