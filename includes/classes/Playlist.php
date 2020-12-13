<?php 


class Playlist
{
	private $con;
	private $id;
	private $name;
	private $owner;

	public function __construct($con,$data)
	{
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
}

 ?>