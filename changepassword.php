<?php
include "connect.php";
session_start();

if(isset($_POST['newpassword'])&&isset($_POST['oldpassword']))
{
	$username = $_SESSION['username'];
	$oldpassword= $_POST['oldpassword'];
	$newpassword= $_POST['newpassword'];
	$oldpass = md5($oldpassword);
	$newpass = md5($newpassword);
	
	$sql = "SELECT * FROM accounts WHERE username='$username' AND password = '$oldpass';";
	$results = mysqli_query($connection, $sql);
	$count = mysqli_num_rows($results);
	if($count==0)
	{
		echo("Username and/or password are invalid");
	}
	else
	{
		$sql = "UPDATE accounts SET password = '$newpass' WHERE password = '$oldpass' AND username='$username';";
		$results = mysqli_query($connection, $sql);
		echo("user’s password has been updated");
		header("Location: account.php");
	}
	
	mysqli_close($connection);
	
}