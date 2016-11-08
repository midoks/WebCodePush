<?php


function wcp_add_user(array $info){

	$content = '<?php '."\r\n".'return array('."\r\n";

	$content .= "\t".'"pwd"=>"'.$info['pwd'].'"'.",\r\n";
	$content .= "\t".'"type"=>'.$info['type'].",\r\n";
	$content .= "\t".'"project"=>"'.$info['project'].'"'."\r\n";

	$content .= ');'."\r\n".'?>';

	return $content;
}


function wcp_add_project(array $info){

	$tmp_project_target = trim($info['project_target']);
	$tmp_project_target = explode("\r", $tmp_project_target);
	foreach ($tmp_project_target as $key => $value) {
		$t = trim($tmp_project_target[$key]);
		if (!empty($t)){
			$tmp_project_target[$key] = trim($t, ',');
		}
	}
	
	$info['project_target'] = implode(',', $tmp_project_target);

	$content = '<?php '."\r\n".'return array('."\r\n";

	$content .= "\t".'"project_site"=>"'.$info['project_site'].'"'.",\r\n";
	$content .= "\t".'"project_cmd"=>'."'".$info['project_cmd']."'".",\r\n";
	$content .= "\t".'"project_source"=>"'.$info['project_source'].'"'.",\r\n";
	$content .= "\t".'"project_target"=>"'.$info['project_target'].'"'.",\r\n";
	$content .= "\t".'"project_desc"=>"'.$info['project_desc'].'"'."\r\n";

	$content .= ');'."\r\n".'?>';

	return $content;


}

?>