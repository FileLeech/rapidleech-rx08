<?php
define('RAPIDLEECH', 'yes');
error_reporting(0);

$maxf=25;
define('MISC_DIR', 'misc/');
define('CLASS_DIR', 'classes/');
define('CONFIG_DIR', './');
define('LANG_DIR', 'languages/');
$PHP_SELF = !$PHP_SELF ? $_SERVER["PHP_SELF"] : $PHP_SELF;

$rev_num = '36B.Rv6';
$RL_VER = 'Rx08.ii'.$rev_num;
require_once(CONFIG_DIR."config.php");
require_once(CLASS_DIR."other.php");

// Load languages set for lynx
$vpage = "lynx";
require_once(LANG_DIR."language.$lang.inc.php");
$charSet = (isset($charSet) && !empty($charSet) ? $charSet : 'charset=UTF-8');
define('DOWNLOAD_DIR', (substr($download_dir, 0, 6) == "ftp://" ? '' : $download_dir));
define('TPL_PATH', 'tpl'. '/' . $csstype . '/');
define('IMAGE_DIR', MISC_DIR . TPL_PATH);

$show_del = $deletelink_in_lynx;

#=====================
if(!$forbid_lynx){
 if ($login===true){
 if(!isset($_SERVER['PHP_AUTH_USER']) || ($loggeduser = logged_user($users)) === false)
	{
		header("WWW-Authenticate: Basic realm=\"Rx08\"");
		header("HTTP/1.0 401 Unauthorized");
		exit("<html>$nn<head>$nn<title>:: $RL_VER ::</title>$nn<meta http-equiv=\"Content-Type\" content=\"text/html; $charSet\"><style type=\"text/css\">$nn<!--$nn@import url(\"".IMAGE_DIR."style_sujancok".$csstype.".css\");$nn-->$nn</style>$nn</head>$nn<body>$nn<h1>$RL_VER: NuLL</h1>$nn</body>$nn</html>");
	}
 }
}else {
 echo "<html>$nn<head>$nn<title>:: $RL_VER ::</title>$nn<meta http-equiv=\"Content-Type\" content=\"text/html; $charSet\">$nn<style type=\"text/css\">$nn<!--$nn@import url(\"".IMAGE_DIR."style_sujancok".$csstype.".css\");$nn-->$nn</style></head>$nn<body>$nn<h1>:: $RL_VER :: <br>Lynx Disabled</h1>$nn</body>$nn</html>";
 exit();
}


define('VERSION', "[ TuxiNuX::TimSukses ][ ccpb::kaskus ]");
$page = 'lynx';
?>

<!DOCTYPE html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<title>LynX :: <?php echo $RL_VER;?> ::</title>
<meta http-equiv="Content-Type" content="text/html; <?php echo $charSet;?>">
<link rel="shortcut icon" href="<?php echo IMAGE_DIR.'idmdl.gif?'.rand(11,9999);?>" type="image/gif">
<script type="text/javascript" src="<?php echo MISC_DIR;?>js.php?lynx"></script>
<script type="text/javascript">
function showAll(){
  if(getCookie("showAll") == 1){
    deleteCookie("showAll");
  }else{
    d.cookie = "showAll = 1;";
  }
  location.href = "<?php echo $PHP_SELF."?act=files"; ?>"; 
}

