<? 

if ( $_SESSION["b_copy_access"] == FALSE) {
	$s_failmassage = 'Sie haben <b>keine Benutzerrechte</b> um Daten zu <b>kopieren</b>';	
}elseif ( isset( $init_kopieren ) &&  isset( $kopieren ) ){
	if ( copy ( $s_copyfile, $s_copyfileto) ) {
		$s_massage = 'Erfolgreich kopiert'; 
	} else {
		$s_failmassage = 'Konnte nicht kopiert werden';	
	}
}else{
	if ( $onbox == 1 ){
		$s_copyfileto = $_SESSION["sess_dir2"];
	}else{
		$s_copyfileto = $_SESSION["sess_dir1"];
	}
	?>
	<div style="position:absolute; top:30%; left:20%;">
		<form action="<? echo $PHP_SELF; ?>" method="get" width="300">
		<input type="hidden" size="10" name="s_copyfile" value="<? echo $s_copyfile; ?>">
		<input type="hidden" size="10" name="onbox" value="<? echo $onbox; ?>">
		<input type="hidden" size="10" name="init_kopieren" value="">
		<table class="massage">
			<tr>
				<td colspan="2" align="left">Kopieren von "<? echo basename($s_copyfile); ?>" nach</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="text" size="80" name="s_copyfileto" value="<? echo $s_copyfileto . '/' . basename($s_copyfile); ?>"></td>			
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" name="kopieren" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
					<input type="submit" value="Abbrechen">
				</td>		
			</tr>
			<tr>
				<td colspan="2" align="center">Hinweis:<br>Sollte die Zieldatei bereits existieren, wird sie überschrieben.</td>			
			</tr>
		</table>
		</form>
	</div>
	<? 
} 
?>

