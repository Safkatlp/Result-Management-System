<?php
  session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
      header("location: login.php");
      exit;
  }


$update_success = false;
$update_failed = false;
$delete_success = false;
$delete_failed = false;
$alert_message = "";


include_once('dbConnection.php');

if(isset($_GET['delete'])){
  $examcode = $_GET['delete'];

  $delete = "DELETE FROM `tblexam` WHERE `tblexam`.`examcode` = '$examcode'";

  
  $result = mysqli_query($con, $delete);

  if($result){
    $delete_success = true;
    $alert_message = "<strong>Success!</strong> Deleted successfully....";

  }
  else{
    $delete_failed = true;
    $alert_message = "<strong>Warning!</strong> Delete failed...";

    //die("errror big errrrorrr".mysqli_error($con));
  }

}

if(isset($_POST['editExamCode'])){
    $examcode = strtoupper($_POST['editExamCode']);
    $examname = strtoupper(validate( $_POST['editExamName'] )) ;
    $class = strtoupper(validate( $_POST['editClass'] )) ;
    $fullmark = validate( $_POST['editFullMark'] ) ;
    $passmark = validate( $_POST['editPassMark'] ) ;
    $courseteacher = strtoupper(validate( $_POST['editCourseTeacher'] )) ;
    

    $update = "UPDATE `tblexam` SET  `examname` = '$examname', `class` = '$class', `fullmark` = '$fullmark', `passmark` = '$passmark', `courseteacher` = '$courseteacher' WHERE `tblexam`.`examcode` = '$examcode';";
    

    $result = mysqli_query($con, $update);

    if($result){
      $update_success = true;
      $alert_message = "<strong>Success!</strong> Details updated....";
    }
    else{
      $updatet_failed = true;
      $alert_message = "<strong>Warning!</strong> Update failed...";

      //die("errror big errrrorrr".mysqli_error($con));
    }
    

    
  }

  function validate($data){
    $data    = trim($data);
    $data    =stripcslashes($data);
    $data    = htmlspecialchars($data);
    return $data;
  }





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- head section -->
    <?php include_once('base_head.php')?>
    <title>Exam List</title>
</head>



