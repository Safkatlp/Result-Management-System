<?php
  session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
      header("location: login.php");
      exit;
  }

  $submit_success = false;
  $submit_failed = false;
  $alert_message = "";

  include_once('dbConnection.php');

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $examcode = strtoupper( $_POST['examCode'] ) ;
    $examname = strtoupper(validate( $_POST['examName'] )) ;
    $class = validate( $_POST['class'] ) ;
    $fullmark = validate( $_POST['fullMark'] ) ;
    $passmark = validate( $_POST['passMark'] ) ;
    $courseteacher = strtoupper(validate( $_POST['courseTeacher'] )) ;
   

    $insert = "INSERT INTO `tblexam` (`examcode`, `examname`, `class`, `fullmark`, `passmark`, `courseteacher`) 
    VALUES ('$examcode', '$examname', '$class', '$fullmark', '$passmark', '$courseteacher');";

    
    $result = mysqli_query($con, $insert);

    if($result){
      $submit_success = true;
      $alert_message = "<strong>Success!</strong> Details submitted...";
    }
    else{
      $submit_failed = true;
      $alert_message = "<strong>Warning!</strong> Submission failed...";

      //die("errror big errrrorrr".mysqli_error($con));
    }

    mysqli_close($con);
  }

  function validate($data){
    $data    = trim($data);
    $data    =stripcslashes($data);
    $data    = htmlspecialchars($data);
    return $data;
  }

?>

<?php



?> 

















<!DOCTYPE html>
<html lang="en">

<head>

  <?php include_once('base_head.php')?>
  <title> </title>

</head>

<body>
  <!--navbar-->
  <?php include_once('navbar.php')?>
  <?php include_once('alert.php');
      if($submit_success == true){
        show_alert("success",$alert_message);
      }else if($submit_failed == true){
        show_alert("warning",$alert_message);
      }
  ?>


  <div class="row">
    <div class="col-md-2 d-flex">
      <!--sidebar-->
      <?php include_once('sidebar.php')?>
    </div>
    <div class="col bg-custom">
      <div class="container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name = "exam_add">

          <div class="container border border-primary bg-dark text-light my-5 pb-3 col-8 row g-3  m-auto">

            <span style class="border-bottom pb-1 text-center h4">Exam Details: </span>

            <div class="col-md-6">
              <label for="examCode" class="form-label">Exam Code</label>
              <input type="text" class="form-control" id="examCode" name="examCode">
            </div>

            <div class="col-md-6">
              <label for="examName" class="form-label">Exam Name</label>
              <input type="text" class="form-control" id="examName" name="examName">
            </div>

            <div class="col-md-6">
              <label for="class" class="form-label">Class</label>
              <input type="text" class="form-control" id="class" name="class">
            </div>

            <div class="col-md-6">
              <label for="fullMark" class="form-label">Full Mark</label>
              <input type="text" class="form-control" id="fullMark" name="fullMark">
            </div>

            <div class="col-md-6">
              <label for="passMark" class="form-label">Pass Mark</label>
              <input type="text" class="form-control" id="passMark" name="passMark">
            </div>

            <div class="col-md-6">
              <label for="courseTeacher" class="form-label">Course Teacher</label>
              <input type="text" class="form-control" id="courseTeacher" name="courseTeacher">
            </div>
            
            <span class="border-top"></span>


            <div class="col-12">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>


    <!--row end-->
  </div>









  <!--footer-->
  <?php include_once('footer.php')?>


</body>

</html>