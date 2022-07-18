<?php

class Patient{
public $name;
public $pdo;
public $file;
public $date;
public $qrcode;
private $statement;
private $insertQ;
public $patientId;

public function __construct()
{

}
	public function addPatient($name, $file, $date, $qrcode)
	{
		global $pdo;
if(!$pdo)
{
	echo "no connection";
	return false;

}else{
	//echo "hii";
}
//echo "hi";
		$insertQ = "insert into pcr_info(qrcode, dates, pname, filelocation) values(:qrcode, :date, :pname, :file)";
		$statement = $pdo->prepare($insertQ);


		$statement->execute([
	':qrcode' => $qrcode,
	':date' => $date,
	':pname' => $name,
	':file' => $file
]);

$this->patientId = $pdo->lastInsertId();
//echo "<br /> $";
if($this->patientId != "")
{
//generate the QR
	$qc = new QRCODE();
$qc->URL("http://159.65.217.22/PCR.php?id=$qrcode");
$img = $qrcode.".png";
//$qrimg = file_put_contents($img, $qc->QRCODEnow(177, $img));
$qrimg = $qc->QRCodenow(177, $img);
echo "<img src='$img' />";

//echo "<b style='color:green;font-size:23;text-aligned:center;'>created successfully!</b>";
return $this->patientId;

}else{
	echo "could not be created ";
	return false;
	}

}

public function getPatient()
{
//	global $pdo;
//	$this->patientId = $pdo->lastInsertId;
	//echo $patientId;
	return $this->patientId;
}

public function displayPCR($qrcode)
{
global $pdo;
$pcrQuery = "select * from pcr_info where qrcode = :qrcode";
$statement = $pdo->prepare($pcrQuery);
$statement->bindParam(':qrcode', $qrcode);
//$statement->bindParam(':passwd', $passwd);
$statement->execute();
$result =  $statement->fetch(PDO::FETCH_ASSOC);

return $result;

}


}