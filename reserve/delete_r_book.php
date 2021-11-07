<?php 

	$data=$_GET['deleteid'];

	include '../structure/connection.php';

	$sql="DELETE FROM b_reserve WHERE re_id='$data'";

	$query=mysqli_query($con,$sql);

	if ($query) {
		echo "<h1 class='text-success display-1'>DATA DELETED SUCCESFULLY</h1>";
	}

	else{
		echo "<h1 class='text-danger display-1'>DATA NOT DELETED</h1>";
	}

?>

<meta http-equiv="Refresh" content="1; url=veiw_r_book.php" />
