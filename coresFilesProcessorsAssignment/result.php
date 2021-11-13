<?php 
$numFiles = 0;
$codeLinesPerFile = array();
$limit = 0;
$cores = 0;
$totalExecutionTime = 0;
$error = "";
$response = "";

require_once "functions.php";

if(isset($_POST["submit"])){
	if(!isset($_POST["codeLinesPerFile"])){
		echo "Please insert valid code lines per file<br><br><a href='./'>Click here to return</a>";
		die();
	}
		
	if(!isset($_POST["cores"])){
		echo "Please set valid number of cores<br><br><a href='./'>Click here to return</a>";
		die();
	}
	
	if(!isset($_POST["numFiles"])){
		echo "Please set valid number of files<br><br><a href='./'>Click here to return</a>";
		die();
	}
		
	if(!isset($_POST["limit"])){
		echo "Please set valid limit for files<br><br><a href='./'>Click here to return</a>";
		die();
	}
	
	echo minTime($_POST["cores"], $_POST["limit"], $_POST["numFiles"], $_POST["codeLinesPerFile"]);
	
}else{
	header("Location:./index.php");
}

?>