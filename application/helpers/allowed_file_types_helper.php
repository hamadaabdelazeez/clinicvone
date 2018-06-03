<?php 
function research_allowed_file_types(){
	return $research_allowed_file_types = array("ott","pot","potx","dotm","dotx","xml","tmd","pages","oxps","vsd","ods","pdf","odt","ppt","pptm","pptx","xls","xlst","xslt","doc","docx","jpg","jpeg","png","pneg","gif","bmp","pmd","pez","mso","keynote","mpp","prd","docm","mbx","ppsm","ppsx","vdx","xdb","sql","gz","bz","gz7","bz7","zip","gzip","bzip","gzip7","bzip7","rar","iso","xlc","sql","otc","kpt","odt#","pdf_","sms","xlsmhtml","pptmhtml","sites","evy","wp","wp?","txt","note","word","dochtml","docmhtml","pdt","oth","otf","dot","xlthtml","project","tar","tar.gz","tar.bz","tar.tgz","tar.tbz","rtf","ooxml","docb" ,"xls","xlsx","xlst","openxmlformats-officedocument","spreadsheetml","sheet","ms-excel","xlm","xlt","xlsm","xltx","xltm","xlsb","xla","xlam","xll","xlw","wav","mp3");
}
function research_allowed_video_audio_types(){
	return $research_allowed_file_types = array("mp3","wav","ogg","webm","avi","mp4");
}
function templates_types($type = false){
	$arr = array();
	if($type)$arr[""] = _lang("Choose type");
	$arr["pdf"] = _lang("pdf");
	$arr["doc"] = _lang("word");
	$arr["xsl"]  = _lang("excel");
	$arr["pot"] = _lang("Power point");
	$arr["pez"] = _lang("Prezi");
	$arr["img"] = _lang("image");
	$arr["zip"] = _lang("compressed  zip");
	$arr["rar"] = _lang("compressed rar");
	$arr["iso"] = _lang("compressed iso");
	return $arr;
}
function template_type_by_id($key){
	$templates = templates_types();
	return $templates[$key];
}