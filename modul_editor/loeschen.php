<? 
$s_delfile = optimiere_verzeichnisse($s_delfile);
if ( is_dir ( $s_delfile ) ){
	$s_frage = 'Soll die markierte Verzeichnis <b>' . basename($s_delfile). '</b> wirklich gel&ouml;scht werden?';
}else{
	$s_frage = 'Soll die markierte Datei <b>' . basename($s_delfile). '</b> wirklich gel&ouml;scht werden?';
}

if ( $_SESSION["b_delete_access"] == FALSE) {
	$s_failmassage = 'Sie haben <b>keine Benutzerrechte</b> um Daten zu <b>l&ouml;schen</b>.';	
}elseif ( isset( $init_del ) &&  isset( $del ) ){
	if ( is_dir ( $s_delfile ) ){
		if ( rmdir( $s_delfile ) ){
			$s_message = "Verzeichnis erfolgreich geloescht";
		}else{
			$s_message = "Konnte Verzeichnis nicht loeschen";
			?>
			<script LANGUAGE="JavaScript">
			alert("<? echo $s_message ?>");
			</script>
			<?
		}
		$sess_dir1 = $dirs;
		$sess_dir2 = $dirs;
	}else{
		if (  unlink( $s_delfile )  ){
			$s_massage = "Datei erfolgreich geloescht";
		}else{
			$s_failmassage = "Konnte Datei nicht loeschen";
			?>
			<script LANGUAGE="JavaScript">
			alert("<? echo $s_message ?>");
			</script>
			<?
		}
	}	
	
}else{
?>
<div style="position:absolute; top:30%; left:30%;">
	<form action="<? echo $PHP_SELF; ?>" method="post" width="300">
	<input type="hidden" name="s_delfile" value="<? echo $s_delfile; ?>">
	<input type="hidden" name="init_del" value="">
	<table class="massage">
		<tr>
			<td colspan="2" class="pfad"><? echo $s_glob_programmname; ?></td>
		</tr>
		<tr>
			<td colspan="2" align="left"><? echo $s_frage ?></td>
		</tr>
		<tr>
			<td align="center">
		    		<input type="submit" name="del" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
		    		<input type="submit" value="Abbrechen">
			</td>
		</tr>
	</table>
	</form>
</div>
<? } ?>