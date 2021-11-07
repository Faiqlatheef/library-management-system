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

$data=$_GET['bid'];

include '../structure/connection.php';

$sql="SELECT * FROM books b INNER JOIN book_type t ON t.bt_id=b.b_type WHERE b_id='$data'";
$query=mysqli_query($con,$sql);
while ($row=mysqli_fetch_array($query)) {
  $id=$row['b_id'];
  $b_name=$row['b_name'];
  $isbn=$row['isbn'];
  $b_pubdate=$row['b_pubdate'];
  $bt_name=$row['bt_name'];
  $b_img=$row['b_img'];
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

          <div class="row mt-30" >
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
              <div class="panel panel-info">
                <div class="panel-heading " style="background-color: #006df0">
                  <h3 class="panel-title text-center " style="color: white;">Book Reserve</h3>
                </div>
                <div class="panel-body" style="background-image: url('../logo/logo2.jpg');background-repeat: no-repeat; background-position: center;  background-size: cover; ">
                  <div class="row" >
                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="Book Pic" src="../uploads/books/<?php echo $b_img?>"> </div>
                    <div class=" col-md-9 col-lg-9 "> 
                      <table class="table table-user-information">
                        <tbody>
                          <tr>
                            <td>Book Name:</td>
                            <td><?php echo $b_name?></td>
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
                    </table>
                  </div>
                </div>
              </div>
              <div class="panel-footer" style="text-align: center;">

                 <form method="POST" data-toggle="validator" enctype="multipart/form-data">
                        
                    <!-- Inputs -->

                    <input type="hidden" name="bookid" value="<?php echo $id ?>">             
                      
                        <button type="submit" name="submit" class="btn btn-sm btn-primary">
                           <i class="fa fa-stack-overflow"> Reserve Now</i>
                        </button>

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
        document.getElementById('re_date').value = param1;
    }
</script>
</body>

</html>

<?php

if (isset($_POST['submit'])) {

  include'../structure/connection.php';

  $bookid=$_POST['bookid'];
  // Should to Derive from session
  $userid=$_SESSION['sessionid'];
  $date=date("Y/m/d");
  $status="Reserved";
  $qty=0;
  // Check If Book Availble By Fininding Qty
  $sql="SELECT quantity FROM books WHERE b_id='$bookid'";

  $query=mysqli_query($con,$sql);

  while ($row=mysqli_fetch_array($query)) {

    if ($row['quantity']==0) {
      echo "Sorry Book Not Available for the momement";
    }

    else
    {
        $qty=$row['quantity'];
        // If Qty > 0 Create new record in Reserve
        $sql1="INSERT INTO b_reserve (re_date,re_status,b_id,u_id) VALUES('$date','$status','$bookid','$userid')";

        $query1=mysqli_query($con,$sql1);

        // If Reserve Success Reduce Qty by 1
        if ($query1) {

          $qty=$qty-1;

          $sql2="UPDATE books SET quantity='$qty' WHERE b_id='$bookid' ";

          $query2=mysqli_query($con,$sql2);

          if ($query2) {
           echo "Successfully Reserved";
          }
          
        }

    }
    
  }

}

?>