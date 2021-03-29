<?php

include '../databaseConnection/databaseConnect.php';

$bankName = $_POST["BankName"];
$branch = $_POST["Branch"];
$account = $_POST["AccountNumber"];


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$sql = "INSERT INTO bank (bankName, AccountNum, branch) VALUES ('$bankName', '$account', '$branch')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    echo $bank;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();

  header('Location: ../banks/bankIndex.php');

?>