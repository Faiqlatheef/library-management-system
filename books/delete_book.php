<?php 

	$data=$_GET['deleteid'];

	include '../structure/connection.php';

	$sql="SELECT b_img FROM books WHERE b_id='$data'";
	$query=mysqli_query($con,$sql);
	while ($row=mysqli_fetch_array($query)) {
		$img=$row['b_img'];
		unlink("../uploads/books/$img");
	}

	$sql="DELETE FROM books WHERE b_id='$data'";

	$query=mysqli_query($con,$sql);

	if ($query) {
		echo "<h1 class='text-success display-1'>DATA DELETED SUCCESFULLY</h1>";
	}

	else{
		echo "<h1 class='text-danger display-1'>DATA NOT DELETED</h1>";
	}

?>

<meta http-equiv="Refresh" content="1; url=veiw_book.php" />
