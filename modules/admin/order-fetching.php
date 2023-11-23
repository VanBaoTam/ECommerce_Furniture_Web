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
            echo '<div class="card mb-3">';
            echo '<div class="d-flex flex-row justify-content-between md-12" style="padding:1rem">';
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
                            <p class="card-text">' . $value . ' $  </p>
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
      echo '<script>console.log("FETCHING FAILED. Error: Internal Server Error");</script>';
}
?>