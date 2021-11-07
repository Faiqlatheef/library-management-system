<?php 

	$data=$_GET['deleteid'];

	include '../structure/connection.php';

	$sql="SELECT u_img FROM users WHERE u_id='$data'";
	$query=mysqli_query($con,$sql);
	while ($row=mysqli_fetch_array($query)) {
		$img=$row['u_img'];
		unlink("../uploads/users/$img");
	}

	$sql="DELETE FROM users WHERE u_id='$data'";

	$query=mysqli_query($con,$sql);

	if ($query) {
		echo "<h1 class='text-success display-1'>DATA DELETED SUCCESFULLY</h1>";
	}

	else{
		echo "<h1 class='text-danger display-1'>DATA NOT DELETED</h1>";
	}

?>
<meta http-equiv="Refresh" content="1; url=veiw_user.php" />