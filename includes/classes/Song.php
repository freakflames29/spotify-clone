<?php

class Song
{
    private $con;
    private $id;
    private $mysqlisongData;
    private $title;
    private $artisId;
    private $albumId;
    private $genre;
    private $duration;
    private $path;

    public function __construct($con, $id)
    {
        $this->con = $con;
        $this->id = $id;

        // sql data fetching
        $songsQuery = mysqli_query($this->con, "SELECT * FROM songs WHERE id='$this->id'");
        $this->mysqlisongData = mysqli_fetch_array($songsQuery);

        $this->title = $this->mysqlisongData['title'];
        $this->artisId = $this->mysqlisongData['artist'];
        $this->albumId = $this->mysqlisongData['album'];
        $this->genre = $this->mysqlisongData['genre'];
        $this->duration = $this->mysqlisongData['duration'];
        $this->path = $this->mysqlisongData['path'];
    }
    public function getsongTitle()
    {
        return $this->title;
    }
    public function getsongArtist()
    {
        // return new Artist($this->con, $this->id);
        return new Artist($this->con, $this->artisId);
    }
    public function getsongAlbum()
    {
        return new Album($this->con, $this->id);
    }
    public function getsongGenre()
    {
        return $this->genre;
    }
    public function getsongDuration()
    {
        return $this->duration;
    }
    public function getsongPath()
    {
        return $this->path;
    }
    public function getsongMysqlisongData()
    {
        return $this->mysqlisongData;
    }
}
