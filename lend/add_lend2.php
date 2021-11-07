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
  $id=$_GET['reid'];
  include'../structure/connection.php';
  $sql="
  SELECT * FROM b_lend l 
  INNER JOIN b_reserve br on br.re_id=l.re_id
  INNER JOIN books b on b.b_id=br.b_id 
  INNER JOIN book_type bt ON bt.bt_id=b.b_type
  INNER JOIN users u ON u.u_id=br.u_id
  WHERE l.l_id='$id';
  ";

  $query=mysqli_query($con,$sql);
  while ($row=mysqli_fetch_array($query)) {
      $ex_date=$row['ex_date'];
      $bookname=$row['b_name'];
      $re_id=$row['re_id'];
      $isbn=$row['isbn'];
      $b_pubdate=$row['b_pubdate'];
      $bt_name=$row['bt_name'];
      $f_name=$row['f_name'];
      $ll_id=$_SESSION['sessionname'];
      $l_date=date("Y/m/d");
      $b_img=$row['b_img'];
   
  }
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <?php include "../structure/head.php" ?>
</head>

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
                      <h1>Lend</h1>
                      <form action="" method="POST" data-toggle="validator" enctype="multipart/form-data">
                        <div class="row">
                          <!-- Inputs -->
                          <div class="row mt-30" >
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
                              <div class="panel panel-info">
                                <div class="panel-heading " style="background-color: #006df0">
                                  <h3 class="panel-title text-center " style="color: white;">Book Lend</h3>
                                </div>
                                <div class="panel-body" style="background-image: url('../logo/logo2.jpg');background-repeat: no-repeat; background-position: center;  background-size: cover; ">
                                  <div class="row" >
                                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="Book Pic" src="../uploads/books/<?php echo $b_img?>"> </div>
                                    <div class=" col-md-9 col-lg-9 "> 
                                      <table class="table table-user-information">
                                        <tbody>
                                          <tr>
                                            <td>Book Name:</td>
                                            <td><?php echo $bookname?></td>
                                          </tr>
                                          <tr>
                                            <td>ISBN:</td>
                                            <td><?php echo $isbn?></td>
                                          </tr>
                                          <tr>
                                            <td>Published Date:</td>
                                            <td><?php echo $b_pubdate?></td>
                                          </tr>
                                          <tr>
                                            <td>Book Type</td>
                                            <td><?php echo $bt_name?></td>
                                          </tr>
                                          <tr>
                                            <td>User Name</td>
                                            <td><?php echo $f_name?></td>
                                          </tr>
                                          <tr>
                                            <td>Librarian ID</td>
                                            <td><?php echo $ll_id?></td>
                                          </tr>
                                          <tr>
                                            <td>Lend Date</td>
                                            <td><?php echo $l_date?></td>
                                          </tr>
                                          <tr>
                                            <td>Expected Date</td>
                                            <td><?php echo $ex_date?></td>
                                          </tr>
                                    </table>
                                  </div>
                                </div>
                              </div>
                              <div class="panel-footer">
                                <span class="pull-right">
                                  <a href="delete_l_book.php" data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                                  <a href="veiw_lend.php" data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="fa fa-reply"></i></a>
                                </span>
                              </div>
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

</body>

</html>


