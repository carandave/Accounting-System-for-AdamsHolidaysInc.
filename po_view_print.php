<?php

    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    if(isset($_POST['viewPrint'])){
        $poId = $_POST['po_Id'];
    }
    
    else{
        header("Location: po_list.php");
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
                <?php require_once("navphp/poNav.php");?>
            </div>


            <?php 
                
            $sql = "SELECT * FROM po WHERE po_Id='$poId'";
            $result = $conn->query($sql);
            
            ?>

            <?php if($result->num_rows > 0){?>
                <?php while($rows = $result->fetch_assoc()){?>
            <div class="col-md-10">
                <div class="container mb-5">
                    <div class="card ">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0 mr-3">Print Purchase Order</h5>

                                <div>
                                    <button class="btn btn-success btn-border btn-round" onclick="printDiv('printThis')">
                                        Print
                                    </button>
                                </div>
                                
                                
                            </div>       
                        </div>

                        <div class="card-body" id="printThis" style="">
                            <div class="d-flex flex-wrap justify-content-center " >
                                <div class="" style="width: 100%" >
                                
                                    <div class="row mt-5 mb-3">
                                        <div class="col-md-4">
                                            <div style="" class="d-flex justify-content-end align-items-center">
                                                <img src="./img/LogoAdam.png" class="" alt="" style="width: 80px; height: 80px;">
                                            </div>
                                        </div>

                                        <div class="col-md-5  d-flex justify-content-center align-items-center" style="flex-direction: column">
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

                    <div class="row mt-3 mx-5">
                        <div class="col-md-12">


                        <div class="row" style="width: 100%; margin: 0 auto;">

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4 ">

                                </div>

                                <div class="col-md-4 ">

                                </div>

                                <div class="col-md-4 ">

                                    <div class="row ">
                                        <div class="col-md-5 text-right">
                                        <span class="h6">PO No.</span>
                                        </div>

                                        <div class="col-md-7 text-left" style="border-bottom: 1px solid black;">
                                            <span class="font-weight-bold h5"><?php echo $rows['po_Number']?></span>
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
                        <h5 class="text-center" style="text-decoration: underline">PURCHASE ORDER</h5>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <span>Supplier: </span> <span class="font-weight-bold "><?php echo $rows['supplier']?></span>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-8">
                                <span >Address: </span> <span class="font-weight-bold "><?php echo $rows['address']?></span>
                            </div>

                            <div class="col-md-8">
                                <span>Agent: </span> <span class="font-weight-bold "><?php echo $rows['agent']?></span>
                            </div>

                            <div class="col-md-4 " style="">
                                
                            </div>
                        </div>

                    </div>

                    <div style="height: 3px; border-bottom: 3px solid black; width: 100%; ">

                    </div>

                    <?php $airfare_paymentMethod = $rows['airfare_paymentMethod'];
                
                            
                    ?>

                    <!-- START COLUMN FOR AIRFARE -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row my-3">
                                <div class="col-md-12">
                                        <?php 
                                            $airfare_passengerName1Arr = explode(",", $rows['airfare_passengerName']); 
                                            $hotel_passengerName1Arr = explode(",", $rows['hotel_passengerName']); 
                                            // $countPassenger = count($airfare_passengerName1Arr);
                                        ?>
                                        <div class="row">
                                            <?php 
                                            echo'<div class="col-md-12">';


                                                    if($rows['po_category'] == "Airfare"){
                                                        
                                                        echo '<h6>AIRFARE</h6>';
                                                        foreach($airfare_passengerName1Arr as $airfare_passengerName1ArrValue){
                                                            
                                                            echo '<h6>'.$airfare_passengerName1ArrValue.'</h6>';
                                                        }
                                                    }

                                                    else{
                                                        
                                                    }


                                                    if($rows['po_category'] == "Hotel"){
                                                        echo '<h6>HOTEL</h6>';
                                                        foreach($hotel_passengerName1Arr as $hotel_passengerName1ArrValue){
                                                            
                                                            echo '<h6>'.$hotel_passengerName1ArrValue.'</h6>';
                                                        }
                                                    
                                                    }

                                                    else{
                                                        
                                                    }
        
                                                   
                                                
                                            echo '</div>';
                                            ?>

                                            
                                        </div>

                                    <div class="mt-2">
                                        <p style="white-space: pre-line;"><?php echo $rows['particular'];?></p>
                                    </div>

                                    
                                    
                                </div>
                            </div>

                            <div class="row my-1">
                                <div class="col-md-12">
                                    <span class="font-weight-bold ">RELOC: <?php echo $rows['rec_locator'];?></span>

                                    <h6 class="mt-3"></h6>
                                    
                                </div>
                            </div>

                            <div  style="border-top: 3px solid black; border-bottom: 3px solid black; width: 100%;">
                                <span class="font-weight-bold">PARTICULARS</span>
                            </div>
                            
                            

                            <div class="row my-3">

                                <?php 
                                
                                $airfare_passengerName = $rows['airfare_passengerName'];
                                if($rows['po_category'] == "Airfare"){
                                
                                ?>
                                <div class="col-md-6" style="">

                                    <div class="row ">
                                        <div class="col-md-5">
                                            <h6>AIRFARE:</h6>
                                            <h6>AIRLINE TAXES: </h6>
                                            <h6>IATA FEE:</h6>
                                            
                                            <h6 style="visibility: hidden;">A</h6>
                                            <h6>TOTAL: </h6>

                                            <!-- <h6 style="visibility: hidden;">A</h6>
                                            <h6 style="visibility: hidden;">A</h6>
                                            <h6>TOTAL PASSENGER: </h6>
                                            <h6>NUMBER OF DAYS: </h6> -->
                                            <h6 style="visibility: hidden;">A
                                                
                                                <?php 
                                                    
                                                    if($airfare_paymentMethod == "USD"){
                                                        
                                                    }

                                                ?>
                                            <h6 style="visibility: hidden;">A</h6>
                                            <h6>TOTAL AMOUNT: </h6>
                                        </div>
                                        
                                        

                                        <div class="col-md-7">
                                            <h6>= <?php 

                                                    $airfare_airfare_usdArr = explode(",", $rows['airfare_airfare_usd']);
                                                    $airfare_airfare_phpArr = explode(",", $rows['airfare_airfare_php']);
                                                    
                                                    
                                                    if($airfare_paymentMethod == "USD"){
                                                        echo '<span>USD</span> ';
                                                        $airfareArray = array($rows['airfare_airfare_usd']);
                                                        $totalAirfare = array_sum($airfare_airfare_usdArr);
                                                        echo number_format((float)$totalAirfare, 2, '.', '');
                                                    }

                                                    elseif($airfare_paymentMethod == "PHP"){
                                                        echo '<span>PHP</span> ';
                                                        $airfareArray = array($rows['airfare_airfare_php']);
                                                        $totalAirfare = array_sum($airfare_airfare_phpArr);
                                                        echo number_format((float)$totalAirfare, 2, '.', '');
                                                    }
                                             
                                                ?>
                                            </h6>
                                            <h6>= <?php 

                                                    $airfare_taxes_usdArr = explode(",", $rows['airfare_taxes_usd']);
                                                    $airfare_taxes_phpArr = explode(",", $rows['airfare_taxes_php']);
                                                    
                                                    
                                                    if($airfare_paymentMethod == "USD"){
                                                        echo '<span>USD</span> ';
                                                        $taxesArray = array($rows['airfare_taxes_usd']);
                                                        $totalTaxes = array_sum($airfare_taxes_usdArr);
                                                        echo number_format((float)$totalTaxes, 2, '.', '');
                                                    }

                                                    elseif($airfare_paymentMethod == "PHP"){
                                                        echo '<span>PHP</span> ';
                                                        $taxesArray = array($rows['airfare_taxes_php']);
                                                        $totalTaxes = array_sum($airfare_taxes_phpArr);
                                                        echo number_format((float)$totalTaxes, 2, '.', '');
                                                    }
                                             
                                                ?>
                                            </h6>
                                            <h6>= <?php 

                                                    $airfare_iata_usdArr = explode(",", $rows['airfare_iata_usd']);
                                                    $airfare_iata_phpArr = explode(",", $rows['airfare_iata_php']);
                                                    
                                                    if($airfare_paymentMethod == "USD"){
                                                        echo '<span>USD</span> ';
                                                        $iataArray = array($rows['airfare_iata_usd']);
                                                        $totalIata = array_sum($airfare_iata_usdArr);
                                                        echo number_format((float)$totalIata, 2, '.', '');
                                                    }

                                                    elseif($airfare_paymentMethod == "PHP"){
                                                        echo '<span>PHP</span> ';
                                                        $iataArray = array($rows['airfare_iata_php']);
                                                        $totalIata = array_sum($airfare_iata_phpArr);
                                                        echo number_format((float)$totalIata, 2, '.', '');
                                                    }
                                             
                                                ?>
                                            </h6>
                                            <h6>---------------</h6>
                                            <h6>=
                                                <?php 
                                                    
                                                    if($airfare_paymentMethod == "USD"){
                                                        // $airfare_airfare_usd = $rows['airfare_airfare_usd'];
                                                        // $airfare_taxes_usd = $rows['airfare_taxes_usd'];
                                                        // $airfare_iata_usd = $rows['airfare_iata_usd'];

                                                        $totalParticularUSD = $totalAirfare + $totalTaxes + $totalIata;
                                                        echo '<span>USD</span> ';
                                                        echo number_format((float)$totalParticularUSD, 2, '.', ''); // Outputs -> 105.00
                                                        // echo $totalParticularUSD;


                                                    }

                                                    elseif($airfare_paymentMethod == "PHP"){

                                                        $totalParticularPHP = $totalAirfare + $totalTaxes + $totalIata;
                                                        // echo $totalParticular;
                                                        echo '<span>PHP</span> ';
                                                        echo number_format((float)$totalParticularPHP, 2, '.', ''); //
                                                    }

                                                
                                                
                                                ?>

                                                
                                            </h6>

                                            <h6><?php
                                                    
                                                    if($airfare_paymentMethod == "USD"){
                                                        // $airfare_noofDays = $rows['airfare_noofDays'];
                                                        $airfaretotalAmountUsd = $totalParticularUSD;
                                                        echo '<span> USD </span> ';
                                                        echo number_format((float)$airfaretotalAmountUsd, 2, '.', '');
                                                        echo '<span> x </span> ';
                                                        $airfare_acr = $rows['airfare_acr'];
                                                        echo number_format((float)$airfare_acr, 2, '.', ''); //
                                                        echo '<span> ACR</span> ';
                                                    }

                                                    else if($airfare_paymentMethod == "PHP"){
                                                        
                                                        echo '<h6 style="visibility: hidden;"> ACR</h6> ';
                                                    }
                                                    ?>


                                                    

                                                        
                                            </h6>
                                                        
                                            <h6>---------------</h6>
                                            <h6></h6>
                                            <h6>
                                                <?php 
                                                
                                                if($airfare_paymentMethod == "USD"){
                                                    $airfaretotalFinalAmountUsd = $airfaretotalAmountUsd * $rows['airfare_acr'];
                                                    echo '<h6> = USD '.number_format((float)$airfaretotalFinalAmountUsd, 2, '.', '').'</h6>';
                                                    // echo number_format((float)$airfaretotalAmountUsd, 2, '.', '');
                                                }

                                                else if($airfare_paymentMethod == "PHP"){
                                                    $totalAifarfare = $rows['airfare_totalAmount'];
                                                    $phpairfaretotalAmount = number_format((float)$totalAifarfare, 2, '.', '');
                                                    
                                                    echo '<h6> = PHP '.$phpairfaretotalAmount.'</h6>';
                                                    // echo $rows['airfare_totalAmount'];
                                                    
                                                }
                                                ?>
                                            </h6>
                                            <!-- <h6>= PHP <?php echo $rows['airfare_totalAmount'];?></h6> -->
                                            
                                        </div>

                                        
                                    </div>
                                </div>

                                <?php } ?>

                                <?php 
                                    
                                    $hotelpassengerName = $rows['hotel_passengerName'];

                                    if($rows['po_category'] == "Hotel"){
                                ?>    

                                <?php $hotel_paymentMethod = $rows['hotel_paymentMethod'];?>
                                <div class="col-md-6 pl-5" >
                                                
                                        <div class="row mb-5">
                                            <div class="col-md-6">
                                                <h6>HOTEL / LAND</h6>
                                                <h6>HOTEL: </h6>
                                                <h6>TAXES:</h6>
                                                
                                                <h6 style="visibility: hidden;">A</h6>
                                                <h6>TOTAL OF: </h6>

                                                <h6 style="visibility: hidden;">A</h6>
                                                <h6 style="visibility: hidden;">A</h6>
                                                <h6>TOTAL AMOUNT: </h6>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 style="visibility: hidden;">A</h6>
                                                <h6 class="">= 
                                                    
                                                    <?php 
                                                        
                                                        if($hotel_paymentMethod == "USD"){
                                                            echo '<span>USD</span> ';
                                                            echo number_format((float)$rows['hotel_hotel_usd'], 2, '.', '');
                                                        }

                                                        elseif($hotel_paymentMethod == "PHP"){
                                                            echo '<span>PHP</span> ';
                                                            echo number_format((float)$rows['hotel_hotel_php'], 2, '.', '');
                                                        }
                                                
                                                    ?>

                                                </h6>
                                                <h6>= 
                                                    
                                                    <?php 
                                                        
                                                        if($hotel_paymentMethod == "USD"){
                                                            echo '<span>USD</span> ';
                                                            echo number_format((float)$rows['hotel_taxes_usd'], 2, '.', '');
                                                        }

                                                        elseif($hotel_paymentMethod == "PHP"){
                                                            echo '<span>PHP</span> ';
                                                            echo number_format((float)$rows['hotel_taxes_php'], 2, '.', '');
                                                        }
                                                
                                                    ?>
                                                
                                                </h6>
                                                <h6>---------------</h6>
                                                <h6>=
                                                    <?php 

                                                        if($hotel_paymentMethod == "USD"){
                                                            $hotel_hotel_usd = $rows['hotel_hotel_usd'];
                                                            $hotel_taxes_usd = $rows['hotel_taxes_usd'];

                                                            $totalHotelParticularUSD = $hotel_hotel_usd + $hotel_taxes_usd;
                                                            echo '<span>USD</span> ';
                                                            echo number_format((float)$totalHotelParticularUSD, 2, '.', ''); // Outputs -> 105.00
                                                            // echo $totalParticularUSD;


                                                        }

                                                        elseif($hotel_paymentMethod == "PHP"){
                                                            $hotel_hotel_php = $rows['hotel_hotel_php'];
                                                            $hotel_taxes_php = $rows['hotel_taxes_php'];

                                                            $totalHotelParticularPHP = $hotel_hotel_php + $hotel_taxes_php;
                                                            // echo $totalParticular;
                                                            echo '<span>PHP</span> ';
                                                            echo number_format((float)$totalHotelParticularPHP, 2, '.', ''); //
                                                        }
                                                    
                                                    // $hotel_hotel_php = $rows['hotel_hotel_php'];
                                                    // $hotel_taxes_php = $rows['hotel_taxes_php'];

                                                    // $totalParticularHotel = $hotel_hotel_php + $hotel_taxes_php;
                                                    // echo $totalParticularHotel;
                                                    ?>

                                                    
                                                </h6>
                                                
                                                <h6>
                                                    <?php
                                                    
                                                    if($hotel_paymentMethod == "USD"){
                                                        // $hotel_totalPassenger = $rows['hotel_totalPassenger'];
                                                        // $hotel_noofDays = $rows['hotel_noofDays'];
                                                        $hoteltotalAmountUsd = $totalHotelParticularUSD;
                                                        $hoteltotalFinalAmountUsd = $totalHotelParticularUSD * $rows['hotel_acr'];
                                                        echo '<span> USD </span> ';
                                                        echo number_format((float)$hoteltotalAmountUsd, 2, '.', '');;
                                                        echo '<span> x </span> ';
                                                        echo $rows['hotel_acr'];
                                                        echo '<span> ACR</span> ';
                                                    }

                                                    else if($hotel_paymentMethod == "PHP"){
                                                        
                                                        echo '<h6 style="visibility: hidden;"> ACR</h6> ';
                                                    }
                                                    ?>
                                                </h6>
                                                <h6>---------------</h6>
                                                <h6></h6>
                                                <?php 
                                                
                                                if($hotel_paymentMethod == "USD"){
                                                    echo '<h6> = USD '.number_format((float)$hoteltotalFinalAmountUsd, 2, '.', '').'</h6>';
                                                    // echo number_format((float)$airfaretotalAmountUsd, 2, '.', '');
                                                }

                                                else if($hotel_paymentMethod == "PHP"){
                                                    // echo '<h6> = PHP</h6>';
                                                    // echo $rows['hotel_totalAmount'];

                                                    $totalHotel = $rows['hotel_totalAmount'];
                                                    $phphoteltotalAmount = number_format((float)$totalHotel, 2, '.', '');
                                                    
                                                    echo '<h6> = PHP '.$phphoteltotalAmount.'</h6>';
                                                    
                                                }
                                                ?>
                                                
                                                
                                            </div>

                                        </div>
                                    
                                    
                                    
                                </div>
                                <?php 
                                }elseif($hotelpassengerName == ""){
                                    
                                } 
                                
                                
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- END COLUMN FOR AIRFARE -->

                    

                    <div style="height: 3px; border-bottom: 3px solid black; width: 100%; ">

                    </div>

                    <div class="row my-3">
                        <div class="col-md-12">
                            <h6>PREPARED BY: <span class="font-weight-bold text-center" style="width: 250px; display: inline-block; border-bottom: 1px solid black;"><?php echo $rows['preparedBy']?></span></h6>
                            <h6>CHECKED BY: <span class="font-weight-bold text-center" style="width: 250px; display: inline-block; border-bottom: 1px solid black;"><?php echo $rows['checkedBy']?></span></h6>
                            <h6>APPROVED BY: <span class="font-weight-bold text-center" style="width: 250px; display: inline-block; border-bottom: 1px solid black;"><?php echo $rows['approvedBy']?></span></h6>
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

            <?php }?>
                <?php }?>
                </div>
            </div> 
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