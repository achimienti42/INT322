<?php 
  session_start();  
  $Err="";
  
  if($_POST){
  
    //gets sql info from file
    $dbLogin =file('/home/int322_163a27/secret/topsecret');
    $dbServer = trim($dbLogin[0]);
    $dbUser = trim($dbLogin[1]);
    $dbPassword = trim($dbLogin[2]);
    $dbName = trim($dbLogin[3]);
   
    
    //creates sql connection
    $connect = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName) or die('Could not connect: ' . mysqli_error($connect));
   
    $enteredUser=$_POST['username'];

    $enteredUser=mysqli_real_escape_string($connect,$enteredUser);
   
    $enteredPassword=$_POST['password'];
   
    $enteredPassword=mysqli_real_escape_string($connect,$enteredPassword);
    
    //match user login info
    $query= "SELECT * FROM users
    WHERE username='$enteredUser'
    AND password='$enteredPassword' LIMIT 1";
   
    $resultQuery = mysqli_query($connect, $query) or die('query failed' . mysqli_error($connect));
    
    
    //prints the username and password
    if( mysqli_num_rows($resultQuery) > 0 ){
     
      $_SESSION['username'] = $enteredUser; 
     
      header("Location:protectedstuff.php");
   
       }else{
     
       $Err = "*Invalid username or password";
   
     }
   
     mysqli_close($connect);
 
 }

?>

<html>
  <head>      
   
     </head>
  <body>
  
    <form method="POST" action="login.php">
  <br>
      Username: <input type="text" name="username" value=""><strong><?php echo $Err ?></strong><br>
  <br>
      Password: <input type="password" name="password" value=""><br>
  <br>
      <input type="submit" value="submit"><br><br>
  
      <a href="passwordrecovery.php">Forgot your Password?</a>
  
    </form>
  </body>
</html>
