<?
include("glob_config.php");
?>
<html>

<head>
	<title><? echo $s_glob_programmname; ?></title>
	<link rel="stylesheet" href="styles.css">
</head>


<body>
<?




//Optionen werden geladen / initialisiert
if ( isset( $mkdir ) ){
	include('mkdir.php');	
}elseif( isset( $del ) ) {
	include('loeschen.php');
}elseif( isset( $mkfile ) ) {
	include('mkfile.php');
}elseif( isset( $kopieren ) ) {
	include('kopieren.php');
}elseif( isset( $upfile ) ) {
	include('upload.php');
}
//Optionen wurden geladen / initzialisiert



if ($dir1) {	
	$_SESSION["sess_dir1"] = $dir1;
}elseif( session_is_registered("sess_dir1") ){
	$dir1 = $sess_dir1;
}else{
	$dir1 = $dirs;
}

if ($dir2) {
	$_SESSION["sess_dir2"] = $dir2;
}elseif ( session_is_registered("sess_dir2") ){
	$dir2 = $sess_dir2;
}else{
	$dir2 = $dirs;
}


if ( strlen($dirs) > strlen( $dir1  )-4 ) 
{
  $_SESSION["sess_dir1"] = $dirs;
  $dir1 = $dirs;
}

if ( strlen($dirs) > strlen( $dir2  )-4 ) 
{
  $_SESSION["sess_dir2"] = $dirs;  
  $dir2 = $dirs;
}



$dir1 = optimiere_verzeichnisse($dir1);
$dir2 = optimiere_verzeichnisse($dir2);
if ( $onbox == 1 ){	
	$focus_dir_vis	= $dir1;
}else{ 	
	$focus_dir_vis	= $dir2;
} 


//verzeichnisse / init Variablen
$d = dir($dir1);
$count_dirs = 0;
$connt_files = 0;
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ 
		
	
		
