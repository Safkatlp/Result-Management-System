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
  $id = $_GET['delete'];

  $delete = "DELETE FROM `tblstudent` WHERE `tblstudent`.`id` = $id";
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

if(isset($_POST['editId'])){
    $id = $_POST['editId'];
    $fname = strtoupper(validate( $_POST['editFirstName'] )) ;
    $lname = strtoupper(validate( $_POST['editLastName'] )) ;
    $class = validate( $_POST['editClass'] ) ;
    $section = strtoupper(validate( $_POST['editSection'] )) ;
    $roll = validate( $_POST['editRollNo'] ) ;
    $bloodgroup = strtoupper(validate( $_POST['editBloodGroup'] )) ;
    $dob = validate( $_POST['editDob'] ) ;
    $address = validate( $_POST['editAddress'] ) ;
    $gname = strtoupper(validate( $_POST['editGaurdianName'] )) ;
    $relation = validate( $_POST['editRelation'] ) ;
    $gphone = validate( $_POST['editGaurdianPhone'] ) ;
    

    $update = "UPDATE `tblstudent` SET `firstname` = '$fname', `lastname` = '$lname', `class` = '$class', `section` = '$section', `roll` = '$roll', `bloodgroup` = '$bloodgroup', `dob` = '$dob', `address` = '$address', `gaurdianname` = '$gname', `relation` = '$relation', `gaurdianphone` = '$gphone' WHERE `tblstudent`.`id` = '$id';";


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
    <title>Student List</title>
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
          <h5 class="modal-title" id="updateModal">Edit Studnet Info</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" name = "student_edit">

                <div class="container text-black border border-primary  col row g-3  m-auto">
      
                  <span style class="border-bottom pb-1 text-center h4">Student Details </span>
                    <input type="hidden" name="editId" id = "editId">
                  <div class="col-md-6">
                    <label for="editFirstName" class="form-label">First Name*</label>
                    <input type="text" class="form-control" id="editFirstName" name="editFirstName" required>
                  </div>
      
                  <div class="col-md-6">
                    <label for="editLastName" class="form-label">Last Name*</label>
                    <input type="text" class="form-control" id="editLastName" name="editLastName" required>
                  </div>
      
                  <div class="col-md-6">
                    <label for="editClass" class="form-label">Class*</label>
                    <input type="text" class="form-control" id="editClass" name="editClass" required>
                  </div>
      
                  <div class="col-md-6">
                    <label for="editSection" class="form-label">Section*</label>
                    <input type="text" class="form-control" id="editSection" name="editSection" required>
                  </div>
      
                  <div class="col-md-6">
                    <label for="editRollNo" class="form-label">ROll No*</label>
                    <input type="text" class="form-control" id="editRollNo" name="editRollNo" required>
                  </div>
      
                  <div class="col-md-6">
                    <label for="editBloodGroup" class="form-label">Blood Group*</label>
                    <input type="text" class="form-control" id="editBloodGroup" name="editBloodGroup" required>
                  </div>
      
                  <div class="col-md-6">
      
                    <label for="editDob" class="form-label">Date of Birth*</label>
                    <input type="date" class="form-control" id="editDob" name="editDob" required>
                  </div>
      
                  <div class="form-group">
                    <label for="editAddress">Address*</label>
                    <textarea class="form-control" id="editAddress" rows="1" name="editAddress" required></textarea>
                  </div>
      
                  <span class="border-top"></span>
                  <span class=" border-bottom pb-1 pt-3 text-center h4">Gaurdian Details </span>
      
      
                  <div class="col-md-6">
                    <label for="editGaurdianName" class="form-label">Gaurdian Name*</label>
                    <input type="text" class="form-control" id="editGaurdianName" name="editGaurdianName" required>
                  </div>
      
                  <div class="col-md-6">
                    <label for="editRelation" class="form-label">Relation</label>
                    <input type="text" class="form-control" id="editRelation" name="editRelation" required>
                  </div>
      
      
                  <div class="col-md-6">
                    <label for="editGaurdianPhone" class="form-label">Gaurdian Phone*</label>
                    <input type="tel" class="form-control" id="editGaurdianPhone" name="editGaurdianPhone" required>
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
                        <th scope="col">S.Id</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Class</th>
                        <th scope="col">Section</th>
                        <th scope="col">Roll</th>
                        <th scope="col">Blood Grp</th>
                        <th scope="col">D.O.B</th>
                        <th scope="col">Address</th>
                        <th scope="col">Gaurdian Name</th>
                        <th scope="col">Relation</th>
                        <th scope="col">Gaurdian Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <!-- table body -->
                <tbody>
                    <!-- inserting table data into body -->
                    <?php
                        $sql = "SELECT * FROM `tblstudent`";
                        $result = mysqli_query($con, $sql);
                        $sl = 0;
                        while($row = mysqli_fetch_assoc($result))
                        {    
                                 $sl++;
                                    echo   "<tr>"
                                                ."<th scope='row'>".$sl."</th>"
                                                ."<td scope='row'>".$row['id']."</td>"
                                                ."<td>".$row['firstname']."</td>"
                                                ."<td>".$row['lastname']."</td>"
                                                ."<td>".$row['class']."</td>"
                                                ."<td>".$row['section']."</td>"
                                                ."<td>".$row['roll']."</td>"
                                                ."<td>".$row['bloodgroup']."</td>"
                                                ."<td>".$row['dob']."</td>"
                                                ."<td>".$row['address']."</td>"
                                                ."<td>".$row['gaurdianname']."</td>"
                                                ."<td>".$row['relation']."</td>"
                                                ."<td>".$row['gaurdianphone']."</td>"
                                                ."<td>
                                                <span class = 'btn-group'>
                                                    <button class = 'edit btn btn-sm btn-outline-primary' id = 'e".$row['id']."'>Edit</button> <button class = 'delete btn btn-sm btn-outline-danger' id = 'd".$row['id']."'>Delete</button>    
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

                id              = row.getElementsByTagName('td')[0].innerText;
                fname           = row.getElementsByTagName('td')[1].innerText;
                lname           = row.getElementsByTagName('td')[2].innerText;
                cls             = row.getElementsByTagName('td')[3].innerText;
                section         = row.getElementsByTagName('td')[4].innerText;
                roll            = row.getElementsByTagName('td')[5].innerText;
                bloodGroup      = row.getElementsByTagName('td')[6].innerText;
                dob             = row.getElementsByTagName('td')[7].innerText;
                address         = row.getElementsByTagName('td')[8].innerText;
                gaurdianName    = row.getElementsByTagName('td')[9].innerText;
                relation        = row.getElementsByTagName('td')[10].innerText;
                gaurdianPhone   = row.getElementsByTagName('td')[11].innerText;

                editId.value = id;
                editFirstName.value = fname;
                editLastName.value = lname;
                editClass.value = cls;
                editSection.value = section;
                editRollNo.value = roll;
                editBloodGroup.value = bloodGroup;
                editDob.value = dob;
                editAddress.value = address;
                editGaurdianName.value = gaurdianName;
                editRelation.value = relation;
                editGaurdianPhone.value =gaurdianPhone;

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

                id = row.getElementsByTagName('td')[0].innerText;

              
                if(confirm("sure to dleete")){
                    window.location =`?delete=${id}`;
                }
                

                
                //updateModal.toggle();
                //$('#updateModal').modal('toggle');

            });
        });
    </script>

</body>

</html>