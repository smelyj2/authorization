
<?php 

$link = mysqli_connect('localhost','root','','testtable');


			 
	$error = array();	
	
		
	if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $error[] = "Логин может состоять только из букв английского алфавита и цифр";
    }	
	
	
	
	if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $error[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }
	
	if(!$_POST['password'])
    {
        $error[] = "Вы забыли указать пароль";
    }
	
	
		
	$login = $_POST['login'];
	$password = $_POST['password'];	
		
	$query = mysqli_query($link, "SELECT COUNT(user_id) FROM datas WHERE user_login='$login'");
	$data = mysqli_fetch_assoc($query);  	// obtain the data array
	$res=0;
	
	foreach ($data as $key => $value){      // writing  data from associative array to variable
		$res += $value;
	}
     
	if ($res > 0)
	{                         // searching for existing login
		$error[] = "Пользователь с таким логином уже существует в базе данных";
	}
	
	
	session_start();
	if($_POST['kapcha'] != $_SESSION['rand_code']) 
	{
			$error[] = "Капча введена неверно";
	} 	

	if(count($error) == 0)
    {
		$login = $_POST['login'];
		 
		$password = $_POST['password'];

		mysqli_query($link,"INSERT INTO datas(user_login, user_password)  VALUES ('$login','$password') ");  // Written log and pass 
		
		echo "<span style='color:black;'>Спасибо за регистрацию!</span>";
		     
    } else
	{
		
		print "<b>При регистрации произошли следующие ошибки:</b><br><br>";
        foreach($error AS $er)
        {
            echo $er."<br>";
        }
		
	}


  ?>
