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
  SELECT * FROM b_reserve br 
  INNER JOIN books b on b.b_id=br.b_id 
  INNER JOIN book_type bt ON bt.bt_id=b.b_type
  INNER JOIN users u ON u.u_id=br.u_id
  WHERE br.re_id='$id';
  ";

  $query=mysqli_query($con,$sql);
  while ($row=mysqli_fetch_array($query)) {
 
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

<body onload="GetDateTime();">
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
                                    </table>
                                  </div>
                                </div>
                              </div>
                              <div class="panel-footer" style="text-align: center;">

                                 <form method="POST" data-toggle="validator" enctype="multipart/form-data">
                                        
                                    <!-- Inputs -->

                                    <input type="hidden" name="re_id" value="<?php echo $re_id ?>">             
                                    <div class="form-group">
                                      <p>Expect Return date</p>
                                      <input type="date" class="form-control" placeholder=" Published date " name="ex_date" required>
                                    </div>
                                        <button type="submit" name="submit" class="btn btn-sm btn-success" value="Lend">
                                           <i class="fa fa-briefcase"> Lend Now</i>
                                        </button>

                                 </form>
                          
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

  <?php include "../structure/script.php" ?>
  <script type="text/javascript" language="javascript">
    function GetDateTime() {

        var param1 = new Date();
        document.getElementById('l_date').value = param1;
    }
</script>
</body>

</html>

<?php



if (isset($_POST['submit'])) {

  include'../structure/connection.php';

  
  $librarianid=$_SESSION['sessionid'];
  $date=date("Y/m/d");  
  $re_id=$_POST['re_id'];
  $ex_date=$_POST['ex_date'];


  
  $sql="INSERT INTO b_lend (l_date,ex_date,re_id,ll_id) VALUES ('$date','$ex_date','$re_id','$librarianid') ";

  $query=mysqli_query($con,$sql);

  if ($query) {
    
      $sql1="UPDATE b_reserve SET re_status='Lended'
            WHERE re_id='$re_id' ";

      $query1=mysqli_query($con,$sql1);

      if ($query1) {
        ?>
            <script>
              alert('SuccessFully Lended')
            </script>
        <?php
      }
      else{
        ?>
            <script>
              alert('Lended, But Reserve status Not Changed')
            </script>
        <?php
      }


  }
  else{
    ?>
        <script>
          alert('Not Lended')
        </script>
    <?php
  }

}

?>

