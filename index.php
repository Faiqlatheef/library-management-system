<?php 
session_start();
?>

<!DOCTYPE html>
<html>
    
<head>
  <title>My Login Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

  <?php include 'structure/head.php'; ?>
  <style type="text/css">
    body,
    html {
      margin: 0;
      padding: 0;
      height: 100%;
    }
    .user_card {
      height: 400px;
      width: 350px;
      margin-top: auto;
      margin-bottom: auto;
      position: relative;
      display: flex;
      justify-content: center;
      flex-direction: column;
      padding: 10px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      border-radius: 5px;
      background-image: url(logo/box1.jpg);
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;

    }
    .brand_logo_container {
      position: absolute;
      height: 170px;
      width: 170px;
      top: -75px;
      border-radius: 50%;
      background: #60a3bc;
      padding: 10px;
      text-align: center;
    }
    .brand_logo {
      height: 150px;
      width: 150px;
      border-radius: 50%;
      border: 2px solid white;
    }
    .form_container {
      margin-top: 100px;
    }
    .login_btn {
      width: 100%;
      background: #0f90ec!important;
      color: white !important;
    }
    .login_btn:focus {
      box-shadow: none !important;
      outline: 0px !important;
    }
    .login_container {
      padding: 0 2rem;
    }
    .input-group-text {
      background: #0f90ec !important;
      color: white !important;
      border: 0 !important;
      border-radius: 0.25rem 0 0 0.25rem !important;
    }
    .input_user,
    .input_pass:focus {
      box-shadow: none !important;
      outline: 0px !important;
    }
    .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
      background-color: #c0392b !important;
    }

    .input-group-append{
      position: absolute;
      height: 100%;
      z-index: 99;
    }

    .form-control{
      padding-left: 50px;
    }
  </style>
</head>
<!--Coded with love by Mutiullah Samim-->
<body style="background-image: url('logo/book2.jpg');background-repeat: no-repeat; background-position: center; background-size: cover;">
  <div class="container h-100">
    <div class="d-flex justify-content-center h-100">
      <div class="user_card">
        <div class="d-flex justify-content-center">
          <div class="brand_logo_container">
            <img src="<?php echo $url?>logo/logo.jpg" class="brand_logo" alt="Logo">
          </div>
        </div>
        <div class="d-flex justify-content-center form_container">
          <form method="POST" >
            <div class="input-group mb-3">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" name="username" class="form-control input_user" placeholder="username">
            </div>
            <div class="input-group mb-2">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" name="password" class="form-control input_pass" placeholder="password">
            </div>
            <div class="d-flex justify-content-center mt-3 login_container">
              <button type="submit" name="Login" value="Login" class="btn login_btn">Login</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
  <?php include 'structure/script.php'; ?>
</body>
</html>


<?php

  if (isset($_POST['Login'])) {

  include'structure/connection.php';
  $username=$_POST['username'];
  $password=$_POST['password'];

  $sql="SELECT * FROM users WHERE username='$username' ";
  $query=mysqli_query($con,$sql);

  $count=mysqli_num_rows($query);

  if ($count==0) {
    ?>
          <script type="text/javascript">
            $.alert({
              title:'Warning!',
              icon:'fa fa-times',
              content:'Sorry Username Not Found!',
              animation:'zoom',
              closeAnimation:'scale',
              theme:'modern',
              type:'red',

            })
          </script>
        <?php
  }

  else{
    $sql1="SELECT * FROM users u 
            INNER JOIN usertype ut 
            ON u.u_type=ut.ut_id 
            WHERE u.username='$username' ";
    $query1=mysqli_query($con,$sql1);

    while ($row=mysqli_fetch_array($query1)) {
      if ($password==$row['password'] && $row['u_status']=="Active" ) {
            $_SESSION['sessionname']=$row['f_name'];
            $_SESSION['sessionu_type']=$row['ut_name'];
            $_SESSION['sessionid']=$row['u_id'];
            ?>
              <script>
                window.location.href = "main.php";
              </script>
            <?php
            
          }
      elseif ($row['u_status']=="Disable") {
        ?>
          <script type="text/javascript">
            $.alert({
              title:'Warning!',
              icon:'fa fa-times',
              content:'Sorry your account has expired !',
              animation:'zoom',
              closeAnimation:'scale',
              theme:'modern',
              type:'red',

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
              content:'Sorry Wrong Password !',
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


