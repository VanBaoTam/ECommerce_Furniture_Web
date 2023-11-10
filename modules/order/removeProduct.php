<?php
function removeProduct($userId, $productId)
{
      require_once(__DIR__ . '/../database/conn.php');

      if (!preg_match('/^[1-9]\d*$/', $userId) || !preg_match('/^[1-9]\d*$/', $productId)) {
            $response = array("code" => "400", "message" => "Invalid credentials");
            return json_encode($response);
      }

      try {
            $orderQuery = "SELECT id FROM orders WHERE user_id = :user_id AND paid = 0";
            $orderStmt = $conn->prepare($orderQuery);
            $orderStmt->bindParam(':user_id', $userId);
            $orderStmt->execute();
            $orderResult = $orderStmt->fetch(PDO::FETCH_ASSOC);

            if (!$orderResult) {
                  $response = array("code" => "404", "message" => "Order not found");
                  return json_encode($response);
            }

            $quantityQuery = "SELECT productordermapping.quantity, product.price, product.discount FROM productordermapping JOIN product ON productordermapping.product_id = product.id WHERE order_id = :order_id AND product_id = :product_id";
            $quantityStmt = $conn->prepare($quantityQuery); // Corrected variable name
            $quantityStmt->bindParam(':order_id', $orderResult['id']);
            $quantityStmt->bindParam(':product_id', $productId);
            $quantityStmt->execute();
            $quantityResult = $quantityStmt->fetch(PDO::FETCH_ASSOC);

            $deleteQuery = "DELETE FROM productordermapping WHERE order_id = :order_id AND product_id = :product_id";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bindParam(':order_id', $orderResult['id']);
            $deleteStmt->bindParam(':product_id', $productId);
            $deleteStmt->execute();

            $updateProductQuery = "UPDATE product SET in_stock = in_stock + :quantity WHERE id = :id";
            $updateProductStmt = $conn->prepare($updateProductQuery);
            $updateProductStmt->bindParam(':id', $productId);
            $updateProductStmt->bindParam(':quantity', $quantityResult['quantity']);
            $updateProductStmt->execute();

            $totalPrice = $quantityResult['quantity'] * ($quantityResult['price'] - ($quantityResult['price'] * $quantityResult['discount'] / 100));
            $totalPrice = round($totalPrice, 2);

            $updateOrderQuery = "UPDATE orders SET cost = cost - :totalPrice, inTotal = inTotal - :totalPrice WHERE id = :order_id";
            $updateOrderStmt = $conn->prepare($updateOrderQuery);
            $updateOrderStmt->bindParam(':order_id', $orderResult['id']);
            $updateOrderStmt->bindParam(':totalPrice', $totalPrice);
            $updateOrderStmt->execute();

            $response = array("code" => "200", "message" => "Product removed successfully");
            return json_encode($response);

      } catch (PDOException $e) {
            $response = array("code" => "500", "message" => "Internal Server Error");
            return json_encode($response);
      }
}
?>