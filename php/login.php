
<?php
// authorization page

# Function to generate a random string
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

# Connecting to database
$link = mysqli_connect('localhost','root','','testtable');

if(isset($_POST['submit']))
{
    # We pulled out of the database record, which is equal to the entered login
    $query = mysqli_query($link,"SELECT user_login, user_id, user_password FROM datas WHERE user_login='".$_POST['login']."'");
    $data = mysqli_fetch_assoc($query);
	
	if(!$_POST['login'] && !$_POST['password']){
		 print "Вы ввели неправильный логин/пароль";
		 exit();
	} 

	if($data['user_password'] == $_POST['password'] && $data['user_login'] == $_POST['login'] ){
		
		# We generate a random number and encrypt it
        $hash = md5(generateCode(10));
		# We write a new hash to database
		
		 mysqli_query($link, "UPDATE datas SET user_hash='".$hash."' WHERE user_id='".$data['user_id']."'");
		 
		 # Set the cockie
        setcookie("id", $data['user_id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30);
		
		
		# Redirects the browser to a page of the script test
        header("Location: check.php"); exit();
		
	}else {
		 print "Вы ввели неправильный логин/пароль";
	}
	
	
}
?>


