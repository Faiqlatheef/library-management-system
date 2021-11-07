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

$data=$_GET['lid'];

include '../structure/connection.php';

$sql="SELECT * FROM b_lend WHERE l_id='$data'";
$query=mysqli_query($con,$sql);
while ($row=mysqli_fetch_array($query)) {
  $ex_date=$row['ex_date'];
  $today = date("YYYY-mm-dd");

  if($today < $ex_date) { 
    ?> 
      <script>
        window.location.href = "add_return_fine.php?lid=<?php echo $row['l_id'];?>";
      </script>
    <?php
   }
  else
  {
    ?> 
      <script>
        window.location.href = "add_return.php?lid=<?php echo $row['l_id'];?>";
      </script>
    <?php
  }

}

?>