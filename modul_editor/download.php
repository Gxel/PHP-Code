<?
$extension = strrchr($s_dat,"."); 
switch($extension){ 
	case ".gif":	$mime = "image/gif";						break;
	case ".gz":	$mime = "application/x-gzip"; 		break;
	case ".htm":   $mime = "text/html"; 					break;
	case ".html":  $mime = "text/html"; 					break;
	case ".jpg":   $mime = "image/jpeg"; 					break;
	case ".tar":   $mime = "application/x-tar"; 			break;
	case ".txt":   $mime = "text/plain"; 					break;
	case ".zip":   $mime = "application/zip"; 			break;
	case ".pdf":   $mime = "application/pdf"; 			break;
	case ".xls":   $mime = "application/msexcel"; 		break;
	default:       $mime = "application/octet-stream"; break;
}

$s_dat_pfad = $s_download_dir . '/' . $s_dat;
if ( file_exists($s_dat_pfad) ) {
	//Ausliefern der Datei
	header("Content-Type: $mime");					// Passenden Datentyp erzeugen.	
	header("Content-Disposition: attachment; filename=\"" . $s_dat . "\"");				// Passenden Dateinamen im Download-Requester vorgeben,
	readfile( $s_dat_pfad );  					// Datei ausgeben.
	exit;
} else {
	echo $fehler = "Es ist ein Fehler aufgetreten, die Datei $s_dat ist auf dem Server nicht vorhanden.";
}
?>