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
                      <form action="add_user.php" method="POST" data-toggle="validator" enctype="multipart/form-data">
                        <div class="row">
                          <!-- Inputs -->

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder=" First Name" name="f_name" required>
                            </div> 
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder=" Last Name" name="l_name" required>
                            </div> 
                          </div>

                          <div class="col-6 bg-white p-3 col-lg-6 col-md-6 col-sm-6 col-xs-6"  >
                            <div class="form-group">
                              <p>User Gender</p>
                              <select class="form-control" name="u_status">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                              </select>
                            </div> 
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                            <div class="form-group">
                              <input type="number" class="form-control" placeholder=" Mobile Number" name="u_mob" required>
                            </div> 
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder=" NIC " name="u_nic" required>
                            </div> 
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder=" Address " name="u_add" required>
                            </div> 
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                            <div class="form-group">
                              <p>User Type</p>
                              <select class="form-control" name="u_type" required >
                              <?php
                                include'../structure/connection.php';
                                $sql="SELECT ut_id,ut_name FROM usertype";
                                $query=mysqli_query($con,$sql);
                                while ($row=mysqli_fetch_array($query)) {
                                  ?>
                                  <option value="<?php echo $row['ut_id'];?>"><?php echo $row['ut_name']; ?></option>
                                  <?php
                                }
                              ?>
                              </select>
                            </div> 
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="Username " name="username" required>
                            </div> 
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-white " >
                            <div class="form-group">
                              <input type="password" class="form-control" placeholder="Password" name="password" required >
                            </div> 
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 bg-white p-3" >
                            <div class="form-group">
                              <p>User Status</p>
                              <select class="form-control" name="u_status">
                                <option value="Active">Active</option>
                                <option value="Disable">Disable</option>
                              </select>
                            </div> 
                          </div>

                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 bg-white p-3" >
                            <div class="form-group">
                            Select user image to upload:
                            <input type="file" name="fileToUpload" id="fileToUpload">
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
  $target_dir = "../uploads/users/";
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
  if ($_FILES["fileToUpload"]["size"] > 500000) {
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
          $f_name=$_POST['f_name'];
          $l_name=$_POST['l_name'];
          $u_gender=$row['u_gender'];
          $u_mob=$_POST['u_mob'];
          $u_nic=$_POST['u_nic'];
          $u_add=$_POST['u_add'];
          $u_status=$_POST['u_status'];
          $u_type=$_POST['u_type'];
          $username=$_POST['username'];
          $password=$_POST['password'];
          $uimg=$_FILES["fileToUpload"]["name"];

          $sql="INSERT INTO users (f_name,l_name,u_gender,u_mob,u_nic,u_add,u_status,u_type,username,password,u_img) 
            VALUES ('$f_name','$l_name','$u_gender','$u_mob','$u_nic','$u_add','$u_status','$u_type','$username','$password','$uimg')";
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
                  title:'Something Wrong!',
                  icon:'fa fa-times',
                  content:'Data not Inserted !',
                  animation:'zoom',
                  closeAnimation:'scale',
                  theme:'modern',
                  type:'Red',

                })
              </script>
            <?php
            
          }
      }
  }
}

?>