<body>

    <!--navbar-->
    <?php include_once('navbar.php')?>

    <?php include_once('alert.php');
      if($update_success == true){
        show_alert("success",$alert_message);
      }
      else if($update_failed == true){
        show_alert("warning",$alert_message);
      }
      else if($delete_success == true){
        show_alert("success",$alert_message);
      }
      else if($delete_failed == true){
        show_alert("warning",$alert_message);
      }
  ?>


    <div class="row d-flex flex-row">
        <div class="col-md-1 d-flex">
            <!--sidebar-->
            <?php include_once('sidebar.php')?>
        </div>
        
        <div class="col  my-3" style="padding-left: 80px; padding-right: 30px">
            <table class="table  table-striped table-hover table-sm " id="myTable">


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal">
    Launch static backdrop modal
  </button> -->
  
  <!-- Modal -->
  <div class="modal fade " id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModal">Edit Exam Info</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name = "exam_edit">

                <div class="container text-black border border-primary  col row g-3  m-auto">
      
                  <span style class="border-bottom pb-1 text-center h4">Exam Details </span>
                   
                  <div class="col-md-6">
                    <label for="editExamCode" class="form-label">Exam Code*</label>
                    <input type="text" class="form-control" id="editExamCode" name="editExamCode" required>
                  </div>
      
                  <div class="col-md-6">
                    <label for="editExamName" class="form-label">Exam Name*</label>
                    <input type="text" class="form-control" id="editExamName" name="editExamName" required>
                  </div>
      
                  <div class="col-md-6">
                    <label for="editClass" class="form-label">Class*</label>
                    <input type="text" class="form-control" id="editClass" name="editClass" required>
                  </div>
      
                  <div class="col-md-6">
                    <label for="editFullMark" class="form-label">Full Mark*</label>
                    <input type="text" class="form-control" id="editFullMark" name="editFullMark" required>
                  </div>
      
                  <div class="col-md-6">
                    <label for="editPassMark" class="form-label">Pass Mark*</label>
                    <input type="text" class="form-control" id="editPassMark" name="editPassMark" required>
                  </div>
      
                  <div class="col-md-6">
                    <label for="editCourseTeacher" class="form-label">Course Teacher*</label>
                    <input type="text" class="form-control" id="editCourseTeacher" name="editCourseTeacher" required>
                  </div>
      
      
                  <span class="border-top"></span>
      
      
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary mb-2">Update</button>
                  </div>
                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>




                <!--table head-->
                <thead class="table-dark ">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Exam Code</th>
                        <th scope="col">Exam Name</th>
                        <th scope="col">Class</th>
                        <th scope="col">Full Mark</th>
                        <th scope="col">Pass Mark</th>
                        <th scope="col">Course Teacher</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <!-- table body -->
                <tbody>
                    <!-- inserting table data into body -->
                    <?php
                        $sql = "SELECT * FROM `tblexam`";
                        $result = mysqli_query($con, $sql);
                        $sl = 0;
                        while($row = mysqli_fetch_assoc($result))
                        {    
                                 $sl++;
                                    echo   "<tr>"
                                                ."<th scope='row'>".$sl."</th>"
                                                ."<td scope='row'>".$row['examcode']."</td>"
                                                ."<td>".$row['examname']."</td>"
                                                ."<td>".$row['class']."</td>"
                                                ."<td>".$row['fullmark']."</td>"
                                                ."<td>".$row['passmark']."</td>"
                                                ."<td>".$row['courseteacher']."</td>"
                                                ."<td>
                                                <span class = 'btn-group'>
                                                    <button class = 'edit btn btn-sm btn-outline-primary' id = 'e".$row['examcode']."'>Edit</button> <button class = 'delete btn btn-sm btn-outline-danger' id = 'd".$row['examcode']."'>Delete</button>    
                                                </span>
                                                </td>"
                                                
                                            ."</tr>";
                        }
                    ?>


                    <!--table body end-->
                </tbody>
                <!--table end-->
            </table>
        </div>
        <!--row end-->
    </div>




    <!--footer-->
    <?php include_once('footer.php')?>

    <!--data table script -->
    <script>
        $(document).ready(function () {
            $("#myTable").dataTable();
        });
    </script>

    <!--script for update operation-->
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                //e.parentElement.parentElement.parentElement
                row = e.target.parentNode.parentNode.parentNode;

                examcode              = row.getElementsByTagName('td')[0].innerText;
                examname           = row.getElementsByTagName('td')[1].innerText;
                cls           = row.getElementsByTagName('td')[2].innerText;
                fullmark             = row.getElementsByTagName('td')[3].innerText;
                passmark         = row.getElementsByTagName('td')[4].innerText;
                courseteacher            = row.getElementsByTagName('td')[5].innerText;
               

                editExamCode.value = examcode;
                editExamName.value = examname;
                editClass.value = cls;
                editFullMark.value = fullmark;
                editPassMark.value = passmark;
                editCourseTeacher.value = courseteacher;
               
                //console.log("hostname :  " ,window.location.href);

                //updateModal.toggle();
                $('#updateModal').modal('toggle');
                

            });
        });


        del = document.getElementsByClassName('delete');
        Array.from(del).forEach((element) => {
            element.addEventListener("click", (e) => {
                //e.parentElement.parentElement.parentElement
                row = e.target.parentNode.parentNode.parentNode;

                examcode = row.getElementsByTagName('td')[0].innerText;

              
                if(confirm("sure to dleete")){
                    window.location =`?delete=${examcode}`;
                }
                

                
                //updateModal.toggle();
                //$('#updateModal').modal('toggle');

            });
        });
    </script>

</body>

</html>