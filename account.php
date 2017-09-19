

<!DOCTYPE html>
<head>
     <title>My Account</title>
 
     
    
      <link href="css/reset.css" rel="stylesheet" type="text/css">
      <link href="css/style.css" rel="stylesheet" type="text/css">
      
</head>


  <body>
  
  <div id="wrapper"> 
  
      <header>
      
        <div id="logo"></div>
         
         <nav>
         
         <ul>
         <li><a href="home.php">Home</a></li>
     
         <li><a href="mypost.php">Post</a></li>
         <li><a href="account.php">My Account</a></li>
         <li><a href="search.html">Search</a></li>
 <?php
             session_start();
            if(isset($_SESSION['username'])){
               
        echo '<li><a href="logout.php" style="text-align: right" >Logout</a></li>';
            }else{
        echo '<li><a href="login.html" style="text-align: right" >Login</a></li>';    
            }
            ?>
         </ul>
          
          </nav>
       
        
        
         
      </header>
      
     <div id="content">
     
     <h1>My Posts:</h1><br>
     <hr>
     
      <section>
 <?php
 
include 'connect.php';
 if(isset($_SESSION['username'])){
     
     
$user = $_SESSION["username"];

     $query = "SELECT image FROM userimages as u JOIN accounts as a WHERE u.username=a.username and u.username='$user';";
    $result = mysqli_query($connection, $query);
     while ($row = mysqli_fetch_array($result)){
  
  $blob = $row['image'];
  echo '<img src="data:image/png;base64,'.base64_encode($blob).'" height ="50" width="50"/>';
 }






$posts = "SELECT * FROM posts WHERE posts.username='$user'";
$retval = mysqli_query($connection, $posts);
             
while ($row = mysqli_fetch_array($retval)){
 
        echo '<article>';
        echo '<p>';
        echo '<h3>'.$row['title'].'</h3>';
        
       
        echo '</p>';
        echo $row['post'];
        echo '</article>';
          echo '<p>'.$row['username'].'&nbsp<a href="#">comments</a>&nbsp PostID=' .$row["pid"].'</p>';
        echo '<hr>';
        
     
        }
 }else{
    header("Location:login.html");
 }
?>



<form action="removepost.php" method="post" enctype="multipart/form-data">
    <h1>Remove Posts</h1>
    <input type="number" id="removePost" name="removePost" placeholder="POST ID">
    <input type="submit">
    
    
    
    
</form>
         

      </section>
      </div> <!-- /end #content-->
      
          <div id="rightcol">
       
     
        <aside>
          
     <h3>Change Password</h3>      
<form method="post" action="changepassword.php" id="mainForm" >
              
  
 <h5> Current Password:</h5><br>
  <input type="password" name="oldpassword" id="oldpassword" class="required">
  <br><br>
   <h5> New Password:</h5><br>
  <input type="password" name="newpassword" id="newpassword" class="required">
  <br>
  
  <br>
  <input type="submit" value="Update Password">
</form>

        </aside>
     
       </div>
      <!-- /end #rightcol-->
      
      

      <footer>
     <p>Arvind Dhindsa &copy; 2017</p>
      </footer>

   </div> <!-- /end #wrapper-->
  </body>
</html>