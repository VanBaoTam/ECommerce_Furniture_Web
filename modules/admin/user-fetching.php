<?php
require_once(__DIR__ . '/../database/conn.php');

try {
      $query = "SELECT * FROM user WHERE status ='activated'";
      $stmt = $conn->query($query);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $admin = array();
      $buyer = array();
      foreach ($result as $value) {
            if ($value["role"] === "1") {
                  $admin[] = $value;
            } else {
                  $buyer[] = $value;
            }
      }
      echo "<div class='container'>";
      echo "<div class='row'>";
      echo "<div class='col-md-12'>";
      echo '<div id="remove-response"></div>';
      echo "<h3> ADMIN </h3>";
      foreach ($admin as $user) {
            echo '<div class="card mb-3">';
            echo '<div class="d-flex flex-row justify-content-between md-12" style="padding:1rem">';
            foreach ($user as $key => $value) {
                  if ($key === "id" || $key === "name" || $key === "email" || $key === "phone_number") {
                        echo '
                    <div class="mb-2" style="width: 200px;">
                        <h6 class="card-title">' . ucwords(str_replace('_', ' ', $key)) . '</h6>
                        <p class="card-text">' . $value . '</p>
                    </div>
                ';
                  }
            }
            echo ' <div class="mb-2" style="width: 200px;">
                <button class="btn btn-secondary" style="float:right;margin-right:5rem" onClick="handleSubmit(' . $user["id"] . ')" id="deleteBtn">DELETE</button>
            </div>';
            echo '</div>';
            echo '</div>';
      }
      echo "</div>";
      echo "</div>";

      echo "<div class='row'>";
      echo "<div class='col-md-12'>";
      echo "<h3> BUYER </h3>";
      foreach ($buyer as $user) {
            echo '<div class="card mb-3">';
            echo '<div class=" d-flex flex-row justify-content-between md-12" style="padding:1rem">';
            foreach ($user as $key => $value) {
                  if ($key === "id" || $key === "name" || $key === "email" || $key === "phone_number") {
                        echo '
                    <div class="mb-2" style="width: 200px;">
                        <h6 class="card-title">' . ucwords(str_replace('_', ' ', $key)) . '</h6>
                        <p class="card-text">' . $value . '</p>
                    </div>
                ';
                  }
            }

            echo ' <div class="mb-2" style="width: 200px;">
                <button class="btn btn-secondary" style="float:right;margin-right:5rem" onClick="handleSubmit(' . $user["id"] . ')" id="deleteBtn">DELETE</button>
            </div>';
            echo '</div>';
            echo '</div>';
      }
      echo "</div>";
      echo "</div>";
      echo "</div>";
} catch (PDOException $e) {
      echo "<script>console.log('[$timestamp]: FETCHING FAILED. Error: " . $e->getMessage() . "') );</script>";
}
?>