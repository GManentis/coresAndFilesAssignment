<?php 
$error = "";
$response = "";
$numCustomers = 0;
$customers = array();
$threshold = 0.05;


if(isset($_POST["submit"])){
	if(!isset($_POST["customers"]) || !is_array($_POST["customers"])){
		echo "Please insert valid customers<br><br><a href='./'>Click here to return</a>";
		die();
	}
	$customers = $_POST["customers"];
		
	if(!isset($_POST["numCustomers"]) || !filter_var($_POST["numCustomers"], FILTER_VALIDATE_INT) || $_POST["numCustomers"] < 1 || $_POST["numCustomers"] >10000){
		echo "Please set valid number of customers<br><br><a href='./'>Click here to return</a>";
		die();
	}
	$numFiles = $_POST["numCustomers"];
	
	$position = 1;
	foreach($customers as $customer){
		if(!$customer){
			echo "Invalid customer entry at position No".$position."<br><br><a href='./'>Click here to return</a>";
			die();
		}
		++$position;
	}

	$customer_appearances = array_count_values($customers);
	ksort($customer_appearances);
	foreach($customer_appearances as $c_name=>$number){
		if($number/count($customers) < 0.05){
			unset($customer_appearances[$c_name]);
		}
	}
	$customer_appearances = array_keys($customer_appearances);
	echo "Customers above the threshold are:<br><br>".implode("<br/>",$customer_appearances)."<br><br><a href='./'>Click here to return</a>";		
}else{
	header("Location:./index.php");
}

?>