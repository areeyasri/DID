<?php 
	
$con = mysqli_connect("127.0.0.1:3306","root","");
mysqli_select_db($con,"database_web");
mysqli_set_charset($con, "utf8");
$i = 0;
$result_rudeword = mysqli_query($con,"SELECT * FROM rudedictionary");
	while($row = mysqli_fetch_array($result_rudeword)) {
		$line_of_text2[$i] = $row['rudeword'];
		//$dictionary_array_rude[crc32(trim($line_of_text2))] = trim($line_of_text2);
		$i = $i+1;
		//echo $row['rude_word'].'|';
	}

	$j = 0;
$result_thaiword = mysqli_query($con,"SELECT * FROM thaidictionary");
	while($row = mysqli_fetch_array($result_thaiword)) {
		$line_of_text[$j] = $row['thaiword'];
		//$dictionary_array_rude[crc32(trim($line_of_text2))] = trim($line_of_text2);
		$j = $j+1;
		//echo $row['rude_word'].'|';
	}
    $mArray  = array('rudeword' => $line_of_text2, 'thaiword' => $line_of_text);
    echo json_encode($mArray,JSON_UNESCAPED_UNICODE );
    mysqli_close($con);
?>