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

	$content = '<?php '."\r\n".'return array('."\r\n";

	$content .= "\t".'"project_site"=>"'.$info['project_site'].'"'.",\r\n";
	$content .= "\t".'"project_type"=>"'.$info['project_type'].'"'.",\r\n";
	$content .= "\t".'"project_source"=>"'.$info['project_source'].'"'.",\r\n";
	$content .= "\t".'"project_target"=>"'.$info['project_target'].'"'.",\r\n";
	$content .= "\t".'"project_desc"=>"'.$info['project_desc'].'"'."\r\n";

	$content .= ');'."\r\n".'?>';

	return $content;


}

?>