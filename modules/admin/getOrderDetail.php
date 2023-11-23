<?php
function getOrderDetail($id)
{
      require_once(__DIR__ . '/../database/conn.php');
      try {
            $query = "SELECT cost, payment_method as paymentMethod, shipment_fee as shipmentFee, other_fee as otherFee, alter_phone_number as alterPhoneNumber, alter_address asalterAddress, alter_zip_postal as alterZipPostal, inTotal, paid FROM orders where id = :id";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                  return $result[0];
            } else {
                  return null;
            }
      } catch (PDOException $e) {
            echo '<script>console.log("FETCHING FAILED. Error: Internal Server Error");</script>';
      }
}
?>