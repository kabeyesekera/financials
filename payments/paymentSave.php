<?php

include '../databaseConnection/databaseConnect.php';
$conn = new mysqli($servername, $username, $password, $dbname);

$method = $_POST["Method"];
$customer = $_POST["CustomerName"];
$amount = $_POST["TotalAmount"];
$bank = $_POST["bank"];
$sqlbankID = "SELECT * FROM bank WHERE bankName='$bank'";


$resultTest = mysqli_query($conn, $sqlbankID);
$bankID = mysqli_fetch_assoc($resultTest);
echo $bankID['id'];


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$sql = "INSERT INTO payment (method, amount, customer) VALUES ('$method', '$amount', '$customer')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    // Getting payment ID//////////////////
    $last_id = mysqli_insert_id($conn);
    echo $bank;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }






// adding bank details//////////////////
if ($method == 'BankTransfer')  {
    $sqlBank = "INSERT INTO paymentaccount (payment_id, bank_id) VALUES ('$last_id', '$bankID[id]')";
    if ($conn->query($sqlBank) === TRUE) {
      echo "New record created successfully";

      
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  

  // adding cheque details/////////////////
  if ($method == 'Cheque') 
  {
    for ($x = 1; $x <= 20; $x++)
    {
      $chequeNo = "chequeNo".$x;
      $branchCode = "branchNo".$x;
      $bankCode = "bankNo".$x;
      $amount = "chequeAmount".$x;
      $chequeDate = "chequeDate".$x;

        if(!empty($_POST[$amount]))
        {

              $sqlCheque = "INSERT INTO paymentcheques (payment_id, chequeNo, BankCode, BranchCode, amount, chequeDate) 
              VALUES ('$last_id','$_POST[$chequeNo]', '$_POST[$bankCode]', '$_POST[$branchCode]', '$_POST[$amount]', '$_POST[$chequeDate]')";
                  if ($conn->query($sqlCheque) === TRUE) 
                  {
                    echo "New record created successfully";
                  } else 
                  {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
        }

     
    }
  }

$conn->close();
header('Location: ../payments/paymentIndex.php');

?>