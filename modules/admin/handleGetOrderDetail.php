<?php

if (isset($_GET["id"])) {
  require_once("getOrderDetail.php");
  $result = getOrderDetail($_GET["id"]);

  if ($result) {
    echo '<table class="table table-bordered">';
    foreach ($result as $key => $value) {
      if (!$value && $key !== "paid") {
        continue;
      }

      $formattedKey = formatKey($key);

      switch ($formattedKey) {
        case "Cost":
        case "In Total":
        case "Shipment Fee":
        case "Other Fee":
          echo '<tr>';
          echo '<td>' . $formattedKey . '</td>';
          echo '<td>' . $value . ' $ </td>';
          echo '</tr>';
          break;

        case "Paid":
          $status = ($value === "1") ? "PAID" : "UNPAID";
          echo '<tr>';
          echo '<td>' . $formattedKey . '</td>';
          echo '<td>' . $status . '</td>';
          echo '</tr>';
          break;

        default:
          echo '<tr>';
          echo '<td>' . $formattedKey . '</td>';
          echo '<td>' . $value . '</td>';
          echo '</tr>';
          break;
      }
    }
    echo '</table>';
    echo '<div style="margin-left:10rem;" id="remove-response">
    </div>';
    echo '<td><button class="btn btn-secondary" style="float:right;margin-right:5rem" onClick="handleSubmit(event)" id="deleteBtn">DELETE</button></td>';

    ;
  } else {
    echo '<div class="products">
            <div class="container">
              <div class="row">
                <div class="col-md-4 col-xs-12">
                  <br>
                  <div class="row">
                    <div class="col-sm-4 col-xs-6">
                      <br>
                    </div>
                  </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <h2>Orders Not Found</h2>
                  <br>
                  <a href="order-management.php" style="font-size:30px">Go back</a>
                </div>
              </div>
            </div>
          </div>';
  }
}
function formatKey($key)
{
  $splitKey = preg_split('/(?=[A-Z])/', $key, -1, PREG_SPLIT_NO_EMPTY);
  $formattedKey = array_map('ucfirst', $splitKey);
  return implode(" ", $formattedKey);
}

?>