<?php
include("dirs.php");

$theurl=$_GET['url'];
$theurl2=$_GET['url'];
$pageslug=$_GET['slug'];

$theID=$_GET['id'];
//$theurl=urlencode($theurl2);
$theurl="http://" . $theurl;
$checkurl="http://validator.w3.org/check?uri=" . $theurl;

$ch = curl_init();
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_URL, $checkurl);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 20);
curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.11) Gecko/20071127 Firefox/2.0.0.11');

// Only calling the head
curl_setopt($ch, CURLOPT_HEADER, true); // header will be at output
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD'); // HTTP request is 'HEAD'

$content = curl_exec ($ch);
curl_close ($ch);

$result=explode("\n",$content);
/*
echo "<pre>";
print_r($result);
echo "</pre>";
*/

$stat=$result[5];
$stat1=explode(":",$stat);
$status=trim($stat1[1]);

$errors=$result[6];
$err1=explode(": ",$errors);
$errors=$err1[1];
$thelink="<a href=\"$theurl\">$pageslug</a>";
$errors="<a href=\"$checkurl\" target=\"_blank\">$errors errors</a>";

if (isset($_GET['replace'])) {
if ($status == 'Invalid') {
echo "<td>" . $thelink . "</td>
<td><img style=\"border:0px;margin-right:2px;\" src=\"". VH_PLUGIN_URL ."/images/invalid.png\" title=\"Invalid\" alt=\"Invalid\">".$errors ."</td>";

}else{

echo "<td>" . $thelink . "</td>
<td><img style=\"border:0px;margin-right:2px;\" src=\"". VH_PLUGIN_URL ."/images/valid.png\" title=\"Valid\" alt=\"Valid\">".$errors ."</td>";
}

}else{
if ($status == 'Invalid') {
echo "<tr class=\"isred\" id=\"row_" . $theID . "\">
<td>" . $thelink . "</td>
<td><img style=\"border:0px;margin-right:2px;\" src=\"". VH_PLUGIN_URL ."/images/invalid.png\" title=\"Invalid\" alt=\"Invalid\">".$errors ."</td>
</tr>";

}else{

echo "<tr class=\"isgreen\">
<td>" . $thelink . "</td>
<td><img style=\"border:0px;margin-right:2px;\" src=\"". VH_PLUGIN_URL ."/images/valid.png\" title=\"Valid\" alt=\"Valid\">".$errors ."</td>
</tr>";
}
}
?>
