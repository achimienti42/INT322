<?php 
  session_start();
  
  if($_POST){

    unset($_SESSION);

    session_destroy();

    setcookie("PHPSESSID", "", time() - 61200,"/");

    header("Location:login.php");

  }
  
  
  if(!isset($_SESSION['username'])){

    header("Location:login.php");

    print "You Must Log In";

    exit();

  }else{
  
?>

<html>
  <body>

    ProtectedStuff
    <br>
    You are logged in <br>

    <form action="protectedstuff.php" method="POST">

      <input type="submit" name="logout "value="logout">

    </form>

    

    

  </body>
</html>

<?php
  }
?>
