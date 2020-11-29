<!-- albums page -->
<?php include 'includes/header.php';?>

<!-- retrieving albumID -->
<?php
if (isset($_GET['id'])) {
    $albumId = $_GET['id'];

} else {
    header("Location:index.php");
}
// information about album q
$albumQuery  = mysqli_query($con, "SELECT * FROM albums WHERE id='$albumId'");
$albumResult = mysqli_fetch_array($albumQuery);

// getiing artist information

// $artistID=$albumResult['artist'];

// creating artist class object

// $artist=new Artist($con,$artistID);

// **************creating Album class object and calling the fuction from there*****************

$albumOb = new Album($con, $albumId);

// getting artist information from Album class

$artistName = $albumOb->getArist(); //new Artist($this->con, $this->artist);

// echo $albumOb->getTitle() . "<br>";
// echo $artistName->getName();

?>
<div class="entityInfo">

	<div class="leftSection">
		<img src="<?php echo $albumOb->getArtworkPath(); ?>" alt="Artwork"> 
	</div>

	<div class="rightSection">
		<h2><?php echo $albumOb->getTitle(); ?></h2>
		<span>By <?php echo $artistName->getName(); ?></span>
	</div>

</div>

<?php include 'includes/footer.php';?>
