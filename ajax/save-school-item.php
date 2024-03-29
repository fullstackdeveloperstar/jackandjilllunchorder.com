<?php
	error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE ^ E_DEPRECATED);
	session_start();
	
	
	require_once("../includes/globals.php");
	require_once($g_docRoot . "classes/school-items.php");
	
		// check for valid page referer
	$rDomain = getDomain($_SERVER["HTTP_REFERER"]);
	$thisDomain = $_SERVER['SERVER_NAME'];

	if (strtolower(trim($rDomain)) != strtolower(trim($thisDomain))) {
		exit("ERROR - Cross domain posting detected");
	}


	// get params
	$id = $_POST["id"];
	$schoolId = $_POST["sid"];
	$item = $_POST["pid"];
	
	$schoolItems = new SchoolItems($g_docRoot, $g_connServer, $g_connUserid, $g_connPwd, $g_connDBName);
	$arrData = ["school_id"=>$schoolId, "product_id"=>$item];

	$schoolItems->update($arrData, $id);
	if ($schoolItems->mError != null && $schoolItems->mError != "")
		exit("Error=" . $schoolItems->mError);
	else
		exit("");
	
	
?>
