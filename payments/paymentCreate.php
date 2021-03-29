<?php include '../layouts/admin.php';?>

<div class="container mt-2">
        <form action="paymentSave.php" method="post" onsubmit="return validateForm()">
            <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="Method">Payment Method</label>
                    <div class="col-sm-10">
                    <select class="form-control" name="Method" id="Method">
                        <option value="Cash">Cash</option>
                        <option value="Cheque">Cheque</option>
                        <option value="BankTransfer">Bank Transfer</option>
                    </select>
                    </div>
            </div>

            <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="TotalAmount">Total Amount</label> 
                    <div class="col-sm-10">
                    <input class="form-control" type="number" name="TotalAmount" id="TotalAmount">
                    </div>
            </div>

            
            <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="CustomerName">Customer Name</label> 
                    <div class="col-sm-10">
                    <input class="form-control" type="Text" name="CustomerName" id="CustomerName">
                    </div>
            </div>

                <div id="chequePayment" style="display:none;">
                        <div class="container-fluid">
                                <div class="row">
                                        <div class="col-lg-12">
                                                <style>
                                                .pre-scrollable {
                                                        max-height: 540px;
                                                        overflow-y: scroll;
                                                        /* overflow-x: scroll; */

                                                }
                                                td {
                                                        min-width: 125px;
                                                }
                                                </style>
                                                <div class="pre-scrollable">
                                                        <div class="table-responsive"> 
                                                        <table class="table table-bordered table-hover">
                                                                <thead>
                                                                        <tr>
                                                                                <th >Cheque No</th>
                                                                                <th >Branch No</th>
                                                                                <th >Bank No</th>
                                                                                <th >Amount</th>
                                                                                <th >Cheque Date</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php  
                                                                        for ($x = 1; $x <= 20; $x++) {
                                                                ?>
                                                                        <tr>
                                                                                <td><input type="number" name="chequeNo<?php echo $x; ?>" id="chequeNo<?php echo $x; ?>" class="form-control" ></td>
                                                                                <td><input type="number" name="branchNo<?php echo $x; ?>" id="branchNo<?php echo $x; ?>" class="form-control" ></td>
                                                                                <td><input type="number" name="bankNo<?php echo $x; ?>" id="bankNo<?php echo $x; ?>" class="form-control" ></td>
                                                                                <td><input type="number" name="chequeAmount<?php echo $x; ?>" id="chequeAmount<?php echo $x; ?>" class="form-control" ></td>
                                                                                <td><input type="date" name="chequeDate<?php echo $x; ?>" id="chequeDate<?php echo $x; ?>" class="form-control" ></td>
                                                                        </tr>
                                                                <?php  
                                                                        }
                                                                ?>
                                                                </tbody>
                                                        </table>
                                                        </div>
                                                </div>   
                                        </div>
                                </div>
                        </div>

                </div>
<?php 
include '../databaseConnection/databaseConnect.php';

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM bank";
$result = $conn->query($sql);
?>
                <div id="bankTransfer" style="display:none;">
                        <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label" for="bank">Bank</label>
                                <div class="col-sm-10">
                                <select class="form-select" name="bank" id="bank">
                                <?php
                                    if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row["bankName"];  ?>"><?php echo $row["bankName"];  ?></option>
                                        <?php
                                     }
                                    }
                                    else {
                                        ?>
                                        <option value="no Bank">no Bank</option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                </div>
                        </div>     
                </div>
                <div class="container pt-5">
                                <div class="form-group">
                                <a class="btn btn-danger" href="">  Cancel</a>
                                <input onclick="save()" type="submit" class="btn btn-info " value="Save">
                                </div>
                </div>

        </form>
</div>

        


<script>
    document.getElementById("Method").addEventListener("change", myFunction);

function myFunction() {
        if(document.getElementById("Method").value == "Cheque"){
                document.getElementById("chequePayment").style.display = "block";
                document.getElementById("bankTransfer").style.display = "none";;
        } else if(document.getElementById("Method").value == "BankTransfer") {
                document.getElementById("chequePayment").style.display = "none";;
                document.getElementById("bankTransfer").style.display = "block";
        } else{
                document.getElementById("chequePayment").style.display = "none";;
                document.getElementById("bankTransfer").style.display = "none";;
        }
        
}
</script>

<script>
function validateForm()
{
        if(document.getElementById("Method").value == "Cheque")
        {
                var chequeAmount;
                var i;
                var TotalChequesValue = 0;
                var tempAmount;
                for (i = 1; i<=20; i++)
                {
                        chequeAmount = "chequeAmount" + i;
                        if (document.getElementById(chequeAmount).value > 0){
                                tempAmount = parseInt(document.getElementById(chequeAmount).value);
                                TotalChequesValue = TotalChequesValue + tempAmount;
                        }
                        
                }
                
                if (document.getElementById("TotalAmount").value != TotalChequesValue) 
                {
                        alert("cheque values doesnt match total value");
                        return false;
                } else {
                        return true;
                }
        }

}



</script>

<?php include '../layouts/footer.php';?>

