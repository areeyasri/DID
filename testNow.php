<html>

	<head prefix="og: http://ogp.me/ns#">
		<meta charset="utf-8" />
		<!-- Use these meta tags to bypass safari touch events on ipad, otherwise scrolling and drawing will not work -->

		<meta http-equiv="content-type" content="text/html; charset=windows-874" />
		<meta http-equiv="Content-Language" content="th" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="language" content="Thai" />

		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>	

		<style>
		.box
		{
			resize: none;
			padding:5px;
			margin:5px;
		}
		</style>
		<!-- <script src = "https://cdn.firebase.com/js/client/2.4.2/firebase.js"></script>
      	<script type = "text/javascript" src = "index.js"></script> -->

	</head>

	<body>
		
		<div class="container-fluid" >
			<table style="border: 1px solid black; margin-left:5%; margin-right:5%; border-spacing: 15px; width: 100%; background-color:#FAEBD7;">
				<!-- Banner Area -->
				<tr>
					<td style="height:250px;" bgcolor="#F0F8FF"></td>
					<td></td>
				</tr>
				<!-- End Banner Area -->
				<tr>
					<td style="border: 0px solid black; width:500px;">
						<!-- Insert data box -->
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#slang">Slang Word</a></li>
							<li><a data-toggle="tab" href="#mistake">Mistake</a></li>
						</ul>

						
						<div class="tab-content" style="background-color:#ddd">
							<!-- Slang Part -->
							<div id="slang" class="tab-pane fade in active">
								<div style="float:left; width:400px;" >
									<form method="post">
										<b>Please insert the information in here</b>
										<button id="submit" value="sent" style="float:right; margin:3 0 0 0px; background-color:blue; border:none;">sent</button>
										<br/>
										<textarea name="text_to_segment" cols="40" rows="50" style="width:450px;height:500px; margin:0 0 15 15px;">
										<?php echo isset($_POST['text_to_segment'])?  trim($_POST['text_to_segment']):'' ?>
										</textarea>
									</form>	
								</div>
							</div>
							
							<!-- Mistake Part -->
							<div id="mistake" class="tab-pane fade">
								<form>
									<textarea name="text" class="box" cols="75" rows="5"></textarea>
								</form>
							</div>
						</div>
					</td>
					<td style="border: 1px solid black; width:500px;">
						<?php
							if ($_POST) {
            
					            $time_start = microtime(true);
					        
					            $text_to_segment = trim($_POST['text_to_segment']);
					            //echo '<hr/>';
					            //echo '<b>ประโยคที่ต้องการตัดคือ: </b>' . $text_to_segment . '<br/>';
					            include(dirname(__FILE__) . DIRECTORY_SEPARATOR . '/THSplitLib/segment.php');
					            $segment = new Segment();
					            //echo '<hr/>';
					            $result = $segment->get_segment_array($text_to_segment);
								$rude_word = $segment->get_rude_word($result);
					            //echo implode(' | ', $result);
								echo '<br/>';
								

					            function convert($size) {
					                $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
					                return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
					            }
					            $time_end = microtime(true);
					            $time = $time_end - $time_start;
					            echo '<br/><b>ประมวลผลใน: </b> '.round($time,4).' วินาที';
					            echo '<br/><b>รับประทานหน่วยความจำไป:</b> ' . convert(memory_get_usage());
					            echo '<br/><b>คำที่อาจจะตัดผิด:</b> ';
																
					            foreach($result as $row)
					            {
					                if (mb_strlen($row) > 12)
					                {
					                    echo $row.'<br/>';
					                }
					            }
								echo '<br/><b>คำหยาบที่พบ:</b> ';
								echo implode(' | ', (array)$rude_word);
        					}
							
						?>
					</td>
					<td></td>
				</tr>
			</table>
		</div>
	</body>

<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-28746062-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>

</html>

