<?php include '../layouts/admin.php';?>


<div class="container mt-2">
        <form action="bankSave.php" method="post">

            <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="BankName">Bank Name</label> 
                    <div class="col-sm-10">
                    <input class="form-control" type="text" name="BankName" id="BankName">
                    </div>
            </div>

            <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="Branch">Branch Name</label> 
                    <div class="col-sm-10">
                    <input class="form-control" type="text" name="Branch" id="Branch">
                    </div>
            </div>

            
            <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="AccountNumber">Account Number</label> 
                    <div class="col-sm-10">
                    <input class="form-control" type="Text" name="AccountNumber" id="AccountNumber">
                    </div>
            </div>

                <div class="container pt-5">
                                <div class="form-group">
                                <a class="btn btn-danger" href="">  Cancel </a>
                                <input type="submit" class="btn btn-info " value="Save">
                                </div>
                </div>

        </form>
</div>

<?php include '../layouts/footer.php';?>

                        
                        



