<?php
if (
      isset($_POST["productName"]) &&
      isset($_POST["productPrice"]) &&
      isset($_POST["productDiscount"]) &&
      isset($_POST["productStock"]) &&
      isset($_FILES) &&
      isset($_POST["description"])
) {
      require_once("addProduct.php");
      $result = addProduct(
            $_POST["productName"],
            $_POST["productPrice"],
            $_POST["productDiscount"],
            $_POST["productStock"],
            $_FILES,
            $_POST["description"]
      );
      echo $result;
} else {
      $response = array("code" => "400", "message" => "Missing credentials");
      echo json_encode($response);
}
?>