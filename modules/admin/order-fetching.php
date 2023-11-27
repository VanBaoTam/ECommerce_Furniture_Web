<?php
require_once(__DIR__ . '/../database/conn.php');

try {
      $query = "SELECT id,user_id as userId,inTotal as total, paid FROM orders";
      $stmt = $conn->query($query);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      echo "<div class='container'>";
      echo "<div class='row'>";
      echo "<div class='col-md-12'>";
      echo "<h3> ORDERS </h3>";
      foreach ($result as $order) {

            $query = "SELECT count(product_id) as total FROM php_excercise.productordermapping where order_id = :id";
            $totalstmt = $conn->prepare($query);
            $totalstmt->bindParam(':id', $order["id"]);
            $totalstmt->execute();
            $totalResult = $totalstmt->fetch(PDO::FETCH_ASSOC);
            echo '<div class="card mb-3">';
            echo '<div class="d-flex flex-row justify-content-between md-12" style="padding:1rem">';

            $order["total"] = $totalResult["total"];
            foreach ($order as $key => $value) {
                  if ($key === "paid") {
                        if ($value === "1") {
                              echo '
                        <div class="mb-2" style="width: 200px;">
                            <h6 class="card-title">' . ucwords(str_replace('_', ' ', $key)) . '</h6>
                            <p class="card-text"> PAID </p>
                        </div>
                    ';
                        } else {
                              echo '
                        <div class="mb-2" style="width: 200px;">
                            <h6 class="card-title">' . ucwords(str_replace('_', ' ', $key)) . '</h6>
                            <p class="card-text"> UNPAID  </p>
                        </div>
                    ';
                        }
                  } else if ($key === "total") {
                        echo '
                        <div class="mb-2" style="width: 200px;">
                            <h6 class="card-title">' . ucwords(str_replace('_', ' ', $key)) . '</h6>
                            <p class="card-text">' . $value . ' products </p>
                        </div>
                    ';
                  } else
                        echo '
                  <div class="mb-2" style="width: 200px;">
                      <h6 class="card-title">' . ucwords(str_replace('_', ' ', $key)) . '</h6>
                      <p class="card-text">' . $value . ' </p>
                  </div>
              ';

            }
            echo ' <div class="mb-2" style="width: 200px;">
           <a href="orders-manage.php?id=' . $order["id"] . '"><button> Manage</button></a>
        </div>';
            echo '</div>';
            echo '</div>';
      }
      echo "</div>";
      echo "</div>";
      echo "</div>";


} catch (PDOException $e) {
      echo $e->getMessage();
}
?>