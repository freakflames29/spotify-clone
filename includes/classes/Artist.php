<?php
/**
 * summary
 */
class Artist
{
    /**
     * artist class
     */
    private $con;
    private $id;
    public function __construct($con, $id)
    {
        $this->con = $con;
        $this->id  = $id;

    }
    public function getName()
    {
        {
           $artistQuery = mysqli_query($this->con, "SELECT name FROM artist WHERE id='$this->id'");

           $artistName = mysqli_fetch_array($artistQuery);
           if ($artistName==null)
           {
           	
           	 header("Location:index.php");
           	
           }
           return $artistName['name'];

        }
    }
    public function getArtistId()
    {
      return  $this->id;
    }

    // we are collecting the songs of an artist by this function

    public function getSongids()
    {
        $songidQuery = mysqli_query($this->con, "SELECT id FROM songs WHERE artist='$this->id' ORDER BY plays ASC ");

        // $songidQuery = mysqli_query($this->con, "SELECT artist FROM songs WHERE album='$this->id' ORDER BY albumorder ASC ");


        $arrayOfsongs = array();
        while ($row = mysqli_fetch_array($songidQuery)) {
            array_push($arrayOfsongs, $row['id']);
        }
        return $arrayOfsongs;
    }

}
