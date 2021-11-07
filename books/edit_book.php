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

$sql="SELECT * FROM books WHERE b_id='$data'";
$query=mysqli_query($con,$sql);
while ($row=mysqli_fetch_array($query)) {
	$id=$row['b_id'];
	$b_name=$row['b_name'];
  $isbn=$row['isbn'];
  $b_pubdate=$row['b_pubdate'];
  $b_type=$row['b_type'];
  $quantity=$row['quantity'];
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
                        <a href="index.html"><img class="main-logo" src="<?php echo"$url"?>img/logo/logo.png" alt="" /></a>
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
      	   <h2>Edit book Form</h2>
        </div>
      	<div class="container">
            <form action="" method="POST">

              <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder=" Book Name" name="b_name" value="<?php echo $b_name ?>" required>
                  </div> 
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                  <div class="form-group">
                    <input type="number" class="form-control" placeholder=" ISBN " name="isbn" value="<?php echo $isbn ?>" required>
                  </div> 
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                  <div class="form-group">
                    <p>Published date</p>
                    <input type="date" class="form-control" placeholder=" Published date " name="b_pubdate" value="<?php echo $b_pubdate ?>" required>
                  </div> 
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                  <div class="form-group">
                    <p>Book type</p> 
                    <select class="form-control" name="b_type" required value="<?php echo $b_type ?>">
                    <?php
                    include'../structure/connection.php';
                    $sql="SELECT bt_id,bt_name FROM book_type";
                    $query=mysqli_query($con,$sql);
                    while ($row=mysqli_fetch_array($query)) {
                    ?>
                    <option value="<?php echo $row['bt_id'];?>"><?php echo $row['bt_name']; ?></option>
                      <?php
                    }
                       ?>
                    </select>
                  </div> 
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white" >
                  <div class="form-group">
                    <p>Book Quantity</p>
                    <select class="form-control" name="quantity" value="<?php echo $quantity ?>">
                    <option value="Available">Available</option>
                    <option value="Reserved">Reserved</option>
                    <option value="Lended">Lended</option>
                    </select>
                  </div> 
                </div>

                <div class="col-lg-12 bg-white " >
                  <div class="form-group">                             
                    <input type="submit" class="btn btn-success" value="Submit" name="submit">
                  </div> 
                </div>
              </div>
            </div>
                  <div class="col-3 bg-white p-3"> </div>
            </form>  
          <?php include '../structure/script.php'; ?>

</body>

</html>


<?php

if (isset($_POST['submit'])) {
    include'../structure/connection.php';
    
    $id=$row['b_id'];
    $b_name=$_POST['b_name'];
    $isbn=$_POST['isbn'];
    $b_pubdate=$_POST['b_pubdate'];
    $b_type=$_POST['b_type'];
    $quantity=$_POST['quantity'];

    $sql="UPDATE books
 	   SET b_name='$b_name',
     isbn='$isbn',
     b_pubdate='$b_pubdate',
     b_type='$b_type',
     quantity='$quantity',
 	   WHERE b_id='$id'";
    $query=mysqli_query($con,$sql);

    if ($query) {
      echo "<h1 class='text-success text-center display-1' > Data Updated successfully </h1>";
    }
    else{
      echo "<h1 class='text-danger text-center display-1' > Data not Updated </h1>";
    }
}




?>
