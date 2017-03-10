 <?php
 
 
 class DBLink {
 
 private $dataConnect;
 private $dataName;
 
 function __construct($dataName){
    $dbLogin = (file('/home/int322_163a27/secret/topsecret'));
    $dbServer = trim($dbLogin[0]);
    $dbUser = trim($dbLogin[1]);
    $dbPassword = trim($dbLogin[2]);
    $dbName = trim($dbLogin[3]);
    
    $this->dataName=$dataName;
     $this->dataConnect = mysqli_connect($dbServer, $dbUser, $dbPassword);
     mysqli_select_db ($this->dataConnect, $this->dataName);
    }
  
   
  function query ($sql_query) {
  
   $result = mysqli_query($this->dataConnect, $sql_query) or die ('Could not Connect' . mysqli_error());
   return $result;
   
   }
   
  function __destruct() {
  
   mysqli_close ($this->dataConnect);
   
   }
  
  
  function emptyResult ($result) {
  
  $empty = false;
  
  if($result){
    $empty = true;
    echo "Success! <br>";
    }else{
    echo "Failure";
    return $empty;
  }
  }
  
  function validLogin ($login) {
  
  if($login > 0){
 
   echo "You Have Logged In";
   
   }else{
   
   $Error = "Login has Failed";
   return $Error;
   }
 }
  
  
 }
 
 
 Class Menu {
 
 function __construct(){
 
   $arg=func_get_args();
   
 echo '<html>';
  echo '<h1><strong>This is the Test Menu<strong></h1>'; 
  echo '<body>';
  
  echo '<form method="POST" action="testMenu.php">';
  

  
  for($i=0; $i < func_num_args(); $i++){
  
  echo $arg[$i]
  ;
  
  }
  
  echo '</body>';
echo '</html>';

}

}
 
 
 ?>