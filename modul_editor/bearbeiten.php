<?
require("glob_config.php");

if ( $_SESSION["b_edit_file"] == FALSE) {
	echo 'Sie haben <b>keine Benutzerrechte</b> um Daten zu <b>&auml;ndern</b>.';	
	exit;
};
?>
<html>
<head>
<title><? echo $s_editdir; ?> - Editor</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
	<?
	//AB HIER GEHT ES LOS MIT DEM "TEXTANSICHT"
	chmod($s_editdir,0777);	
	if ( isset($b_save) ) {	
		$scheiben = fopen($s_editdir, "w+");
		fwrite($scheiben, str_replace (  "|textarea|","textarea", stripslashes($s_syntax))  );
		fclose($scheiben); 	
	}
	
	$fp = fopen($s_editdir, "r");
	$s_text = fread($fp, filesize($s_editdir) );
	fclose($fp);	
	?>	
	<form action="<? echo $PHP_SELF; ?>" method="post">
	<input type="hidden" size="10" name="s_editdir" value="<? echo $s_editdir; ?>">
	<table border="0">
		<tr>
			<td><textarea name="s_syntax" cols="80" rows="20" wrap="off"><? echo str_replace ("textarea","|textarea|", $s_text ); ?></textarea></td>
		</tr>
		<tr>
		    <td align="right">
		    		<input type="submit" name="b_save" value="Speichern">
		    		<input type="submit" name="aktuallisieren" value="Refrech">
		    </td>
		</tr>
	</table>
	</form>	
</body>
</html>


