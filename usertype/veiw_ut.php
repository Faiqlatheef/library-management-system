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
                              <th>User Type</th>
                              <th>Actions</th>
                            </tr>
                            
                            <?php
                              include '../structure/connection.php';

                              $sql="SELECT * FROM usertype ORDER BY ut_id DESC";

                              $query=mysqli_query($con,$sql);

                              while ($row=mysqli_fetch_array($query)) {
                                ?>
                                  <tr>
                                    <td><?php echo $row['ut_name']?></td>
                                    <td>
                                      <a onclick="deletethis(this.id)" id="<?php echo $row['ut_id'];?>" class="btn btn-danger">
                                        DELETE
                                      </a>
                                      <a href="edit_ut.php?editid=<?php echo $row['ut_id'];?>" class="btn btn-primary">
                                        EDIT
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
                           location.href="delete_ut.php?deleteid="+id;
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