<?php 

    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    $userName = $_SESSION['name'];

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <!-- Animation Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Font Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS LINK -->
    <link rel="stylesheet" href="ar.css">

</head>

<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;700;800;900;1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

.error{
    color: red;
    font-size: 12px;
}

body{
    font-family: 'Nunito', sans-serif;
    font-family: 'Roboto', sans-serif;
}

h2{
    font-weight: 900;
}

.icon{
    display: inline-block;
    padding: 15px ;
    outline: 6px solid #E1E1E1;
    border: 5px solid white;
    border-radius: 50%;
    font-size: 32px;
    color: white;
    text-align: center;
    margin: 0 auto;
}

.box{
    box-shadow: 8px 9px 9px -6px rgba(120,120,120,0.73);
    -webkit-box-shadow: 8px 9px 9px -6px rgba(120,120,120,0.73);
    -moz-box-shadow: 8px 9px 9px -6px rgba(120,120,120,0.73);
    transition: 0.2s ease-in;
}

.box:hover{
    transform: translateY(-10px);
}

.heading-box{
    font-size: 20px;
    display: inline-block;
    width: 100%;
    background: #5A6B5D;
    text-align: center;
    padding: 10px 6px;
    color: #E1E1E1;
    border-radius: 5px;

}

.button{
    padding: 8px 16px;
    background: #E1E1E1;
    color: #5A6B5D;
    text-decoration: none;
    border-radius: 20px;
    width: 50%;
    text-align: center;
    font-weight: 700;
    font-size: 14px;
    border: 0;
    transition: 0.3s ease-in;
    letter-spacing: 1px;
    box-shadow: 0px 0px 36px 0px rgba(120,120,120,0.59);
-webkit-box-shadow: 0px 0px 36px 0px rgba(120,120,120,0.59);
-moz-box-shadow: 0px 0px 36px 0px rgba(120,120,120,0.59);
}

.button:hover{
    color: #E1E1E1;
    text-decoration: none;
    background: #5A6B5D;
}
</style>



