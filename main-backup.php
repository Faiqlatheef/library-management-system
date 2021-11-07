<?php 
  session_start();
  if(!$_SESSION['sessionname']){
    header("Location:index.php");
  }
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
  <?php include "structure/head.php" ?>
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Start Left menu area -->
    <?php include "structure/sidebar-desktop.php" ?>
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
            <?php include "structure/topbar.php" ?>
            <?php include "structure/mobile-menu.php" ?>
            <?php include "structure/breadcrumb.php" ?>
        </div>


        <!-- Your Contents Start -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-sales-chart">
                        <?php  
                         $connect = mysqli_connect("localhost", "root", "", "lms");  
                         $query = "SELECT u_type, count(*) as number FROM users GROUP BY u_type";  
                         $result = mysqli_query($connect, $query);  
                         ?>  
                         <!DOCTYPE html>  
                         <html>  
                              <head>  
                                   <title>Users Types</title>  
                                   <script type="text/javascript" src="<?php echo $url?>js/chart/loader.js"></script>  
                                   <script type="text/javascript">  
                                   google.charts.load('current', {'packages':['corechart']});  
                                   google.charts.setOnLoadCallback(drawChart);  
                                   function drawChart()  
                                   {  
                                        var data = google.visualization.arrayToDataTable([  
                                                  ['User type', 'Number'],  
                                                  <?php  
                                                  while($row = mysqli_fetch_array($result))  
                                                  {  
                                                       echo "['".$row["u_type"]."', ".$row["number"]."],";  
                                                  }  
                                                  ?>  
                                             ]);  
                                        var options = {  
                                              title: 'Users Types',  
                                              //is3D:true,  
                                              pieHole: 0.4  
                                             };  
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                                        chart.draw(data, options);  
                                   }  
                                   </script>  
                              </head>  
                              <body>  
                                   <br /><br />  
                                   <div style="width:900px;"> 
                                        <div id="piechart" style="width: 900px; height: 500px;"></div>  
                                   </div>  
                              </body>  
                         </html>  
                    </div>

                </div>
                <?php  
                $connect = mysqli_connect("localhost", "root", "", "lms");  
                $query = "SELECT u_gender, count(*) as number FROM users GROUP BY u_gender";  
                $result = mysqli_query($connect, $query);  
                ?>  
                <!DOCTYPE html>  
                <html>  
                     <head>  
                          <title>Webslesson Tutorial | Make Simple Pie Chart by Google Chart API with PHP Mysql</title>  
                          <script type="text/javascript" src="<?php echo $url?>js/chart/loader.js"></script>  
                          <script type="text/javascript">  
                          google.charts.load('current', {'packages':['corechart']});  
                          google.charts.setOnLoadCallback(drawChart);  
                          function drawChart()  
                          {  
                               var data = google.visualization.arrayToDataTable([  
                                         ['Gender', 'Number'],  
                                         <?php  
                                         while($row = mysqli_fetch_array($result))  
                                         {  
                                              echo "['".$row["u_gender"]."', ".$row["number"]."],";  
                                         }  
                                         ?>  
                                    ]);  
                               var options = {  
                                     title: 'Gender of Users',  
                                     //is3D:true,  
                                     pieHole: 0.4  
                                    };  
                               var chart = new google.visualization.PieChart(document.getElementById('piechart1'));  
                               chart.draw(data, options);  
                          }  
                          </script>  
                     </head>  
                     <body>  
                          <br /><br />  
                          <div style="width:900px;">  
                               <div id="piechart1" style="width: 900px; height: 500px;"></div>  
                          </div>  
                     </body>  
                </html>  
            </div>
        </div>


        <!-- Your Contents End -->
       
        
        <br>
        <?php include "structure/footer.php" ?>
    </div>

  <?php include "structure/script.php" ?>
  
</body>

</html>