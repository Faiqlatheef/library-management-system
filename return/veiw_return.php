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
                              <th>Returned Date</th>
                              <th>Return status</th>
                              <th>Lended ID</th>
                              <th>Lecturer</th>
                              <th>Actions</th>
                            </tr>

                            <?php
                              include '../structure/connection.php';
                              $sql="SELECT * FROM breturn b INNER JOIN users ur ON ur.u_id=b.rl_id INNER JOIN b_lend l ON l.l_id=b.l_id ORDER BY b.r_id DESC";

                              $query=mysqli_query($con,$sql);

                              while ($row=mysqli_fetch_array($query)) {
                                ?>
                                  <tr>
                                    <td><?php echo $row['r_date']?></td>
                                    <td><?php echo $row['r_status']?></td>
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
                                    <td><?php echo $row['f_name']?></td>                                  
                                    <td>
                                      <a onclick="deletethis(this.id)" id="<?php echo $row['r_id'];?>" class="btn btn-danger">
                                        DELETE
                                      </a>
                                      <a href="veiw_return.php?viewid=<?php echo $row['r_id'];?>" class="btn btn-warning">
                                        View
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
       <script>
                 function deletethis(uid){
                   var id = uid;
                 $.confirm({
                     title: 'Confirm!',
                     content: 'Simple confirm!',
                     buttons: {
                         confirm: function () {
                           location.href="delete_re_book.php?deleteid="+id;
                         },
                         cancel: function () {
                             alert(id)
                         }
                        
                     }
                 });
                 }
               </script>
        
        <br>
        <?php include "../structure/footer.php" ?>
    </div>

  <?php include "../structure/script.php" ?>
  
</body>

</html>