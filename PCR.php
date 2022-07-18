<?php

require 'dpo.php';
require 'Patient.php';
require 'qr.php';


if($_GET['id'] == "")
{
	echo "no PCR found!";
	exit;
}
//echo "hi";
$id = $_GET['id'];
//echo $id;
$Patient = new Patient();
$pcr = $Patient->displayPCR($id);
//print_r($Patient);
//echo $pcr['filelocation'];
//print_r($pcr);

//exit;
if($pcr['filelocation'] != NULL)
{
echo "<br /><img src='uploads/".$pcr['filelocation']."' />";
}else{
	echo "no info to display!";
}