?>
<table class="haupt" bgcolor="#D4D0C8" align="center" width="100%" height="100%" border="0">
<? if ( isset($s_failmassage)  ){ ?>
	<tr>
		<td colspan="11" valign="top" bgcolor="red">
			<? echo $s_failmassage ?>
		</td>
	</tr>
<? }elseif ( isset($s_massage) ){ ?>
	<tr>
		<td colspan="11" valign="top" bgcolor="green">
			<? echo $s_massage ?>
		</td>
	</tr>
<? } ?>
<tr>
	<td colspan="11" valign="top" border="1">
	<table class="haupt" align="left" valign="top" border="0" bgcolor="#FFFFFF" cellspacing="1" cellpadding="1" width="49.5%">
	<tr>
		<td class="pfad" colspan="11"><? echo $d->path; ?></td>
	</tr>
	<tr>
		<td valign="middle" class="overtxt">Name</td>
		<td valign="middle" class="overtxt">Erw.</td>
		<td valign="middle" class="overtxt">Gr&ouml;sse</td>
		<td valign="middle" class="overtxt">Datum</td>
		<td valign="middle" class="overtxt">Attr.</td>
	</tr>
	<?
	//Verzeichnisse werden geladen //////////////////////////////////////////////////////////////
	while( $file1 = $d->read() ) {
		if ( is_dir($dir1.'/'.$file1) ) { ?>
			<tr>
				<? if ( $file1 == '..' ) { ?>
					<? if ( $dirs <> $dir1 || $admin == 1 )  {?>
					    <td valign="middle">
							<a href="<? echo $PHP_SELF . '?dir1=' . $dir1 . '/' . $file1. '&onbox=1'; ?>">
								<img src="images/pfeil.gif" border="0">&nbsp;[<? echo $file1; ?>]
							</a>
						</td>
						<td valign="middle"></td>
						<td valign="middle">&lt;DIR&gt;</td>
						<td valign="middle"><? echo date("d.m.Y G:i:s",fileatime($dir1.'/'.$file1));  ?></td>
						<td valign="middle"><? echo fileperms($dir1.'/'.$file1); ?></td>
					<? } ?>
				<? } elseif ( $file1 == '.' ) {?>
				
					<? // nichts machen?>
					
				<? } else { ?>
					<td valign="middle">
						<a href="<? echo $PHP_SELF . '?dir1=' . $dir1 . '/' . $file1 . '&onbox=1'; ?>">	
							<img src="images/register.gif" border="0">&nbsp;[<? echo $file1; ?>]
						</a>										
					</td>
					<td valign="middle"></td>
					<td valign="middle">&lt;DIR&gt;</td>
					<td valign="middle"><? echo date("d.m.Y G:i:s",fileatime($dir1.'/'.$file1));  ?></td>
					<td valign="middle"><? echo fileperms($dir1.'/'.$file1); ?></td>
				<? } ?>
			</tr>
			<?
			$count_dirs++;
		}
	}
	$d->close();
	// Verzeichnisse wurde geladen ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ 
	

	//Daten werden geladen ////////////////////////////////////////////////////////////////////////
	$d = dir($dir1);		
	while( $file1 = $d->read() ) {
		if ( !is_dir($dir1.'/'.$file1) ) { ?>
			<tr>
				<td>
					<a href="<? echo $PHP_SELF . '?focus_file=' . $file1 . '&onbox=1#bottom'; ?>">
						<? if ( strstr( getfiletype($file1) , '/wmv') ) { ?>
							<img src="images/zettel_mediaplayer.gif" border="0">&nbsp;<? echo $file1; ?>
						<? } elseif ( strstr( getfiletype($file1) , 'image/') ) { ?>
							<img src="<?=str_replace($s_glob_subdirs, "http://", $dir1).'/'.$file1?>" border="0" height="14" width="14" >&nbsp;<? echo $file1; ?>
						<? }else{ ?>
							<img src="images/zettel.gif" border="0">&nbsp;<? echo $file1; ?>
						<? } ?>
					</a>
				</td>
				<td valign="middle"></td>
				<td valign="middle"><? echo (filesize($dir1.'/'.$file1) / 1000);  ?></td>
				<td valign="middle"><? echo date("d.m.Y G:i:s",fileatime($dir1.'/'.$file1));  ?></td>
				<td valign="middle"><? echo fileperms($dir1.'/'.$file1); ?></td>
			</tr>
			<?
			$connt_files++;
		}
	}
	$d->close();
	//Daten wurden geladen ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ 	
	?>
	<tr>
		<td colspan="11" bgcolor="#D4D0C8"><font size="2"><b><? echo $count_dirs-2; ?> Verzeichnis(se) und <? echo $connt_files; ?> Daten</b></font></td>
	</tr>
	</table>	
	<?
	///////////////////////////////////////// TABELLEN TRENNUNG ////////////////////////	
	?>
	<table class="haupt" valign="top" align="left" border="1" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" width="1%" height="100%">
	<tr>
		<td></td>
	</tr>
	</table>
	<?
	///////////////////////////////////////// TABELLEN TRENNUNG ////////////////////////		
	$dir2 = optimiere_verzeichnisse($dir2);
	$d = dir($dir2);
	$count_dirs = 0;
	$connt_files = 0;	
	?>
	<table class="haupt" align="left" valign="top" border="0" bgcolor="#FFFFFF" cellspacing="1" cellpadding="1" width="49.5%">
	<tr>
		<td class="pfad" colspan="6"><? echo $d->path; ?> </td>
	</tr>
	<tr>
		<td valign="middle" class="overtxt">Name</td>
		<td valign="middle" class="overtxt">Erw.</td>
		<td valign="middle" class="overtxt">Gr&ouml;sse</td>
		<td valign="middle" class="overtxt">Datum</td>
		<td valign="middle" class="overtxt">Attr.</td>
	</tr>
	<?
	//Verzeichnisse werden geladen //////////////////////////////////////////////////////////////
	while( $file2 = $d->read() ) {
		if ( is_dir($dir2.'/'.$file2) ) { ?>
			<tr>
				<? if  ( $file2 == '..' )  { ?>
					<? if ( $dirs <> $dir2 || $admin == 1 )  {?>
						<td valign="middle">
							<a href="<? echo $PHP_SELF . '?dir2=' . $dir2 . '/' . $file2. '&onbox=2'; ?>">
								<img src="images/pfeil.gif" border="0">&nbsp;[<? echo $file2; ?>]
							</a>
						</td>
						<td valign="middle"></td>
						<td valign="middle">&lt;DIR&gt;</td>
						<td valign="middle"><? echo date("d.m.Y G:i:s",fileatime($s_zieldir2.'/'.$s_dir2));  ?></td>
						<td valign="middle"><? echo fileperms($s_zieldir2.'/'.$s_dir2); ?></td>
					<? } ?>
				<? } elseif ( $file2 == '.' ) {?>
				
					<? // nichts machen?>
				
				<? } else { ?>
					<td valign="middle">
						<a href="<? echo $PHP_SELF . '?dir2=' . $dir2 . '/' . $file2. '&onbox=2'; ?>">
								<img src="images/register.gif" border="0">&nbsp;[<? echo $file2; ?>]
						</a>
					</td>
					<td valign="middle"></td>
					<td valign="middle">&lt;DIR&gt;</td>
					<td valign="middle"><? echo date("d.m.Y G:i:s",fileatime($s_zieldir2.'/'.$s_dir2));  ?></td>
					<td valign="middle"><? echo fileperms($s_zieldir2.'/'.$s_dir2); ?></td>
				<? } ?>
			</tr>
			<?
			$count_dirs++;
		}
	}
	$d->close();
	//Verzeichnisse wurden geladen ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ 
	
	//Daten werden geladen /////////////////////////////////////////////////////////////////////// 
	$d = dir($dir2);		
	while( $file2 = $d->read() ) {
		if ( !is_dir($dir2.'/'.$file2) ) { ?>
			<tr>
				<td valign="middle">
					<a href="<? echo $PHP_SELF . '?focus_file=' . $file2 . '&onbox=2#bottom'; ?>">
						<? if ( strstr( getfiletype($file2) , '/wmv') ) { ?>
							<img src="images/zettel_mediaplayer.gif" border="0">&nbsp;<? echo $file2; ?>
						<? } elseif ( strstr( getfiletype($file2) , 'image/') ) { ?>
							<img src="<?=str_replace($s_glob_subdirs, "http://", $dir2).'/'.$file2?>" border="0" height="14" width="14" >&nbsp;<? echo $file2; ?>
						<? } else { ?>
							<img src="images/zettel.gif" border="0">&nbsp;<? echo $file2; ?>
						<? } ?>
					</a>
				</td>
				<td valign="middle"></td>
				<td valign="middle"><? echo (filesize($dir2.'/'.$file2) / 1000);  ?></td>
				<td valign="middle"><? echo date("d.m.Y G:i:s",fileatime($dir2.'/'.$file2));  ?></td>
				<td valign="middle"><? echo fileperms($dir2.'/'.$file2); ?></td>
			</tr>
			<?
			$connt_files++;
		}
	}
	$d->close();	
	//Daten wurden geladen ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ 
	?>
	<tr>
		<td colspan="11" bgcolor="#D4D0C8"><font size="2"><b><? echo $count_dirs-2; ?> Verzeichnis(se) und <? echo $connt_files; ?> Daten</b></font></td>
	</tr>
	</table>
	</td>
