<?php
 session_start();
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
     
     <h1>Recent Posts</h1><br>
     <hr>
     
      <section>
 <?php
 
include 'connect.php';



$posts = 'select * FROM posts ORDER BY title ASC';
$retval = mysqli_query($connection, $posts);
             
while ($row = mysqli_fetch_array($retval)){
 
      
         echo '<form action="comments.php" method="post">';
        echo '<article>';
        echo '<p>';
        echo '<h3>'.$row['title'].'</h3>';
        
       
        echo '</p>';
        echo $row['post'];
        echo '</article>';
        $postnum =$row['pid'];
        
   
       echo  '<input type="hidden" name="postID" id="postID" value="'.$postnum.'" >';
        echo '<p>'.$row['username'].'&nbsp<input type="submit" value="comments"</p>';
        echo '</form>';
        
         
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