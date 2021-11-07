<?php 
  session_start();
  if(!$_SESSION['sessionname']){
    header("Location:../index.php");
  }
  elseif ($_SESSION['sessionu_type']!="Librarian") {
    header("Location:../main.php");
  }
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <?php include "../structure/head.php" ?>
</head>

<body>
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
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


        <!-- Your Contents Start -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-sales-chart">
                      <h1>User Type</h1>
                      <form action="add_ut.php" method="POST" data-toggle="validator" enctype="multipart/form-data">
                        <div class="row">
                          <!-- Inputs -->

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder=" User Type " name="ut_name" required>
                            </div> 
                          </div>

                          <div class="col-lg-12 bg-white " >
                            <div class="form-group">                             
                              <input type="submit" class="btn btn-success" value="Submit" name="submit">
                            </div> 
                          </div>

                        </div>
 
                      </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Your Contents End -->
       
        
        <br>
        <?php include "../structure/footer.php" ?>
    </div>

  <?php include "../structure/script.php" ?>
  
</body>

</html>

<?php

if (isset($_POST['submit'])) {
  include'../structure/connection.php';
  if (!$con) {
      echo "<h1 class='text-warning' > Not-Connected </h1>";
    }

    $ut_name=$_POST['ut_name'];

    $sql="INSERT INTO usertype (ut_name) VALUES ('$ut_name')";
    $query=mysqli_query($con,$sql);

    if ($query) {
      echo "<h1 class='text-success text-center display-1' > Data Inserted successfully </h1>";
    }
    else{
      echo "<h1 class='text-danger text-center display-1' > Data not Inserted </h1>";
    }
}

?>