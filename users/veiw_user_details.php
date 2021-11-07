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
  <style type="text/css">
    .user-row {
    margin-bottom: 14px;
}

.user-row:last-child {
    margin-bottom: 0;
}

.dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover {
    cursor: pointer;
}

.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad
{margin-top:20px;
}


  </style>
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
        <div class="container mt-40">
            <div class="row mt-30">
        <?php
          include '../structure/connection.php';
          $sql="SELECT * FROM users u INNER JOIN usertype t ON t.ut_id=u.u_type ORDER BY u.u_id DESC";

          $query=mysqli_query($con,$sql);
          while ($row=mysqli_fetch_array($query)) {
          ?>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
                <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title"><?php echo $row['f_name']?></h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="../uploads/users/<?php echo $row['u_img']?>" class="img-circle img-responsive"> </div>

                    <div class=" col-md-9 col-lg-9 "> 
                      <table class="table table-user-information">
                        <tbody>
                          <tr>
                            <td>Department:</td>
                            <td>Programming</td>
                          </tr>
                          <tr>
                            <td>Hire date:</td>
                            <td>06/23/2013</td>
                          </tr>
                          <tr>
                            <td>Date of Birth</td>
                            <td>01/24/1988</td>
                          </tr>
                       
                             <tr>
                                 <tr>
                            <td>Gender</td>
                            <td>Female</td>
                          </tr>
                            <tr>
                            <td>Home Address</td>
                            <td>Kathmandu,Nepal</td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td><a href="mailto:info@support.com">info@support.com</a></td>
                          </tr>
                            <td>Phone Number</td>
                            <td>123-4567-890(Landline)<br><br>555-4567-890(Mobile)
                            </td>
                               
                          </tr>
                         
                        </tbody>
                      </table>
                      
                      <a href="#" class="btn btn-primary">My Sales Performance</a>
                      <a href="#" class="btn btn-primary">Team Sales Performance</a>
                    </div>
                  </div>
                </div>
                     <div class="panel-footer">
                            <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                            <span class="pull-right">
                                <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                                <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                            </span>
                        </div>
                
              </div>
            </div>
          </div>
           <?php
    }
  ?>
        </div>
      </div>

  
  
</body>
  <?php include "../structure/script.php" ?>
</html>