<body style="overflow-x: hidden;">

    <!-- <div class="fluid-container " style="height: 100vh; width: 100%; background: #E1E1E1"> -->
    <div class="fluid-container py-5" style="min-height: 100vh; width: 100%; background: #fff">
        <div class="" style="height: 100%; width: 100%; flex-direction: column">

        <div class="row">
            <div class="col-md-2" >
                <?php require_once("navphp/poNav.php");?>
            </div>

            <div class="col-md-10">
                <div class="bg-success" style="width: 85%; padding: 8px 20px; margin: 0 auto;" >
                    <h5 class="mb-0 text-light">Purchase Order Entry Form</h5>
                </div>
                <form action="" id="po_Form" style="width: 85%; margin: 0 auto; border: 1px solid lightgray;" class="p-4" >
                    <input type="text" name="by" id="" value="<?php echo $userName;?>" class="d-none form-control form-control-sm" readonly>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Supplier:</label>
                            <input type="text" name="supplier" id="supplier" class="form-control form-control-sm " required>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Address:</label>
                            <input type="text" name="address" id="address" class="form-control form-control-sm" required>
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Agent:</label>
                            <input type="text" name="agent" id="agent" class="form-control form-control-sm" value="N/A" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Particular:</label>
                            <textarea cols="10" rows="5" name="particular" id="particular" class="form-control form-control-sm" required>

                            </textarea>
                            <!-- <input type="text" name="particular" id="particular" class="form-control form-control-sm" required> -->
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Rec. Locator:</label>
                            <input type="text" name="rec_locator" id="rec_locator" class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Conjunction:</label>
                            <input type="text" name="conjunction" id="conjunction" class="form-control form-control-sm " required>
                        </div>
                    </div>
                    

                    <?php
                        $timestamp = time();
                        $date = date( "Y-m-d", $timestamp );
                    ?>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Date:</label>
                            <input type="date" name="date" id="date" value="<?php echo $date;?>" class="form-control form-control-sm " required>
                        </div>

                        

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Amount Deposit:</label>
                            <input type="number" name="amount_deposit" id="amount_deposit" class="form-control form-control-sm" value="0" required>
                        </div>

                        <!-- <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>
                            <input type="number" name="acr" id="acr" class="form-control form-control-sm" required>
                        </div> -->
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>AR:</label>
                            <input type="text" name="or" id="or" class="form-control form-control-sm " value="N/A" required>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>CV:</label>
                            <input type="text" name="cv" id="cv" class="form-control form-control-sm" value="N/A" required>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>SA:</label>
                            <input type="text" name="sa" id="sa" class="form-control form-control-sm" value="N/A" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <ul class="nav nav-pills mb-3 bg-success d-flexalign-items-center" style="justify-content: space-around" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-white" id="airfare" data-toggle="pill" href="#pills-airfare" role="tab" aria-controls="pills-home" aria-selected="true">AIRFARE</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-white" id="hotel_landarrangement" data-toggle="pill" href="#pills-hotel_landarrangement" role="tab" aria-controls="pills-profile" aria-selected="false">HOTEL / LAND ARRANGEMENT</a>
                                </li>

                    
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-airfare" role="tabpanel" style="background-color: white">
                                    <!-- <p class="text-light">AIRFARE</p> -->
                                    <div class="row " style="">
                                        <div class="col-md-10">

                                            <table class="table mb-0"  style="">
                                                <thead>
                                                    <th><span class="text-danger mr-1">*</span>Passenger Name</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="airfare_passengerName[]" class="airfare_passengerName form-control form-control-sm" value="" id="">
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>

                                           

                                            <div id="divNextAirfare">

                                            </div>

                                            

                                        </div>

                                        <div class="col-md-2 ">
                                            <input type="button" onclick="countAirfarePassenger()" class="addAirfareBtn btn btn-dark btn-sm mb-0 mt-2 p-1" style="border: 0; cursor: pointer; width: 100%;" value="ADD PASSENGER" id="addAirfareBtn">
                                        </div>

                                    </div>
                                    
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Group Name:</label>
                                            <textarea cols="5" rows="3" name="airfare_groupName" id="airfare_groupName" class="form-control form-control-sm" required>

                                            </textarea>
                                        </div>
                                    </div>



                                    <div class="row mt-3">
                                        <div class="col-md-3 d-flex justify-content-center" style="align-items: self-end;">
                                            <h6 class="text-center "><span class="text-danger mr-1">*</span>USD OR PHP: </h6>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-6 ">

                                                    <div class="d-flex ">
                                                        <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>USD:</label>
                                                        <input type="radio" name="airfare_paymentMethod" onclick="selectedUsdPhp()" value="USD" id="usdchose" class="form-control form-control" >
                                                    </div>
                                                    
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="d-flex ">
                                                        <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>PHP:</label>
                                                        <input type="radio" name="airfare_paymentMethod" onclick="selectedUsdPhp()" value="PHP" id="phpchose" class="form-control form-control" >
                                                    </div>
                                                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mt-3">
                                        <div class="col-md-3 d-flex justify-content-center" style="align-items: self-end;">
                                            <h5 class="text-center "><span class="text-danger mr-1">*</span>AIRFARE: </h5>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>USD:</label>
                                                    <input type="number" name="airfare_airfare_usd" oninput="airfare();" id="airfare_airfare_usd" class="airfare_usdInput form-control form-control-sm" value="0" required>
                                                    <input type="number" name="airfare_airfare_usdD" oninput="airfare();" id="airfare_airfare_usdD" class="d-none form-control form-control-sm" value="0" required>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>
                                                    <input type="number" name="airfare_airfare_arc" oninput="airfare();" id="airfare_airfare_arc" class="airfare_arcInput form-control form-control-sm" value="0" required>
                                                    <input type="number" name="airfare_airfare_arcD" oninput="airfare();" id="airfare_airfare_arcD" class="d-none form-control form-control-sm" value="0" required>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>PHP:</label>
                                                    <input type="number" name="airfare_airfare_php" oninput="totalAmountPo();" id="airfare_airfare_php" class="airfare_phpInput form-control form-control-sm" value="0" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Dito na tayo sa pag cacalculate ng total amount -->
                                    <div class="row mt-3">
                                        <div class="col-md-3 d-flex justify-content-center" style="align-items: self-end;">
                                            <h5 class="text-center "><span class="text-danger mr-1">*</span>TAXES: </h5>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>USD:</label>
                                                    <input type="number" name="airfare_taxes_usd" oninput="taxes();" id="airfare_taxes_usd" class="airfare_usdInput form-control form-control-sm" value="0" required>
                                                    <input type="number" name="airfare_taxes_usdD" oninput="taxes();" id="airfare_taxes_usdDD" class="d-none airfare_taxes_usdDD form-control form-control-sm" value="0" required>
                                                </div>

                                                <div class="col-md-4" style="visibility: hidden">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>
                                                    <input type="number" name="airfare_taxes_arc" oninput="taxes();" id="airfare_taxes_arc" class="airfare_arcInput form-control form-control-sm" value="0" required>
                                                    <input type="number" name="airfare_taxes_arcD" oninput="taxes();" id="airfare_taxes_arcD" class="d-none form-control form-control-sm" value="0" required>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>PHP:</label>
                                                    <input type="number" name="airfare_taxes_php" oninput="totalAmountPo();" id="airfare_taxes_php" class="airfare_phpInput form-control form-control-sm" value="0" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-3 d-flex justify-content-center" style="align-items: self-end;">
                                            <h5 class="text-center "><span class="text-danger mr-1">*</span>IATA FEE: </h5>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>USD:</label>
                                                    <input type="number" name="airfare_iata_usd" oninput="iata();" id="airfare_iata_usd" class="airfare_usdInput form-control form-control-sm" value="0" required>
                                                    <input type="number" name="airfare_iata_usdD" oninput="iata();" id="airfare_iata_usdD" class="d-none form-control form-control-sm" value="0" required>
                                                </div>

                                                <div class="col-md-4" style="visibility: hidden">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>
                                                    <input type="number" name="airfare_iata_arc" oninput="iata();" id="airfare_iata_arc" class="airfare_arcInput form-control form-control-sm" value="0" required>
                                                    <input type="number" name="airfare_iata_arcD" oninput="iata();" id="airfare_iata_arcD" class="d-none form-control form-control-sm" value="0" required>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>PHP:</label>
                                                    <input type="number" name="airfare_iata_php" oninput="totalAmountPo();" id="airfare_iata_php" class="airfare_phpInput form-control form-control-sm" value="0" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="text" name="airfare_totalUsd" onclick="" value="0" id="airfare_totalUsd" class="d-none form-control " >

                                    <div class="row mt-4">
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Total Passenger:</label>
                                                <input type="number" name="airfare_totalPassenger" oninput="totalAmountPo()" id="airfare_totalPassenger" value="0" class="form-control form-control-sm" >
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                        
                                            <div class="col-md-12">
                                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>No. of Days:</label>
                                                <input type="number" name="airfare_noOfDays" oninput="" id="airfare_noOfDays" class="form-control form-control-sm" value="0">
                                            </div>
                                            
                                        </div>
                                    </div>
                                   
                                    <div class="row mt-4">
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Total Amount:</label>
                                                <input type="text" name="airfare_totalAmount" id="airfare_totalAmount" class="form-control form-control-sm" value="0" readonly>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Amount in Words:</label>
                                                <input type="text" name="airfare_amountInWords" style="text-transform: uppercase;" id="airfare_amountInWords" class="form-control form-control-sm" readonly>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="tab-pane fade" id="pills-hotel_landarrangement" role="tabpanel" style="background-color: white" >
                                <!-- <p class="text-light">localfare</p> -->
                                    <div class="row " >
                                        <div class="col-md-10">
                                            <!-- Dito na tayo sa Land Arrangement -->
                                            
                                            <table class="table mb-0"  style="">
                                                <thead>
                                                    <th>Passenger Name</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="hotel_passengerName[]" class=" form-control form-control-sm" id="" value="">
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>

                                            <div id="divNextLocalfare">

                                            </div>

                                        </div>

                                        <div class="col-md-2">
                                            <input type="button" class="addLocalfareBtn btn btn-dark btn-sm mb-0 mt-2 p-1" style="border: 0; cursor: pointer; width: 100%;" value="ADD PASSENGER" id="addLocalfareBtn">
                                        </div>

                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Check In:</label>
                                            <input type="date" name="hotel_checkIn" oninput="calculateDays()" id="hotel_checkIn" class="form-control form-control-sm" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Check Out:</label>
                                            <input type="date" name="hotel_checkOut" oninput="calculateDays()" id="hotel_checkOut" class="form-control form-control-sm" required>
                                        </div>
                                    </div>

                                    

                                    <div class="row mt-3">
                                        <div class="col-md-3 d-flex justify-content-center" style="align-items: self-end;">
                                            <h6 class="text-center "><span class="text-danger mr-1">*</span>USD OR PHP: </h6>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-6 ">

                                                    <div class="d-flex ">
                                                        <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>USD:</label>
                                                        <input type="radio" name="hotel_paymentMethod" onclick="selectedUsdPhpHotel()" value="USD" id="usdChoseHotel" class="form-control form-control" required>
                                                    </div>
                                                    
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="d-flex ">
                                                        <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>PHP:</label>
                                                        <input type="radio" name="hotel_paymentMethod" onclick="selectedUsdPhpHotel()" value="PHP" id="phpChoseHotel" class="form-control form-control" required >
                                                    </div>
                                                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-3 d-flex justify-content-center" style="align-items: self-end;">
                                            <h5 class="text-center "><span class="text-danger mr-1">*</span>HOTEL</h5>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>USD:</label>
                                                    <input type="number" name="hotel_hotel_usd" oninput="hotel();" id="hotel_hotel_usd" class="hotel_usdInput form-control form-control-sm" value="0" required>
                                                    <input type="number" name="hotel_hotel_usdD" oninput="hotel();" id="hotel_hotel_usdD" class="d-none form-control form-control-sm" value="0" required>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>
                                                    <input type="number" name="hotel_hotel_arc" oninput="hotel();" id="hotel_hotel_arc" class="hotel_arcInput form-control form-control-sm" value="0" required>
                                                    <input type="number" name="hotel_hotel_arcD" oninput="hotel();" id="hotel_hotel_arcD" class="d-none form-control form-control-sm" value="0" required>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>PHP:</label>
                                                    <input type="number" name="hotel_hotel_php" oninput="totalAmountHotelPo();" id="hotel_hotel_php" class="hotel_phpInput form-control form-control-sm" value="0" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Dito na tayo sa pag cacalculate ng total amount -->
                                    <div class="row mt-3">
                                        <div class="col-md-3 d-flex justify-content-center" style="align-items: self-end;">
                                            <h5 class="text-center "><span class="text-danger mr-1">*</span>TAXES: </h5>
                                        </div>

                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>USD:</label>
                                                    <input type="number" name="hotel_taxes_usd" oninput="hoteltaxes();" id="hotel_taxes_usd" class="hotel_usdInput form-control form-control-sm" value="0" required>
                                                    <input type="number" name="hotel_taxes_usdD" oninput="hoteltaxes();" id="hotel_taxes_usdDD" class="d-none airfare_taxes_usdDD form-control form-control-sm" value="0" required>
                                                </div>

                                                <div class="col-md-4" style="visibility: hidden">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>
                                                    <input type="number" name="hotel_taxes_arc" oninput="hoteltaxes();" id="hotel_taxes_arc" class="hotel_arcInput form-control form-control-sm" value="0" required>
                                                    <input type="number" name="hotel_taxes_arcD" oninput="hoteltaxes();" id="hotel_taxes_arcD" class="d-none form-control form-control-sm" value="0" required>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>PHP:</label>
                                                    <input type="number" name="hotel_taxes_php" oninput="totalAmountHotelPo();" id="hotel_taxes_php" class="hotel_phpInput form-control form-control-sm" value="0" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Total Passenger:</label>
                                            <!-- <input type="number" name="hotel_totalPassenger" oninput="totalAmountHotelPo()" id="hotel_totalPassenger" class="form-control form-control-sm" > -->
                                            <input type="number" name="hotel_totalPassenger" oninput="" id="" class="hotel_totalPassenger form-control form-control-sm" value="0">
                                        </div>
                                        
                                    </div>

                                    <div class="row mt-3" >
                                        <div class="col-md-12">
                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>No. of Days:</label>
                                            <input type="text" name="hotel_noOfDays" id="hotel_noOfDays" class="hotel_noOfDays form-control form-control-sm" value="0" readonly>
                                        </div>
                                    </div>

                                    

                                    <div class="row mt-3" >
                                        <div class="col-md-12">
                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Total Amount:</label>
                                            <input type="text" name="hotel_totalAmount" id="hotel_totalAmount" class="form-control form-control-sm" value="0" readonly>
                                        </div>

                                    </div>

                                </div>

                        
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Prepared By:</label>
                            <input type="text" name="ar_preparedBy" id="ar_preparedBy" value="<?php echo $userName;?>" class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Checked By:</label>
                            <input type="text" name="ar_checkedBy" id="ar_checkedBy" class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Approved By:</label>
                            <input type="text" name="ar_approvedBy" id="ar_approvedBy" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <input type="submit" id="addBtn" class="btn btn-success btn-block mt-3" value="Submit">
                    
                </form>
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

    $('#airfare_airfare_usd').prop('readonly', true);
    $('#airfare_airfare_arc').prop('readonly', true);

    $('#airfare_taxes_usd').prop('readonly', true);
    $('#airfare_taxes_arc').prop('readonly', true);

    $('#airfare_iata_usd').prop('readonly', true);
    $('#airfare_iata_arc').prop('readonly', true);

    $('#airfare_airfare_php').prop('readonly', true);
    $('#airfare_taxes_php').prop('readonly', true);
    $('#airfare_iata_php').prop('readonly', true);


    // Start For Hotel PO

    let hotel_usdInput = document.querySelectorAll('.hotel_usdInput');
        // console.log(tourcost1_usdInput)
        hotel_usdInput.forEach(function(hotel_usdInput_Item, index) {
        
        
            hotel_usdInput_Item.addEventListener("input", (event) => {
            if(hotel_usdInput_Item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                hotel_usdInput_Item.value = 0;
                
                hotel()
                hoteltaxes()
                
            }
            else{
                // alert("Merong value");
            }
            });
        });


        let hotel_arcInput = document.querySelectorAll('.hotel_arcInput');
        // console.log(tourcost1_usdInput)
        hotel_arcInput.forEach(function(hotel_arcInput_Item, index) {
        
        
            hotel_arcInput_Item.addEventListener("input", (event) => {
            if(hotel_arcInput_Item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                hotel_arcInput_Item.value = 0;
                hotel()
                
            }
            else{
                // alert("Merong value");
            }
            });
        });


        let hotel_phpInput = document.querySelectorAll('.hotel_phpInput');
        // console.log(tourcost1_usdInput)
        hotel_phpInput.forEach(function(hotel_phpInput_Item, index) {
        
        
            hotel_phpInput_Item.addEventListener("input", (event) => {
            if(hotel_phpInput_Item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                hotel_phpInput_Item.value = 0;
                totalAmountHotelPo();
                
            }
            else{
                // alert("Merong value");
            }
            });
        });


        let hotel_totalPassenger = document.querySelector('.hotel_totalPassenger');
        hotel_totalPassenger.addEventListener("input", (event) => {
            if(hotel_totalPassenger.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                hotel_totalPassenger.value = 0;
                
                totalAmountHotelPo();
                
            }
            else{
                // alert("Merong value");
            }
            });


        let hotel_noOfDays = document.querySelector('.hotel_noOfDays');
    
        hotel_noOfDays.addEventListener("input", (event) => {
        if(hotel_noOfDays.value == ""){
            // alert("Walang value si " + tourcost1_usdInput_item.value);
            hotel_noOfDays.value = 0;
            
            totalAmountHotelPo();
            
        }
        else{
            // alert("Merong value");
        }
        });
    
    
        

        
                                        

    

    function selectedUsdPhpHotel(){
        //Validate the USD OR PHP Radio Button
        if(document.getElementById('usdChoseHotel').checked) {
        //USD radio button is checked
            console.log("naclick si usd")


            $('#hotel_hotel_php').prop('readonly', true);
            $('#hotel_taxes_php').prop('readonly', true);
            
            $('#hotel_hotel_usd').prop('readonly', false);
            $('#hotel_hotel_arc').prop('readonly', false);

            $('#hotel_taxes_usd').prop('readonly', false);
            $('#hotel_taxes_arc').prop('readonly', false);

            

        }
        
        else if(document.getElementById('phpChoseHotel').checked) {
        //Php radio button is checked
            console.log("naclick si php")

            $('#hotel_hotel_usd').prop('readonly', true);
            $('#hotel_hotel_arc').prop('readonly', true);
            $('#hotel_hotel_usd').val(0);
            $('#hotel_hotel_arc').val(0);

            $('#hotel_taxes_usd').prop('readonly', true);
            $('#hotel_taxes_arc').prop('readonly', true);
            $('#hotel_taxes_usd').val(0);
            $('#hotel_taxes_arc').val(0);

            $('#hotel_hotel_php').prop('readonly', false);
            $('#hotel_taxes_php').prop('readonly', false);

            
        }
    }

    $('#hotel_hotel_usd').prop('readonly', true);
    $('#hotel_hotel_arc').prop('readonly', true);

    $('#hotel_taxes_usd').prop('readonly', true);
    $('#hotel_taxes_arc').prop('readonly', true);


    $('#hotel_hotel_php').prop('readonly', true);
    $('#hotel_taxes_php').prop('readonly', true);




    function calculateDays(){
        var dateIn = document.getElementById("hotel_checkIn").value;
        var dateOut = document.getElementById("hotel_checkOut").value;

        var dateIns = new Date(dateIn);
        var dateOuts = new Date(dateOut);

        var Difference_In_Time = dateOuts.getTime()  -  dateIns.getTime(); 

        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

        var hotel_noOfDays = document.getElementById("hotel_noOfDays");
            hotel_noOfDays.value = Difference_In_Days + 1;

        totalAmountHotelPo()
    }

    function hotel() {

        var totalAmountHotelPhp = document.getElementById('hotel_hotel_php');

        let hotelacr = document.getElementById("hotel_hotel_arc").value;
        let hotelacrD = document.getElementById("hotel_hotel_arcD");

        let hotelacrs = (Math.round(hotelacr * 100) / 100).toFixed(2);
            hotelacrD.value = hotelacrs;

        let hotelusd = document.getElementById("hotel_hotel_usd").value;
        let hotelusdD = document.getElementById("hotel_hotel_usdD");

        let hotelusds = (Math.round(hotelusd * 100) / 100).toFixed(2);
            hotelusdD.value = hotelusds;

        let hotelsum = parseFloat(hotelacr) * parseFloat(hotelusd);
        var hotelphp = document.getElementById("hotel_hotel_php").value = (Math.round(hotelsum * 100) / 100).toFixed(2);

        totalAmountHotelPhp.value = hotelphp;

        let hotel_taxes_arc = document.getElementById("hotel_taxes_arc")

        hotel_taxes_arc.value = hotelacr
        hoteltaxes();

        totalAmountHotelPo()

    }

    function hoteltaxes() {

        var totalAmountHotelTaxesPhp = document.getElementById('hotel_taxes_php');

        let hoteltaxesusd = document.getElementById("hotel_taxes_usd").value;
        let hoteltaxesusdD = document.getElementById("hotel_taxes_usdDD");

        let hoteltaxesusds = (Math.round(hoteltaxesusd * 100) / 100).toFixed(2);
            hoteltaxesusdD.value = hoteltaxesusds;

        let hoteltaxesacr = document.getElementById("hotel_taxes_arc").value;
        let hoteltaxesacrD = document.getElementById("hotel_taxes_arcD");

        let hoteltaxesacrs = (Math.round(hoteltaxesacr * 100) / 100).toFixed(2);
            hoteltaxesacrD.value = hoteltaxesacrs;


        let hoteltaxessum = parseFloat(hoteltaxesacr) * parseFloat(hoteltaxesusd);
        var hoteltaxesphp = document.getElementById("hotel_taxes_php").value = (Math.round(hoteltaxessum * 100) / 100).toFixed(2);

        totalAmountHotelTaxesPhp.value = hoteltaxesphp;
        totalAmountHotelPo()
    }

    function totalAmountHotelPo() {

        console.log("Napindot")

        let hoteltotalSum = document.getElementById("hotel_hotel_php").value
        let hoteltaxestotalSum = document.getElementById("hotel_taxes_php").value
        
        // let hotel_noOfDays = document.getElementById("hotel_noOfDays").value
        // let hotel_totalPassenger = document.getElementById("hotel_totalPassenger").value

        let hotel_totalAmount = document.getElementById("hotel_totalAmount")

        let totalAllHotelAmountwPassenger = (parseFloat(hoteltotalSum) + parseFloat(hoteltaxestotalSum));
        
        let totalAllHotelAmount = totalAllHotelAmountwPassenger;
        console.log(totalAllHotelAmount)
        hotel_totalAmount.value = parseFloat(totalAllHotelAmount);

        convertAmountToText(totalAllHotelAmount);


    }


    // End For Hotel PO





    
    // Start For AIRFARE PO

    let airfare_usdInput = document.querySelectorAll('.airfare_usdInput');
        // console.log(tourcost1_usdInput)
        airfare_usdInput.forEach(function(airfare_usdInput_Item, index) {
        
        
            airfare_usdInput_Item.addEventListener("input", (event) => {
            if(airfare_usdInput_Item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                airfare_usdInput_Item.value = 0;
                
                taxes()
                iata()
                
            }
            else{
                // alert("Merong value");
            }
            });
        });

        let airfare_arcInput = document.querySelectorAll('.airfare_arcInput');
        // console.log(tourcost1_usdInput)
        airfare_arcInput.forEach(function(airfare_arcInput_Item, index) {
        
        
            airfare_arcInput_Item.addEventListener("input", (event) => {
            if(airfare_arcInput_Item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                airfare_arcInput_Item.value = 0;
                airfare()
                
            }
            else{
                // alert("Merong value");
            }
            });
        });


        let airfare_phpInput = document.querySelectorAll('.airfare_phpInput');
        // console.log(tourcost1_usdInput)
        airfare_phpInput.forEach(function(airfare_phpInput_Item, index) {
        
        
            airfare_phpInput_Item.addEventListener("input", (event) => {
            if(airfare_phpInput_Item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                airfare_phpInput_Item.value = 0;
                totalAmountPo();
                
            }
            else{
                // alert("Merong value");
            }
            });
        });

        let airfare_totalPassenger = document.getElementById('airfare_totalPassenger');
            airfare_totalPassenger.addEventListener("input", (event) => {
            if(airfare_totalPassenger.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                airfare_totalPassenger.value = 0;
                
                totalAmountPo();
                
            }
            else{
                // alert("Merong value");
            }
            });

        
        let airfare_noOfDays = document.getElementById('airfare_noOfDays');
    
        airfare_noOfDays.addEventListener("input", (event) => {
        if(airfare_noOfDays.value == ""){
            // alert("Walang value si " + tourcost1_usdInput_item.value);
            airfare_noOfDays.value = 0;
            
            totalAmountPo();
            
        }
        else{
            // alert("Merong value");
        }
        });

    function selectedUsdPhp(){
        //Validate the USD OR PHP Radio Button
        if(document.getElementById('usdchose').checked) {
        //USD radio button is checked
            console.log("naclick si usd")
            $('#airfare_airfare_php').prop('readonly', true);
            $('#airfare_taxes_php').prop('readonly', true);
            $('#airfare_iata_php').prop('readonly', true);

            $('#airfare_airfare_usd').prop('readonly', false);
            $('#airfare_airfare_arc').prop('readonly', false);

            $('#airfare_taxes_usd').prop('readonly', false);
            $('#airfare_taxes_arc').prop('readonly', false);

            $('#airfare_iata_usd').prop('readonly', false);
            $('#airfare_iata_arc').prop('readonly', false);


        }
        
        else if(document.getElementById('phpchose').checked) {
        //Php radio button is checked
            console.log("naclick si php")

            $('#airfare_airfare_usd').prop('readonly', true);
            $('#airfare_airfare_arc').prop('readonly', true);
            $('#airfare_airfare_usd').val(0);
            $('#airfare_airfare_arc').val(0);

            $('#airfare_taxes_usd').prop('readonly', true);
            $('#airfare_taxes_arc').prop('readonly', true);
            $('#airfare_taxes_usd').val(0);
            $('#airfare_taxes_arc').val(0);

            $('#airfare_iata_usd').prop('readonly', true);
            $('#airfare_iata_arc').prop('readonly', true);
            $('#airfare_iata_usd').val(0);
            $('#airfare_iata_arc').val(0);

            $('#airfare_airfare_php').prop('readonly', false);
            $('#airfare_taxes_php').prop('readonly', false);
            $('#airfare_iata_php').prop('readonly', false);
        }
    }

    

    // FOR CALCULATION

    function airfare() {

            var totalAmountAirfarePhp = document.getElementById('airfare_airfare_php');

            let airfareacr = document.getElementById("airfare_airfare_arc").value;
            let airfareacrD = document.getElementById("airfare_airfare_arcD");

            let airfareacrs = (Math.round(airfareacr * 100) / 100).toFixed(2);
                airfareacrD.value = airfareacrs;

            let airfareusd = document.getElementById("airfare_airfare_usd").value;
            let airfareusdD = document.getElementById("airfare_airfare_usdD");

            let airfareusds = (Math.round(airfareusd * 100) / 100).toFixed(2);
                airfareusdD.value = airfareusds;

            let airfaresum = parseFloat(airfareacr) * parseFloat(airfareusd);
            var airfarephp = document.getElementById("airfare_airfare_php").value = (Math.round(airfaresum * 100) / 100).toFixed(2);

            totalAmountAirfarePhp.value = airfarephp;

            
            

            let airfare_taxes_arc = document.getElementById("airfare_taxes_arc");
            let airfare_iata_arc = document.getElementById("airfare_iata_arc");


            airfare_taxes_arc.value = airfareacr;
            airfare_iata_arc.value = airfareacr;
            taxes()
            iata();
            totalAmountPo()

    }

    function taxes() {

        var totalAmountTaxesPhp = document.getElementById('airfare_taxes_php');

        let taxesusd = document.getElementById("airfare_taxes_usd").value;
        let taxesusdD = document.getElementById("airfare_taxes_usdDD");
        
        let taxesusds = (Math.round(taxesusd * 100) / 100).toFixed(2);
            taxesusdD.value = taxesusds;

        let taxesacr = document.getElementById("airfare_taxes_arc").value;
        let taxesacrD = document.getElementById("airfare_taxes_arcD");

        let taxesacrs = (Math.round(taxesacr * 100) / 100).toFixed(2);
            taxesacrD.value = taxesacrs;


        let taxessum = parseFloat(taxesacr) * parseFloat(taxesusd);
        var taxesphp = document.getElementById("airfare_taxes_php").value = (Math.round(taxessum * 100) / 100).toFixed(2);

        totalAmountTaxesPhp.value = taxesphp;
        totalAmountPo()
    }

    function iata() {

        var totalAmountIataPhp = document.getElementById('airfare_iata_php');

        let iatausd = document.getElementById("airfare_iata_usd").value;
        let iatausdD = document.getElementById("airfare_iata_usdD");

        let iatausds = (Math.round(iatausd * 100) / 100).toFixed(2);
        iatausdD.value = iatausds;

        let iataacr = document.getElementById("airfare_iata_arc").value;
        let iataacrD = document.getElementById("airfare_iata_arcD");

        let iataacrs = (Math.round(iataacr * 100) / 100).toFixed(2);
            iataacrD.value = iataacrs;


        let iatasum = parseFloat(iatausd) * parseFloat(iataacr);
        var iataphp = document.getElementById("airfare_iata_php").value = (Math.round(iatasum * 100) / 100).toFixed(2);

        totalAmountIataPhp.value = iataphp;

        totalAmountPo()
    }

    function totalAmountPo() {

        console.log("Napindot")
        // FOR TOTAL USD IN airfare

        let airfare_totalUsd = document.getElementById("airfare_totalUsd")

        let airfare_airfare_usd = document.getElementById("airfare_airfare_usd").value
        let airfare_taxes_usd = document.getElementById("airfare_taxes_usd").value
        let airfare_iata_usd = document.getElementById("airfare_iata_usd").value

        let totalAmountUsd = (parseFloat(airfare_airfare_usd) + parseFloat(airfare_taxes_usd) + parseFloat(airfare_iata_usd)); 
        airfare_totalUsd.value = (Math.round(totalAmountUsd * 100) / 100).toFixed(2);

        // FOR TOTAL PHP IN AIRFARE
        let airfaretotalSum = document.getElementById("airfare_airfare_php").value
        let taxestotalSum = document.getElementById("airfare_taxes_php").value
        let iataretotalSum = document.getElementById("airfare_iata_php").value
        let airfare_totalPassenger = document.getElementById("airfare_totalPassenger").value
        // let airfare_noOfDays = document.getElementById("airfare_noOfDays").value
        let airfare_totalAmount = document.getElementById("airfare_totalAmount")

        let totalAllAmountwPassenger = (parseFloat(airfaretotalSum) + parseFloat(taxestotalSum) + parseFloat(iataretotalSum)) * airfare_totalPassenger; 
        let totalAllAmount = totalAllAmountwPassenger;
        airfare_totalAmount.value = parseFloat(totalAllAmount);

        convertAmountToText(totalAllAmount);


    }


    function convertAmountToText(totalAllAmount) {
  const units = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
  const tens = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
  const scales = ['', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion'];

  function convertNumberToWordsLessThanThousand(num) {
    if (num === 0) return '';
    if (num < 20) return units[num];
    if (num < 100) return tens[Math.floor(num / 10)] + (num % 10 !== 0 ? '-' + units[num % 10] : '');
    return units[Math.floor(num / 100)] + ' hundred' + (num % 100 !== 0 ? ' ' + convertNumberToWordsLessThanThousand(num % 100) : '');
  }

  function convertNumberToWords(num) {
    if (num === 0) return 'zero';
    let words = '';
    let scaleIndex = 0;
    while (num > 0) {
      const numLessThanThousand = num % 1000;
      if (numLessThanThousand !== 0) {
        const scale = scales[scaleIndex];
        words = convertNumberToWordsLessThanThousand(numLessThanThousand) + (scale ? ' ' + scale : '') + (words ? ', ' + words : '');
      }
      num = Math.floor(num / 1000);
      scaleIndex++;
    }
    return words;
  }

  // Split the input number into millions and centavos parts
  const millions = Math.floor(totalAllAmount);
  const centavos = Math.round((totalAllAmount - millions) * 100);

  // Convert millions and centavos parts into words
  const millionsText = convertNumberToWords(millions);
  const centavosText = convertNumberToWords(centavos);

  // Combine the results and format the final text
  let result = millionsText;
  if (centavos > 0) {
    result += ' and ' + centavosText + ' centavos ';
  }

  let airfare_amountInWords = document.getElementById("airfare_amountInWords");

  airfare_amountInWords.value = result + " PESOS ONLY ";

  return result;
}   

    // //Add Check Button

    // For Airfare

    $("#addAirfareBtn").click(function(e){
        e.preventDefault();

        console.log("Napindot si addAirfareBtn")

        $("#divNextAirfare").append(

            
            
            `
            <table class="table mb-0"  >
                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="airfare_passengerName[]" value="" class="airfare_passengerName form-control form-control-sm" id="">
                        </td>
                        <td style="" id="container-amount">
                            <input type="button" class=" btn btn-danger btn-sm mb-0" style="border: 0; cursor: pointer; width: 100%;" onclick="" value="REMOVE" id="removeCheckBtnAirfare">
                        </td>
                    </tr>
                </tbody>
            </table>`);
 
    })

    $(document).on('click', '#removeCheckBtnAirfare', function(e){
            e.preventDefault();

            

            // let checkAmount = document.getElementById('checkAmount').value = "";

            let conAmount = document.getElementById('container-amount');
            conAmount.children[0];
            console.log(conAmount.children[0]);
            let amountVal = conAmount.children[0].value;
            console.log(amountVal);



            let row_item = $(this).parent().parent().parent();
            let input_item = $(this).parent();
            console.log("Hsa been")
            console.log(input_item);
            $(row_item).remove();

            totalAmountPo();

    })

    // For Hotel and Land Arrangement
    $("#addLocalfareBtn").click(function(e){
        e.preventDefault();

        console.log("Napindot si addAirfareBtn")

        $("#divNextLocalfare").append(
            `<table class="table mb-0"  style="">
                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="hotel_passengerName[]" value="" class="form-control form-control-sm" id="">
                        </td>
                        <td style="" id="container-amount-hotel">
                            <input type="button" class=" btn btn-danger btn-sm mb-0" style="border: 0; cursor: pointer; width: 100%;" onclick="" value="REMOVE" id="removeCheckBtnHotel">
                        </td>
                    </tr>
                    
                </tbody>
            </table>`);
 
    })

    $(document).on('click', '#removeCheckBtnHotel', function(e){
            e.preventDefault();

            

            // let checkAmount = document.getElementById('checkAmount').value = "";

            let conAmount = document.getElementById('container-amount-hotel');
            conAmount.children[0];
            console.log(conAmount.children[0]);
            let amountVal = conAmount.children[0].value;
            console.log(amountVal);



            let row_item = $(this).parent().parent().parent();
            let input_item = $(this).parent();
            console.log("Hsa been")
            console.log(input_item);
            $(row_item).remove();

            totalAmountPo();

    })

    $(document).ready(function(){

        console.log("start");

        var isAjaxInProgress = false;
        
            $("#addBtn").click(function(e){
                
                    console.log("napindot");
                    e.preventDefault();

                    if(isAjaxInProgress){
                        alert("Please wait, previous request still on progress")
                        return;
                    }

                    isAjaxInProgress = true;

                    $.ajax({
                        url: "add_process.php",
                        method: "POST",
                        data: $("#po_Form").serialize() + "&action=AddPO",
                        success : function (response){
                            if(response == "Success"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Successfully Added PO!',
                                    showConfirmButton: false,
                                    timer: 1300  
                                }).then(function(){
                                    window.location = "po_list.php";
                                })
                            }

                            else if(response == "Error"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'There is an error Please try again Thankyou!',
                                    showConfirmButton: false,
                                    timer: 1300  
                                })
                            }

                            else if(response == "EmptyError"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Make sure the input fields are not empty. Please try again Thankyou!',
                                    showConfirmButton: false,
                                    timer: 2000  
                                })
                            }

                            isAjaxInProgress = false;

                        },
                        error: function(error) {
                            console.error('AJAX error:', error);
                            // Reset the flag after an error or timeout
                            isAjaxInProgress = false;
                        }
                    })

                    setTimeout(function() {
                    // Reset the flag after the timeout
                    isAjaxInProgress = false;
                    }, 5000);
            })
        
        

        
        
        
    });

</script>



<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>