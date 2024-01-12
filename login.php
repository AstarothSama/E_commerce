<?php
	
    session_start();
    // Array to store validation errors
    $errmsg_arr = array();
    
    // Validation error flag
    $errflag = false;
    
    include("connexion.php");
    
    // Sanitize the POST values
    $login = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
   
    
    if ($login == '') {
        $errmsg_arr[] = 'Username missing';
        $errflag = true;
    }
    if ($password == '') {
        $errmsg_arr[] = 'Password missing';
        $errflag = true;
    }
    
    // If there are input validations, redirect back to the login form
    if ($errflag) {
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        session_write_close();
        header("location: index.php");
        exit();
    }
    
$stmt = $pdo->prepare("SELECT * FROM users WHERE Username=:login");
$stmt->bindParam(':login', $login);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if ($user) {
    if (isset($user['Password']) && password_verify($password, $user['Password'])) {
        session_regenerate_id();

        $_SESSION['SESS_MEMBER_ID'] = $user['Username'];
        $_SESSION['SESS_NAME'] = $user['Name'];

        session_write_close();
        header("location: main/dashboard.php");
    } else {
        
        $errmsg_arr[] = 'Incorrect password';
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        session_write_close();
        header("location: index.php");
        exit();
    }
} else {
   
    $errmsg_arr[] = 'Username not found';
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: index.php");
    exit();
}

?>
