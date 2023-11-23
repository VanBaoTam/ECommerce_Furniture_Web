<?php

function SignUp($email, $password, $name, $birthday, $phone, $postal, $address)
{
      require_once(__DIR__ . '/../database/conn.php');


      if (
            !preg_match('/^(?=.{8,50}$)[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/', $email) ||
            !preg_match('/^.{8,50}$/', $password) ||
            !preg_match('/^.{6,30}$/', $name) ||
            strlen($birthday) === 0 ||
            !preg_match('/^0\d{9}$/', $phone) ||
            strlen($address) <= 10 ||
            !preg_match('/^\d{5}$/', $postal) ||
            !isOver18($birthday)
      ) {
            $response = array("code" => "400", "message" => "Invalid Credentials");
            return json_encode($response);
      }

      try {
            $query = "SELECT * FROM user WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                  $response = array("code" => "400", "message" => "Email already exists");
                  return json_encode($response);
            }
            $query = "SELECT * FROM user WHERE phone_number = :phone";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':phone', $phone);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                  $response = array("code" => "400", "message" => "Phone number already exists");
                  return json_encode($response);
            }


            $query = "INSERT INTO user (email, password, name, date_of_birth, phone_number, zip_postal, address) VALUES (:email, :password, :name, :date_of_birth, :phone_number, :zip_postal, :address)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':date_of_birth', $birthday);
            $stmt->bindParam(':phone_number', $phone);
            $stmt->bindParam(':zip_postal', $postal);
            $stmt->bindParam(':address', $address);
            $stmt->execute();

            $response = array("code" => "200", "message" => "Signup successfully");
            return json_encode($response);

      } catch (PDOException $e) {
            $response = array("code" => "500", "message" => "Error: Internal Server Error");
            return json_encode($response);
      }
}

function isOver18($birthday)
{
      $today = new DateTime();
      $birthdate = new DateTime($birthday);
      $age = $today->diff($birthdate)->y;
      return $age >= 18;
}

?>