<?php
function addProduct($id, $user_id, $quantity)
{
      require_once(__DIR__ . '/../database/conn.php');

      if (!preg_match('/^[1-9]\d*$/', $id) || !preg_match('/^[1-9]\d*$/', $user_id) || !preg_match('/^[1-9]\d*$/', $quantity)) {
            $response = array("code" => "400", "message" => "Invalid product ID or quantity");
            return json_encode($response);
      }

      try {


            // Use prepared statements to prevent SQL injection
            $query = "SELECT in_stock, price, discount FROM product WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $productResult = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($productResult["in_stock"] <= 0) {
                  $response = array("code" => "400", "message" => "Out of stock for the product, we are sorry!");
                  return json_encode($response);
            }
            if ($quantity > $productResult["in_stock"]) {
                  $response = array("code" => "400", "message" => "Requested quantity exceeds available stock");
                  return json_encode($response);
            }

            $orderQuery = "SELECT * FROM orders WHERE user_id = :user_id AND paid = 0";
            $orderStmt = $conn->prepare($orderQuery);
            $orderStmt->bindParam(':user_id', $user_id);
            $orderStmt->execute();
            $orderResult = $orderStmt->fetch(PDO::FETCH_ASSOC);

            if (!$orderResult) {
                  $orderInsertQuery = "INSERT INTO orders (user_id, cost, shipment_fee, other_fee, inTotal) VALUES (:user_id, 0, 10, 10, 20)";
                  $orderInsertStmt = $conn->prepare($orderInsertQuery);
                  $orderInsertStmt->bindParam(':user_id', $user_id);
                  $orderInsertStmt->execute();
            }

            $orderQuery = "SELECT * FROM orders WHERE user_id = :user_id AND paid = 0";
            $orderStmt = $conn->prepare($orderQuery);
            $orderStmt->bindParam(':user_id', $user_id);
            $orderStmt->execute();
            $orderResult = $orderStmt->fetch(PDO::FETCH_ASSOC);

            // Update product quantity and order total
            $updateProductQuery = "UPDATE product SET in_stock = in_stock - :quantity WHERE id = :id";
            $updateProductStmt = $conn->prepare($updateProductQuery);
            $updateProductStmt->bindParam(':id', $id);
            $updateProductStmt->bindParam(':quantity', $quantity);
            $updateProductStmt->execute();

            $existProductQuery = "SELECT * FROM `productordermapping` WHERE product_id = :id AND order_id = :order_id";
            $existProductStmt = $conn->prepare($existProductQuery);
            $existProductStmt->bindParam(':id', $id);
            $existProductStmt->bindParam(':order_id', $orderResult["id"]);
            $existProductStmt->execute();
            $existProductResult = $existProductStmt->fetch(PDO::FETCH_ASSOC);
            if ($existProductResult) {

                  $updateProductOrderQuery = "UPDATE `productordermapping` SET quantity = quantity + :quantity WHERE product_id = :id AND order_id = :order_id";
                  $updateProductOrderStmt = $conn->prepare($updateProductOrderQuery);
                  $updateProductOrderStmt->bindParam(':id', $id);
                  $updateProductOrderStmt->bindParam(':order_id', $orderResult["id"]);
                  $updateProductOrderStmt->bindParam(':quantity', $quantity);
                  $updateProductOrderStmt->execute();

            } else {

                  $productOrderQuery = "INSERT INTO `productordermapping` (product_id, order_id, quantity) VALUES (:id,:order_id,:quantity)";
                  $productOrderStmt = $conn->prepare($productOrderQuery);
                  $productOrderStmt->bindParam(':id', $id);
                  $productOrderStmt->bindParam(':order_id', $orderResult["id"]);
                  $productOrderStmt->bindParam(':quantity', $quantity);
                  $productOrderStmt->execute();
            }


            // Calculate the total price after discount
            $totalPrice = $quantity * ($productResult["price"] - ($productResult["price"] * $productResult["discount"] / 100));
            $totalPrice = round($totalPrice, 2);
            // Update the order with the calculated total price
            $updateOrderQuery = "UPDATE orders SET cost = cost + :totalPrice, inTotal = inTotal + :totalPrice WHERE user_id = :user_id AND paid = 0";
            $updateOrderStmt = $conn->prepare($updateOrderQuery);
            $updateOrderStmt->bindParam(':user_id', $user_id);
            $updateOrderStmt->bindParam(':totalPrice', $totalPrice);
            $updateOrderStmt->execute();


            $response = array("code" => "200", "message" => "Product added to order successfully");
            return json_encode($response);
      } catch (PDOException $e) {
            $response = array("code" => "500", "message" => $e->getMessage());
            return json_encode($response);
      }
}
?>