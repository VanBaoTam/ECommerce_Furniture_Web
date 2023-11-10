<?php
if (isset($_POST["userId"]) && isset($_POST["productId"])) {

      require_once("removeProduct.php");
      $result = removeProduct($_POST["userId"], $_POST["productId"]);
      echo $result;
} else {
      $response = array("code" => "400", "message" => "Missing credentials");
      echo json_encode($response);
}
?>