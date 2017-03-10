<?php
	if($_POST){

		$cookieName=$_POST['cookieName'];

		$cookieValue=$_POST['cookieValue'];

		setcookie($cookieName, $cookieValue, time()+3600*1000, "/");

	}

	if(!isset($_COOKIE['visits'])){

		$cookievisit="visits";

		$cookievisitvalue=1;

		setcookie($cookievisit, $cookievisitvalue, time()+3600*1000,"/");

	}

	else{

		$cookievisit="visits";

		$cookievisitvalue=$_COOKIE['visits']+1;

		setcookie($cookievisit, $cookievisitvalue, time()+3600*1000,"/");

	}
?>
<html>
<body>

	Back So Soon? Returning  <?php print($_COOKIE['visits'])?> times 
	
	<form action="lab5.php" method="post">
	
	Cookie Name <input type="text" name="cookieName" value="<?php if($_POST['cookieName'])echo $_POST['cookieName'];?>"> <br>

		Cookie Content<input type="text" name="cookieValue" value="<?php if($_POST['cookieValue'])echo $_POST['cookieValue'];?>"><br>

		<input type="submit" value="Create Cookie">

	</form>

	<?php if(!empty($_COOKIE)) print_r($_COOKIE);?>

</body>
</html>
