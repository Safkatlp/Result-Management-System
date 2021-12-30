<?php
  session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
      header("location: login.php");
      exit;
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php include_once('base_head.php')?>
  <title>Welcome | <?php echo $_SESSION['user']?> </title>

</head>

<body>
  <!--navbar-->
  <?php include_once('navbar.php')?>


  <div class="row">
    <div class="col-md-2 d-flex">
      <!--sidebar-->
      <?php include_once('sidebar.php')?>
    </div>
    <div class="col bg-custom">
      <div class="container">
        
      </div>
    </div>


    <!--row end-->
  </div>









  <!--footer-->
  <?php include_once('footer.php')?>


</body>

</html>