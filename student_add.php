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
    $fname = strtoupper(validate( $_POST['firstName'] )) ;
    $lname = strtoupper(validate( $_POST['lastName'] )) ;
    $class = validate( $_POST['class'] ) ;
    $section = strtoupper(validate( $_POST['section'] )) ;
    $roll = validate( $_POST['rollNo'] ) ;
    $bloodgroup = strtoupper(validate( $_POST['bloodGroup'] )) ;
    $dob = validate( $_POST['dob'] ) ;
    $address = validate( $_POST['address'] ) ;
    $gname = strtoupper(validate( $_POST['gaurdianName'] )) ;
    $relation = validate( $_POST['relation'] ) ;
    $gphone = validate( $_POST['gaurdianPhone'] ) ;
    

    $insert = "INSERT INTO `tblstudent` (`firstname`, `lastname`, `class`, `section`, `roll`, `bloodgroup`, `dob`, `address`, `gaurdianname`, `relation`, `gaurdianphone`) 
    VALUES ('$fname', '$lname', '$class', '$section', '$roll', '$bloodgroup', '$dob', '$address', '$gname', '$relation', '$gphone');";

    
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
// insert query
//INSERT INTO `tblstudent` (`id`, `firstname`, `lastname`, `class`, `section`, `roll`, `bloodgroup`, `dob`, `address`, `gaurdianname`, `relation`, `gaurdianphone`, `email`) 
//VALUES (NULL, 'Safkat', 'Khan', '10', 'A', '11', 'A+', '2021-12-07', 'chittagong', 'Mr. Khan', 'family', '8892020', 'sl@gmail.com');






  // if(!empty($_POST['student_add'])){
  //   echo "set";
  // }


  // $sql = "SELECT * FROM `tblstudent`";
  
  // $result = mysqli_query($con, $sql);

  // while($row = mysqli_fetch_assoc($result)){
  //   echo "id = ".$row['id']. "|"."First Name = ".$row['firstname']. "|"."Last Name = ".$row['lastname']. "|"."class = ".$row['class']. "|".
  //   "section = ".$row['section']. "|"."roll = ".$row['roll']. "|"."blood = ".$row['bloodgroup']. "|"."dob= ".$row['dob']. "|"."address = ".$row['address']. "|".
  //   "gaurdian name = ".$row['gaurdianname']. "|"."relation = ".$row['relation']. "|"."gaurdian phone = ".$row['gaurdianphone']. "|"."email = ".$row['email']. "<br/>";
  // }




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
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name = "student_add">

          <div class="container border border-primary bg-dark text-light my-5 pb-3 col-8 row g-3  m-auto">

            <span style class="border-bottom pb-1 text-center h4">Student Details </span>

            <div class="col-md-6">
              <label for="firstName" class="form-label">First Name*</label>
              <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>

            <div class="col-md-6">
              <label for="lastName" class="form-label">Last Name*</label>
              <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>

            <div class="col-md-6">
              <label for="class" class="form-label">Class*</label>
              <input type="text" class="form-control" id="class" name="class" required>
            </div>

            <div class="col-md-6">
              <label for="section" class="form-label">Section*</label>
              <input type="text" class="form-control" id="section" name="section" required>
            </div>

            <div class="col-md-6">
              <label for="rollNo" class="form-label">ROll No*</label>
              <input type="text" class="form-control" id="rollNo" name="rollNo" required>
            </div>

            <div class="col-md-6">
              <label for="bloodGroup" class="form-label">Blood Group*</label>
              <input type="text" class="form-control" id="bloodGroup" name="bloodGroup" required>
            </div>

            <div class="col-md-6">

              <label for="dob" class="form-label">Date of Birth*</label>
              <input type="date" class="form-control" id="dob" name="dob" required>
            </div>

            <div class="form-group">
              <label for="address">Address*</label>
              <textarea class="form-control" id="address" rows="1" name="address" required></textarea>
            </div>

            <span class="border-top"></span>
            <span class=" border-bottom pb-1 pt-3 text-center h4">Gaurdian Details </span>


            <div class="col-md-6">
              <label for="gaurdianName" class="form-label">Gaurdian Name*</label>
              <input type="text" class="form-control" id="gaurdianName" name="gaurdianName" required>
            </div>

            <div class="col-md-6">
              <label for="relation" class="form-label">Relation</label>
              <input type="text" class="form-control" id="relation" name="relation" required>
            </div>


            <div class="col-md-6">
              <label for="gaurdianPhone" class="form-label">Gaurdian Phone*</label>
              <input type="tel" class="form-control" id="gaurdianPhone" name="gaurdianPhone" required>
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