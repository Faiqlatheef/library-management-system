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
    <!-- Start Left menu area -->
    <?php include "structure/sidebar-desktop.php" ?>
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
            <?php include "structure/topbar.php" ?>
            <?php include "structure/mobile-menu.php" ?>
            <?php include "structure/breadcrumb.php" ?>
        </div>


        <!-- Your Contents Start -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-sales-chart">

                        

                        <canvas id="bar-chart" width="800" height="450"></canvas>

                      
                        <?php 

                            // include "structure/connection.php";

                            // $sql = "SELECT sum(b.quantity) FROM books b
                            //         INNER JOIN book_type bt 
                            //         ON b.b_type=bt.bt_id
                            //         GROUP BY b.b_type";

                            // $result = mysqli_query($con,$sql);

                            // $data = array();
                            // foreach ($result as $row) {
                            //     $data[] = $row;
                            // }

                            // echo "$data";

                            // echo json_encode($data);

                         ?>



                    </div>
                </div>

            </div>
        </div>

       


        <!-- Your Contents End -->
       
        
        <br>
        <?php include "structure/footer.php" ?>
    </div>

  <?php include "structure/script.php" ?>
  
</body>

</html>



<?php

    include "structure/connection.php";
    $sql="SELECT bt.bt_name , sum(b.quantity) FROM books b
        INNER JOIN book_type bt 
        ON b.b_type=bt.bt_id
        GROUP BY b.b_type";
    $result = mysqli_query($con,$sql); 

?>

<?php

    include "structure/connection.php";
    $sql1="SELECT bt.bt_name , sum(b.quantity) FROM books b
        INNER JOIN book_type bt 
        ON b.b_type=bt.bt_id
        GROUP BY b.b_type";
    $result1 = mysqli_query($con,$sql1);

?>



<script>
    // Bar chart
    new Chart(document.getElementById("bar-chart"), {
        type: 'bar',
        data: {
            labels: [
                        <?php
                            while ($row=mysqli_fetch_array($result)) {
                               echo "'$row[0]'".",";
                            }
                        ?>
                    ],
            datasets: [{
                label: '# of Votes',
                data: [
                            <?php
                                while ($row1=mysqli_fetch_array($result1)) {
                                    echo $row1[1].",";
                                }
                            ?>
                      ],
                
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });


</script>

<script>    