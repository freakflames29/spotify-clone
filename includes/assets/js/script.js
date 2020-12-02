let currentPlaylist=Array();
let audioElement;




function Audio ()
{
	this.currentPlaying;

	this.audio=document.createElement("audio");

	// setting the track	
	this.setTrack=function(src)
	{
		this.audio.src =src;
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
}
