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
    .box8 .icon,.box8 .title{margin:0;position:absolute}
.box8{box-shadow:0 0 3px rgba(0,0,0,.3);position:relative}
.box8 img{width:100%;height:auto}
.box8 .box-content{width:100%;height:100%;background:rgba(0,0,0,.6);opacity:0;position:absolute;top:0;left:0;transform:perspective(400px) rotateX(-90deg);transform-origin:center top 0;transition:all .5s ease 0s}
.box8 .icon li a,.box8 .title{background:blue;font-size:20px;color:#fff}
.box8:hover .box-content{opacity:1;transform:perspective(400px) rotateX(0)}
.box8 .title{padding:5px 7px;border-radius:5px;font-weight:600;bottom:20px;left:20px;transition:all .9s ease 0s}
.box8 .icon li a,.box9 .box-content,.box9 .icon li,.box9 img{transition:all .35s ease 0s}
.box8:hover .title{bottom:-40px}
.box8 .icon{list-style:none;padding:0;top:42%;left:0;right:0}
.box8 .icon li a{display:block;width:40px;height:40px;line-height:40px;border-radius:50%;margin-right:7px}
.box9 .icon,.box9 .title{width:100%;font-size:22px}
.box8 .icon li a:hover{background:#fff;color:#000}
@media only screen and (max-width:990px){.box8{margin-bottom:20px}
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
        <div class="container mt-40" style="background-image: url('../logo/rack3.jpg');background-repeat: repeat-y; background-position: center; background-size: cover;">
            <div class="row mt-30">
        <?php
          include '../structure/connection.php';
          $sql="SELECT * FROM books b INNER JOIN book_type t ON t.bt_id=b.b_type ORDER BY b.b_id DESC";

          $query=mysqli_query($con,$sql);
          while ($row=mysqli_fetch_array($query)) {
          ?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                    <div class="box8">
                        <img src="../uploads/books/<?php echo $row['b_img']?>">
                        <h3 class="title" style="background-color: blue;"><?php echo $row['b_name']?></h3>
                        <div class="box-content">
                            <ul class="icon">
                                <li><a href="<?php echo $url?>books/veiw_book.php"><i class="fa fa-eye " style="background-color: absolute;" ></i> </a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
           
      <?php
    }
  ?>
   </div>
        </div>

       
        
        <br>
        <?php include "../structure/footer.php" ?>
    </div>

  <?php include "../structure/script.php" ?>
  
</body>

</html>