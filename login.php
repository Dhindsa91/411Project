<?php
include 'connect.php';
session_start();
 
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      if(isset($_POST["username"]) && isset($_POST["password"])){
        //handle the user inputted data
        $username= $_POST["username"];
        $password = $_POST["password"];
        $pass = md5($password);
        
     
        $count = "SELECT * FROM accounts WHERE username='$username' AND password='$pass';";
        $result1 = mysqli_query($connection, $count);
        
        while ($row = mysqli_fetch_array($result1)){
        
        $_SESSION['aid'] = $row['aid'];
        
        }
        
        
        
        
        
        
        
        $count = "SELECT username, password FROM accounts WHERE username='$username' AND password='$pass';";
        $result = mysqli_query($connection, $count);
        if($result && mysqli_num_rows($result) > 0){
          //user is found, set session variable and redirect to main page.
          $_SESSION['username'] = $username;
          header('Location: home.php');
          //username and password combo exist in database, redirect to index.php
         
        }
        else{
          header('Location: home.php');
          //username and password combo do not exist, redirect to login.php
        }

      }

      else{
        //username or password was not set, redirect back to the login password_get_info
        header('Location: home.php');
      }
    }

    else{
      //user is trying to access page indirectly, redirect to login page
      header('Location: home.php');
    }


?>