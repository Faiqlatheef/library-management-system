<?php 
  session_start();
  if(!$_SESSION['sessionname']){
    header("Location:../index.php");
  }
  elseif ($_SESSION['sessionu_type']!="Librarian") {
    header("Location:../main.php");
  }
?>
<?php 

$data=$_GET['editid'];

include '../structure/connection.php';

$sql="SELECT * FROM users WHERE u_id='$data'";
$query=mysqli_query($con,$sql);


while ($row=mysqli_fetch_array($query)) {
	$id=$row['ut_id'];
	$ut_name=$row['ut_name'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <?php include '../structure/head.php'; ?>
</head>
<body>
  <!-- Start Left menu area -->
    <?php include "../structure/sidebar-desktop.php" ?>
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <?php include "../structure/topbar.php" ?>
            <?php include "../structure/mobile-menu.php" ?>
            <?php include "../structure/breadcrumb.php" ?>
        </div>
  <div div class="col-12 bg-primary p-3 text-center">
	<h2>Users Form</h2>
  </div>

	<div class="container">
      <form action="" method="POST">

        <div class="row">

          <div class="col-6 bg-white p-3" >
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
              <div class="form-group">
                <input type="text" class="form-control" placeholder=" User Type " name="ut_name" required>
              </div> 
            </div>

            <div class="col-12 p-3">
              <input type="submit" class="btn btn-success" value="Submit" name="submit">
            </div>

          </div>
        </div>
        <div class="col-3 bg-white p-3"> </div>
      </form>
    </div>    
    <?php include '../structure/script.php'; ?>

</body>

</html>


<?php

if (isset($_POST['submit'])) {
    include'../structure/connection.php';
    
    $id=$row['ut_id'];
    $ut_name=$_POST['ut_name'];

    $sql="UPDATE usertype
 	   SET ut_name='$ut_name'
 	   WHERE ut_id='$id'";
    $query=mysqli_query($con,$sql);

    if ($query) {
      echo "<h1 class='text-success text-center display-1' > Data Updated successfully </h1>";
    }
    else{
      echo "<h1 class='text-danger text-center display-1' > Data not Updated </h1>";
    }
}




?>
