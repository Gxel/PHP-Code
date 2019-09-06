<?
require("glob_config.php");
?>
<html>
<head>
<title><? echo $s_glob_programmname; ?></title>
<link rel="stylesheet" href="styles.css">
</head>
<body>


<table class="haupt" bgcolor="#D4D0C8" align="center" width="100%" height="100%" border="0">
<tr>
<? if ( strstr( getfiletype($s_totalfile) , 'image/') ) { ?>
	<td colspan="1"  align="center" valign="middle" >
		<a href="<?=str_replace($s_glob_subdirs, "http://", $s_totalfile);?>" target="_blank">
			<img src="<?=str_replace($s_glob_subdirs, "http://", $s_totalfile);?>" border="1" title="">
		</a>
	</td>
<? } elseif ( strstr( getfiletype($s_totalfile) , '/wmv') ) { ?>
	<td colspan="1"  align="center" valign="middle" >
		<OBJECT ID="MediaPlayer" classid="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95"
		CODEBASE="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701"
		standby="Loading Microsoft Windows Media Player components..."
		TYPE="application/x-oleobject">
		<PARAM NAME="FileName" VALUE="<?=str_replace($s_glob_subdirs, "http://", $s_totalfile)?>">
		<PARAM NAME="AnimationAtStart" VALUE="0">
		<PARAM NAME="Volume" VALUE="-1">
		<PARAM NAME="TransparentAtStart" VALUE="FALSE">
		<PARAM NAME="ShowControls" VALUE="1">
		<PARAM NAME="ShowDisplay" VALUE="0">
		<PARAM NAME="ShowStatusBar" VALUE="1">
		<PARAM NAME="AutoSize" VALUE="1">
		<param name="DisplayBackColor" value="65791">
		<param name="DisplayForeColor" value="0">

		<embed TYPE="application/x-mplayer2"
		pluginspage="http://www.microsoft.com/windows95/downloads/
		contents/wurecommended/s_wufeatured/mediaplayer/default.asp" SRC="<?=str_replace($s_glob_subdirs, "http://", $s_totalfile)?>"
		Name=MediaPlayer
		ShowControls=1
		ShowDisplay=0
		ShowStatusBar=1
		width=100% height=100%>
		</embed>

		</OBJECT>
	</td>
<? } else { ?>
  <td valign="top"><?=highlight_file($s_totalfile);?></td>
<? } ?>
</tr>
</table>


</body>
</html>


