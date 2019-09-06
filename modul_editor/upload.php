<? 
if ( $_SESSION["b_upload_access"] == FALSE) {
	$s_failmassage = 'Sie haben <b>keine Benutzerrechte</b> um Daten <b>hochzuladen</b>';	
}elseif ( isset( $init_upfile ) &&  isset( $upfile ) ){
	$i_maxbyte = 50000000;
	$s_erlaube = "alles";  //jpg|gif|txt|htm|html
	
	if( eregi("(" . $s_erlaube . ")$",$s_file_name) || $s_erlaube == "alles" ) { 
		if( $s_file_size < $i_maxbyte AND $s_file_size != 0) { 
			copy($s_file, $s_updir.'/'.$s_file_name); // Kopiert das Bild 			
			$s_massage  =  "Die Datei erfolgreich hochgeladen.<br>"; 
			$s_massage .=  "Größe: ".$s_file_size." Byte<br>"; 
			$s_massage .=  "Name: ".$s_file_name."<br>";
			$s_massage .=  "MIME-Type: ".$s_file_type."<br>";
			//$s_massage .=  "Ansehen: <a href='".$s_file_name."'>".$s_file_name."</a>";  
		} else { 
			$s_failmassage =  "Ihre Datei ist über " . ( $i_maxbyte / 1000 ) . " KB oder gleich 0";  
		} 
	} else { 
		$s_failmassage =  "Falsche Erweiterung: ".$s_file_name; 
	} 
}else{
?>
<div style="position:absolute; top:30%; left:30%;">
	<form action="<? echo $PHP_SELF; ?>" method="post" width="300" enctype="multipart/form-data">
	<input type="hidden" size="10" name="s_updir" value="<? echo $s_updir; ?>">
	<input type="hidden" size="10" name="init_upfile" value="">
	<table class="massage">
		<tr>
			<td colspan="2" class="pfad"><? echo $s_glob_programmname; ?></td>
		</tr>
		<tr>
			<td colspan="2" align="left">Datei Hochladen</td>
		</tr>
		<tr>
			<td colspan="2" align="left"><? echo $s_updir; ?></td>
		</tr>
		<tr>
			<td colspan="2" align="left"><input type="file" size="20" name="s_file"></td>
		</tr>
			<tr>
			<td align="center">
		    		<input type="submit" name="upfile" value='Hochladen'>
		    		<input type="submit" value="Abbrechen">
			</td>
		</tr>
	</table>
	</form>
</div>
<? } ?>
