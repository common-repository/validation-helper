<?php
include("dirs.php");
?>


<script type="text/javascript" language="JavaScript"><!--
image1 = new Image();
image1.src = "<?php echo VH_PLUGIN_URL; ?>/images/loading.gif";
image2 = new Image();
image2.src = "<?php echo VH_PLUGIN_URL; ?>/images/valid.png";
image3 = new Image();
image3.src = "<?php echo VH_PLUGIN_URL; ?>/images/invalid.png";

var url= new Array();
var slug=new Array();
var IDs = new Array();

<?php 
global $wpdb;
$prefix=$wpdb->prefix;
$myQuery="SELECT ID,post_name,guid FROM " . $prefix . "posts WHERE post_status='publish'";
$query=mysql_query($myQuery);
$i=0;
$url=get_bloginfo('url');
$url2=get_bloginfo('url');
$url=str_replace("http://","",$url);
while ($myrow=mysql_fetch_array($query)) {
echo "slug[$i]='$myrow[post_name]';\n";

$theLink=get_permalink($myrow['ID']);
$theLink=str_replace("http://","",$theLink);
echo "url[$i]='$theLink';\n";
echo "IDs[$i]=$myrow[ID];\n";
$i++;
}
?>

var checkurl='<?php echo VH_PLUGIN_URL; ?>/check.php';


function startValidation() {
document.getElementById('tableresults').style.display = "";
document.getElementById('startbutton').style.display = "none";

var i=0;
var u=0;
while (i < url.length) {

theurl=checkurl + "?url=" + url[i] + "&slug=" + slug[i] + "&id=" + IDs[i];
jQuery.ajax({
  url: theurl,
  cache: false,
  success: function(html){
    jQuery("#results").append(html);
	u++;
	document.getElementById('checking').innerHTML='<b>Checking:</b> ' + u + '/' + url.length;
	if (u >=url.length){
document.getElementById('loadingpic').style.background='none';
document.getElementById('checking').innerHTML='';
jQuery("#sorting").fadeIn(1000);
var isgreen=jQuery('.isgreen').length;
var isred=jQuery('.isred').length;
jQuery('#totalgreen').html(isgreen);
jQuery('#totalred').html(isred);
}
  }
});
i++;
}
}

function sortBy(type) {
var type2='isgreen';

if (type == 'isgreen') {
type2='isred';
}

jQuery("." + type).fadeIn(1000);
jQuery("." + type2).fadeOut(1000);
}
//--></script>

<style type="text/css">
#results td {
padding-right: 20px;
}
#results td.first {
color:#000000;
}
</style>

<div class="wrap">
<h2>Validation Helper</h2>
<div class="updated fade"><p>Because of a noneffective and slow solution of HTML validation offered by this plugin, the support of Validation Helper has been terminated. The author recommends deactivating and deleting this plugin to all users.</p></div>

<p>Validation Helper converts your XHTML output to pure HTML.<br>After activating this plugin most of your pages and posts should be HTML valid.</p>

<h3>Validation check</h3>
<p id="startbutton" style="display:display;">This tool will allow you to check all your posts and pages against the W3C Validator. <input class="button-primary" type="button" value="Start validation check" onClick="startValidation();"></p>


<div id="tableresults" style="display:none;">
<table border="0" id="results">

<tr>
<td colspan="4" align="center" class="first">
<div id="sorting" style="display:none;">
Show: <img style="border:0px;;margin-right:2px;" src="<?php echo VH_PLUGIN_URL; ?>/images/valid.png" title="Valid" alt="Valid"><a href="javascript:sortBy('isgreen');">Valid</a> (<span id="totalgreen"></span>) | <img style="border:0px;margin-right:2px;" src="<?php echo VH_PLUGIN_URL; ?>/images/invalid.png" title="Invalid" alt="Invalid"><a href="javascript:sortBy('isred');">Invalid</a> (<span id="totalred"></span>)</div>

<div id="loadingpic" style="width:208px;height:13px;background:url(<?php echo VH_PLUGIN_URL; ?>/images/loading.gif);"> &nbsp; </div>
<span id="checking"></span>
</td>
</tr>

<tr>
<td class="first"style="width: 400px;"><b>Page/Post</b></td>
<td class="first"><b>Status</b></td>
</tr>

</table>
</div>

</div>
