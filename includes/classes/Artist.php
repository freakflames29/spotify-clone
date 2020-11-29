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
}
