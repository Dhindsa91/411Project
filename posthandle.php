<?php

include "connect.php";
session_start();

if(isset($_POST['title'])&&isset($_POST['post']))
{
	$title= $_POST['title'];
	$post= $_POST['post'];
    $username= $_SESSION["username"];
    
   
    
    $query = "INSERT INTO posts (title,post,username) VALUES ('$title','$post','$username');";
	$result = mysqli_query($connection, $query);
    header("Location: home.php");
}

?>
    