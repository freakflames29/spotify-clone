<?php
/**
 * summary
 */
class Album
{
    /**
     * summary
     */
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

        // album query
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
    public function getArist()
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

}
