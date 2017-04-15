<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	//echo $_SESSION['user_id'];
	require_once("connectSQL.php");

	mb_internal_encoding('UTF-8');
	$time_start = microtime(true);
	date_default_timezone_get("Asia/Bangkok");
					        
	$text_to_segment = trim($_POST['text_to_segment']);

	include(dirname(__FILE__) . DIRECTORY_SEPARATOR . '/THSplitLib/segment.php');
	$segment = new Segment();
	//echo '<hr/>';
	$result = $segment->get_segment_array($text_to_segment);
	$rude_word = $segment->get_rude_word($result);
	$similar = $segment->edtidistance($result);
	$distance = $segment->edtidistance_distance($result);
	//$newrudewordforadd = $segment->new_word_user_add();
	//echo implode(' | ', $result);
	//echo '<br/>';
								
	function convert($size) {
		$unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
		return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	//echo '<br/><b>ประมวลผลใน: </b> '.round($time,4).' วินาที';
	//echo '<br/><b>รับประทานหน่วยความจำไป:</b> ' . convert(memory_get_usage());
	//echo '<br/><b>คำที่อาจจะตัดผิด:</b> ';
	
	$wrongword = "";															
	foreach($result as $row){
		if (mb_strlen($row) > 12){
			$wrongword = $row;
			//echo $row.'<br/>';
		}
	}
	//echo '<br/><b>คำหยาบที่พบ:</b> ';
	//echo implode(' | ', (array)$rude_word); 
	$mArray  = array('full_text' => $result,'rudeword' => $rude_word, 'time' => round($time,4), 'wrongword' => $wrongword, 'similar' => $similar, 'distance' => $distance);
	echo json_encode($mArray,JSON_UNESCAPED_UNICODE );

	if(!isset($_SESSION['user_id'])){

	}
	else{
		$strSQL = "INSERT INTO history (inputText,datetime,user_id) VALUES (".
					"'".$text_to_segment."',".
					"'".time()."',".
					"'".$_SESSION['user_id']."')";	
				mysqli_query($con,$strSQL);

	    $delDuplicate = "DELETE FROM history WHERE id NOT IN (
	    SELECT * FROM (
	    SELECT id from history WHERE user_id=".$_SESSION['user_id']." group by inputText  ORDER by id desc) AS A  )";
		//mysqli_query($con,$delDuplicate);
	}
?> 