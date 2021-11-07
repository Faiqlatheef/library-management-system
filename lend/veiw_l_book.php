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
                        <h1>Users</h1>
                          <table class="table table-hover table-bordered">
                            <tr class="text-uppercase">
                              <th>Reserve Date</th>
                              <th>Reserve Status</th>
                              <th>Book Name</th>
                              <th>User Name</th>
                              <th>Actions</th>
                            </tr>

                            <?php
                              include '../structure/connection.php';
                              $sql="SELECT * FROM b_reserve r INNER JOIN books b ON b.b_id=r.b_id INNER JOIN users u ON u.u_id=r.u_id WHERE r.re_status='Reserved' ORDER BY r.re_id DESC";

                              $query=mysqli_query($con,$sql);
                              while ($row=mysqli_fetch_array($query)) {
                                ?>
                                  <tr>
                                    <td><?php echo $row['re_date']?></td>
                                    <td>
                                      <?php  

                                        if ($row['re_status']=="Available") {
                                          echo '<span class="badge badge-success">Available</span>';
                                        }
                                        elseif ($row['re_status']=="Reserved") {
                                          echo '<span class="badge badge-warning">Reserved</span>';
                                        }
                                        elseif ($row['re_status']=="Lended") {
                                          echo '<span class="badge badge-danger">Lended</span>';
                                        }
                                      ?>
                                    </td>
                                    <td><?php echo $row['b_name']?></td>
                                    <td><?php echo $row['f_name']?></td>
                                    <td>
                                      <a href="delete_l_book.php?deleteid=<?php echo $row['b_id'];?>" class="btn btn-danger">
                                        DELETE
                                      <a href="add_lend.php?reid=<?php echo $row['re_id'];?>" class="btn btn-warning">
                                        LEND
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

