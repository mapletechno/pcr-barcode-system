<?php
session_start();
require 'dpo.php';
require 'Patient.php';
require '../qr.php';
if(!$_SESSION['logged'])
{
	header("Location: login.php");
	exit;
}
//echo $hash;
echo "<br />";
  $file = $_FILES['image'];
  if($file != NULL)
  {


/*
$ImageName = $_FILES['image']['name'];
$fileElementName = 'file';
$path = 'uploads/'; 
$location = $path . $_FILES['image']['name']; 
$file_name = $_FILES['image']['name']; 
$file_tmp =$_FILES['image']['tmp_name']; 
$tmp = dirname(__FILE__) . "/uploads/" . $file_name;
//$ok  = move_uploaded_file($file_tmp, $tmp);
if(move_uploaded_file($file_tmp, $tmp))
{
	echo " done well!";
}else{
	echo "big trouble!";
var_dump(error_get_last());
}
*/
$allow = array('jpg', 'jpeg', 'png');
		   	$exntension = explode('.', $file['name']);
		   	$fileActExt = strtolower(end($exntension));
		   	$fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
		   	echo $fileNew;
		   	echo "<br />ddd<br />";
		   	$filePath = '../uploads/'.$fileNew; 
			
			if (in_array($fileActExt, $allow)) {
    		          if ($file['size'] > 0 && $file['error'] == 0) {
		            if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
		            	echo "done successfully!";
//insert into db
$date = time();
$qrcode = bin2hex(random_bytes(16));

		     $patient = new Patient();
		     $patientId = $patient->addPatient($_POST['name'], $fileNew, $date, $qrcode);       	
//print_r($x);
if($patient->patientId != "")
{
//	echo "we have a trouble";
//	print_r($patient->patientId);
print_r($patient->patientId);
echo "<br />\n Patient function: <br />";
echo $patient->getPatient();
//	print_r($patient);
}else{
	echo "we have a trouble";
	print_r($patient->patientId);

	echo "thanks";
//	echo "<br />\n ".;
//	echo $patient;
//	echo "is patient id";
}
		  // 		$query = "INSERT INTO customers(name, email, username, dob, profile_image)
			//		VALUES('$name','$email','$username','$dob','$fileNew')";
			//	$sql = $this->con->query($query);
				   		    
		        }else{
		        	print_r($_FILES);
		        	//echo $file['tmp_name'];
		        	echo "<br />we have a problem!";
		        }
		      }
		   }

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Upload PCR info</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="card text-center" style="padding:15px;">
      <h4 style="color:orange;">Upload PCR info</h4>
    </div><br>
    <div class="container">
<form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Customer Name:</label>
          <input type="text" class="form-control" name="name" placeholder="Enter name" required="">
        </div>
        <div class="form-group">
          <label for="profile_image">PCR Image:</label>
          <input type="file" class="form-control" name="image" required="">
        </div>
        <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
      </form>
    </div>
  </body>
</html>