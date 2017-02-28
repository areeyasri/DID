<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
/**
 * Title: Thai Splitter Lib
 * Author: Suwicha Phuak-im
 * Email: suwichalala@gmail.com
 * Website: http://www.projecka.com
 */
class Segment {

    private $_input_string;
    private $_dictionary_array = array();
    private $_thcharacter_obj;
    private $_unicode_obj;
    private $_segmented_result = array();
    private $array_rude_word = array();
      
    function __construct() {
        if (!class_exists('Thchracter')) {
        include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'thcharacter.php');
		}
		
		if (!class_exists('Unicode')) {
        include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'unicode.php');
		}
		
		$con = mysqli_connect("127.0.0.1:3306","root","");
		mysqli_select_db($con,"database_web");
        mysqli_set_charset($con, "utf8");
		$result_thaiword = mysqli_query($con,"SELECT * FROM dictionary");
		while($row = mysqli_fetch_array($result_thaiword)) {
			$line_of_text = $row['th_word'];
			$this->_dictionary_array[crc32(trim($line_of_text))] = trim($line_of_text);
		}
		//read rude word main from database
        
		$result_rudeword = mysqli_query($con,"SELECT * FROM rudedictionary");
		while($row = mysqli_fetch_array($result_rudeword)) {
			$line_of_text2 = $row['rudeword'];
			$this->_dictionary_array_rude[crc32(trim($line_of_text2))] = trim($line_of_text2);
		}

        if(!isset($_SESSION['user_id'])){
            $this->array_rude_word = $this->_dictionary_array_rude;
        }
        else {
            $con1 = mysqli_connect("127.0.0.1:3306","root","");
            mysqli_select_db($con1,"database_web");
            mysqli_set_charset($con1, "tis-620");
        	$result_newword = mysqli_query($con1,"SELECT * FROM newrudeword where user_id = '".$_SESSION['user_id']."' ");

            //$result_newword = mysqli_query($con,"SELECT * FROM newrudeword where user_id = '2' ");
            while($row = mysqli_fetch_array($result_newword)) {
            	$line_of_text3 = $row['newword'];
            	$this->_dictionary_array_new_rude[crc32(trim($line_of_text3))] = trim($line_of_text3);
            }
            $this->array_rude_word = array_merge($this->_dictionary_array_rude,$this->_dictionary_array_new_rude);
        }
       
		

        // Load Helper Class/
        $this->_unicode_obj = new Unicode();
        $this->_thcharacter_obj = new Thchracter();
    }

    public function FunctionName()
    {
        return $this->array_rude_word = array_merge($this->_dictionary_array_rude,$this->_dictionary_array_new_rude);
    }

    private function clear_duplicated($string) {
        //หดรูปตัวอักษรซ้ำๆ//
        $input_string_split = $this->_unicode_obj->uni_strsplit($string);
        $previous_char = '';
        $previous_string = '';
        $dup_list_array = array();
        $dup_list_array_replace = array();
        foreach ($input_string_split as $current_char) {

            if ($previous_char == $current_char) {
                $previous_char = $current_char;
                $previous_string .= $current_char;
            } else {
                if (mb_strlen($previous_string) > 3) {
                    $dup_list_array[] = $previous_string;
                    $dup_list_array_replace[] = $current_char;
                    $string = str_replace($previous_string, $previous_char, $string);
                }
                $previous_char = $current_char;
                $previous_string = $current_char;
            }
        }
        if (mb_strlen($previous_string) > 3) {
            $dup_list_array[] = $previous_string;
            $dup_list_array_replace = $current_char;
        }
        return str_replace($dup_list_array, $dup_list_array_replace, $string);
    }

    public function get_segment_array($input_string) {
        $this->_input_string = $input_string;


        // ลบเครื่องหมายคำพูด, ตัวแบ่งประโยค //
        $this->_input_string = str_replace(array('\'', '‘', '’', '“', '”', '"', '-', '/','.', '(', ')', '{', '}', '...', '!', '..', '…', '', ',', ':', '|', '\\'), '', $this->_input_string);
        // เปลี่ยน newline ให้กลายเป็น Space เพื่อที่ใช้สำหรับ Trim
        $this->_input_string = str_replace(array("\r", "\r\n", "\n"), ' ', $this->_input_string);


        // กำจัดซ้ำ //
        $this->_input_string = $this->clear_duplicated($this->_input_string);

        // แยกประโยคจากช่องว่าง (~เผื่อไว้สำหรับภาษาอังกฤษ) //
        $this->_input_string_exploded = explode(' ', $this->_input_string);

       // Reverse Array สำหรับการใช้ Dictionary แบบ Reverse //
        foreach ($this->_input_string_exploded as $input_string_exploded_row) {
            $current_string_reverse_array = array_reverse($this->_unicode_obj->uni_strsplit(trim($input_string_exploded_row)));
            
            $current_array_result = $this->_segment_by_dictionary_reverse($current_string_reverse_array);
            foreach ($current_array_result as $each_result) {
                if (trim($each_result) != '')
                    $this->_segmented_result[] = trim($each_result);
            }
        }

        // จัดการคำที่ตัดที่ยาวผิดปกติ (~อาจจะเป็นเพราะว่าพิมผิด) โดยการตัดตาม Dict แบบธรรมดา//
        $tmp_result = array();
        foreach ($this->_segmented_result as $result_row) {
            if (mb_strlen($result_row) > 10) {

                $current_string_array = $this->_unicode_obj->uni_strsplit(trim($result_row));

                $current_array_result = $this->_segment_by_dictionary($current_string_array);

                foreach ($current_array_result as $current_result_row) {

                    $tmp_result[] = trim($current_result_row);
                }
            } else {
                $tmp_result[] = $result_row;
            }

        }
        $this->_segmented_result = $tmp_result;
        return $this->_segmented_result;
    }

    private function _segment_by_dictionary($input_array) {

        $result_array = array();
        $tmp_string = '';

        $pointer = 0;
        $length_of_string = count($input_array)-1;

        while ($pointer <= $length_of_string) {

            $tmp_string .= $input_array[$pointer];

            if (isset($this->_dictionary_array[crc32($tmp_string)])) { // ถ้าเจอใน Dict //
                $dup_array = array();
                $dup_array[] = array(
                    'title' => $tmp_string,
                    'to_mark' => $pointer + 1,
                );
                $count_more = 0;
                $more_tmp = $tmp_string;
                //echo $more_tmp.'find in dict <br/>';


                for ($i = $pointer + 1; $i <= $length_of_string; $i++) {
                    $more_tmp .= $input_array[$i];
                    //echo $more_tmp.'<br/>';
                    //echo $more_tmp.'<br/>';
                    if (isset($this->_dictionary_array[crc32($more_tmp)])) {
                        $dup_array[] = array(
                            'title' => $more_tmp,
                            'to_mark' => $i + 1,
                        );
                        //print_r($dup_array);
                    }

                    $count_more++;
                }

                if (count($dup_array) > 0) {
                    $result_array[] = $dup_array[count($dup_array) - 1]['title'];

                    $pointer = $dup_array[count($dup_array) - 1]['to_mark'];

                    //echo $to_mark;
                } else {
                    
                }
                //echo '-------------------<br/>';
                $dup_array = array();
                $tmp_string = '';
                continue;
            }

            $pointer++;
        }

        if ($tmp_string != '') { //  ส่วนที่เหลือ ถ้าไม่เจอใน Dict
            $result_array[] = $tmp_string;
        }

        if (count($result_array) == 0) {
            return array(implode($input_array));
        }
        return $result_array;
    }

    private function _segment_by_dictionary_reverse($input_array) {

        $result_array = array();
        $tmp_string = '';

        $pointer = 0;
        $length_of_string = count($input_array)-1;

        while ($pointer <= $length_of_string) {

            $tmp_string = $input_array[$pointer] . $tmp_string;

            if (isset($this->_dictionary_array[crc32($tmp_string)])) { // ถ้าเจอใน Dict //
                $dup_array = array();
                $dup_array[] = array(
                    'title' => $tmp_string,
                    'to_mark' => $pointer + 1,
                );
                $count_more = 0;
                $more_tmp = $tmp_string;
                //echo $more_tmp.'<br/>';


                for ($i = $pointer + 1; $i <= $length_of_string; $i++) {
                    $more_tmp = $input_array[$i] . $more_tmp;
                    //echo $more_tmp.'<br/>';
                    //echo $more_tmp.'<br/>';
                    if (isset($this->_dictionary_array[crc32($more_tmp)])) {
                        $dup_array[] = array(
                            'title' => $more_tmp,
                            'to_mark' => $i + 1,
                        );
                        //print_r($dup_array);
                    }

                    $count_more++;
                }

                if (count($dup_array) > 0) {
                    $result_array[] = $dup_array[count($dup_array) - 1]['title'];

                    $pointer = $dup_array[count($dup_array) - 1]['to_mark'];

                    //echo $to_mark;
                } else {
                    
                }
                //echo '-------------------<br/>';
                $dup_array = array();
                $tmp_string = '';
                continue;
            }

            $pointer++;
        }

        if ($tmp_string != '') { //  ส่วนที่เหลือ ถ้าไม่เจอใน Dict
            $result_array[] = $tmp_string;
        }

        if (count($result_array) == 0) {
            return array(implode(array_reverse($input_array)));
        }
        return array_reverse($result_array);
    }

	
	public function get_rude_word($input_array){
		//echo implode(' ', $input_array);
		$eachinput = '';
		$found = 0;
		$result_rude = array_fill( 0, count($this->array_rude_word), null);
		
		foreach ($input_array as $eachinput){
			$checkrude = 0;
			$i = 0;
			foreach ($this->array_rude_word as $eachrude){
				if(strcmp( $eachinput,$eachrude) == 0){
					$result_rude[$i] = 1;
					$checkrude = 1;
				}
				$i = $i +1;
			}
			if($checkrude == 1){
			//	echo '*** ';
				//echo '<p style="color:red;">*** ';
				$found = 1;
			}
			else{
                
            }
			//	echo $eachinput;
			//echo '</p>';
		}
		if($found==0){
			return 'NOT FOUND';
		}
		else if($found==1){
			$i = 0;
			$runner = 0;
			foreach($this->array_rude_word as $eachrude){
				if($result_rude[$runner] == 1)
					$i = $i +1;
				$runner = $runner+1;	
				
			}
			$result_return = array_fill( 0, $i, null);
				
			$i = 0;
            $j=0;
			foreach($this->array_rude_word as $eachrude){
				
				if($i<count($result_rude) && $result_rude[$i] == 1)
				{
					$result_return[$j] = $eachrude;
                    $j++;
				}
				$i = $i+1;
			}
			return $result_return;
		}


	}


  
}
?>