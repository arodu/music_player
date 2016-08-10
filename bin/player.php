<?php
	//@session_start();

	if(isset($_POST['song'])){
			//$song = $_SESSION['song'] = $_POST['song'];
			$song = $_POST['song'];
			setcookie("song",$song);
	}elseif(isset($_COOKIE['song'])){
		$song = $_COOKIE['song'];
	}else{
		$song ='';
	}
?>

<audio id="audio" autoplay src="<?php echo $_COOKIE["tracks"].$song ?>" ontimeupdate="TrackAudio(this)"></audio>

<script type="text/javascript">

	var tagCurrentTime = $('.current-time');
	var tagAudioDuration = $('.audio-duration');
	var tagPlaySong = $('.play-song');

	$(function(){
		console.log('play-song:', "<?= $song ?>");
		tagPlaySong.text("<?= $song ?>");

		var audio = $('#audio')[0];

		audio.onloadedmetadata = function() {
			console.log('audio-duration:', audio.duration);
			tagAudioDuration.text(audio.duration);
		};
	});

	function TrackAudio(element){
		var curTime = Math.floor(element.currentTime);

		var mins = Math.floor( curTime / 60 );
		var segs = curTime - (mins*60);
		//console.log('current-time:',curTime)   //Value in seconds.
		tagCurrentTime.text( add0(mins)+":"+add0(segs));
	}

	function add0(time){
		return ( time < 10 ? "0"+time : time );
	}

</script>
