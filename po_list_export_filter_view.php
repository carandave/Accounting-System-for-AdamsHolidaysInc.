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
        header("Location: po_list_export_view.php");
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
                <?php require_once("navphp/poNav.php");?>
            </div>

            <div class="col-md-10 qwe">

                <div class="row">
                    <div class="col-md-6">

                    </div>

                    <div class="col-md-6 d-flex justify-content-end pr-5 mt-5">
                        
                        <a href="po_export_excel_filter.php?from=<?php echo $from;?>&to=<?php echo $to?>" class="btn btn-success ">Export to Excel</a>
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
                    <h5 class="mb-0 text-light">Purchase Order List</h5>
                </div>

                <!-- Dito na tayo  -->
                
                <?php 

                $sqlx = "SELECT * FROM po WHERE archive='No' AND date BETWEEN '$from' AND '$to' ORDER BY po_Id DESC";
                $result = $conn->query($sqlx);
                
                $data = "

                    <table border='1' class='table table-bordered table-responsive table-hover table-sm' style='width: 90%; margin: 0 auto;'>
                        <thead style='width: 100%;'>
                            <tr>
                                <th>PO No.</th>
                                <th>AR No.</th>
                                <th>Supplier</th>
                                <th>Address</th>
                                <th>Agent</th>
                                <th>Particular</th>
                                <th>Rec Locator</th>
                                <th>Conjunction</th>
                                <th>Date</th>
                                <th>Amount Deposit</th>
                                <th>CV</th>
                                <th>SA</th>
                                <th>Category</th>
                                <th>Airfare Group Name</th>
                                <th>Airfare Payment Method</th>
                                <th>Airfare ACR</th>
                                <th>Airfare Passenger Name</th>
                                <th>Airfare-Airfare Usd</th>
                                <th>Airfare-Taxes Usd</th>
                                <th>Airfare-Iata Usd</th>
                                <th>Airfare-Airfare Php</th>
                                <th>Airfare-Taxes Php</th>
                                <th>Airfare-Iata Php</th>
                                <th>Airfare Sub Total Usd</th>
                                <th>Airfare Sub Total Php</th>
                                <th>Airfare Sub Final Total Usd</th>
                                <th>Airfare Sub Final Total Php</th>
                                <th>Airfare Total Amount</th>
                                <th>Airfare Amount In Words</th>
                
                                <th>Hotel Payment Method</th>
                                <th>Hotel ACR</th>
                                <th>Hotel Passenger Name</th>
                                <th>Hotel-Hotel Usd</th>
                                <th>Hotel-Taxes Usd</th>
                                <th>Hotel-Hotel Php</th>
                                <th>Hotel-Taxes Php</th>
                                <th>Hotel Sub Total Usd</th>
                                <th>Hotel Sub Total Php</th>
                                <th>Hotel Total Amount</th>
                                <th>Hotel Amount In Words</th>
                                <th>Prepared By</th>
                                <th>Checked By</th>
                                <th>Approved By</th>
                            </tr>
                        </thead>

                        <tbody>";

                        while($row = $result->fetch_assoc()){
                            $varia = 1;
                            $airfare_passengerNameArr = explode(",", $row['airfare_passengerName']);

                            $airfare_airfare_usdArr = explode(",", $row['airfare_airfare_usd']);
                            $airfare_taxes_usdArr = explode(",", $row['airfare_taxes_usd']);
                            $airfare_iata_usdArr = explode(",", $row['airfare_iata_usd']);

                            $airfare_airfare_phpArr = explode(",", $row['airfare_airfare_php']);
                            $airfare_taxes_phpArr = explode(",", $row['airfare_taxes_php']);
                            $airfare_iata_phpArr = explode(",", $row['airfare_iata_php']);

                            $hotel_passengerNameArr = explode(",", $row['hotel_passengerName']);

                            $data.= "<tr>
                                        <td>$row[po_Number]</td>
                                        <td>$row[or_No]</td>
                                        <td>$row[supplier]</td>
                                        <td>$row[address]</td>
                                        <td>$row[agent]</td>
                                        <td>$row[particular]</td>
                                        <td>$row[rec_locator]</td>
                                        <td>$row[conjunction]</td>
                                        <td>$row[date]</td>
                                        <td>$row[amount_deposit]</td>
                                        <td>$row[cv]</td>
                                        <td>$row[sa]</td>
                                        <td>$row[po_category]</td>
                                        <td>$row[airfare_groupName]</td>
                                        <td>$row[airfare_paymentMethod]</td>
                                        <td>$row[airfare_acr]</td>
                                    ";

                                    $data.="<td> ";
            
                                    foreach($airfare_passengerNameArr as $airfare_passengerNameArrValue){
                                            $data.= $airfare_passengerNameArrValue. '<br>';
                                    }
                            $data.="</td>";
                
                            $data.="<td> ";
                            
                                    foreach($airfare_airfare_usdArr as $airfare_airfare_usdArrValue){
                                            $data.= $airfare_airfare_usdArrValue. '<br>';
                                    }
                            $data.="</td>";
                
                            $data.="<td> ";
                            
                                    foreach($airfare_taxes_usdArr as $airfare_taxes_usdArrValue){
                                            $data.= $airfare_taxes_usdArrValue. '<br>';
                                    }
                            $data.="</td>";
                
                            $data.="<td> ";
                            
                                    foreach($airfare_iata_usdArr as $airfare_iata_usdArrValue){
                                            $data.= $airfare_iata_usdArrValue. '<br>';
                                    }
                            $data.="</td>";
                
                            $data.="<td> ";
                            
                                    foreach($airfare_airfare_phpArr as $airfare_airfare_phpArrValue){
                                            $data.= $airfare_airfare_phpArrValue. '<br>';
                                    }
                            $data.="</td>";
                
                            $data.="<td> ";
                            
                                    foreach($airfare_taxes_phpArr as $airfare_taxes_phpArrValue){
                                            $data.= $airfare_taxes_phpArrValue. '<br>';
                                    }
                            $data.="</td>";
                
                            $data.="<td> ";
                            
                                    foreach($airfare_iata_phpArr as $airfare_iata_phpArrValue){
                                            $data.= $airfare_iata_phpArrValue. '<br>';
                                    }
                            $data.="</td>";

                            $data.="
                                    <td>$row[airfare_sub_total_usd]</td>
                                    <td>$row[airfare_sub_total_php]</td>
                                    <td>$row[airfare_final_sub_total_usd]</td>
                                    <td>$row[airfare_final_sub_total_php]</td>
                                    <td>$row[airfare_totalAmount]</td>
                                    <td>$row[airfare_amountInWords]</td>
                
                                    <td>$row[hotel_paymentMethod]</td>
                                    <td>$row[hotel_acr]</td>
                                ";

                            $data.="<td> ";
                                    
                                    foreach($hotel_passengerNameArr as $hotel_passengerNameArrValue){
                                            $data.= $hotel_passengerNameArrValue. '<br>';
                                    }
                            $data.="</td>";

                            $data.="
                                    <td>$row[hotel_hotel_usd]</td>
                                    <td>$row[hotel_hotel_php]</td>
                                    <td>$row[hotel_taxes_usd]</td>
                                    <td>$row[hotel_taxes_php]</td>
                                    <td>$row[hotel_sub_total_usd]</td>
                                    <td>$row[hotel_sub_total_php]</td>
                                    <td>$row[hotel_totalAmount]</td>
                                    <td>$row[hotelland_amountInWords]</td>
                                    <td>$row[preparedBy]</td>
                                    <td>$row[approvedBy]</td>
                                    <td>$row[checkedBy]</td>
                                    </tr>";

                            // $data.="
                            //         <td>$row[total_amount]</td>
                            //         <td>$row[PR_no]</td>
                            //         <td>$row[by_signature]</td>
                            //     </tr>";
                        }
                    
                        $data.= "
                            </tbody> 
                        </table> 
                        ";

                    $name = "Purchase Order - From: ".$from. "To: ".$to;

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