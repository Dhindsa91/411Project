
<?php

include "connect.php";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['username'])&&isset($_POST['email'])&&isset($_POST['password']))
{
	$firstname= $_POST['firstname'];
	$lastname= $_POST['lastname'];
	$username = $_POST['username'];
	$email= $_POST['email'];
	$password= $_POST['password'];
	$pass = md5($password);
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
	if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	
	$sql = "SELECT * FROM accounts WHERE username='$username' OR email = '$email';";
	$results = mysqli_query($connection, $sql);
	$count = mysqli_num_rows($results);
	if($count==0)
	{
		$query = "INSERT INTO accounts (username,firstname,lastname,email,password) VALUES ('$username','$firstname','$lastname','$email','$pass');";
		$result = mysqli_query($connection, $query);
		
		$query2 = "SELECT aid FROM accounts WHERE accounts.email = '$email';";
		
		$result2 = mysqli_query($connection, $query2);
		
		while ($row = mysqli_fetch_assoc($result2))
		{
		 $user = $row['aid'];
		 echo $user;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			$imagedata = file_get_contents($_FILES['fileToUpload']['tmp_name']);
			$sql = "INSERT INTO userimages (aid, contentType, image, username) VALUES(?,?,?, '$username')";
			$stmt = mysqli_stmt_init($connection); //init prepared statement object
			mysqli_stmt_prepare($stmt, $sql); // register the query
			$null = NULL;
			mysqli_stmt_bind_param($stmt, "isb", $user, $imageFileType, $null);
			mysqli_stmt_send_long_data($stmt, 2, $imagedata);
			$result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
			mysqli_stmt_close($stmt);
		}
		echo("An account for user $firstname has been created.");
		header("Location: home.php");
	}
	else
	{
		echo("User already exists with this name and/or email");
		header("Locations: home.php");
	}
	
	mysqli_free_result($results);
	mysqli_close($connection);
}






















/*	$sql = "SELECT * FROM accounts WHERE username='$username' OR email = '$email';";
	$results = mysqli_query($connection, $sql);
	$count = mysqli_num_rows($results);
	if($count==0)
	{
		$query = "INSERT INTO accounts (firstname,lastname,email,username,password) VALUES ('$firstname','$lastname','$email','$username','$pass');";
		$result = mysqli_query($connection, $query);
		header("Location:home.php");
	}
	else
	{
            header("Location: home.php");
	    echo("User already exists with this name and/or email");
		
	}
	
	mysqli_free_result($results);
	mysqli_close($connection);
}*/
?>