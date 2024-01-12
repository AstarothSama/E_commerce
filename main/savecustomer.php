<?php
session_start();
include('../connexion.php');
$username = $_POST['username']; 

$sql = "SELECT COUNT(*) FROM users WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->execute(['username' => $username]);
$count = $stmt->fetchColumn();
if ($count > 0) {
    echo '<script>alert("Sorry, this username is already taken. Please choose another one."); setTimeout(function() { window.location.href = "http://localhost/my%20project/"; }, 0);</script>';


exit();   
} else if ($_POST['password'] != $_POST['Cpassword']) {
    echo '<script>alert("password dase not match"); setTimeout(function() { window.location.href = "http://localhost/my%20project/"; }, 0);</script>';

} else {
      
      $name = $_POST['name'];
      $address = $_POST['address'];
      $contact = $_POST['contact'];
      $email = $_POST['email'];
      $birthdate = $_POST['birthdate'];
      $password = $_POST['password'];
      
      if (empty($username) || empty($name) || empty($address) || empty($contact) || empty($email) || empty($birthdate) || empty($password)) {
        echo "Please fill in all fields.";
        exit;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Display an error message if the email address is invalid
        echo "Invalid email address.";
        exit;
    }

      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
     
      $sql = "INSERT INTO users (Username, Name, Adress, Contact, Email, Birthdate, Password) VALUES (:username, :name, :address, :contact, :email, :birthdate, :password)";
      $stmt = $pdo->prepare($sql);
      
      $result = $stmt->execute([
          ':username' => $username,
          ':name' => $name,
          ':address' => $address,
          ':contact' => $contact,
          ':email' => $email,
          ':birthdate' => date('Y-m-d', strtotime($birthdate)), 
          ':password' => $hashed_password
      ]);
      
      if (!$result) {
          echo "An error occurred while inserting data into the database.";
          exit;
      }
      
      header("location: dashboard.php");
}
?>
