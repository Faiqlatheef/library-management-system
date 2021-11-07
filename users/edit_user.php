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
	$id=$row['u_id'];
	$f_name=$row['f_name'];
  $l_name=$row['l_name'];
  $u_gender=$row['u_gender'];
  $u_mob=$row['u_mob'];
  $u_nic=$row['u_nic'];
  $u_add=$row['u_add'];
  $ustatus=$row['u_status'];
  $utype=$row['u_type'];
  $username=$row['username'];
  $password=$row['password'];
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
                        <a href="../index.php"><img class="main-logo" src="<?php echo"$url"?>img/logo/logo.png" alt="" /></a>
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

          <div class="col-6 bg-white p-3" >
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder=" First Name" name="f_name" value="<?php echo $f_name ?>"required>
                  </div> 
                </div>

                <div class="col-6 bg-white p-3" >
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder=" Last Name" name="l_name" value="<?php echo $l_name ?>" required>
                  </div> 
                </div>

                <div class="col-6 bg-white p-3" >
                  <div class="form-group">
                    <p>User Gender</p>
                    <select class="form-control" name="u_status" value="<?php echo $u_gender ?>">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                    </select>
                  </div> 
                </div>

                <div class="col-6 bg-white p-3" >
                  <div class="form-group">
                    <input type="number" class="form-control" placeholder=" Mobile Number" name="u_mob" value="<?php echo $u_mob ?>" required>
                  </div> 
                </div>

                <div class="col-6 bg-white p-3" >
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder=" NIC " name="u_nic" value="<?php echo $u_nic ?>" required>
                  </div> 
                </div>

                <div class="col-6 bg-white p-3" >
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder=" Address " name="u_add" value="<?php echo $u_add ?>" required>
                  </div> 
                </div>
                
                <div class="col-6 bg-white p-3" >
                  <div class="form-group">
                    <p>User Status</p>
                    <select class="form-control" name="u_status" value="<?php echo $u_status ?>">
                      <option value="Admin">Active</option>
                      <option value="Manager">Disable</option>
                    </select>
                  </div> 
                </div>

                <div class="col-6 bg-white p-3 " >
                  <div class="form-group">
                    <p>User Type</p>
                    <select class="form-control" name="u_type" value="<?php echo $u_type ?>" required >
                    <?php
                      include'../structure/connection.php';
                      $sql="SELECT ut_id,ut_name FROM usertype";
                      $query=mysqli_query($con,$sql);
                      while ($row=mysqli_fetch_array($query)) {
                        ?>
                        <option value="<?php echo $row['ut_id'];?>"><?php echo $row['ut_name']; ?></option>
                        <?php
                      }
                    ?>
                    </select>
                  </div> 
                </div>

                <div class="col-12 bg-white p-3" >
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username " name="username" value="<?php echo $username ?>" required>
                  </div> 
                </div>

                <div class="col-12 bg-white p-3" >
                  <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $password ?>" required >
                  </div> 
                </div>

                <div class="col-12 p-3">
                  <input type="submit" class="btn btn-success" value="Submit" name="submit">
                </div>

              </div>
            </div>
          
        </div>
      </form>
    </div>    
    <?php include '../structure/script.php'; ?>

</body>

</html>


<?php

if (isset($_POST['submit'])) {
    include'../structure/connection.php';
    
    $id=$row['u_id'];
    $f_name=$_POST['f_name'];
    $l_name=$_POST['l_name'];
    $u_gender=$row['u_gender'];
    $u_mob=$_POST['u_mob'];
    $u_nic=$_POST['u_nic'];
    $u_add=$_POST['u_add'];
    $u_status=$_POST['u_status'];
    $u_type=$_POST['u_type'];
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="UPDATE users
 	   SET f_name='$f_name',
     l_name='$l_name',
     u_gender='$u_gender',
     u_mob='$u_mob',
     u_nic='$u_nic',
     u_add='$u_add',
     u_status='$u_status',
     u_type='$u_type',
 	   username='$username',
 	   password='$password'
 	   WHERE u_id='$id'";
    $query=mysqli_query($con,$sql);

    if ($query) {
      echo "<h1 class='text-success text-center display-1' > Data Updated successfully </h1>";
    }
    else{
      echo "<h1 class='text-danger text-center display-1' > Data not Updated </h1>";
    }
}




?>
