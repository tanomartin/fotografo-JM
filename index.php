<?php 
	include('includes/templateEngine.inc.php');
	$videoPath = "fotos/default/";
	function detect() {
		$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
		$os=array("WIN","MAC","LINUX");
	
		# definimos unos valores por defecto para el navegador y el sistema operativo
		$info['browser'] = "OTHER";
		$info['os'] = "OTHER";
	
		# buscamos el navegador con su sistema operativo
		foreach($browser as $parent)
		{
			$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
			$f = $s + strlen($parent);
			$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
			$version = preg_replace('/[^0-9,.]/','',$version);
			if ($s)
			{
				$info['browser'] = $parent;
				$info['version'] = $version;
			}
		}
	
		# obtenemos el sistema operativo
		foreach($os as $val)
		{
			if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
				$info['os'] = $val;
		}
	
		# devolvemos el array de valores
		return $info;
	}
	
	$info=detect();
	$browser = $info["browser"];
	
	if(strpos($browser, 'MSIE') !== FALSE || strpos($browser, 'Edge') !== FALSE || strpos($browser, 'Trident') !== FALSE) {
		$videoPath = $videoPath."video-home.wmv";
	}
	if(strpos($browser, 'Opera Mini') !== FALSE || strpos($browser, 'Opera') !== FALSE || strpos($browser, 'OPR') !== FALSE) {
		$videoPath = $videoPath."video-home.ogg";
	}
	if(strpos($browser, 'Firefox') !== FALSE || strpos($browser, 'Chrome') !== FALSE || strpos($browser, 'Safari') !== FALSE) {
		$videoPath = $videoPath."video-home.mp4";
	}
	if ($videoPath == "fotos/default/") {
		header('Location: home.php');	
	} else {
		$twig->display('index.html', array("videoPath" => $videoPath));
	}
	echo $videoPath."<br>";
	echo $browser;
?>