<?php

  if($_POST){

    //gets sql information from file
    $dbLogin =file('/home/int322_163a27/secret/topsecret');
    $dbServer = trim($dbLogin[0]);
    $dbUser = trim($dbLogin[1]);
    $dbPassword = trim($dbLogin[2]);
    $dbName = trim($dbLogin[3]);
   
    
    //sql connect code block
    $connect = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName) or die('Could not connect: ' . mysqli_error($connect));
  
    $enteredEmail=$_POST['email'];

    $enteredEmail=mysqli_real_escape_string($connect,$enteredEmail);

    $query= "SELECT * FROM users WHERE username='$enteredEmail' LIMIT 1";

    $resultQuery = mysqli_query($connect, $query) or die('query failed' . mysqli_error($connect));
  
	//ensures that values are entered
    if( mysqli_num_rows($resultQuery) > 0 ){

      $query= "SELECT passwordHint FROM users WHERE username='$enteredEmail' LIMIT 1";

      $resultQuery = mysqli_query($connect, $query) or die('query failed' . mysqli_error($connect));
      
      
      //fetches the row from the sql
      $row=mysqli_fetch_row($resultQuery);
      $passHint = $row[0];
      

	//creates and sends message to the email
      $email = $_POST['email'];
      $subject = "Password Recovery";

      $comment = "The information for your account password is: \n
\n
Your email/username is: " . $_POST['email']. "\n
\n    
Your Password Hint is: " . $passHint;
echo "\n";
      mail($email, $subject, $comment);        

     print "Password information has been sent"; 
                  
    }else{

      header("Location:login.php");

    }

    mysqli_close($connect);

  }

?>

<html>
  <body>

     <form method="POST" action="passwordrecovery.php">
         <br>
       Password Recovery
        <br>
        <br>
       
       Email Address: <input type="email" name="email" value=""><br>
       <br>
       <input type="submit">


     </form>    

  </body>
</html>
