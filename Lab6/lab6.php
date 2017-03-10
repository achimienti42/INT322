<?php 
 
  
  
  if($_POST){
  
    //gets sql info from file
    $dbLogin =file('/home/int322_163a27/secret/topsecret');
    $dbServer = trim($dbLogin[0]);
    $dbUser = trim($dbLogin[1]);
    $dbPassword = trim($dbLogin[2]);
    $dbName = trim($dbLogin[3]);
   
    
    
    $connect = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName) or die('Could not connect: ' . mysqli_error($connect));
   
    $enterUser=$_POST['username'];

    $enterUser=mysqli_real_escape_string($connect,$enterUser);
   
    $enterPass=$_POST['password'];
   
    $enterPass=mysqli_real_escape_string($connect,$enterPass);
    
    
    $query="SELECT salt FROM users WHERE username='$enterUser' LIMIT 1";
    $querySuccess=mysqli_query($connect, $query) or die ('query failed' . mysqli_error($connect));
    $saltPass=mysqli_fetch_row($querySuccess);
    
    $correctPass=crypt($enterPass, $saltPass[0]);
    
    
   $query="SELECT * FROM users WHERE password='$correctPass' LIMIT 1";
   $querySuccess=mysqli_query($connect, $query);
   
   
    $result = mysqli_query($connect, $query) or die('query failed' . mysqli_error($connect));
    
    $NumRows = mysqli_num_rows($result);
     mysqli_close($connect);
     
    
 }
 
 if($NumRows > 0){
 
   echo "You Have Logged In";
   
   }else{
   
   $Error = "Login has Failed";

?>

<html>
  <head>      
   
     </head>
  <body>
  
    <form method="POST" action="lab6.php">
  <br>
      Username: <input type="text" name="username"><?php echo $Error; ?><br>
  <br>
      Password: <input type="password" name="password"><?php echo $Error; ?><br>
  <br>
      <input type="submit" value="submit"><br><br>
  
  
    </form>
  </body>
</html>

<?php } ?>
