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

$data=$_GET['editid'];

include '../structure/connection.php';

$sql="SELECT * FROM users WHERE u_id='$data'";
$query=mysqli_query($con,$sql);
while ($row=mysqli_fetch_array($query)) {
	$id=$row['u_id'];
  $u_imgold=$row['u_img'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <?php include '../structure/head.php'; ?>
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
                        <a href="../index.php"><img class="main-logo" src="<?php echo"$url"?>img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <?php include "../structure/topbar.php" ?>
            <?php include "../structure/mobile-menu.php" ?>
            <?php include "../structure/breadcrumb.php" ?>
        </div>
        <div div class="col-12 bg-primary p-3 text-center">
      	   <h2>Edit Users Image Form</h2>
        </div>

      	<div class="container">
            <form action="" method="POST" data-toggle="validator" enctype="multipart/form-data">

              <div class="row">

                <div class="col-6 bg-white p-3" >
                  <img src="../uploads/users/<?php echo $u_imgold?>" alt="User Pic">
                  <div class="form-group">
                  Select user image to upload:
                  <input type="file" name="fileToUpload" id="fileToUpload" required="">
                  </div> 
                </div>

                <div class="col-12 p-3">
                  <input type="submit" class="btn btn-success" value="Submit" name="submit">
                </div>

              </div>
            </form>
          </div>    
          <?php include '../structure/script.php'; ?>

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

          $uimg=$_FILES["fileToUpload"]["name"];

          $sql="UPDATE users SET u_img='$uimg' WHERE u_id='$id'";
          $query=mysqli_query($con,$sql);
          if ($query) {
            ?>
              <script type="text/javascript">
                $.confirm({
                    title:'Success!',
                    icon:'fa fa-check',
                    content:'Data Successfully Inserted !',
                    animation:'zoom',
                    closeAnimation:'scale',
                    theme:'modern',
                    type:'green',
                    buttons: {
                        okay: function () {
                            location.reload();
                        },   
                    }
                });
               
              </script>
            <?php
          
          }
          if ($query) {
            unlink("../uploads/users/$u_imgold");
          }
          else{
            echo "<h1 class='text-danger text-center display-1' > Data not Inserted </h1>";
          }
      }
  }
}


?>
