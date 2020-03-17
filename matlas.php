<?php
	$postData = file_get_contents('php://input');
	$xml = simplexml_load_string($postData);
	$array = json_decode(json_encode((array)$xml),1);
	matlas($array);
	if(!empty($array)){
		if(isset($array['rcemsTrxSubResp']))
		{
			echo $mdata = '<?xml version="1.0" encoding="UTF-8"?><rcemsTrxSubReqAck><TrxStsCode>'.$array["rcemsTrxSubResp"]["TrxStsCode"].'</TrxStsCode></rcemsTrxSubReqAck>';
		}
	}
	function matlas($array){
		print_r('<pre>');
			var_dump($array);
		print_r('</pre>');
	}
?>