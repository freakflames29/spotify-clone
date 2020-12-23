<?php 


class Playlist
{
	private $con;
	private $id;
	private $name;
	private $owner;

	public function __construct($con,$data)
	{
		//here is pretty cool thing we are passing the data from yourMusic.php and the data is an array format but we are passing the playlist id from playlist.php but this is a simple string not an array so now this code will behave different so we are going to check whether the data is array or string. if the data is string then we are we goinig to perform a query to fetch data from database and rewrite the data variable and other wise we are simply going to use the array which we are passing
		if(!is_array($data))
		{
			// $isnotArrayDataQuery=mysqli_query($this->con,"SELECT * FROM playlists WHERE id='$data' ");

			$dataArray=mysqli_query($con,"SELECT * FROM playlists WHERE id='$data'");
			if(!$dataArray)
			{
				echo 'sql error';
			}

			$data=mysqli_fetch_array($dataArray);
		}




		$this->con=$con;
		$this->id=$data['id'];
		$this->name=$data['name'];
		$this->owner=$data['owner'];


	}
	 public function getPlaylistid()
	{
		return $this->id;
	}
	public function getPlaylistName()
	{
		return $this->name;
	}
	public function getOwnerName()
	{
		return $this->owner;
	}
	public function getNumberOfsongs()
	{
		$numberOfSongsQuery=mysqli_query($this->con,"SELECT songid FROM playlistSongs WHERE playlistid='$this->id'");

		return mysqli_num_rows($numberOfSongsQuery);

	}
	public function getSongids()
    {
        $songidQuery = mysqli_query($this->con, "SELECT songid FROM playlistSongs WHERE playlistid='$this->id' ORDER BY playlistOrder ASC ");

        // $songidQuery = mysqli_query($this->con, "SELECT artist FROM songs WHERE album='$this->id' ORDER BY albumorder ASC ");


        $arrayOfsongs = array();
        while ($row = mysqli_fetch_array($songidQuery)) {
            array_push($arrayOfsongs, $row['songid']);
        }
        return $arrayOfsongs;
    }

    // this function will return the playlists name
    public static function getPlaylistDropdown($con,$username)
    {
    	$dropdown='<select class="item playlist paddinglist">
					<option value="">Add to playlist</option>';

		$playlist_Name_Id_fetch_query=mysqli_query($con,"SELECT id,name FROM playlists WHERE owner ='$username'");
		while ($row=mysqli_fetch_array($playlist_Name_Id_fetch_query))
		{
			$id=$row['id'];
			$name=$row['name'];

			$dropdown=$dropdown."<option value='$id'>$name</option>";
		    
		}

		return $dropdown."</select>";
    }
}

 ?>