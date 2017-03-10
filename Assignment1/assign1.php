<html>
<body><?php


 //gets sql info from file
 $dbLogin =file('/home/int322_163a27/secret/topsecret');
 $dbServer = trim($dbLogin[0]);
 $dbUser = trim($dbLogin[1]);
 $dbPassword = trim($dbLogin[2]);
 $dbName = trim($dbLogin[3]);
 $fail = 0;
 
 
 //creates sql connection
 $connect = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName) or die('Could not connect: ' . mysqli_error($connect));
 
 //verifying the connection exists
 $ifexist = mysqli_query($connect, 'SELECT * FROM cellphones');

//verifies if information already exists or not
  if(!$ifexist) {
  
  //creates table
  $table = "create table cellphones (
    id int zerofill not null auto_increment,
    model varchar(40) not null, 
    version varchar(20) not null, 
    os varchar(10) not null,
    price decimal(10,2) not null,
    primary key (id)
    );";
  
  
  mysqli_query($connect, $table);
  
  //declares variables from each text file
  $ModelArray = file("Model.txt");
  $PriceArray = file("price.txt");
  $OSArray = file("OS.txt");
  $VersionArray = file("version.txt");
  
  //Inserts Values into table
  for ($i=0; $i < 9; $i++){
  
    mysqli_query($connect, "INSERT INTO cellphones(id, model, os, price, version) 
    VALUES(null,'".$ModelArray[$i]."','".$OSArray[$i]."','".$PriceArray[$i]."','".$VersionArray[$i]."');");
  
    }
    // echo "Table and Info Created";
    
  } else {
  
  // echo "Table and Info Already Exists";
  $ModelArray = file("Model.txt");
  $VersionArray = file("version.txt");
  
  }
  



?>

<?php

$minPriceErr = "";
$maxPriceErr = "";

//Validates Minimum and Maximum user price entry

if(!is_numeric($_POST['minprice'])){
    $minPriceErr = "Please enter a Number Value for Minimum Price";
    $fail = 1;
}


if(!is_numeric($_POST['maxprice'])){
    $maxPriceErr = "Please enter a Number Value for Maximum Price";
    $fail = 1;
    
}

if ($_POST['maxprice'] < $_POST['minprice']){
    $maxPriceErr = "Max Price must be higher than Min Price";
    $minPriceErr = "Min Price must be lower than Max Price";
    $fail = 1;
}

$minprice = $_POST['minprice'];
$maxprice = $_POST['maxprice'];

?>



<?php //layout of html page
?>
Assignment 1:
<br>
<br>
Adam Chimienti
<br>
<br>
107904153
<br>
<br>

<?php //text fields, and field validation error echos
?>
<form action="assign1.php" method="post">
Min Price: <input type="text" name="minprice" value="<?php if(isset($_POST['minprice'])) echo $_POST['minprice']; ?>"> <?php echo $minPriceErr?><br>
<br>
Max Price: <input type="text" name="maxprice" value="<?php if(isset($_POST['maxprice'])) echo $_POST['maxprice']; ?>"><?php echo $maxPriceErr?><br>
<br>
<br>


<?php //drop down menu 
?>
<select name="Model">
<option value="BlueBerry" <?php if($_POST['Model']=='BlueBerry' ) echo "SELECTED"; ?>> BlueBerry</option>
<option value="Galaxy" <?php if($_POST['Model']=='Galaxy' ) echo "SELECTED"; ?>> Galaxy</option>
<option value="Planet" <?php if($_POST['Model']=='Planet' ) echo "SELECTED"; ?>> Planet</option>
<option value="Blue Line" <?php if($_POST['Model']=='Blue Line' ) echo "SELECTED"; ?>> Blue Line</option>
<option value="Flip Phone" <?php if($_POST['Model']=='Flip Phone' ) echo "SELECTED"; ?>> Flip Phone</option>
<option value="Solar System" <?php if($_POST['Model']=='Solar System' ) echo "SELECTED"; ?>> Solar System</option>
</select>


<br>
<br>

<input type="submit" name="submit">

  </form>
  
<?php
$model = $_POST['Model'];

  if((isset($_POST['submit'])) && ($fail == 0)){
  //testing to make sure select statement work
  
  //echo "SELECT * FROM cellphones WHERE model LIKE '%". $model ."%' AND price BETWEEN ". $minprice ." AND ". $maxprice;
    
  //select statement to filter through what will be printed, depending on user input
    $query = mysqli_query($connect, "SELECT * FROM cellphones WHERE model LIKE '%". $model ."%' AND price BETWEEN ". $minprice ." AND ". $maxprice) or die('Query not Submitted.');
		
   ?>
  <?php //creation of table
  ?> 
   <table border="1">
   <tr>
       <th>ID</th><th>Model</th><th>OS</th><th>Price</th><th>version</th>
   </tr>
   <?php //prints data from table
   ?>
   <?php while ($data = mysqli_fetch_array($query)){ ?>
    <tr>
    <td><?php echo $data['id']; ?></td>
		<td><?php echo $data['model']; ?></td>
		<td><?php echo $data['os']; ?></td>
    <td><?php echo $data['price']; ?></td>
		<td><?php echo $data['version']; ?></td>
		</tr>

<?php
}
?>
</table>
<?php
date_default_timezone_set("America/New_York");
echo "Submitted: ".date("1"). ", ". date('Y/m/d'). " at ". date('H:i:s');
 }?>	
</body>
</html>
