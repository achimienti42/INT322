<?php

require_once("myClasses.php");

$testDB = new DBLink('int322_163a27');

$sql_query=$testDB->query('SELECT * from users');

//$sql_query=$testDB->query("INSERT INTO users(username, password, role, passwordHint, salt) VALUES('newperson@hotmail.com', '$testDB->hasedPass('$105rPu2zJ$')', 'user', 'I wont tell', '$105rPu2zJ$')");
//$sql_query=$testDB->query("UPDATE users SET username='achimienti@gmail.com', passwordHint='New Pass Hint' WHERE username='adam_chimienti@hotmail.com'")


$testDB->emptyResult($sql_query);


while($row=mysqli_fetch_assoc($sql_query)){


  echo $row['username'];
  echo $row['password'];
  echo $row['role'];
  echo $row['passwordHint'];
  echo $row['salt'];
  echo "<br>";


}


?>