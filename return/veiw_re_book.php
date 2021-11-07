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
                        <h1>Return</h1>
                          <table class="table table-hover table-bordered">
                            <tr class="text-uppercase">
                              <th>Lended Date</th>
                              <th>Lended status</th>
                              <th>Reserved ID</th>
                              <th>Actions</th>
                            </tr>

                            <?php
                              include '../structure/connection.php';
                              $sql="SELECT * FROM b_lend b INNER JOIN users ur ON ur.u_id=b.ll_id INNER JOIN b_reserve br ON br.re_id=b.re_id ORDER BY b.l_id DESC";

                              $query=mysqli_query($con,$sql);

                              while ($row=mysqli_fetch_array($query)) {
                                ?>
                                  <tr>
                                    <td><?php echo $row['l_status']?></td>
                                    <td>
                                      <?php  

                                        if ($row['l_status']=="Available") {
                                          echo '<span class="badge badge-success">Available</span>';
                                        }
                                        elseif ($row['l_status']=="Reserved") {
                                          echo '<span class="badge badge-primary">Reserved</span>';
                                        }
                                        else{
                                          echo '<span class="badge badge-danger">Lended</span>';
                                        }

                                      ?>
                                    </td>
                                    <td><?php echo $row['re_id']?></td>                                  
                                    <td>
                                      <a href="delete_l_book.php?deleteid=<?php echo $row['l_id'];?>" class="btn btn-danger">
                                        DELETE
                                      </a>
                                      <a href="return.php?lid=<?php echo $row['l_id'];?>" class="btn btn-primary">
                                        Return
                                      </a>
                                    </td>
                                  </tr>
                                <?php
                              }
                            ?>

                          </table>
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