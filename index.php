<?php
//Session variables are variables which is stored as long as the user is connected to the website and has the page active on their browser.
session_start();

    $_SESSION['loginid']=1;
    echo $_SESSION['loginid'];
    
    if(isset($_POST["submit"])){
        $result="<div class='alert alert-success'>Form Submitted</div>";
        $error="";

        if(!$_POST["name"]){
            $error="<br/> Please enter your name.";
        }

        if(!$_POST["email"]){
            $error.="<br/> Please enter your email address.";
        }

        if(!$_POST["comment"]){
            $error.="<br/> Please enter a comment.";
        }

        if ($_POST['email']!="" AND !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) { 
            $error.="<br/> Please enter a valid email address.";
        } 

        if($error){
            $result="<div class='alert alert-danger'>There were error(s) in the form: $error</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document- PHP Practice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    .form{
        border: 1px solid grey;
        margin: 6px;
        border-radius: 6px;
    }
    .form-group{
        margin: 20px;
    }
</style>
<body>
    <?php

        $num1= 20;
        $num2 =90;
        // echo ($num1+$num2);

        $name= "John Doe";
        $a= "name";
        // echo "My name is ".$name;
        // echo $$a;

        $myArray= array("mango","apple","banana");
        print_r($myArray);
        echo $myArray[1];

        echo "</br>";

        $myArray2= array(
            "Fruit"=>"Mango",
            "Vegetable"=>"Brinjal",
            "Tree"=>"Banyan"
        );
        print_r($myArray2);

        echo "</br>";

        if($num1!=34){
            echo "True";
        }
        else{
            echo "Number is 34";
        }

        echo "</br>";

        $i = 0;
        $array = array("a", "b", "c");

        //isset() function in Php determines whether a variable is set or not.
        while (isset($array[$i])) {
            echo $array[$i];
            $i++;
        }

        //Sending Email in PHP
        // $emailTo= "sharmilidas06@gmail.com";
        // $subject= "Hope this works!";
        // $body= "This is an email";
        // $headers="From: sharmilidas1@gmail.com";

        // if(mail($emailTo, $subject, $body, $headers)){
        //     echo "Mail Sent Successfully!";
        // }else{
        //     echo "Mail not sent!";
        // }

        echo "</br>";

        //$_GET contains an array of variables received via the HTTP GET method.
        //$_POST method, data from HTML FORM is submitted/collected using a super global variable $_POST.
        //filter_var() function filters a variable and check whether it's of a certain type.

        $names= array("John Doe","Sharmili Das","Henry Smith");

        // if (isset($_POST["submit"])) {
        //     if (($_POST["name"])) {
        //         foreach($names as $name){
        //             if($_POST['name']==$name){
        //                 echo "I know you. Your name is ".$name;
        //                 $knowYou=1;
        //             }
        //         }
        //         if(!isset($knowYou)) echo "Don't know you.".$_POST['name'];

        //     } else {
        //         echo "Please enter your name";
        //     }
        // }

        $hostName = "localhost";
        $dbUser = "root";
        $dbPassword = "";
        $dbName = "practice_db";
        $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
        if (!$conn) {
            die("Something went wrong;");
        }
        else{
            echo "Working!";
        }

        // $query = "INSERT INTO `users`(`name`,`email`,`password`) VALUES ('Sharmili','test@gmail.com','sha123') ";

        $query = "UPDATE `users` SET `email`='test3@gmail.com' WHERE id=2 LIMIT 1";
        mysqli_query($conn, $query);

        $query = "SELECT * FROM `users`";
        if($result=mysqli_query($conn, $query)){
            echo mysqli_num_rows($result);
            while($row= mysqli_fetch_array($result)){
            print_r($row);
            } 
        } 
        else{
            echo "It failed!";
        }

    ?>
    <form method='post' action="" class="form">

    <div class='form-group'>
    <label for="name">Name: </label>
    <input type="text" name='name' placeholder='Your Name' class="form-control">
    </div>

    <div class='form-group'>
    <label for="email">Email: </label>
    <input type="text" name='email' placeholder='Your Email' class="form-control">
    </div>

    <div class='form-group'>
    <label for="comment"> Comment: </label>
    <textarea name='comment' placeholder='Additional Comments..' class="form-control"></textarea>
    </div>

    <div class="form-group">
    <input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg">
    </div>
    </form>
</body>
</html>