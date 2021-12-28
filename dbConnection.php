<?php 

$server = "localhost";
$username = "root";
$password = "";
$database = "dbresultmanagement";

$con = mysqli_connect($server,$username,$password,$database);

if(!$con){
    die("Connection failed due to". mysqli_connect_error());
}



// function insert($sql){


//     return mysqli_query($con, $sql);
// }

?>