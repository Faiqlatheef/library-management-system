<?php 
  session_start();
  if(!$_SESSION['sessionname']){
    header("Location:../index.php");
  }
  elseif ($_SESSION['sessionu_type']!="Librarian") {
    header("Location:../main.php")
  }
?>
<?php 

$data=$_GET['editid'];

include '../structure/connection.php';

$sql="SELECT * FROM fine WHERE f_id='$data'";
$query=mysqli_query($con,$sql);
while ($row=mysqli_fetch_array($query)) {
	$id=$row['f_id'];
	$cash_type=$_POST['cash_type'];
  $f_cash=$_POST['f_cash'];
  $f_type=$_POST['f_type'];
  $rl_id=$_POST['rl_id'];
  $u_id=$_POST['u_id'];
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
                        <a href="../index.php"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
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
	<h2>Edit Users Form</h2>
  </div>

	<div class="container">
      <form action="" method="POST">

        <div class="row">

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
            <div class="form-group">
              
              <select class="form-control" name="cash_type" required >
              <?php
                include'../structure/connection.php';
                $sql="SELECT ft_id,ft_name FROM fine_type";
                $query=mysqli_query($con,$sql);
                while ($row=mysqli_fetch_array($query)) {
                  ?>
                  <option value="<?php echo $row['ft_id'];?>"><?php echo $row['ft_name']; ?></option>
                  <?php
                }
              ?>
              </select>
            </div> 
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
            <div class="form-group">
              <input type="text" class="form-control" placeholder=" Amount " name="f_cash" required>
            </div> 
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
            <div class="form-group">
              <input type="text" class="form-control" placeholder=" Reason " name="f_type" required>
            </div> 
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
            <div class="form-group">
              <p>Lecturer</p>
              <select class="form-control" name="rl_id" required >
                
              <?php
                include'../structure/connection.php';
                $sql="SELECT r_id,rl_id FROM b_return ";
                $query=mysqli_query($con,$sql);
                while ($row=mysqli_fetch_array($query)) {
                  ?>
                  <option value="<?php echo $row['r_id'];?>"><?php echo $row['rl_id']; ?></option>
                  <?php
                }
              ?>
              </select>
            </div> 
          </div>

          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
            <div class="form-group">
              <p>User</p>
              <select class="form-control" name="u_id" required >
                
              <?php
                include'../structure/connection.php';
                $sql="SELECT r_id,u_id FROM b_return";
                $query=mysqli_query($con,$sql);
                while ($row=mysqli_fetch_array($query)) {
                  ?>
                  <option value="<?php echo $row['r_id'];?>"><?php echo $row['u_id']; ?></option>
                  <?php
                }
              ?>
              </select>
            </div> 
          </div>

                <div class="col-12 p-3">
                  <input type="submit" class="btn btn-success" value="Submit" name="submit">
                </div>

              </div>
            </div>
            <div class="col-3 bg-white p-3"> </div>
          
        </div>
      </form>
    </div>    
    <?php include '../structure/script.php'; ?>

</body>

</html>


<?php

if (isset($_POST['submit'])) {
    include'../structure/connection.php';
    
    $id=$row['f_id'];
    $cash_type=$_POST['cash_type'];
    $f_cash=$_POST['f_cash'];
    $f_type=$_POST['f_type'];
    $rl_id=$_POST['rl_id'];
    $u_id=$_POST['u_id'];

    $sql="UPDATE fine
 	   SET cash_type='$cash_type',
     f_cash='$f_cash',
     f_type='$f_type',
     rl_id='$rl_id',
     u_id='$u_id',
 	   WHERE f_id='$id'";
    $query=mysqli_query($con,$sql);

    if ($query) {
      echo "<h1 class='text-success text-center display-1' > Data Updated successfully </h1>";
    }
    else{
      echo "<h1 class='text-danger text-center display-1' > Data not Updated </h1>";
    }
}




?>
