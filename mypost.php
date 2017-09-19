
    <?php
    session_start();
    
if(isset($_SESSION["username"])){
    
echo '<!DOCTYPE html>

<head>
     <title>Create Post</title>
 
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
     
         <li><a href="mypost.php">My Posts</a></li>
         <li><a href="account.php">My Account</a></li>
         <li><a href="search.html">Search</a></li>
         </ul>
         
          </nav>
  
      </header>
      
     <div id="content">
     
      <section>
    <form action="posthandle.php" method="post" enctype="multipart/form-data">
    <fieldset>
      <legend> Create A Post</legend>
      <p>
        <label> Title: </label><br>
        <input type="text" name="title" id="title" class="formstyle"/><br>
         <label> Post: </label><br>
        <textarea  name="post" id="post" rows="7" class="formstyle"></textarea><br>
        <br><br><br><br>
        <input type="submit">
     </p>

       </fieldset>
   </form>
      </section>
      </div> <!-- /end #content-->
  
      <footer>
     <p>Arvind Dhindsa &copy; 2017</p>
      </footer>

   </div> <!-- /end #wrapper-->
  </body>
</html>';
}else{
    header("Location:login.html");
}
?>