<?php
include '../../config.php';

if(isset($_POST['$songiD']))
{
    $songiD=$_POST['$songiD'];
    $songQ=mysqli_query($con,"UPDATE songs SET plays=plays+1 WHERE id='$songiD'");

    // $ra=mysqli_num_rows($songQ);
    // echo $ra;
//
//    if($songQ)
//    {
//        echo "ok succces";
//    }
//    else{
//        header("Location:https://google.com");
//    }
    	echo $songQ;	
}
?>