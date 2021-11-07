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


        <!-- Your Contents Start -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-sales-chart">
                      <h1>Fine</h1>
                      <form action="add_fine.php" method="POST" data-toggle="validator" enctype="multipart/form-data">
                        <div class="row">
                          <!-- Inputs -->

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

    $cash_type=$_POST['cash_type'];
    $f_cash=$_POST['f_cash'];
    $f_type=$_POST['f_type'];
    $rl_id=$_POST['rl_id'];
    $u_id=$_POST['u_id'];

    $sql="INSERT INTO fine (cash_type,f_cash,f_type,rl_id,u_id) VALUES ('$cash_type','$f_cash','$f_type','$rl_id','$u_id')";
    $query=mysqli_query($con,$sql);

    if ($query) {
      echo "<h1 class='text-success text-center display-1' > Data Inserted successfully </h1>";
    }
    else{
      echo "<h1 class='text-danger text-center display-1' > Data not Inserted </h1>";
    }
}

?>