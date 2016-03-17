
<?php 
// Page of downloads pics

$link = mysqli_connect('localhost','root','','testtable');


	if ($_FILES['image']['size'] > 10485760 ) 
	{	
		echo "Картинка не должна весить больше 10 мегабайт";
		
		exit();
		
	}
	

	if (strpos($_FILES['image']['type'], 'jpeg') || strpos($_FILES['image']['type'], 'png'))
	{	

		$filename = '../uploads';
		
			if (!file_exists($filename)) 
			{
				
				mkdir("../uploads", 0777);
				
			}

			
		copy($_FILES['image']['tmp_name'],"../uploads/".basename($_FILES['image']['name']));
		
		$imgpath = "../uploads/".$_FILES['image']['name'];
		
		$userId = $_COOKIE['id'];
		

		$query = mysqli_query($link,"SELECT image_owner FROM images");
		
		$data = mysqli_fetch_assoc($query);

		mysqli_query($link, "INSERT INTO images (image_content, image_owner) VALUES ('$imgpath','$userId') ON DUPLICATE KEY UPDATE image_content = '$imgpath', image_owner = '$userId'");

		$queryImg = mysqli_query($link, "SELECT image_content FROM images WHERE image_owner = '".$_COOKIE['id']."'");
		
		$imageData = mysqli_fetch_assoc($queryImg);
		
		
		session_start();
		
		$_SESSION['path'] = $imageData['image_content'];
		

		header("Location: mainPage.php"); exit();	
		
	}else{
	
		echo "Вы загрузили не правильный тип картинки";
	
	}
?>