</tr>
<tr>
	<td colspan="11" align="right" valign="middle"><hr></td>
</tr>
<tr height="10">
	<td colspan="10" align="right" valign="middle">
		<b><? echo $focus_dir_vis; ?>&gt;</b><input type="text" size="40" name="s_editdir" value="<? echo $focus_file ?>">
	</td>
	<? if ( strstr( getfiletype($focus_file) , 'image/') ) { ?>
		<td colspan="1"  align="center" valign="middle" >
			<a href="<?=str_replace($s_glob_subdirs, "http://", $focus_dir_vis).'/'.$focus_file?>" target="_blank">
				<img src="<?=str_replace($s_glob_subdirs, "http://", $focus_dir_vis).'/'.$focus_file?>" border="1" title="<?=$focus_file ?>" height="50" width="50">
			</a>
		</td>
	<? } ?>
</tr>
<tr>
	<td colspan="11" align="right" valign="middle"><hr></td>
</tr>
<tr>
	<td colspan="1" align="center"><a href="<? echo 'anzeige.php?s_totalfile=' . $focus_dir_vis . '/' . $focus_file; ?>" target="_blank" class="menu">&nbsp;&nbsp;Anzeige&nbsp;&nbsp;</a></td>
	<td colspan="1" align="center">|</a>
	<td colspan="1" align="center"><a href="<? echo 'bearbeiten.php?s_editdir=' . $focus_dir_vis . '/' . $focus_file; ?>" target="_blank" class="menu">&nbsp;&nbsp;Bearbeiten&nbsp;&nbsp;</a></td>
	<td colspan="1" align="center">|</a>
	<td colspan="1" align="center"><a href="<? echo $PHP_SELF . '?s_copyfile=' . $focus_dir_vis . '/' . $focus_file . '&onbox=' . $onbox . '&kopieren' ?>" class="menu">&nbsp;&nbsp;Kopieren&nbsp;&nbsp;</a></td>
	<td colspan="1" align="center">|</a>
	<td colspan="1" align="center"><a href="<? echo $PHP_SELF . '?s_newfiledir=' . $focus_dir_vis . '&mkfile' ?>" class="menu">&nbsp;&nbsp;MkFile&nbsp;&nbsp;</a></td>
	<td colspan="1" align="center">|</a>
	<td colspan="1" align="center"><a href="<? echo $PHP_SELF . '?s_newfiledir=' . $focus_dir_vis . '&mkdir' ?>" class="menu">&nbsp;&nbsp;MkDir&nbsp;&nbsp;</a></td>
	<td colspan="1" align="center">|</a>
	<td colspan="1" align="center"><a href="<? echo $PHP_SELF . '?s_updir=' . $focus_dir_vis . '&upfile' ?>"  class="menu">&nbsp;&nbsp;Upload&nbsp;&nbsp;</a></td>
