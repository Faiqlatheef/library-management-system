<?php 
  session_start();
  if(!$_SESSION['sessionname']){
    header("Location:../index.php");
  }
  elseif ($_SESSION['sessionu_type']!="Librarian" && $_SESSION['sessionu_type']!="Lecturer" && $_SESSION['sessionu_type']!="Student" ) {
    header("Location:../main.php");
  }
?>
<?php 
$data=$_GET['viewid'];
include '../structure/connection.php';

$sql="SELECT * FROM users u INNER JOIN usertype t ON t.ut_id=u.u_type WHERE u.u_id='$data'";
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
  $u_img=$row['u_img'];
  $ut_name=$row['ut_name'];
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

<body >
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
    <div class="container mt-40" >

      <!-- Printing form veiw start -->
      <div class="row" >
        <div class="col-12" style="background-image: url('../logo/logo2.jpg');background-repeat: no-repeat; background-position: center; background-size: cover; ">
          <div class="hidden">
            <div id="printDiv">
             <table class="table table-user-information">
              <tbody>
                  <tr>
                    <td rowspan="7" style="width: 20%;"><img alt="User Pic" src="../uploads/users/<?php echo $u_img?>" ></td>
                    <td>First Name:</td>
                    <td><?php echo $f_name?></td>
                  </tr>
                  <tr>
                    <td>Last Name:</td>
                    <td><?php echo $l_name?></td>
                  </tr>
                  <tr>
                    <td>Gender:</td>
                    <td><?php echo $u_gender?></td>
                  </tr>
                  <tr>
                    <td>Mobile Number</td>
                    <td><?php echo $u_mob?></td>
                  </tr>
                  <tr>
                    <td>NIC</td>
                    <td><?php echo $u_nic?></td>
                  </tr>
                  <tr>
                    <td>User Status</td>
                    <td><?php echo $ustatus?></td>
                  </tr>
                  <tr>
                    <td>User Type</td>
                    <td><?php echo $ut_name?></td>
                  </tr>
                  <td>User Name</td>
                  <td><?php echo $username?></td> 
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Printing form veiw end -->



  <div class="row mt-30" >
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
      <div class="panel panel-info">
        <div class="panel-heading " style="background-color: #006df0">
          <h3 class="panel-title text-center " style="color: white;">User Detail</h3>
        </div>
        <div class="panel-body">
          <div class="row" style="background-image: url('../logo/logo2.jpg');background-repeat: no-repeat; background-position: center; background-attachment: fixed; background-size: 100% 100%; ">
            <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="../uploads/users/<?php echo $u_img?>"> </div>
            <div class=" col-md-9 col-lg-9 "> 
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>First Name:</td>
                    <td><?php echo $f_name?></td>
                  </tr>
                  <tr>
                    <td>Last Name:</td>
                    <td><?php echo $l_name?></td>
                  </tr>
                  <tr>
                    <td>Gender:</td>
                    <td><?php echo $u_gender?></td>
                  </tr>
                  <tr>
                    <td>Mobile Number</td>
                    <td><?php echo $u_mob?></td>
                  </tr>
                  <tr>
                    <td>NIC</td>
                    <td><?php echo $u_nic?></td>
                  </tr>
                  <tr>
                    <td>User Status</td>
                    <td><?php echo $ustatus?></td>
                  </tr>
                  <tr>
                    <td>User Type</td>
                    <td><?php echo $ut_name?></td>
                  </tr>
                  <tr>
                  <td>User Name</td>
                  <td><?php echo $username?></td> 
                  </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" id="doPrint" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></a>
        <span class="pull-right">
          <a href="edit_user.php?editid=<?php echo $id;?>" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="fa fa-pencil-square-o"></i></a>
          <a href="delete_user.php" data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
          <a href="veiw_user.php" data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i></a>
        </span>
      </div>
    </div>
    </div>
  </div>



</div>
</div>



<script>
  document.getElementById("doPrint").addEventListener("click", function() {
   var printContents = document.getElementById('printDiv').innerHTML;
   var originalContents = document.body.innerHTML;
   document.body.innerHTML = printContents;
   window.print();
   document.body.innerHTML = originalContents;
 });
</script>

</body>
<?php include "../structure/script.php" ?>
</html>