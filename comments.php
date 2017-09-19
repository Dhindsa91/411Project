<?php
 session_start();
 include 'connect.php';
?>


<!DOCTYPE html>

<head>
     <title>My Forum</title>
 
     
    
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
     
     <hr>
     
      <section>
<?php
if(isset($_POST['postID']))
{
     
      $pid = $_POST['postID'];
     
     
    $query = "SELECT image, pid FROM userimages as u JOIN posts as p WHERE  p.pid='$pid' and u.username=p.username ";
    $result = mysqli_query($connection, $query);
     while ($row = mysqli_fetch_array($result)){
 
  $blob = $row['image'];
  echo '<img src="data:image/png;base64,'.base64_encode($blob).'" height ="50" width="50"/>';
 }  
 

  
  
  
    
   

 
    $posts = "SELECT * FROM posts WHERE posts.pid='$pid'";
    $retval = mysqli_query($connection, $posts);
    
    
    
     $_SESSION["pid"]=$pid;

while ($row = mysqli_fetch_array($retval)){

        echo '<article>';
        echo '<p>';
        echo '<h3>'.$row['title'].'</h3>';
        
       
        
        echo $row['post'];
        echo '</p>';
        echo '<h5>'.$row['username'].'</h5>';
        echo '</article>';
        
        

}

}
if(isset($_SESSION['username'])){
    
  
    echo '<form action="postcomment.php" method="post">
    <fieldset>
    <legend> Comment</legend>
    <textarea  name="comment" id="comment" rows="7" class="formstyle"></textarea><br>
    
    
    <input type="submit">
   
    </fieldset>
    </form>';
}



    ?>
      <h2>Comments:</h2>

      <?php
      $pid = $_SESSION['pid'];
      
          $posts = "SELECT * FROM comments WHERE comments.pid='$pid'";
          $retval = mysqli_query($connection, $posts);
          


             
while ($row = mysqli_fetch_array($retval)){

       $t = $row['comment'];
    

        echo '<article>';
        echo '<p>';
        echo $t;
        
       
        echo '</p>';
        
        echo '</article>';
        echo '<hr>';

}
      
      
      ?>
      
      


      </section>
      </div> <!-- /end #content-->
      
          <div id="rightcol">
       
     
        <aside>
         <?php
           
            if(!isset($_SESSION['username'])){
               
        echo '<form method="post" action="login.php" id="LoginForm" enctype="multipart/form-data">
            <h3 class="highlight">Log In</h3><br>
   Username:<br>
  <input type="text" name="username" id="username">
  <br>
  Password:<br>
  <input type="password" name="password" id="password" >
  <br>
  <br>
  <input type="submit" value="Login">
  </form>
  <a href="register.html">Register</a>';
          }
            ?>
        </aside>
     
       </div>
      <!-- /end #rightcol-->
      
      

      <footer>
     <p>Arvind Dhindsa &copy; 2017</p>
      </footer>

   </div> <!-- /end #wrapper-->
  </body>
</html>






