<?php
  session_start();
  
  if(!$_SESSION['username']){
  
     header("Location:login.php");
 
 }else{
?>

<html>
  <body>
 
   <h1>Page 2!</h1>

    <?php print($_SESSION['username']) ?><br>

    <a href="login.php">Login Page</a><br>

    <a href="protectedstuff.php">Protected Stuff Page</a>

  </body>

</html>

<?php 
  }
?>
