<?php
function confirmOrder($id, $method)
{
      require_once(__DIR__ . '/../database/conn.php');

      if (!preg_match('/^[1-9]\d*$/', $id) || !preg_match('/^(COD|VISA|Paypal)$/', $method)) {
            $response = array("code" => "400", "message" => "Invalid credentials");
            return json_encode($response);
      }

      try {
            $orderQuery = "SELECT id FROM orders WHERE user_id = :user_id AND paid = 0";
            $orderStmt = $conn->prepare($orderQuery);
            $orderStmt->bindParam(':user_id', $id);
            $orderStmt->execute();
            $orderResult = $orderStmt->fetch(PDO::FETCH_ASSOC);

            if (!$orderResult) {
                  $response = array("code" => "400", "message" => "No unpaid orders found for the user");
                  return json_encode($response);
            }

            $orderId = $orderResult['id'];

            $query = "UPDATE orders SET paid = 1, payment_method=:method";
            if (isset($_POST["alter-phone"])) {
                  $query .= ", alter_phone_number = :phone";
            }

            if (isset($_POST["alter-address"])) {
                  $query .= ", alter_address = :address";
            }

            if (isset($_POST["alter-postal"])) {
                  $query .= ", alter_zip_postal = :postal";
            }

            $query .= " WHERE id = :order_id";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':order_id', $orderId);
            $stmt->bindParam(':method', $method);
            if (isset($_POST["alter-phone"])) {
                  $stmt->bindParam(':phone', $_POST["alter-phone"]);
            }

            if (isset($_POST["alter-address"])) {
                  $stmt->bindParam(':address', $_POST["alter-address"]);
            }

            if (isset($_POST["alter-postal"])) {
                  $stmt->bindParam(':postal', $_POST["alter-postal"]);
            }

            $stmt->execute();

            $response = array("code" => "200", "message" => "Confirmed the order");
            return json_encode($response);

      } catch (PDOException $e) {
            $response = array("code" => "500", "message" => "Error: Internal Server Error");
            return json_encode($response);
      }
}
?>