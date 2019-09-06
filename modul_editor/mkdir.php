<? 
if ( $_SESSION["b_mkdir_access"] == FALSE) {
	$s_failmassage = 'Sie haben <b>keine Benutzerrechte</b> um Verzeichnisse zu <b>erstellen</b>.';	
}elseif ( isset( $init_mkdir ) &&  isset( $mkdir ) ){
	mkdir ($s_newfiledir . '/' . $s_newdir, 0777);	
}else{
?>
<div style="position:absolute; top:30%; left:30%;">
	<form action="<? echo $PHP_SELF; ?>" method="post" width="300">
	<input type="hidden" size="10" name="s_newfiledir" value="<? echo $s_newfiledir; ?>">
	<input type="hidden" size="10" name="init_mkdir" value="">
	<table class="massage">
		<tr>
			<td colspan="2" class="pfad"><? echo $s_glob_programmname; ?></td>
		</tr>
		<tr>
			<td colspan="2" align="left">Neuer Ordner (Verzeichnis)</td>
		</tr>
		<tr>
			<td colspan="2" align="left"><? echo $s_newfiledir; ?></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="text" size="40" name="s_newdir" value="<? echo $s_newfile; ?>"></td>			
		</tr>
		<tr>
			<td align="center">
		    		<input type="submit" name="mkdir" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
		    		<input type="submit" value="Abbrechen">
			</td>
		</tr>
	</table>
	</form>
</div>
<? } ?>
