<?php
	$time_start = microtime(true);
					        
	$text_to_segment = trim($_POST['text_to_segment']);
	//echo '<hr/>';
//	echo '<b>ประโยคที่ต้องการตัดคือ: </b>' . $text_to_segment . '<br/>';
	include(dirname(__FILE__) . DIRECTORY_SEPARATOR . '/THSplitLib/segment.php');
	$segment = new Segment();
	//echo '<hr/>';
	$result = $segment->get_segment_array($text_to_segment);
	$rude_word = $segment->get_rude_word($result);


	//echo implode(' | ', $result);
//	echo '<br/>';
								
	function convert($size) {
		$unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
		return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	//echo '<br/><b>ประมวลผลใน: </b> '.round($time,4).' วินาที';
	//echo '<br/><b>รับประทานหน่วยความจำไป:</b> ' . convert(memory_get_usage());
	//echo '<br/><b>คำที่อาจจะตัดผิด:</b> ';
																
	foreach($result as $row){
		if (mb_strlen($row) > 12){
			//echo $row.'<br/>';
		}
	}
	//echo '<br/><b>คำหยาบที่พบ:</b> ';
	//echo implode(' | ', (array)$rude_word); 
	$mArray  = array('full_text' => $result,'rudeword' => $rude_word, 'time' => round($time,4) );
	echo json_encode($mArray,JSON_UNESCAPED_UNICODE );
?> 