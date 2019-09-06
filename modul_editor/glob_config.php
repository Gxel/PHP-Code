<?
session_start();



//Globale Variablen:
if ( isset($reset) ) {
	session_destroy();
	session_start();
}

if ( isset($admin) ){
  session_register("admin");
}


$dirs = "/hp/az/aa/ld/www/www.domain.tz";
$s_glob_subdirs = '/hp/az/aa/ld/www/'; 
$s_glob_programmname = 'phpMyCommander Version 0.2.5 - a OpenSource project by Göksel Yücel';




include("authorisations.inc.php");





##FUNKTIONEN

function optimiere_verzeichnisse($s_zieldir){
	$as_zieldir = explode("/",$s_zieldir);
	$i_dirs = count($as_zieldir) - 1;
	if ( $as_zieldir[$i_dirs] == '..' || $as_zieldir[$i_dirs] == '.') {
		$s_modzieldir = "";
		for ( $i = 0; $i < $i_dirs - 1; $i++ ) {
			if ( $i != 0 ) $s_modzieldir .= "/";
			if ( $as_zieldir[$i] )  $s_modzieldir .= $as_zieldir[$i];
		}
		return $s_modzieldir;
	}else{
		return $s_zieldir;
	}	
};



function getfiletype( $afile ){
	if ( strstr( $afile , '.jpg') ) {
		return 'image/jpg';
	}elseif ( strstr( $afile , '.png') ) {
		return 'image/png';
	}elseif ( strstr( $afile , '.gif') ) {
		return 'image/gif';
	}elseif ( strstr( $afile , '.wma') ) {
		return 'music/wma';
	}elseif ( strstr( $afile , '.wmv') ) {
		return 'movie/wmv';
	}else{
		return FALSE;
	};
};


?>