let currentPlaylist = Array();
let shufflePlaylist = Array();
let tempPlaylist = Array();

let audioElement;
let mouseDown = false;
let repeat = false;

let userLoggedin;

let currentIndex = 0;

let shuffle=false;


var timer;




// the function is for playing the song when clicked the play button in artist page
function ArtistPlaysong()
{
  // we can do this in two way 
  // 1st way to click the play button
  // document.querySelector(".playTheSong").click();
  
  // 2nd way to set The track to tempPlaylist which we are getting from when the page is loading

  setTrack(tempPlaylist[0],tempPlaylist,true);

}


// creating the createPlaylist function
function createPlaylist()
{
  console.log(userLoggedin);
  var popup=prompt("Enter the playlist name");
  if(popup!=null)
  {
    // console.log("ok");
    $.post("includes/handlers/ajax/CreatePlaylist.php",{ name : popup , username : userLoggedin }).done(function(error)
    {
      if(error!="")
      {
        alert(error);
      }

      // location.reload();
      openPage("yourMusic.php");
    });
  }
}

// delete playlist function
function deletePlaylist(playlistId)
{
    let confirmDelete=confirm("Are you want to delete the playlist?");
    if(confirmDelete)
    {
      // console.log("DLETE playlist");

      // now we are going to do ajax call to delete the playlist
      $.post("includes/handlers/ajax/deletePlaylist.php",{playlistId:playlistId}).
      done(function(error)
      {
        if(error!="")
        {
          alert(error);

        }
        onPage("yourMusic.php");
      });

    }
}
// logout function


function logout()
{
  $.post("includes/handlers/ajax/logout.php",function()
  {
    location.reload();
  });
}




// deleting songs from playlist page

function removeSongFromPlaylist(button,playlistID)
{
  var song_ID=$(button).prevAll(".songId").val();

  // ajax call
  $.post("includes/handlers/ajax/removeSongFromPlaylist.php",

      {
        playlistID:playlistID,
        songID:song_ID }//data

    ).done(function(data)
    {
        if(data)
        {
          alert(data);
        }
        onPage("playlist.php?id="+playlistID);


    });


}














// showing the options when the tripple dot button is clicked
function showOptions(button)
{
  let songid_is=$(button).prevAll(".songId").val();//getting the song val 
  let menu=$(".optionsMenu");
  menu.find(".songId").val(songid_is);
  let menuWidth=menu.width();
  let scrolltop=$(window).scrollTop();
  let elementWidth=$(button).offset().top;

  let top=elementWidth-scrolltop;
  let left=$(button).position().left;

  menu.css({"top":top+"px","left":+left-menuWidth+"px","display":"inline"});
}
// updating the email value
function updateEmail(emailClass)
{
  let emailValue=$("."+emailClass).val();
  $.post("includes/handlers/ajax/UpdateEmail.php",{emailIs:emailValue,username:userLoggedin}).done(function(data)
  {
    $("."+emailClass).nextAll(".mesage").text(data);
    let timer=setTimeout(function()
    {

    $("."+emailClass).nextAll(".mesage").text("");

    },2000);
    // clearTimeout(timer);

  });
}
// updating the passwords
function updatePassword(oldPasswordclass,newPasswordClass1,newPasswordClass2)
{
  let oldPassword=$("."+oldPasswordclass).val();
  let newPassword1=$("."+newPasswordClass1).val();
  let newPassword2=$("."+newPasswordClass2).val();

  $.post("includes/handlers/ajax/UpdatePassword.php",{oldPassword:oldPassword,newPassword1:newPassword1,newPassword2:newPassword2,username:userLoggedin}).done(function(data)
  {

    $("."+oldPasswordclass).nextAll(".mesage").text(data);


  });



}


// adding the song to playlist and database
$(document).on("change","select.playlist",function()
{
  var select=$(this);
  var playList_id=select.val();
  var song_id=select.prev(".songId").val();

  // console.log("playlistID: "+playList_id);
  // console.log("songID: "+song_id);

  $.post("includes/handlers/ajax/addToPlaylist.php",{

        playlistID:playList_id,
        songID:song_id


  }).done(function(data)
  {

    console.log(data);
    hideMenu();
    select.val("");

  });

});








// hiding the menu function
// WE ARE gouing to hide that on scroll and also on off click

// offclick hide
$(document).click(function(e)
{
  var target=$(e.target);
  if(!target.hasClass("item") && !target.hasClass("optionButton"))
  {
      hideMenu();
  }
});

$(window).scroll(function()
{
  hideMenu();
});
function hideMenu()
{
  let Hidemenu=$(".optionsMenu");
  if(Hidemenu.css("display")!="none")
  {
    Hidemenu.css("display","none");
  }
}


// now we are loading the maincontent's content dynamically
function onPage(url)
{
  //this is for when timer is on and if we move to another page our setTinmeout method in search.php redirect us to the search page so we have to clear the timer if we move to another page by openPage functon otherwise we will redirect back to search php page and the search files will be undefined
  
  if(timer!=null)
  {
    clearTimeout(timer);

  }
  if(url.indexOf('?')==-1)
  {

    url+='?';
  }
  let endocdeurl=encodeURI(url+"&userLoggedin="+userLoggedin);
  console.log(endocdeurl);
  $("#mainContent").load(endocdeurl);
  $("body").scrollTop(0);
  history.pushState(null,null,url);
  // history.pushState(null,null,endocdeurl);
}

function formatTime(seconds) {
  // console.log(seconds);
  let time = Math.round(seconds);
  let min = Math.floor(time / 60);
  let sec = time - min * 60;

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
  let extraZero = sec < 10 ? "0" : "";

  return min + ":" + extraZero + sec;
}
// updating the current time and progress bar

function updateTimeANDProgressbar(audio) {
  $(".progressTime.current").text(formatTime(audio.currentTime));
  // to change the remaining time
  // $(".progressTime.remaining").text(formatTime( audio.duration - audio.currentTime));

  // updating the progress bar

  let progress = (audio.currentTime / audio.duration) * 100;
  $(".playbackBar .progress").css("width", progress + "%");
}
// updating the volume bar
function updateVolume(audio) {
  let VolumeP = audio.volume * 100;
  $(".volumeBar .progress").css("width", VolumeP + "%");
}

function Audio() {
  this.currentPlaying;

  this.audio = document.createElement("audio");

  // adding an addEventListener for if a song ends then play the next song or repeat the song
  this.audio.addEventListener("ended", function () {
    nextSong();
  });

  this.audio.addEventListener("canplay", function () {
    let duration = formatTime(this.duration);
    $(".progressTime.remaining").text(duration);
  });

  this.audio.addEventListener("timeupdate", function () {
    if (this.duration) {
      updateTimeANDProgressbar(this);
    }
  });

  // volume change eventlistner adding
  this.audio.addEventListener("volumechange", function () {
    updateVolume(this);
  });

  // setting the track
  this.setTrack = function (songParse) {
    // console.log(songParse);
    // console.log("hidhsids");
    this.currentPlaying = songParse;
    // console.log(this.currentPlaying.id);
    this.audio.src = songParse.path;
  };
  // playing the audio
  this.play = function () {
    this.audio.play();
  };
  // audio pause function
  this.pause = function () {
    this.audio.pause();
  };
  // adding dragging time
  this.setTime = function (secs) {
    this.audio.currentTime = secs;
  };
}
