<?php
	$link = mysqli_connect('localhost','root','','testtable');

	
	$query = mysqli_query($link, "SELECT * FROM datas WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
	
	$userdata = mysqli_fetch_assoc($query);
	

	print "<h2>Привет, <font color=\"red\">".$userdata['user_login']."</font>. Вы авторизованы!</h2>";
	
?>



<br><br>
<span>download your image:</span><br><br>
<form action="putimage.php" method="post" enctype="multipart/form-data">
<input type="file" name="image">
<input type="submit" value="Загрузить"></form>


<?php

	$queryImg = mysqli_query($link, "SELECT image_content, image_owner FROM images WHERE image_owner = '".$_COOKIE['id']."'");
	
	$imageData = mysqli_fetch_assoc($queryImg);
	

	session_start();
	

		if ($imageData['image_owner'] == $_COOKIE['id'])
		{	
	
			$_SESSION['path'] = $imageData['image_content'];

		} else {
	
			$_SESSION['path'] = '';
	
		}
	
		if (file_exists($_SESSION['path'])) 
		{	
	
			echo '<img src = "'.$_SESSION['path'].'" alt = "картинко" />' ;	
			
		}	
?>









		