function clk(idck){
  var cur = d.getElementById(idck).checked;
  d.getElementById(idck).checked = !cur;
}
</script>
<style type="text/css">
<!--
@import url("<?php print IMAGE_DIR;?>style_sujancok<?php print $csstype;?>.css");
-->
.tdheadolgo { 
 background: transparent no-repeat url(<?php print IMAGE_DIR;?>rl_lgo.png);
}
</style>
</head><body>
<div class="head_container"><center>
<a href="<?php echo $index_file;?>" alt="Rapidleech 2.3"><div class="tdheadolgo">&nbsp;</div></a></center>
</div>
<center>
<?php
//SHOW TIME WORK
$is_worktime = cek_worktime($workstart, $workend);
if(!$is_worktime && $limit_timework){
  $limitmsg="";
  if(!$is_worktime){
    if(!empty($limitmsg)){$limitmsg.="<br>";}$limitmsg.=$gtxt['worktime_alert'];
    echo "<div style=\"padding-top:20px;padding-bottom:20px;\"><div class=\"warn_alert\">$limitmsg</div></div>";
  }
}
else
{

?>
<noscript>
<p><b><?php echo $gtxt['js_disable'];?></b></noscript>
<!--
    <table class="tab-content" id="tb1" name="tb" cellspacing="5" width="100%"><tr><td align="center" style="font-size:15px;">	<br> <b>Under Maintenance...!</b> <br><br>Sorry for this inconvenience!<br><br></td></tr></table>
-->

<?php
$c = 0;
$total_size = 0;
$nn = "\n";

// true in _create_list mean never count md5_file()
_create_list(true);
if($list)
{
  if ($show_all === true){
   unset($Path);
  }
?>
<link media="screen" rel="stylesheet" type="text/css" href="<?php echo MISC_DIR;?>jQ_fb.css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo MISC_DIR;?>jQ_fb.js"></script>
<script language="javascript">
//=============================================AJAX=============================================
jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loading_image : 'loading.gif',
        close_image   : 'closelabel.gif'
      }) 
});

$.facebox.settings.loadingImage = '<?php echo MISC_DIR;?>facebox/loading.gif';


//==============================================//==============================================
var dFile = new Object();
var text = "", thead, tfoot;

<?php 
 
 echo "var _dlpath = '".($download_dir != "" ? "$download_dir" : "/")."';$nn$nn";
 foreach($list as $key => $file)
  {
  if(file_exists($file["name"])){
	 $c++;
     $total_size+=filesize($file["name"]);	 
	 echo 'dFile["'.$file["date"].'"] = new Object();'.$nn;
	 echo 'dFile["'.$file["date"].'"]["name"] = "'.basename($file["name"]).'"'.$nn;
	 echo 'dFile["'.$file["date"].'"]["size"] = "'.$file["size"].'"'.$nn;
	 $rnd = rand(11,99);
	 echo 'dFile["'.$file["date"].'"]["delkey"] = "'.str_replace("=","", rotN(base64_encode($file["date"].':'.'4puZ'), $rnd))."-".$rnd.'"'.$nn;	 	
	}
  } // end loop all files
	  
  echo 'total_size = "'.$total_size.'";'."$nn";
  echo 'c = "'.$c.'";'."$nn";
