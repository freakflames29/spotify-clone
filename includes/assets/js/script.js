let currentPlaylist=Array();
let audioElement;
let mouseDown=false;

let currentIndex=0;

function formatTime(seconds)
{
	// console.log(seconds);
	let time=Math.round(seconds);
	let min=Math.floor(time/60);
	let sec=time-(min*60);

	// let extraZero;

	// if(sec<10)
	// {
	// 	extraZero="0";
	// }
	// else
	// {
	// 	extraZero="";
	// }

	// using conditonal opeartor
	let extraZero=(sec<10) ? "0":"";

	return min+":"+ extraZero + sec;

}
// updating the current time and progress bar

function updateTimeANDProgressbar(audio)
{
	$(".progressTime.current").text(formatTime(audio.currentTime));
	// to change the remaining time
	// $(".progressTime.remaining").text(formatTime( audio.duration - audio.currentTime));

	// updating the progress bar

	let progress=audio.currentTime/audio.duration * 100;
	$(".playbackBar .progress").css("width",progress+"%");

}
// updating the volume bar
function updateVolume(audio)
{
	let VolumeP=audio.volume * 100;
	$(".volumeBar .progress").css("width",VolumeP+"%");


}

function Audio ()
{
	this.currentPlaying;

	this.audio=document.createElement("audio");

	this.audio.addEventListener("canplay",function()
	{
		let duration=formatTime(this.duration);
		$(".progressTime.remaining").text(duration);
	});

	this.audio.addEventListener("timeupdate",function()
	{
			if(this.duration)
			{
				updateTimeANDProgressbar(this);

			}
	});



	// volume change eventlistner adding
	this.audio.addEventListener("volumechange",function()
	{
			updateVolume(this);
	});

	// setting the track	
	this.setTrack=function(songParse)
	{
		// console.log(songParse);
		// console.log("hidhsids");
		this.currentPlaying=songParse;
		// console.log(this.currentPlaying.id);
		this.audio.src =songParse.path;
	}
	// playing the audio
	this.play=function ()
	{
		this.audio.play();
	}
	// audio pause function
	this.pause=function ()
	{
		this.audio.pause();
	}
	// adding dragging time
	this.setTime=function(secs)
	{
		this.audio.currentTime=secs;
	}
}
