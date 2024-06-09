<?php

    //We can access session variables from one page to another.
    // $expire = time() + 60 * 60 * 24 * 30; 
    // setcookie("id", "1234", $expire);

    // echo $_COOKIE['id']; 
    // echo md5(md5($row['id'])."password");

    session_start();

    $hostName = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "practice_db";

    $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
    if (!$conn) {
    die("Something went wrong;");
    }

    $error = ""; // Initialize error variable

    if (isset($_POST['submit'])) {
    $result = "";

    // Validate email
    if (!isset($_POST["email"]) || empty($_POST["email"])) {
        $error .= "<br/> Please enter an email";
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error .= "<br/> Please enter a valid email";
    }

    // Validate name
    if (!isset($_POST["name"]) || empty($_POST["name"])) {
        $error .= "<br/> Please enter your name";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $_POST["name"])) {
        $error .= "<br/> Please enter a valid name (letters and spaces only)";
    }

    // (Optional) Validate number (uncomment if needed)
    /*
    if (!isset($_POST["number"]) || empty($_POST["number"])) {
        $error .= "<br/> Please enter a number";
    } else if (!is_int($_POST["number"])) {
        $error .= "<br/> Please enter a valid integer";
    }
    */

    // Validate password
    if (!isset($_POST['password']) || empty($_POST["password"])) {
        $error .= "<br/> Please enter a password";
    } else if (!isset($_POST['confirm_password']) || empty($_POST["confirm_password"])) {
        $error .= "<br/> Please confirm your password";
    } else if ($_POST["password"] != $_POST["confirm_password"]) {
        $error .= "<br/> Please Enter Matching Passwords";
    } else if (strlen($_POST["password"]) < 6) {
        $error .= "<br/> Password must be at least 6 characters";
    } else {
        if (!preg_match('`[A-Z]`', $_POST['password'])) {
        $error .= "<br/> Password must contain at least one uppercase letter";
        }
        if (!preg_match('`[0-9]`', $_POST['password'])) {
        $error .= "<br/> Password must contain at least one number";
        }
    }

    // Check for errors and display message if any
    if ($error) {
        $result = "<div class='alert alert-danger'>There were error(s) in the form: $error</div>";
        echo $result;
    } else {
        // No errors, proceed with form submission logic (if any)

        // **Example (check for existing email):**
        $name= mysqli_real_escape_string($conn, $_POST["name"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password= md5(md5($_POST['email']).$_POST['password']);
        $query = "SELECT * FROM `users` WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $results = mysqli_num_rows($result);

        if ($results) echo "Email already Exists!";

        else {
            $query="INSERT INTO `users` (`name`,`email`,`password`) VALUES ('$name','$email','$password')";
            $result = mysqli_query($conn,$query);

            if($result){
                $result= "Form Submitted Successfully!";
                echo $result;
                $_SESSION['id']= mysqli_insert_id($conn);
                header("Location: login2.php");
            } else{
                echo "Error inserting user data: ".mysqli_error($conn);
            }
        }
    }
    }

    mysqli_close($conn);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Form</title>
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
  <form action="login.php" method="post">
    <div>
      <label for="email">Email</label>
      <input type="email" name="email" id="email">
    </div>
    <div>
      <label for="name">Name</label>
      <input type="text" name="name" id="name">
    </div>
    <div>
      <label for="password">Password</label>
      <input type="password" name="password" id="password">
    </div>
    <div>
      <label for="password">Confirm Password</label>
      <input type="password" name="confirm_password" id="confirm_password">
    </div>
    <div>
      <input type="submit" value="Register" name="submit">
    </div>
  </form>
</body>
</html>
