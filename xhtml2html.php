<?php

function xhtml2html_start()	{
	ob_start("convert");
}

function convert($content)	{
	$content = str_replace(array(" />", "/>"), ">", $content);

	$correctDTD = '<!DOCTYPE html PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
	$content = preg_replace("~<!DOCTYPE html PUBLIC (\"|\')-//W3C//DTD XHTML(.+?)>~iu", $correctDTD, $content);
	$content = preg_replace("~ xmlns=(\"|\')(.+?)(\"|\')~iu", "", $content);
	$content = preg_replace("~ profile=(\"|\')(.+?)(\"|\')~iu", "", $content);
	$content = preg_replace("~ lang=(\"|\')(.+?)(\"|\')~iu", "", $content);
	$content = preg_replace("~ dir=(\"|\')(.+?)(\"|\')~iu", "", $content);

	return $content;
}


xhtml2html_start();
?>
