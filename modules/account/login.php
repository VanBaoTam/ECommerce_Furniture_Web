<?php

function login($email, $password)
{
      // Validation
      if (!preg_match('/^(?=.{8,50}$)[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/', $email)) {
            $response = array("code" => "400", "message" => "Invalid email or password");
            return json_encode($response);
      }

      if (!preg_match('/^.{8,50}$/', $password)) {
            $response = array("code" => "400", "message" => "Invalid email or password");
            return json_encode($response);
      }

      require_once(__DIR__ . '/../database/conn.php');
      try {
            // Use prepared statements to prevent SQL injection
            $query = "SELECT id, name FROM user WHERE email = :email and password = :password";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            unset($stmt, $query);
            if ($result) {
                  $response = array("code" => "200", "message" => "Login successfully", "id" => $result["id"], "name" => $result["name"]);
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

?>