<?php include '../layouts/admin.php';

include '../databaseConnection/databaseConnect.php';

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM bank";
$result = $conn->query($sql);
?>




<div class="container mt-2">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

        <div class="container-fluid pt-2">
                    <div class="row">
                                <div class="col-md-6">
                                    <a href="../banks/bankCreate.php" class="btn btn-primary ">Add new Bank</a>
                                </div>
                    </div> 
            <div class="pt-2">
                     <table id="myTable" class="display" width="100%">
              
                        <thead class="thead-dark">
                            <tr>
    
                                <th width=10%>ID</th>
                                <th>Bank Name</th>
                                <th>Bank Branch</th>

   
                              </tr>
                          </thead>
                          <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td> <?php echo $row["id"];  ?> </td>
                                            <td> <?php echo $row["bankName"];  ?> </td>
                                            <td> <?php echo $row["branch"];  ?> </td>
                                        </tr>
                                    <?php
                                     }
                                    }
                                    else {
                                        ?>
                                        <tr> No Data Found </tr>
                                    <?php
                                    }
                                    ?>
                            </tbody>
    
                      </table>
              </div>
             
        </div>
    
      <script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            "order": [[ 0, "desc" ]],
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          
    
        });
    } );
            </script>

</div>

<?php include '../layouts/footer.php';?>