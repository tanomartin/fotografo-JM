<?php 
	include_once('includes/templateEngine.inc.php');
	require_once('includes/MobileDetect/Mobile_Detect.php');
	
	function detect() {
		$browser=array("SAFARI","CHROME","IE","OPR","MOZILLA","NETSCAPE","FIREFOX","TRIDENT");
		$os=array("WIN","MAC","LINUX");
	
		# definimos unos valores por defecto para el navegador y el sistema operativo
		$info['browser'] = "OTHER";
		$info['os'] = "OTHER";
	
		# buscamos el navegador con su sistema operativo
		foreach($browser as $parent) {
			$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
			$f = $s + strlen($parent);
			$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
			$version = preg_replace('/[^0-9,.]/','',$version);
			
			if ($s) {
				$info['browser'] = $parent;
				$info['version'] = $version;
			}
		}
	
		# obtenemos el sistema operativo
		foreach($os as $val) {
			if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
				$info['os'] = $val;
		}
	
		# devolvemos el array de valores
		return $info;
	}
	
	$detect = new Mobile_Detect;
	if ($detect->isMobile() || $detect->isTablet()) {
		header('Location: home.php');
	} else {
		$info=detect();
		$videoPath = "fotos/default/";
		$browser = $info["browser"]; 
		if(strpos($browser, 'IE') !== FALSE ) {
			$videoPath .= "video-home.wmv";
		}
		if(strpos($browser, 'SAFARI') !== FALSE) {
			$videoPath .= "video-home.ogg";
		}
		if(strpos($browser, 'OPR') !== FALSE || strpos($browser, 'TRIDENT') !== FALSE || strpos($browser, 'FIREFOX') !== FALSE || strpos($browser, 'CHROME') !== FALSE || strpos($browser, 'FIREFOX') !== FALSE) {
			$videoPath .= "video-home.mp4";
		}
		if ($videoPath == "fotos/default/") {
			header('Location: home.php');	
		} else {
			$twig->display('index.html', array("videoPath" => $videoPath));
		}
	}
?>