?>
   
   thead = "<table id='fltbl' cellpadding='1' cellspacing='1'  style='display: none;'>";
   thead+= "<tr valign='bottom' align='center' class='filelist_title'>";
   thead+= "<td></td>";
   thead+= "<td align=right><b>&nbsp;<?php echo $ltxt['_fname'];?> &nbsp;</b></td>";
   thead+= "<td align=left><b>&raquo;&nbsp;|&nbsp;<?php echo $gtxt['tabel_sz'];?>&nbsp;</b></td>";
   thead+= "<td><b>&nbsp;<?php echo $gtxt['tabel_dt'];?></b></td>";
   thead+= "<?php if($show_del && !$disable_deleting){?><td><b>&nbsp;<?php echo $gtxt['act_del'];?></b></td><?php }?></tr>";
   
   tfoot = "<tfoot>";
   tfoot+= "<tr class='filelist_title'><td><input type=checkbox id='chksAll' onClick='javascript:sAll(this.checked);'></td>";
   tfoot+= "<td id='totfile'><?php echo 'Total : <b class=\"y\">'.$c.'</b> file(s)';?></td>";
   tfoot+= "<td align='right' id='totsz'><?php echo '<b class=\"y\">'.bytesToKbOrMbOrGb($total_size).'</b>';?> </td>";
   tfoot+= "<td align=right></td><?php  if($show_del && !$disable_deleting){?><td></td><?php }?></tr></tfoot>";
   
   
   var dtemplate = "<tr id='brs((chkidx))' class='rowlist' onMouseDown='clk(\"chkfL-((chkidx))\")' onMouseOut='if(document.getElementById(\"chkfL-((chkidx))\").checked){this.className=\"rowlist_checked\";}else{this.className=\"rowlist\";}'>";
   dtemplate+= "<td><input type=checkbox id='chkfL-((chkidx))' onClick='clk(\"chkfL-((chkidx))\")'></td>";
   dtemplate+= "<td align=right><span id='fN-((chkidx))'>((filename))</span></td>";
   dtemplate+= "<td align=left><a id='fL-((chkidx))' href='((dlpath))((filename))' title='((filename))'><img src=\'<?php echo IMAGE_DIR;?>idmdl.gif\'></a>[<b>((filesize))</b>]</td>";
   dtemplate+= "<td align=right>&nbsp;&nbsp;((formatdate))</td>";
   
   /*Old Trick(window pop-up):
   <a id='dL-((chkidx))' title='Delete: ((filename))' href='del.php?d=((b64filename))' onclick='opennewwindow(this.id);return false;'>
   */
   
   dtemplate+= "<?php  if($show_del && !$disable_deleting){?><td align=center><a id='dL-((chkidx))' title='Delete: ((filename))' href='del.php?d=((b64filename))&lineid=((chkidx))' rel='facebox'> <img src='<?php echo IMAGE_DIR;?>rldel.png'></a></td><?php }?>";
   dtemplate+= "</tr>";
	//  chkidx; filename; dlpath; filesize; formatdate; b64filename; 
</script>

<script language="javascript">
   function trparser()
   {
     var _tpl = "", i = 0;
	 for(var date in dFile)
	 {
	   pfile = dFile[date];
	   _tpl = dtemplate;
	   // do replacement string;  10-May-2009, 23:09
	   var now = new Date(parseInt(date) * 1000);
	   dDate = now.toGMTString("dd-mmm-yy, HH:MM");
	   dDate = dDate.split(" ");
	   _tpl = _tpl.replace(/\(\(chkidx\)\)/g, i);
	   _tpl = _tpl.replace(/\(\(filename\)\)/g, pfile["name"]);
	   _tpl = _tpl.replace(/\(\(filesize\)\)/g, pfile["size"]);
	   _tpl = _tpl.replace(/\(\(formatdate\)\)/g, dDate[1]+'-'+dDate[2]+'-'+dDate[3].substr(2,2)+', '+dDate[4].substr(0,2)+':'+dDate[4].substr(3,2));
	   _tpl = _tpl.replace(/\(\(dlpath\)\)/g, _dlpath);
	   _tpl = _tpl.replace(/\(\(b64filename\)\)/g, pfile["delkey"]);
	   text+= _tpl;
	   i++;
	 }
   }
   
</script>
<br>
<?php
}
else
{
	echo "<br><span class='warn_alert' style='padding:0 100px 0 100px;'><b>".$gtxt['tabel_no_file']."</b></span><br>";
}

if($show_all === true)
  {
?>
<a href="javascript:showAll();"><?php echo $gtxt['_show']."&nbsp;";?>
<script language="JavaScript">
if(getCookie("showAll") == 1)
  {
  document.write("<?php echo $gtxt['_downloaded'];?>");
  }
else
  {
  document.write("<?php echo $gtxt['_everything'];?>");
  }
function clk(idck)
{
  var cur = document.getElementById(idck).checked;
  document.getElementById(idck).checked = !cur;
}
</script></a>
<?php
  }else{
  ?>
<script language="JavaScript">
  deleteCookie("showAll");
</script>
<?php
  }
?>

