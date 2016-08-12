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

<style media="screen">
.nav > li {
    position: relative;
    display: inline-block;
}
.controls{
	margin-top: 4px;
}
.not-active {
   pointer-events: none;
   cursor: default;
}

</style>


<div class="container">



	<!-- <input type="text" id="example_id" name="example_name" value="" />

	<!-- <li><span class="navbar-text current-time">00:00</span></li> -->
	<!-- <li><input type="text" class="slider" /></li> -->
	<!-- <li><span class="navbar-text audio-duration">00:00</span></li> -->


	<div class="controls">
		<p class="navbar-text play-song visible-xs-block"></p>
		<div>
			<input type="text" id="tracker" name="tracker_time" value="" />
		</div>
		<div class="clearfix"></div>

		<ul class="nav navbar-nav">
			<li><a href="#" class="play-pause"><span class="glyphicon glyphicon-play"></span></a></li>
			<li><a href="#"><span class="glyphicon glyphicon-fast-backward"></span></a></li>
			<li><a href="#"><span class="glyphicon glyphicon-fast-forward"></span></a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="icon-volume"><span class="glyphicon glyphicon-volume-up"></span></span>
				</a>
				<div class="dropdown-menu">
					<input type="text" class="volume" />
				</div>
			</li>
			<li><p class="navbar-text play-song hidden-xs"></p></li>

			<li><audio id="audio" autoplay src="<?php echo $_COOKIE["tracks"].$song ?>" ontimeupdate="TrackAudio(this)"></audio></li>

		</ul>
 </div>

</div><!-- /.container-fluid -->


<script type="text/javascript">

	var audio = $('#audio')[0];
	var tagCurrentTime = $('.current-time');
	var tagAudioDuration = $('.audio-duration');
	var iconVolume = $('.icon-volume');
	var tagPlaySong = $('.play-song');

	var controls = $('.controls a');
	controls.addClass('not-active');

	//var volume = $("input.volume").slider({
	//	reversed : true,
	//	min: 0,
	//	max: 10,
	//	step: 1,
	//	value: 10,
	//	orientation: "vertical",
	//});

	var sliderTime = $("input.slider").ionRangeSlider();

	var track_enable = false;

	$("#tracker").ionRangeSlider({
		min: 0,
    max: 0,
    from: 0,
		step: 0.001,
		from_shadow: true,
		prettify: function(value){
			return getTime(Math.floor(value));
		},
    disable: true,

		onStart: function (data) {
			console.log('start');
			console.log(data.from);
		},
		onChange: function (data) {
			console.log('change');
			track_enable = true;
		},
		onFinish: function (data) {
			console.log('finish');
			track_enable = true;
			audio.currentTime = data.from;
			setTimeout(function(){ track_enable = false },1500);
		},
		//onUpdate: function (data) {
		//	console.log(data.from);
		//}

	});
	var tracker = $("#tracker").data("ionRangeSlider");

	$(function(){
		console.log('play-song:', "<?= $song ?>");
		tagPlaySong.text("<?= $song ?>");

	  //sliderTime.slider("disable");

		audio.onloadedmetadata = function(){
			console.log(getTime(audio.duration));
			tagAudioDuration.text(audio.duration);

			//alert(getTime(audio.duration));
			tagAudioDuration.text(getTime(audio.duration));

			//sliderTime.slider("enable");
			tracker.update({
				max: audio.duration,
				disable: false,
			});

			controls.removeClass('not-active');

			if(audio.paused){
				$('.play-pause').find('.glyphicon').removeClass('glyphicon-pause').addClass('glyphicon-play');
			}else{
				$('.play-pause').find('.glyphicon').removeClass('glyphicon-play').addClass('glyphicon-pause');
			}
		};

		// --- Controls ---
		$('a.play-pause').click(function(){
			//alert(audio.paused);
			if(audio.paused){
				audio.play();
				$('.play-pause').find('.glyphicon').removeClass('glyphicon-play').addClass('glyphicon-pause');
			}else{
				audio.pause();
				$('.play-pause').find('.glyphicon').removeClass('glyphicon-pause').addClass('glyphicon-play');
			}
			return false;
		});

	});



	function TrackAudio(element){
		//var curTime = Math.floor(element.currentTime);
		//tagCurrentTime.text( getTime(curTime) );
		if(!track_enable){
			tracker.update({
				from: element.currentTime,
			});
		}
	}

	function getTime(time){
		var mins = Math.floor( time / 60 );
		var segs = time - (mins*60);
		return add0(mins)+":"+add0(segs);
	}

	function add0(time){
		time = Math.round(time);
		return ( time < 10 ? "0"+time : time );
	}

	function checkVolume(audio){
		//alert(audio.volume)
		if(audio.volume <= 0.0){
			iconVolume.html('<span class="glyphicon glyphicon-volume-off"></span>');
		}else if(audio.volume <= 0.5){
			iconVolume.html('<span class="glyphicon glyphicon-volume-down"></span>');
		}else{
			iconVolume.html('<span class="glyphicon glyphicon-volume-up"></span>');
		}
	}


</script>
