<?php
if (isset($_POST["id"]) || isset($_POST["method"]) || isset($_POST["terms"])) {

      require_once("confirmOrder.php");
      $result = confirmOrder($_POST["id"], $_POST["method"]);
      echo $result;
} else {
      $response = array("code" => "400", "message" => "Missing credentials");
      echo json_encode($response);
}


?>