&nbsp;<input class="refresh" onclick="location.reload();" alt="Refresh" title="Refresh" type="image" src="<?php echo IMAGE_DIR;?>refresh.png" style="vertical-align:bottom;" >
	
	
<table id='tblbaru'>
<tr><td>

<div id="dtblbaru"></div>

</td></tr>
</table>



<script language="javascript">
var dwindow = '<?php echo '_'.substr(md5(time()),0,7).'_'; ?>';
var idwindow = new Array();
function opennewwindow(id) {
	var options = "width=700,height=250,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,copyhistory=no";
	var start_link = document.getElementById(id);
	idwindow[id] = window.open(start_link, dwindow+id, options);
	idwindow[id].opener=self;
	idwindow[id].focus();
}

function sAll(niLai){
	var dc;
	diq=document.getElementById('add_comment').checked=false;
	document.getElementById('comment').style.display='none';
	for (i=0;i< <?php echo $c;?> ;i++) {
	   document.getElementById('chkfL-'+i).checked=niLai;
	   dc = document.getElementById('brs'+i);
	   //if(niLai){dc.bgColor='#B1F4AE';}else{dc.bgColor='#D49659';}
	   if(niLai){dc.className='rowlist_checked';}else{dc.className='rowlist';}
	}
}

function highlight(field) {
        field.focus(); field.select(); }


function GenTag(){
var displ=document.getElementById('add_comment').checked?'':'none';

if(!displ){
var chk,buFF="",kd=unescape("%B2"),nC=<?php echo $c;?>,cLnk=0,AdL=<?php echo $auto_del_time; ?>;
var ttip="",ttip2="",ttip3="",ttip4="",delink="";
var Simultan = true; //set this true if your server allow simultan download 
var codeTagOnly = document.getElementById('wterm').checked ? false:true; //true is without Term of Download
var DelLink = <?php if($show_del){?>document.getElementById('dellnk').checked ? true:false;<?php }else{echo 'false;';}?> //true is with Delete Link
var poslynx, hostpath = document.location.href;
poslynx = hostpath.lastIndexOf("/");
hostpath = hostpath.substring(0,poslynx+1);
  if(!codeTagOnly){
	ttip="\n[SIZE=1]Term of Download:";
	if(!Simultan)ttip2="\n-Gak bisa simultan, (kudu hiji"+kd+"||satu"+kd+")"; 
	if(AdL>0)ttip3="\n-Limit: AutoDelete: [b][color=red]" + AdL +" hour(s)[/color][/b]";
	if(DelLink)ttip3+="\n-Delete the file(s) using [i]Delete-Link[/i] after ur download's done";
	ttip4="\n-[color=red]JANGAN post link hasil sulap di thread[/color]";
	ttip4+="\n[center]\n[IMG]http://www.kaskus.us/images/smilies/sumbangan/smiley_beer.gif[/IMG][/center]";
  }
  
  delink="\n[SPOILER=Delete-Link][SIZE=2]";
  
  for (i=0;i< nC ;i++) {
    chk=document.getElementById('chkfL-'+i).checked;
	if((chk)&&(chk!='')) {
		buFF=buFF+"\n"+ (document.getElementById('fL-'+i));
		if(DelLink){
		   dL = document.getElementById('dL-'+i).href;		   
		   dL = dL.substring(0, dL.indexOf('&lineid'));
		   delink=delink+"\n"+ dL;
		}
		cLnk++;
	}
  }
  delink=delink+"\n[/SIZE][/SPOILER]";
  if(buFF!=''){
	buFF="[CODE]" + (buFF) + "\n[/CODE]";
	if(DelLink){buFF=buFF+delink;}
	buFF+=ttip;
	if(cLnk>1){buFF+=ttip2+ttip3;}
	else{buFF+=ttip3;}
	buFF+=ttip4;
	if(!codeTagOnly){ buFF+="[/SIZE]";}
  }
}
var dca = document.getElementById('comment');
var trwarn = document.getElementById('warn_alert');
if(buFF!="")
 { dca.style.display=displ;
   document.getElementById('cmtarea').value=buFF;
   trwarn.style.display = 'none';
 }
 else{
   dca.style.display='none';
   document.getElementById('td_warn').innerHTML = '<div class="acthistory_result" style="width:200px;">Error, No Selected Files</div>';
   trwarn.style.display = '';
   
 }
 
}

