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
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
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
                        <h1>Books</h1>
                          <table class="table table-hover table-bordered">
                            <tr class="text-uppercase">
                              <th>Book Name</th>
                              <th>ISBN</th>
                              <th>Published Date</th>
                              <th>Book Type</th>
                              <th>Quantity</th>
                              <th>Book Image</th>
                              <th>Actions</th>
                            </tr>

                            <?php
                              include '../structure/connection.php';
                              $sql="SELECT * FROM books b INNER JOIN book_type t ON t.bt_id=b.b_type ORDER BY b.b_id DESC";

                              $query=mysqli_query($con,$sql);

                              while ($row=mysqli_fetch_array($query)) {
                                ?>
                                  <tr>
                                    <td><?php echo $row['b_name']?></td>
                                    <td><?php echo $row['isbn']?></td>
                                    <td><?php echo $row['b_pubdate']?></td>
                                    <td><?php echo $row['bt_name']?></td>
                                    <td><?php echo $row['quantity']?></td>
                                    <td><img src="../uploads/books/<?php echo $row['b_img']?>" width="10%" alt=""></td>
                                    <td>
                                      <a onclick="deletethis(this.id)" id="<?php echo $row['b_id'];?>" class="btn btn-danger">
                                        DELETE
                                      </a>
                                      <a href="edit_book.php?editid=<?php echo $row['b_id'];?>" class="btn btn-primary">
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
                    location.href="delete_book.php?deleteid="+id;
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