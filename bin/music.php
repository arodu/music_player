<?php
	//@session_start();
	//$files = opendir($_SESSION["tracks"]);
	$files = opendir($_COOKIE["tracks"]);

	echo '<ul class="list-unstyled">';
	while ($file = readdir($files)){
		if($file != '.' and $file != '..' ){
			echo '<li><a href="#" class="song" data-song="'.$file.'"><span class="glyphicon glyphicon-play-circle"></span></a> '.$file.'</li>';
		}
	}
	echo '</ul>';

?>
