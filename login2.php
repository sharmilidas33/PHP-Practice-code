<?php
session_start();

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "practice_db";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
  die("Something went wrong;");
}

if (isset($_POST['submit']) && $_POST['submit'] == "Login") {

  $name = mysqli_real_escape_string($conn, $_POST['login_name']);
  $email = mysqli_real_escape_string($conn, $_POST['login_email']);
  $password = md5(md5($_POST['login_email']) . $_POST['login_password']); 

  $query = "SELECT * FROM `users` WHERE email='$email' AND name='$name' AND password='$password'";
  $results = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($results);

  
  if ($row) {
    $_SESSION['id'] = $row['id'];
    echo "Login Successful";

  } else {
    echo "Invalid Login Credentials!";
  }

} 

mysqli_close($conn); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0; 
      padding: 20px; 
    }

    form {
      width: 300px; 
      border: 1px solid #ccc; 
      padding: 40px; 
      border-radius: 5px; 
    }

    label {
      display: block; 
      margin-bottom: 5px; 
    }

    input[type="text"],
    input[type="password"] {
      width: 100%; 
      padding: 10px; 
      border: 1px solid #ccc; 
      border-radius: 3px; 
    }

    input[type="submit"] {
      background-color: #4CAF50; 
      color: white; 
      padding: 10px 20px;
      border: none; 
      border-radius: 5px; 
      cursor: pointer; 
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <form action="login2.php" method="post">
    <div>
      <label for="email">Email</label>
      <input type="email" name="login_email" id="login_email">
    </div>
    <div>
      <label for="name">Name</label>
      <input type="text" name="login_name" id="login_name">
    </div>
    <div>
      <label for="password">Password</label>
      <input type="password" name="login_password" id="login_password">
    </div>
    <div>
      <input type="submit" value="Login" name="submit">
    </div>
  </form>
</body>
</html>
