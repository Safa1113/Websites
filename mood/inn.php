<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<!-- Website Design By: www.happyworm.com -->
<title>Demo : jPlayer as an audio player</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../dist/skin/blue.monday/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../lib/jquery.min.js"></script>
<script type="text/javascript" src="../../dist/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){

	$("#jquery_jplayer_1").jPlayer({
		ready: function (event) {
			$(this).jPlayer("setMedia", {
				title:"Bubble",
		//mp3:"http://www.jplayer.org/audio/mp3/Miaow-07-Bubble.mp3",
		//oga:"http://www.jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"
		wav: "http://localhost/mood/assets/sounds/2018-03-05-07-11-12.wav"
			});
		},
		//swfPath: "../../dist/jplayer",
		swfPath: "http://localhost/mood/assets/jPlayer-2.9.2/dist/jplayer",
		//supplied: "mp3,oga",
		supplied: "wav",
		wmode: "window",
		useStateClassSkin: true,
		autoBlur: false,
		smoothPlayBar: true,
		keyEnabled: true,
		remainingDuration: true,
		toggleDuration: true
	});
});
//]]>
</script>
</head>
<body>


<div id="jquery_jplayer_1" class="jp-jplayer"></div>
<div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
	<div class="jp-type-single">
		<div class="jp-gui jp-interface">
			<div class="jp-controls">
				<button class="jp-play" role="button" tabindex="0">play</button>
				<button class="jp-stop" role="button" tabindex="0">stop</button>
			</div>
			<div class="jp-progress">
				<div class="jp-seek-bar">
					<div class="jp-play-bar"></div>
				</div>
			</div>
			<div class="jp-volume-controls">
				<button class="jp-mute" role="button" tabindex="0">mute</button>
				<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
				<div class="jp-volume-bar">
					<div class="jp-volume-bar-value"></div>
				</div>
			</div>
			<div class="jp-time-holder">
				<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
				<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
				<div class="jp-toggles">
					<button class="jp-repeat" role="button" tabindex="0">repeat</button>
				</div>
			</div>
		</div>
		<div class="jp-details">
			<div class="jp-title" aria-label="title">&nbsp;</div>
		</div>
		<div class="jp-no-solution">
			<span>Update Required</span>
			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		</div>
	</div>
</div>




</body>

</html>
