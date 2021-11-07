<?php 
  session_start();
  if(!$_SESSION['sessionname']){
    header("Location:../index.php");
  }
  elseif ($_SESSION['sessionu_type']!="Librarian" && $_SESSION['sessionu_type']!="Lecturer" && $_SESSION['sessionu_type']!="Student" ) {
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


        <!-- Your Contents Start -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-sales-chart">
                        <h1>Users</h1>
                          <table class="table table-hover table-bordered">
                            <tr class="text-uppercase">
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Gender</th>
                              <th>Mobile</th>
                              <th>NIC</th>
                              <th>Address</th>
                              <th>User status</th>
                              <th>User type</th>
                              <th>User Image</th>
                              <th>Username</th>
                              <th>Actions</th>
                            </tr>

                            <?php
                              include '../structure/connection.php';
                              $sql="SELECT * FROM users u INNER JOIN usertype t ON t.ut_id=u.u_type ORDER BY u.u_id DESC";

                              $query=mysqli_query($con,$sql);

                              while ($row=mysqli_fetch_array($query)) {
                                ?>
                                  <tr>
                                    <td><?php echo $row['f_name']?></td>
                                    <td><?php echo $row['l_name']?></td>
                                    <td><?php echo $row['u_gender']?></td>
                                    <td><?php echo $row['u_mob']?></td>
                                    <td><?php echo $row['u_nic']?></td>
                                    <td><?php echo $row['u_add']?></td>
                                    <td>
                                      <?php  

                                        if ($row['u_status']=="Active") {
                                          echo '<span class="badge badge-success">ACTIVE</span>';
                                        }
                                        else{
                                          echo '<span class="badge badge-danger">DISABLE</span>';
                                        }

                                      ?>
                                    </td>
                                    <td><?php echo $row['ut_name']?></td>
                                    <td><img src="../uploads/users/<?php echo $row['u_img']?>" width="20%" alt=""></td>
                                    <td><?php echo $row['username']?></td>
                                   
                                    <td>
                                      <!-- <a href="delete_user.php?deleteid=<?php //echo $row['u_id'];?>" class="btn btn-danger"> -->
                                      <a onclick="deletethis(this.id)" id="<?php echo $row['u_id'];?>" class="btn btn-danger">
                                        DELETE
                                      </a>
                                      <a href="edit_user.php?editid=<?php echo $row['u_id'];?>" class="btn btn-primary">
                                        EDIT
                                      </a>
                                      <a href="veiw_user_single.php?viewid=<?php echo $row['u_id'];?>" class="btn btn-warning">
                                        View
                                      </a>
                                      <a href="edit_img.php?editid=<?php echo $row['u_id'];?>" class="btn btn-info">
                                        Edit Image
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
                    location.href="delete_user.php?deleteid="+id;
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