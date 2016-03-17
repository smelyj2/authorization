
<?php

# Connecting to database
$link = mysqli_connect('localhost','root','','testtable');

if(isset($_COOKIE['id']) && isset($_COOKIE['hash']) )
{		

	$query = mysqli_query($link, "SELECT * FROM datas WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
	
    $userdata = mysqli_fetch_assoc($query);
	
	
	 if(($userdata['user_hash'] == $_COOKIE['hash']) && ($userdata['user_id'] == $_COOKIE['id']))
	{
		
		  print "Привет, ".$userdata['user_login'].". Вы авторизованы!";
		  header("Location: mainPage.php"); exit();
		 
		  
	 } else {
		 
		 
		setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
		
        print "Хм, что-то не получилось";
		
	 }
	


} 


	
?>





