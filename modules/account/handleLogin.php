<?php
function login($email, $password)
{
      // Validation
      if (!is_string($email) || !is_string($password) || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) < 8 || strlen($email) > 50 || strlen($password) < 8 || strlen($password) > 50) {
            $response = array("code" => "400", "message" => "Invalid email or password");
            return json_encode($response);
      }

      require_once(__DIR__ . '/../database/conn.php');
      try {
            // Use prepared statements to prevent SQL injection
            $query = "SELECT email, password FROM user WHERE email = :email and password = :password";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            // Fetch the result as an associative array
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            unset($stmt, $query);
            if ($user) {
                  $query = "SELECT id, name FROM user WHERE email = :email and password = :password";
                  $stmt = $conn->prepare($query);
                  $stmt->bindParam(':email', $email);
                  $stmt->bindParam(':password', $password);
                  $stmt->execute();
                  $result = $stmt->fetch(PDO::FETCH_ASSOC);
                  $response = array("code" => "200", "message" => "Login successful", "id" => $result["id"], "name" => $result["name"]);
                  return json_encode($response);
            } else {
                  $response = array("code" => "404", "message" => "Account's Credential not found");
                  return json_encode($response);
            }
      } catch (PDOException $e) {
            $response = array("code" => "500", "message" => "Internal Server Error");
            return json_encode($response);
      }
}
if (isset($_POST["email"]) && isset($_POST["password"])) {
      $result = login($_POST["email"], $_POST["password"]);
      $resultArray = json_decode($result);
      if ($resultArray->code === "200") {
            // Create an associative array with 'id' and 'name'
            $responseData = array("id" => $resultArray->id, "name" => $resultArray->name);
            echo json_encode($responseData);
      } else {
            echo "<script> console.log('Login failed'); </script>";
      }
} else {
      $response = array("code" => "400", "message" => "Missing email or password");
      echo json_encode($response);
}

?>