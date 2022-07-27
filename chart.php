<?php

session_start();
error_reporting(0);
include('db.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{
    $userid=$_SESSION['detsuid'];
header('Content-Type: application/json');



$sqlQuery = "SELECT Expenseitem,ExpenseCost FROM tblexpense WHERE UserId= '$userid'";

$result = mysqli_query($con,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;

}

mysqli_close($con);

echo json_encode($data);

  }
?>