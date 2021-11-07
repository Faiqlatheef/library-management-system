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
                      <h1>Book</h1>
                      <form method="POST" data-toggle="validator" enctype="multipart/form-data">
                        <div class="row">
                          <!-- Inputs -->

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder=" Book Name" name="b_name" required>
                            </div> 
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                            <div class="form-group">
                              <input type="number" class="form-control" placeholder=" ISBN " name="isbn" required>
                            </div> 
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                            <div class="form-group">
                              <p>Published date</p>
                              <input type="date" class="form-control" placeholder=" Published date " name="b_pubdate" required>
                            </div> 
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                            <div class="form-group">
                              <p>Book type</p> 
                              <select class="form-control" name="bt_name" required >
                              <?php
                                include'../structure/connection.php';
                                $sql="SELECT bt_id,bt_name FROM book_type";
                                $query=mysqli_query($con,$sql);
                                while ($row=mysqli_fetch_array($query)) {
                                  ?>
                                  <option value="<?php echo $row['bt_id'];?>"><?php echo $row['bt_name']; ?></option>
                                  <?php
                                }
                              ?>
                              </select>
                            </div> 
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white" >
                            <div class="form-group">
                              <input type="number" class="form-control" placeholder=" Book Quantity " name="isbn" required>
                            </div> 
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 " >
                            <div class="form-group">
                            <p>Select book image to upload:</p>
                            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                            </div> 
                          </div>

                          <div class="col-lg-12 bg-white " >
                            <div class="form-group">                             
                              <input type="submit" class="btn btn-success" value="Submit" name="submit">
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
  
</body>

</html>

<?php

if (isset($_POST['submit'])) {

  include'../structure/connection.php';
  $target_dir = "../uploads/books/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 5000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } 
  else 
  {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
          include'../structure/connection.php';
          $b_name=$_POST['b_name'];
          $isbn=$_POST['isbn'];
          $b_pubdate=$_POST['b_pubdate'];
          $bt_name=$_POST['bt_name'];
          $quantity=$_POST['quantity'];
          $b_img=$_FILES["fileToUpload"]["name"];

          $sql="INSERT INTO books (b_name,isbn,b_pubdate,b_type,quantity,b_img) 
            VALUES ('$b_name','$isbn','$b_pubdate','$bt_name','$quantity','$b_img')";
          $query=mysqli_query($con,$sql);
          if ($query) {
            ?>
              <script type="text/javascript">
                $.alert({
                  title:'Success!',
                  icon:'fa fa-check',
                  content:'Data Successfully Inserted !',
                  animation:'zoom',
                  closeAnimation:'scale',
                  theme:'modern',
                  type:'green',

                })
              </script>
            <?php
        
          }
          else{
            ?>
          <script type="text/javascript">
            $.alert({
              title:'Warning!',
              icon:'fa fa-times',
              content:'Data Not Inserted !',
              animation:'zoom',
              closeAnimation:'scale',
              theme:'modern',
              type:'red',

            })
          </script>
        <?php
          }
      }
  }
}

?>