</tr>
<tr><td colspan="11"><hr></td></tr>
<tr>
	<td colspan="1" align="center"><a href="<? echo $PHP_SELF . '?reset=1' ?>" class="menu">&nbsp;&nbsp;Reset&nbsp;&nbsp;</a></td>
	<td colspan="1" align="center">|</a>
	<td colspan="1" align="center"><a href="#" class="menu">&nbsp;&nbsp;NC&nbsp;&nbsp;</a></td>
	<td colspan="1" align="center">|</a>
	<td colspan="1" align="center"><a href="#" class="menu">&nbsp;&nbsp;NC&nbsp;&nbsp;</a></td>
	<td colspan="1" align="center">|</a>
	<td colspan="1" align="center"><a href="#" class="menu">&nbsp;&nbsp;NC&nbsp;&nbsp;</a></td>
	<td colspan="1" align="center">|</a>
	<td colspan="1" align="center"><a href="<? echo $PHP_SELF . '?s_delfile=' . $focus_dir_vis. '/' . $focus_file . '&del' ?>" class="menu">&nbsp;&nbsp;L&ouml;schen&nbsp;&nbsp;</a></td>
	<td colspan="1" align="center">|</a>
	<? if ($focus_file){ ?>
		<td colspan="1" align="center"><a href="<? echo 'download.php?s_download_dir=' . $focus_dir_vis . '&s_dat=' . $focus_file; ?>" class="menu">&nbsp;&nbsp;Download&nbsp;&nbsp;</a></td>
	<? }else{ ?>
		<td colspan="1" align="center"><a href="#" class="menu">&nbsp;&nbsp;Download&nbsp;&nbsp;</a></td>
	<? } ?>
</tr>
</table>

<a name="bottom">&nbsp;</a>

</body>
</html>
