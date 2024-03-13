<?php

    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    if(isset($_POST['viewPrint'])){
        $cvId = $_POST['cv_Id'];
    }
    
    else{
        header("Location: cv_list.php");
    }


    $officialId = $_SESSION['officialsId'];
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <title>Adams Holidays, Inc</title>
    
    <!-- Custom Css File Start -->
    <!-- <link rel="stylesheet" href="styles/dashAdmin.css">   -->
    <!-- Custom Css File End-->
    
    <!-- Font Links Start-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Links End-->

    <!-- JS for jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- bootstrap css and js -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Bootstrap Links Start -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
     -->
    <!-- Bootstrap Links End -->

    <!-- Animation Links Start -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> -->
    <!-- Animation Links End -->

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> -->
    <!-- Sweetalert Cdn Start -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Sweetalert Cdn End -->

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

<body style="height: 100vh; overflow-x: hidden">


    <!-- <div class="fluid-container " style="height: 100vh; width: 100%; background: #E1E1E1"> -->
    <div class="fluid-container py-5" style="min-height: 100vh; width: 100%; background: #fff">
        <div class="" style="height: 100%; width: 100%; flex-direction: column">

        <div class="row">
            <div class="col-md-2" >
                <?php require_once("navphp/cvNav.php");?>
            </div>


            <?php 
                
            $sql = "SELECT * FROM cv WHERE cv_Id='$cvId'";
            $result = $conn->query($sql);
            
            ?>

            <?php if($result->num_rows > 0){?>
                <?php while($rows = $result->fetch_assoc()){?>
            <div class="col-md-10">
                <div class="container mb-5">
                    <div class="card ">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0 mr-3">Print Check Voucher</h5>

                                <div>
                                    <button class="btn btn-success btn-border btn-round" onclick="printDiv('printThis')">
                                        Print
                                    </button>
                                </div>
                                
                                
                            </div>       
                        </div>

                        <div class="card-body m-5" id="printThis" style="">
                            <div class="d-flex flex-wrap justify-content-center pb-3 " >
                                <div class="" style="width: 100%">

                                    <div class="row mt-5 mb-3">
                                        <div class="col-md-4">
                                            <div style="" class="d-flex justify-content-end align-items-center">
                                                <img src="./img/LogoAdam.png" class="" alt="" style="width: 80px; height: 80px;">
                                            </div>
                                        </div>

                                        <div class="col-md-5 d-flex justify-content-center align-items-center" style="flex-direction: column">
                                            <h3 style="font-weight: 900" class="mb-0">ADAMS HOLIDAYS, INC</h3>
                                            <h5 style="font-weight: 700" class="font-italic">"Creating Lifetime Memories"</h5>
                                        </div>

                                        <div class="col-md-3 d-flex justify-content-center " style="flex-direction: column">
                                            
                                        </div>
                                        
                                    </div>

                                    <div class="text-center ml-5 mt-3" >
                                        <p class="mb-0" style="font-size: 14px;">2nd Floor, Unit 4B, Arquiza Trade Center, 1214 Arquiza corner M.H. Del Pilar Streets, Ermita, Manila 1000 Philippines</p>
                                        <p class="mb-0" style="font-size: 14px;">Tel: (632) 840 39110 || (632) 700 08443 | Mobile: (63) 917 1569 9214 || (63) 921 361 0333 </p>
                                        <p class="mb-0" style="font-size: 14px;">E-mail: adamsholidayinc@gmail.com | reservations@adamsholidays.com</p>
                                        <p class="mb-0" style="font-size: 14px;">NON-VAT REG TIN 757-923-556-000</p>
                                    </div>

                                </div>
                            </div>

                    <div class="row mx-5">
                        <div class="col-md-12">

                    <div class="row mt-2 " style="width: 100%; margin: 0 auto;">

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4 ">

                                </div>

                                <div class="col-md-4 ">

                                </div>

                                <div class="col-md-4 ">

                                    <div class="row mt-3">
                                        <div class="col-md-5 text-right">
                                        <span class="h6">CV No.</span>
                                        </div>

                                        <div class="col-md-7 text-left" style="border-bottom: 1px solid black;">
                                            <span class="font-weight-bold h5"><?php echo $rows['cv_Number']?></span>
                                        </div>
                                    </div>
                                    
                                </div> 
                            </div>
                        </div>
                    
                    </div>

                    <div class="row " style="width: 100%; margin: 0 auto;">

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4 ">

                                </div>

                                <div class="col-md-4 ">

                                </div>

                                <div class="col-md-4 ">

                                    <div class="row mt-3">
                                        <div class="col-md-5 text-right">
                                            <span class="h6">Date.</span>
                                        </div>

                                        <div class="col-md-7 text-left" style="border-bottom: 1px solid black;">
                                            <span class="font-weight-bold h5"><?php echo $rows['date']?></span>
                                        </div>
                                    </div>
                                    
                                </div> 
                            </div>
                        </div>
                    
                    </div>
                
                    <div class="mt-3 " >
                        <h5 class="text-center" style="text-decoration: underline">CASH/CHECK VOUCHER</h5>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <span>Payee: </span> <span class="font-weight-bold h5"><?php echo $rows['payee']?></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <span>Agent: </span> <span class="font-weight-bold h5"><?php echo $rows['agent']?></span>
                            </div>
                        </div>

                    </div>

                    <!-- <div style="height: 3px; border-bottom: 3px solid black; width: 100%; ">

                    </div> -->

                    <!-- START COLUMN FOR AIRFARE -->
                    <div class="row mt-4" style="border-top: 3px solid black; border-bottom: 3px solid black;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="mb-0 py-1 text-center font-weight-bold">PARTICULARS</h6>
                                </div>

                                <div class="col-md-4">
                                    <h6 class="mb-0 py-1 text-center font-weight-bold">AMOUNT</h6>
                                </div>
                                        
                            </div>

                        </div>
                    </div>

                    <?php 
                    
                    $cv_passengerNameArr = explode(",", $rows['cv_passengerName']);
                    $payment_method = $rows['payment_method'];
                   
                    ?>

                    <div class="row " style="">
                        <div class="col-md-12">
                            <div class="row" style="min-height: 300px;">
                                <div class="col-md-8 p-3" style="border-right: 1px dashed black;">

                                    <h5><?php echo $rows['particular'];?></h5>

                                    <div class="row mt-3">

                                        <div class="col-md-12 pl-5">
                                            <span class="font-weight-bold h6">
                                                <?php foreach($cv_passengerNameArr as $cv_passengerNameArrValue){
                                                        
                                                        echo $cv_passengerNameArrValue."<br>";

                                                }?> 
                                           </span>

                                                
                                            
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4" style="border-left: 1px dashed black;">

                                <h5 style="visibility: hidden">x</h5>

                                    <div class="row mt-3">

                                        <div class="col-md-12">

                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <span class="font-weight-bold h5">
                                                    <?php 
                                                    
                                                    if($payment_method == "USD"){
                                                        echo "USD";
                                                    }

                                                    elseif($payment_method == "PHP"){
                                                        echo "PHP";
                                                    }
                                                    
                                                    ?>
                                                    </span>


                                                    <span class="font-weight-bold h5">
                                                    <?php echo $rows['total_amount'];?>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        
                                    </div>
                                </div>
                                        
                            </div>

                        </div>
                    </div>

                    <div class="row" style=" border-top: 3px solid black; border-bottom: 3px solid black;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 class="mb-0 py-1 text-center font-weight-bold">For Acct. usd only</h6>
                                </div>

                                <div class="col-md-3">
                                    <h6 class="mb-0 py-1 text-center font-weight-bold">ENTRY</h6>
                                </div>

                                <div class="col-md-2" >
                                    <h6 class="mb-0 py-1 text-center font-weight-bold" style="border-left: 1px dashed black; border-right: 1px dashed black;" >DR</h6>
                                </div>

                                <div class="col-md-4">
                                    <h6 class="mb-0 py-1 text-center font-weight-bold">CR</h6>
                                </div>
                                        
                            </div>

                        </div>
                    </div>

                    <div class="row" style="height: 200px; border-bottom: 3px solid black;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 class="mb-0 py-1 text-center font-weight-bold"></h6>
                                </div>

                                <div class="col-md-3">
                                    <h6 class="mb-0 py-1 text-center font-weight-bold"></h6>
                                </div>

                                <div class="col-md-2" style="height: 100%;" >
                                    <h6 class="mb-0 py-1 text-center font-weight-bold" style=" " ></h6>
                                </div>

                                <div class="col-md-4">
                                    <h6 class="mb-0 py-1 text-center font-weight-bold"></h6>
                                </div>
                                        
                            </div>

                        </div>
                    </div>

                    <!-- END COLUMN FOR THE BILL -->

                    <div class="row mt-3">
                        <div class="col-md-12" >
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <span class="" style="font-size: 15px; width: 100%; display-inline: block; ">Received the sum of peso/dollar: </span>
                                </div>

                                <div class="col-md-9 text-left" style="border-bottom: 1px solid black">
                                <span style="width: 100%; display-inline: block; font-style: italic; font-weight: bold;font-size: 17px;text-transform: uppercase" class="ml-0 pl-0">*** <?php echo $rows['sum_of_peso'];?>***</span>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-md-12" >
                            <div class="row">
                                <div class="col-md-3 text-right">
                                <span class="" style="font-size: 15px; width: 100%; display-inline: block; ">Php/Usd: </span>
                                </div>

                                <div class="col-md-9 text-left" style="border-bottom: 1px solid black">
                                <span style="width: 100%; display-inline: block; font-style: italic; font-weight: bold;font-size: 17px;text-transform: uppercase" class="ml-0 pl-0"><?php echo $rows['total_amount'];?></span>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    


                    <div class="row my-4">
                        <div class="col-md-6">
                            <h6>REQUESTED BY: <span class="font-weight-bold text-center" style="width: 250px; display: inline-block; border-bottom: 1px solid black;"><?php echo $rows['prepared_by']?></span></h6>
                            <h6>CHECKED BY: <span class="font-weight-bold text-center" style="width: 250px; display: inline-block; border-bottom: 1px solid black;"><?php echo $rows['checked_by']?></span></h6>
                            <h6>APPROVED BY: <span class="font-weight-bold text-center" style="width: 250px; display: inline-block; border-bottom: 1px solid black;"><?php echo $rows['approved_by']?></span></h6>
                        </div>

                        <div class="col-md-6">
                            <h6>Check No/Bank: <span class="font-weight-bold text-center" style="width: 250px; display: inline-block; border-bottom: 1px solid black;"><?php echo $rows['check_no']?></span></h6>
                            <h6>Received By: <span class="font-weight-bold text-center" style="width: 250px; display: inline-block; border-bottom: 1px solid black;"><?php echo $rows['received_by']?></span></h6>
                            <h6>Date Received: <span class="font-weight-bold text-center" style="width: 250px; display: inline-block; border-bottom: 1px solid black;"><?php echo $rows['date_received']?></span></h6>
                        </div>
                    </div>

                    <div style="height: 3px; border-bottom: 3px solid black; width: 100%; ">

                    </div>

                    <div style="height: 250px; ">

                    </div>

                    <div class="row">
                        <div class="col-md-6">

                        </div>

                        <div class="col-md-6 text-right" >
                            <!-- <?php date_default_timezone_set('Asia/Manila'); ?>
                            <p style="font-weight: bold" class="text-right"><?php echo date("Y-m-d  h:i:sa") ?></p> -->
                        </div>
                    </div>

                    
                
                            
                    
                </div> 
                
                </div>
            </div>  
            
            </div>
            </div>  

            <?php }?>
                <?php }?>
        </div>

   
        </div>
    </div>

    <script src="ar.js"></script>

    <script>


        function printDiv(divName) {

           

            
                        
                        var printContents = document.getElementById(divName).innerHTML;
                        var originalContents = document.body.innerHTML;

                        document.body.innerHTML = printContents;
                        
   
                        
                        window.print();


                        document.body.innerHTML = originalContents;


                        

                        

                        
                    
            }

            

            
            
            
            
        

        
    </script>

    <!-- <script>
            function printDiv(divName) {
                        
                        var printContents = document.getElementById(divName).innerHTML;
                        var originalContents = document.body.innerHTML;

                        document.body.innerHTML = printContents;

                        window.print();

                        document.body.innerHTML = originalContents;

                        setTimeout(function() {
                            logPrintStatus();
                        }, 1000);

                        
                    
            }

            function logPrintStatus() {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'ar_check_print_status.php?status=printed', true);
                xhr.send();
            }        
    </script> -->
    

    
        
    

    





    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script> -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
        <!-- JavaScript Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
    
</body>
</html>