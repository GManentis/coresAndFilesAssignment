<?php
function minTime($cores, $limit ,$numFiles, $codeLinesPerFile){
	if(!filter_var($cores,FILTER_VALIDATE_INT) || $cores < 1 || $cores > 1000000000){
		return "Please set valid number of cores<br><br><a href='./'>Click here to return</a>";
	}
	
	if(!filter_var($limit,FILTER_VALIDATE_INT) || $limit < 1 || $limit > 1000000000){
		return "Please set valid number of files as limit<br><br><a href='./'>Click here to return</a>";
	}
	
	if(!is_array($codeLinesPerFile)){
		return "Please insert valid code lines per file<br><br><a href='./'>Click here to return</a>";
	}
	
	if(!filter_var($numFiles, FILTER_VALIDATE_INT) || $numFiles < 1 || $numFiles >10000){
		return "Please set valid number of files<br><br><a href='./'>Click here to return</a>";
	}
	
	if(count($codeLinesPerFile) != $numFiles){
		return "The given number of files are not equal to the files given<br><br><a href='./'>Click here to return</a>";
	}

	$position = 1;
	foreach($codeLinesPerFile as $codeln){
		if(!filter_var($codeln, FILTER_VALIDATE_INT) || $codeln < 1 || $codeln >1000000000){
			echo "Invalid number of code lines in field No".$position."<br><br><a href='./'>Click here to return</a>";
			die();
		}
		++$position;
	}
	
	$total_execution_time = 0;
	$splittable_files = array();
	$unsplittable_files = array();
	foreach($codeLinesPerFile as $codeln){
		if($codeln%$cores == 0){
			array_push($splittable_files,$codeln);
		}else{
			array_push($unsplittable_files,$codeln);
		}
	}
	if(count($splittable_files) != 0){
		rsort($splittable_files);
		if($limit < count($splittable_files)){
			$excluded = array_slice($splittable_files,$limit);
			$unsplittable_files = array_merge($unsplittable_files, $excluded);
			$splittable_files = array_slice($splittable_files,0,$limit);
		}
		foreach($splittable_files as $file){
			$total_execution_time += $file/$cores;
		}
	}
	foreach($unsplittable_files as $u_file){
		$total_execution_time += $u_file;
	}
	echo $response = "Total process time is ".$total_execution_time;
}

?>