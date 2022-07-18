<?php
session_start();
require 'dpo.php';

//$password = "KocfE30s@72A4aZ";
//echo password_hash($password, PASSWORD_DEFAULT); echo "<br />\n";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
try {
	$pdo = new PDO($dsn, $user, $password);

	if ($pdo) {
//		echo "Connected to the $db database successfully!";
	}
} catch (PDOException $e) {
	echo $e->getMessage();
}

if(  (isset($_POST['username']) && !empty($_POST['username'])) & (isset($_POST['passwd']) && !empty($_POST['passwd']) ) )
{
	$uname = test_input($_POST['username']);
	$passwd = test_input($_POST['passwd']);
$loginQ = "select * from admin_login where uname = :uname";
$statement = $pdo->prepare($loginQ);
$statement->bindParam(':uname', $uname);
//$statement->bindParam(':passwd', $passwd);
$statement->execute();
$result =  $statement->fetch(PDO::FETCH_ASSOC);

if($result)
{
	//print_r($result);
//
	if(password_verify($passwd, $result['pawwd']) === true)
	{
		$_SESSION['logged'] = "valid";
header("Location: upload.php");
//	echo "welcome!";

}else{
	$error = "login incorrect";
}
}else{
$error = "login incorrect";	
//	echo "you have a trrouble!";
}

}else{
//	echo "please submit details";
}

?>
<!DOCTYPE html>    
    <html>    
    <head>    
        <title>Login Form</title>    
        <link rel="stylesheet" type="text/css" href="style.css">    
    </head>    
    <body>    
        <h2>Login Page</h2><br> 
        <?php 
      echo (empty($error)) ? "": "<h3 style='color:red;text-align:center;'>$error</h3>";
//      echo (empty ($_POST['uname'])) ? '<b>you failed to enter your name!</b>' : $_POST['name'];
        ?>
        <div class="login">    
        <form id="login" method="post" action="login.php">    
            <label><b>User Name     
            </b>    
            </label>    
            <input type="text" name="username" id="Uname" placeholder="Username">    
            <br><br>    
            <label><b>Password     
            </b>    
            </label>    
            <input type="password" name="passwd" id="Pass" placeholder="Password">    
            <br><br>    
            <input type="submit" name="log" id="log" value="Log In Here">       
            <br><br>    
           
            <label class="container">Remember Me
  <input type="checkbox" checked="checked">
  <span class="checkmark"></span>
</label>
            <br><br>    
            <a href="#">Forgot Password</a>    
        </form>     
    </div>    
    </body>    
    </html>     
