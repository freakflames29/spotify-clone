<?php

/**
 * summary
 */
class Album
{
    /**
     * summary
     */

    //TODO hello
    //-jonf is good
    //! this is anoter comment
    //! this is not


    private $con;
    private $id;
    private $title;
    private $artist;
    private $genre;
    private $artworkPath;

    public function __construct($con, $id)
    {
        $this->con = $con;
        $this->id  = $id;

        // -album query

        $albumQuery  = mysqli_query($this->con, "SELECT * FROM albums WHERE id='$this->id'");
        $albumResult = mysqli_fetch_array($albumQuery);

        $this->title       = $albumResult['title'];
        $this->artist      = $albumResult['artist'];
        $this->genre       = $albumResult['genre'];
        $this->artworkPath = $albumResult['artworkPath'];
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getArtist()
    {
        return new Artist($this->con, $this->artist);
    }
    public function getGenre()
    {
        return $this->genre;
    }

    public function getArtworkPath()
    {
        return $this->artworkPath;
    }
    public function getSongsCount()
    {
        $songsCountQuery = mysqli_query($this->con, "SELECT id FROM songs WHERE album='$this->id'");
        return mysqli_num_rows($songsCountQuery);
    }
    public function getSongids()
    {
        $songidQuery = mysqli_query($this->con, "SELECT id FROM songs WHERE album='$this->id' ORDER BY albumorder ASC ");

        // $songidQuery = mysqli_query($this->con, "SELECT artist FROM songs WHERE album='$this->id' ORDER BY albumorder ASC ");


        $arrayOfsongs = array();
        while ($row = mysqli_fetch_array($songidQuery)) {
            array_push($arrayOfsongs, $row['id']);
        }
        return $arrayOfsongs;
    }
}
