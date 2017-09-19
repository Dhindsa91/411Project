<?php

include "connect.php";
session_start();

if(isset($_POST['comment'])&&isset($_SESSION['username']))
{
	$comment= $_POST['comment'];
	$user = $_SESSION['username'];
    $postid = $_SESSION['pid'];
   
    
    $query = "INSERT INTO comments (comment,pid) VALUES ('$comment','$postid');";
	$result = mysqli_query($connection, $query);
    header("Location: comments.php");
}

?>
    