</script>


<table width="60%" align=center cellpadding="0" cellspacing="0">
<tbody id="checknavigat" style="DISPLAY: none;">
<tr id="warn_alert" style="display:none;"><td id="td_warn" align=center></td></tr>
<tr>
<td align="center">
<label><input type="checkbox" name="wterm" id="wterm" onClick="javascript:GenTag();" checked>&nbsp;<?php echo $ltxt['_term'];?> </label>&nbsp;&nbsp;
<?php if($show_del){?>
 <label><input type="checkbox" name="dellnk" id="dellnk" onClick="javascript:GenTag();">&nbsp;<?php echo $ltxt['_deletelink'];?></label>&nbsp;&nbsp;
<?php
}
?>
<input type="checkbox" name="add_comment" id="add_comment" onClick="javascript:GenTag();">&nbsp;<a onClick="javascript:var diq=document.getElementById('add_comment');if(!diq.checked){diq.checked=true;}GenTag();"><u><label for="cmtarea"><?php echo $ltxt['_genlink'];?></label></u></a>
</td></tr>
<tr id="comment" style="DISPLAY: none;">
<td align="center">
<textarea id="cmtarea" name="comment" rows="5" style="color:#666; width:90%; font-family:verdana,lucida,arial; font-size: 7pt;" readonly="yes" onFocus='highlight(this);'></textarea>
<br/>
</td></tr>
</tbody>

<?php
}
?>
<tr align=center><td id="usage"><br>
<?php
if($auto_del_time>0)
	{
	echo "<span class=\"c\">".$gtxt['_autodel'].":&nbsp;<b class=\"g\">".$auto_del_time."</b>&nbsp;hour".($auto_del_time>1?"s":"")."</span>";
    //auto_del($auto_del_time);
    purge_files($auto_del_time);
	}
if($lowlimitsize>0)
	{
	echo "&nbsp;||&nbsp;<span class=\"c\">".$gtxt['_minfilesize'].":&nbsp;<b class=\"s\">".$lowlimitsize."</b>&nbsp;MB</span>";
	}
if($limitsize>0)
	{
	echo "&nbsp;||&nbsp;<span class=\"c\">".$gtxt['_maxfilesize'].":&nbsp;<b class=\"s\">".$limitsize."</b>&nbsp;MB</span>";
	}
if(!empty($add_ext_5city))
	{
	echo "&nbsp;||&nbsp;<span class=\"c\">".$gtxt['_fakeext'].":&nbsp;<b><a style=\"color:red;\" href=\"javascript:void(0);\" title=\"Auto rename extension with this\">.$add_ext_5city</a></b></span>";
	}
if($limit_timework)
	{
	echo "<br><span class=\"c\">".$gtxt['_timework'].":&nbsp;</span><b class=\"s\">$workstart</b>&nbsp;upto&nbsp;<b class=\"s\">$workend</b>";
	}
?>
<br>

<?php
if($server_info || $show_sinfo){if(@file_exists(CLASS_DIR."sinfo.php")) require_once(CLASS_DIR."sinfo.php");}else echo "<hr>";
?> 


 </td>
</tr><tr><td>
<div align="center">

<?php print VERSION; ?>
<hr>
</div></td>
</tr>
</table>



<?php
if($list){
?>
<script type="text/javascript">
 trparser();
 var dtabelbaru = document.getElementById("tblbaru").getElementsByTagName("div")[0];
 dtabelbaru.innerHTML = thead + text + tfoot;
 document.getElementById('fltbl').style.display='';
 document.getElementById('checknavigat').style.display='';
</script> 
<?php
}
?>
</body></html><br>