<?php
session_start();
include 'connect.php';

if(isset($_POST['removePost']))
{
    
	
	$rpost= $_POST['removePost'];
    $username= $_SESSION["username"];
    
   
    $query = "DELETE FROM posts WHERE posts.pid='$rpost' and posts.username='$username'";
    $result = mysqli_query($connection, $query);
    header("Location: account.php");
  
}
?>