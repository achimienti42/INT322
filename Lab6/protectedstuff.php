<?php 
  session_start();
  
  if($_POST){

    unset($_SESSION);

    session_destroy();

    setcookie("PHPSESSID", "", time() - 61200,"/");

    header("Location:lab6.php");

  }
  
  
  if(!isset($_SESSION['username'])){

    header("Location:lab6.php");

    print "You Must Log In";

    exit();

  }else{
  
?>

<html>
  <body>

    ProtectedStuff
    <br>
    <h1>You are logged in!<h1><br>

    <form action="protectedstuff.php" method="POST">

      <input type="submit" name="logout "value="logout">

    </form>

    

    

  </body>
</html>

<?php
  }
?>
