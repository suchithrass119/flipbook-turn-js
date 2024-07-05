<?php

$FileName = $_POST["filename"];

if ((ctype_alnum($FileName)))
{

	
	// $FileName = $FileName . ".pdf";
	//  $cmd = 'resources\cpdf -info book\\' . $FileName; //the command which needs to be executed to find out the metadata about file
	
	$cmd = 'resources\cpdf -info "book\\' . $filename . '" 2>&1';
	$Details = [];
	exec($cmd, $Details);
	$Pages = explode(": ", $Details[4]) [1]; //This will return number of pages from the output produced by cpdf
	echo $Pages;
}



?>
