<?php 
    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    if(isset($_POST['exportBtn'])){
        $from = $_POST['from'];
        $to = $_POST['to'];

    }

    else{
        header("Location: ar_list_export_view.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adam's Holidays, Inc</title>

    <!-- Css Link -->
    <!-- <link rel="stylesheet" href="style.css"> -->

    <!-- Bootstrap Links  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- JQUERY Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Animation Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Font Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- CSS LINK -->
    <link rel="stylesheet" href="ar.css">

    

</head>

<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;700;800;900;1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

body{
    font-family: 'Nunito', sans-serif;
    font-family: 'Roboto', sans-serif;
}

/* .qwe{
    background-color: red !important;
} */


</style>



<body style="overflow-x: hidden;">

    <!-- <div class="fluid-container " style="height: 100vh; width: 100%; background: #E1E1E1"> -->
    <div class="fluid-container py-5" style="min-height: 100vh; width: 100%; background: #fff">
        <div class="" style="height: 100%; width: 100%; flex-direction: column">

        <div class="row">
            <div class="col-md-2" >
                <?php require_once("navphp/arNav.php");?>
            </div>

            <div class="col-md-10 qwe">

                <div class="row">
                    <div class="col-md-6">

                    </div>

                    <div class="col-md-6 d-flex justify-content-end pr-5 mt-5">
                        
                        <a href="ar_export_excel_filter.php?from=<?php echo $from;?>&to=<?php echo $to?>" class="btn btn-success ">Export to Excel</a>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 pl-5 mb-3 ">
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="font-weight-bold" style="font-size: 18px">From: <?php echo date("F j Y", strtotime($from));?></label>
                                </div>
                            </div>
                       
                    </div>

                    <div class="col-md-6 pl-5 mb-3 ">
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="font-weight-bold" style="font-size: 18px">To: <?php echo date("F j Y", strtotime($to));?></label>
                                </div>
                            </div>
                        
                    </div>
                </div>

                

                

                <div class="bg-success" style="width: 90%; padding: 8px 20px; margin: 0 auto;" >
                    <h5 class="mb-0 text-light">Acknowledgement Receipt List</h5>
                </div>
                
                <?php 

                $sqlx = "SELECT * FROM ar WHERE archive='No' AND date BETWEEN '$from' AND '$to' ORDER BY ar_Id DESC";
                $result = $conn->query($sqlx);
                
                $data = "

                    <table border='1' class='table table-bordered table-responsive table-hover table-sm' style='width: 90%; margin: 0 auto;'>
                        <thead style='width: 100%;'>
                            <tr>
                                <th>AR No.</th>
                                <th>Received From</th>
                                <th>Business Name</th>
                                <th>Address</th>
                                <th>TIN No.</th>
                                <th>Sum of Pesos</th>
                                <th>Full/Partial Payment</th>
                                <th>Date</th>
                                <th>Transaction</th>
                                <th>ACR</th>
                                <th>USD Amount</th>
                                <th>PHP Value</th>
                                <th>Cash Amount</th>
                                <th>Check Bank</th>
                                <th>Check No.</th>
                                <th>Check Amount</th>
                                <th>Pax Name</th>
                                <th>Pax Service</th>
                                <th>Pax Amount</th>
                                <th>Total Amount</th>
                                <th>Reference No.</th>
                                <th>By Signature</th>
                            </tr>
                        </thead>

                        <tbody>";

                        while($row = $result->fetch_assoc()){
                            $varia = 1;
                            $checkBank1Arr = explode(",", $row['checkBank1']);
                            $checkNo1Arr = explode(",", $row['check_no1']);
                            $checkAmount1Arr = explode(",", $row['check_amount1']);


                            $paxNameArr = explode(",", $row['pax_name']);
                            $paxServiceArr = explode(",", $row['pax_service']);
                            $paxAmountArr = explode(",", $row['pax_amount']);
                            

                            $data.= "<tr>
                                    <td>$row[ar_Number]</td>
                                    <td>$row[received_from]</td>
                                    <td>$row[business_name]</td>
                                    <td>$row[address]</td>
                                    <td>$row[tin]</td>
                                    <td>$row[sum]</td>
                                    <td>$row[full]</td>
                                    <td>$row[date]</td>
                                    <td>$row[transaction]</td>
                                    <td>$row[acr]</td>
                                    <td>$row[usd_amount]</td>
                                    <td>$row[php_val]</td>
                                    <td>$row[cash_amount]</td>";

                            $data.="<td> ";
                            
                                    foreach($checkBank1Arr as $checkBank1ArrValue){
                                            $data.= $checkBank1ArrValue. '<br>';
                                    }
                            $data.="</td>";

                            $data.="<td> ";
                                    
                                    foreach($checkNo1Arr as $checkNo1ArrValue){
                                            $data.= $checkNo1ArrValue. '<br>';
                                    }
                            $data.="</td>";

                            $data.="<td> ";
                                    
                                    foreach($checkAmount1Arr as $checkAmount1Value){
                                            $data.= $checkAmount1Value. '<br>';
                                    }
                            $data.="</td>";

                            // For Pax

                            $data.="<td> ";
                            
                                    foreach($paxNameArr as $paxNameArrValue){
                                            $data.= $paxNameArrValue. '<br>';
                                    }
                            $data.="</td>";

                            $data.="<td> ";
                                    
                                    foreach($paxServiceArr as $paxServiceArrValue){
                                            $data.= $paxServiceArrValue. '<br>';
                                    }
                            $data.="</td>";

                            $data.="<td> ";
                                    
                                    foreach($paxAmountArr as $paxAmountArrValue){
                                            $data.= $paxAmountArrValue. '<br>';
                                    }
                            $data.="</td>";
                                    
                            

                            $data.="
                                    <td>$row[total_amount]</td>
                                    <td>$row[PR_no]</td>
                                    <td>$row[by_signature]</td>
                                </tr>";
                        }
                    
                        $data.= "
                            </tbody> 
                        </table> 
                        ";

                    $name = "Acknowledgement Receipt - From: ".$from. "To: ".$to;

                    // header("Content-Type: application/xls");
                    // header("Content-Disposition: attachment; filename=$name.xls");
            
                    echo $data;
                
                ?>
                
            </div>
        </div>
        
        

        

        </div>
    </div>

    
<!-- Sweetalert Cdn Start -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Sweetalert Cdn End -->

<!-- JS SCRIPT -->
<script src="ar.js"></script>

<script>

    function confirmDelete(self){
        var id = self.getAttribute("data-id");

        document.getElementById("form-archive-user").id.value = id;
        $("#myModal").addClass("animate__fadeInDown");
        $("#myModal").modal("show");
        
    }

    $(document).ready(function(){

        $("#archive_btn").click(function(e){
                e.preventDefault();
                console.log("napindot si a");
                // e.preventDefault();

                $.ajax({
                    url: "archive_process.php",
                    method: "POST",
                    data: $("#form-archive-user").serialize() + "&action=archiveAR",
                    success : function (response){

                        if(response == "successArchive"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Successfully Archived!',
                                    showConfirmButton: false,
                                    timer: 1300  
                                }).then(function(){
                                    window.location = "ar_archive_list.php";
                                })
                        }

                        else if(response == "errorArchive"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'There is an error, Please try again',
                                    showConfirmButton: false,
                                    timer: 1300  
                                }).then(function(){
                                    window.location = "ar_archive_list.php";
                                })
                        }
                        
                    }
                })
        })

        
    })
</script>



<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>