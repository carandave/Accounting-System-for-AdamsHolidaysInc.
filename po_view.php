<?php 

    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    if(isset($_POST['viewPo'])){
        $poId = $_POST['po_Id'];
    }

    else{
        header("Location: po_list.php");
    }

    $userName = $_SESSION['name'];

    $event = "Viewed";
    $form = "PO";
    $dateEdited = date('Y-m-d');
    $timeEdited = date('H:i:s');

    $sqli = "INSERT INTO audit_trail (user, event, form, date, time) VALUES ('$userName', '$event', '$form', '$dateEdited', '$timeEdited')";
    $resulti = $conn->query($sqli);

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

            <?php 
            
            $sql = "SELECT * FROM po WHERE po_Id='$poId'";
            $result = $conn->query($sql);
            
            ?>

            <?php if($result->num_rows > 0){?>
                <?php while($rows = $result->fetch_assoc()){?>

            <div class="col-md-10">
                <div class="bg-success" style="width: 85%; padding: 8px 20px; margin: 0 auto;" >
                    <h5 class="mb-0 text-light">Purchase Order View</h5>
                </div>
                <form action="" id="edit_po_Forms" style="width: 85%; margin: 0 auto; border: 1px solid lightgray;" class="p-4" >
                    <input type="text" name="edit_by" id="" value="<?php echo $userName;?>" class="d-none form-control form-control-sm" readonly>
                    <input type="text" name="edit_poId" id="" value="<?php echo $poId?>" class="d-none form-control form-control-sm" readonly>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>PO Number:</label>
                            <input type="text" name="" id="" value="<?php echo $rows['po_Number'];?>" class="form-control form-control-sm " readonly>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Supplier:</label>
                            <input type="text" name="edit_supplier" id="supplier" value="<?php echo $rows['supplier'];?>" class="form-control form-control-sm " readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Address:</label>
                            <input type="text" name="edit_address" id="address" value="<?php echo $rows['address'];?>" class="form-control form-control-sm" readonly>
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Agent:</label>
                            <input type="text" name="edit_agent" id="agent" value="<?php echo $rows['agent'];?>" class="form-control form-control-sm" readonly>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Particular:</label>
                            <textarea cols="10" rows="5" name="edit_particular" value="<?php echo $rows['particular'];?>" id="particular" class="form-control form-control-sm" readonly><?php echo $rows['particular'];?></textarea>
                            <!-- <input type="text" name="particular" id="particular" class="form-control form-control-sm" required> -->
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Rec. Locator:</label>
                            <input type="text" name="edit_rec_locator" id="rec_locator" value="<?php echo $rows['rec_locator'];?>" class="form-control form-control-sm" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Conjunction:</label>
                            <input type="text" name="edit_conjunction" id="conjunction" value="<?php echo $rows['conjunction'];?>" class="form-control form-control-sm " readonly>
                        </div>
                    </div>
            

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Date:</label>
                            <input type="date" name="edit_date" id="date" value="<?php echo $rows['date'];?>" class="form-control form-control-sm " readonly>
                        </div>

                        

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Amount Deposit:</label>
                            <input type="number" name="edit_amount_deposit" id="amount_deposit" value="<?php echo $rows['amount_deposit'];?>" class="form-control form-control-sm" value="0" readonly>
                        </div>

                        <!-- <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>
                            <input type="number" name="acr" id="acr" class="form-control form-control-sm" required>
                        </div> -->
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>AR:</label>
                            <input type="text" name="edit_or" id="or" value="<?php echo $rows['or_No'];?>" class="form-control form-control-sm " readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>CV:</label>
                            <input type="text" name="edit_cv" id="cv" value="<?php echo $rows['cv'];?>" class="form-control form-control-sm" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>SA:</label>
                            <input type="text" name="edit_sa" id="sa" value="<?php echo $rows['sa'];?>" class="form-control form-control-sm" readonly>
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
                                    
                                    <div class="row " style="">
                                        <div class="col-md-10">

                                        </div>

                                        <div class="col-md-2 ">
                                        </div>

                                    </div>
                                    
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Group Name:</label>
                                            <textarea cols="5" rows="3" value="<?php echo $rows['airfare_groupName'];?>" name="airfare_groupName" id="airfare_groupName" class="form-control form-control-sm" readonly required>
                                            <?php echo $rows['airfare_groupName'];?>
                                            </textarea>
                                        </div>
                                    </div>

                                    <!-- <div class="row p-3">
                                        <div class="col-md-4 pl-4">
                                            
                                        </div>

                                        <div class="col-md-4">

                                        </div>

                                        <div class="col-md-4 d-flex justify-content-end align-items-end pr-0 ">
                                            <input type="button" class="addPassengerTab btn btn-block btn-dark mb-0 mt-3" onclick="" style="border: 0; cursor: pointer;" value="ADD PASSENGER" id="addPassengerTab">
                                        </div>
                                    </div>   -->

                                    <div class="row m-1 mt-3 bg-primary">
                                        <div class="col-md-12 mx-0">
                                            <div class="row p-3 mx-0">
                                                <div class="col-md-6 mx-0" style="border-right: 3px solid white">
                                                    <div class="d-flex ">
                                                        <label for="" class="font-weight-bold text-light mb-0"><span class="text-danger mr-1 ">*</span>USD:</label>
                                                        <input type="radio" name="airfare_paymentMethod" onclick="selectedUsdPhpAirfare()" value="USD" id="usdChosePaymentMethod" class="form-control " required disabled
                                                        
                                                        <?php if($rows['airfare_paymentMethod'] == "USD"){
                                                            echo "checked";
                                                        }?>
                                                        
                                                        >
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mx-0" style="border-left: 3px solid white">
                                                    <div class="d-flex ">
                                                        <label for="" class="font-weight-bold text-light mb-0"><span class="text-danger mr-1">*</span>PHP:</label>
                                                        <input type="radio" name="airfare_paymentMethod" onclick="selectedUsdPhpAirfare()" value="PHP" id="phpChosePaymentMethod" class="form-control " required disabled
                                                        
                                                            <?php if($rows['airfare_paymentMethod'] == "PHP"){
                                                                echo "checked";
                                                            }?>

                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row bg-warning p-3 m-1 " id="acr-div">
                                        <div class="col-md-12 ">
                                            <label for="" class="font-weight-bold text-dark"><span class="text-danger mr-1">*</span>ACR:</label>
                                            <input type="number" name="airfare_acr" value="<?php echo $rows['airfare_acr'];?>" id="acr" class="form-control form-control-sm" required readonly>
                                        </div>
                                    </div>

                                    <?php 

                                        $airfare_passengerNameArr = explode(",", $rows['airfare_passengerName']);

                                        $airfare_airfare_usdArr = explode(",", $rows['airfare_airfare_usd']);
                                        $airfare_taxes_usdArr = explode(",", $rows['airfare_taxes_usd']);
                                        $airfare_iata_usdArr = explode(",", $rows['airfare_iata_usd']);

                                        $airfare_airfare_phpArr = explode(",", $rows['airfare_airfare_php']);
                                        $airfare_taxes_phpArr = explode(",", $rows['airfare_taxes_php']);
                                        $airfare_iata_phpArr = explode(",", $rows['airfare_iata_php']);

                                        $airfare_sub_total_usdArr = explode(",", $rows['airfare_sub_total_usd']);
                                        $airfare_sub_total_phpArr = explode(",", $rows['airfare_sub_total_php']);
                                        
                                    ?>

                                    <?php foreach($airfare_passengerNameArr as $airfare_passengerNameArrIndex => $index){ ?>

                                    <div class="row bg-success p-3 pb-4 mt-3" style="margin: 0 5px;">
                                        <div class="col-md-12">

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">PASSENGER NAME: </span></label>
                                                </div>

                                                <div class="col-md-8 d-flex">
                                                    
                                                    <input type="text" name="airfare_passengerName[]" value="<?php echo $airfare_passengerNameArr[$airfare_passengerNameArrIndex]?>" oninput="" style="height: 35px;" id="passengername_airfare" class="passengername_airfare form-control form-control-sm" required readonly>
                                                </div>

                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">AIRFARE</span></label>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">USD: </span></label>
                                                    <input type="number" name="airfare_usd[]" oninput="subtotalusd()" value="<?php echo $airfare_airfare_usdArr[$airfare_passengerNameArrIndex]?>" style="height: 35px;" id="airfare_usd" class="airfare_usd form-control form-control-sm input-sm" required readonly>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">PHP: </span></label>
                                                    <input type="number" name="airfare_php[]" oninput="subtotalphp()" value="<?php echo $airfare_airfare_phpArr[$airfare_passengerNameArrIndex]?>" id="airfare_php" style="height: 35px;" class="airfare_php form-control" required readonly>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">TAXES</span></label>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">USD: </span></label>
                                                    <input type="number" name="taxes_usd[]" oninput="subtotalusd()" value="<?php echo $airfare_taxes_usdArr[$airfare_passengerNameArrIndex]?>" id="taxes_usd" style="height: 35px;" class="taxes_usd form-control" required readonly>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">PHP: </span></label>
                                                    <input type="number" name="taxes_php[]" oninput="subtotalphp()" value="<?php echo $airfare_taxes_phpArr[$airfare_passengerNameArrIndex]?>" id="taxes_php" style="height: 35px;" class="taxes_php form-control" required readonly>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">IATA</span></label>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">USD: </span></label>
                                                    <input type="number" name="iata_usd[]" oninput="subtotalusd()" id="iata_usd" value="<?php echo $airfare_iata_usdArr[$airfare_passengerNameArrIndex]?>" style="height: 35px;" class="iata_usd form-control" required readonly>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">PHP: </span></label>
                                                    <input type="number" name="iata_php[]" oninput="subtotalphp()" id="iata_php" value="<?php echo $airfare_iata_phpArr[$airfare_passengerNameArrIndex]?>" style="height: 35px;" class="iata_php form-control form-control-sm" required readonly>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                </div>

                                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white mb-0  d-flex justify-content-center align-items-center" style="font-size: 12px; height: 35px;" ><span class="mb-0">TOTAL USD: </span></label>
                                                    <input type="number" name="airfare_sub_total_usd[]" oninput="" value="<?php echo $airfare_sub_total_usdArr[$airfare_passengerNameArrIndex]?>" id="sub_total_usd" style="height: 35px;" class="sub_total_usd form-control" readonly>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white mb-0 d-flex justify-content-center align-items-center" style="font-size: 12px; height: 35px;" ><span >TOTAL PHP: </span></label>
                                                    <input type="number" name="airfare_sub_total_php[]" oninput="" value="<?php echo $airfare_sub_total_phpArr[$airfare_passengerNameArrIndex]?>" id="sub_total_php" style="height: 35px;" class="sub_total_php form-control form-control-sm" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php } ?>

                                    <div id="divNextPassengerTab">

                                    </div>

                                    <div class="row p-3 mt-2" style="margin: 0 5px;">
                                        <div class="col-md-4">
                                            <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white"><span class="text-center">SUB TOTAL</span></label>
                                        </div>

                                        <div class="col-md-4 d-flex">
                                        <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white"><span class="text-center">USD: </span></label>
                                            <input type="number" name="airfare_final_sub_total_usd" oninput="" value="<?php echo $rows['airfare_final_sub_total_usd'];?>" id="final_sub_total_usd" style="height: 40px;" class="final_sub_total_usd form-control" readonly>
                                        </div>

                                        <div class="col-md-4 d-flex">
                                            <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white"><span class="text-center">PHP: </span></label>
                                            <input type="number" name="airfare_final_sub_total_php" oninput="" value="<?php echo $rows['airfare_final_sub_total_php'];?>" id="final_sub_total_php" style="height: 40px;" class="final_sub_total_php form-control form-control-sm" readonly>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Total Amount:</label>
                                                <input type="text" name="airfare_totalAmount" value="<?php echo $rows['airfare_totalAmount'];?>" id="airfare_totalAmount" class="form-control form-control-sm" readonly>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Amount in Words:</label>
                                                <input type="text" name="airfare_amountInWords" value="<?php echo $rows['airfare_amountInWords'];?>" style="text-transform: uppercase;" id="airfare_amountInWords" class="form-control form-control-sm" readonly>
                                            </div>
                                            
                                        </div>
                                    </div>

                                </div>


                                <!-- FOR HOTEL LAND TAB -->

                                <div class="tab-pane fade" id="pills-hotel_landarrangement" role="tabpanel" style="background-color: white" >
                                    
                                    <!-- <div class="row p-3">
                                        <div class="col-md-4 pl-4">
                                            
                                        </div>

                                        <div class="col-md-4">

                                        </div>

                                        <div class="col-md-4 d-flex justify-content-end align-items-end pr-0 ">
                                            <input type="button" class="addLocalfareBtn btn btn-block btn-dark mb-0 mt-3" onclick="" style="border: 0; cursor: pointer;" value="ADD PASSENGER" id="addLocalfareBtn">
                                        </div>
                                    </div> -->

                                    <div class="row m-1 mt-3 bg-primary">
                                        <div class="col-md-12 mx-0">
                                            <div class="row p-3 mx-0">
                                                <div class="col-md-6 mx-0" style="border-right: 3px solid white">
                                                    <div class="d-flex ">
                                                        <label for="" class="font-weight-bold text-light mb-0"><span class="text-danger mr-1 ">*</span>USD:</label>
                                                        <input type="radio" name="hotel_paymentMethod" onclick="selectedUsdPhpHotelLand()" value="USD" id="usdChoseHotel" class="form-control " required disabled
                                                        
                                                            <?php if($rows['hotel_paymentMethod'] == "USD"){
                                                                echo "checked";
                                                            }?>

                                                        >
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mx-0" style="border-left: 3px solid white">
                                                    <div class="d-flex ">
                                                        <label for="" class="font-weight-bold text-light mb-0"><span class="text-danger mr-1">*</span>PHP:</label>
                                                        <input type="radio" name="hotel_paymentMethod" onclick="selectedUsdPhpHotelLand()" value="PHP" id="phpChoseHotel" class="form-control " required disabled
                                                        
                                                            <?php if($rows['hotel_paymentMethod'] == "PHP"){
                                                                echo "checked";
                                                            }?>

                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row bg-warning p-3 m-1 " id="hotel-acr-div">
                                        <div class="col-md-12 ">
                                            <label for="" class="font-weight-bold text-dark"><span class="text-danger mr-1">*</span>ACR:</label>
                                            <input type="number" name="hotel_acr" oninput="" value="<?php echo $rows['hotel_acr'];?>" id="hotel_acr" class="form-control form-control-sm" required readonly>
                                        </div>
                                    </div>

                                    <?php 

                                        $hotel_passengerNameArr = explode(",", $rows['hotel_passengerName']);

                                    ?>

                                    

                                    <div class="row bg-success p-3 pb-4 mt-3" style="margin: 0 5px;">
                                        <div class="col-md-12">
                                            <?php foreach($hotel_passengerNameArr as $hotel_passengerNameArrValue => $index){ ?>      
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">PASSENGER NAME: </span></label>
                                                    </div>
                                                    <div class="col-md-8 d-flex">
                                                        <input type="text" name="hotel_passengerName[]" value="<?php echo $hotel_passengerNameArr[$hotel_passengerNameArrValue]?>" style="height: 35px;" id="hotel_passengerName" class="hotel_passengerName form-control form-control-sm" required readonly>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <div id="divNextLocalfare">

                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">HOTEL</span></label>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">USD: </span></label>
                                                    <input type="number" name="hotel_hotel_usd" value="<?php echo $rows['hotel_hotel_usd'];?>" oninput="hotellandusd()" style="height: 35px;" id="hotel_hotel_usd" class="hotel_hotel_usd form-control form-control-sm input-sm" required readonly>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">PHP: </span></label>
                                                    <input type="number" name="hotel_hotel_php" value="<?php echo $rows['hotel_hotel_php'];?>" oninput="hotellandphp()" id="hotel_hotel_php" style="height: 35px;" class="hotel_hotel_php form-control" required readonly>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">TAXES</span></label>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">USD: </span></label>
                                                    <input type="number" name="hotel_taxes_usd" value="<?php echo $rows['hotel_taxes_usd'];?>" oninput="hotellandusd()" id="hotel_taxes_usd" style="height: 35px;" class="hotel_taxes_usd form-control" required readonly>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">PHP: </span></label>
                                                    <input type="number" name="hotel_taxes_php" value="<?php echo $rows['hotel_taxes_php'];?>" oninput="hotellandphp()" id="hotel_taxes_php" style="height: 35px;" class="hotel_taxes_php form-control" required readonly>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                </div>

                                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white mb-0  d-flex justify-content-center align-items-center" style="font-size: 12px; height: 35px;" ><span class="mb-0">TOTAL USD: </span></label>
                                                    <input type="number" name="hotel_sub_total_usd" value="<?php echo $rows['hotel_sub_total_usd'];?>" oninput="" id="hotel_sub_total_usd" style="height: 35px;" class="hotel_sub_total_usd form-control" value="0" readonly>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white mb-0 d-flex justify-content-center align-items-center" style="font-size: 12px; height: 35px;" ><span >TOTAL PHP: </span></label>
                                                    <input type="number" name="hotel_sub_total_php" value="<?php echo $rows['hotel_sub_total_php'];?>" oninput="" id="hotel_sub_total_php" style="height: 35px;" class="hotel_sub_total_php form-control form-control-sm" value="0" readonly>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row mt-3" >
                                        <div class="col-md-12">
                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Total Amount:</label>
                                            <input type="text" name="hotel_totalAmount" value="<?php echo $rows['hotel_totalAmount'];?>" id="hotel_totalAmount" class="form-control form-control-sm" value="0" readonly>
                                        </div>

                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Amount in Words:</label>
                                            <input type="text" name="hotelland_amountInWords" value="<?php echo $rows['hotelland_amountInWords'];?>" style="text-transform: uppercase;" id="hotelland_amountInWords" class="form-control form-control-sm" value="N/A" readonly>
                                        </div>
                                    </div>

                                </div>

                        
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Prepared By:</label>
                            <input type="text" name="edit_po_preparedBy" id="po_preparedBy" value="<?php echo $rows['preparedBy'];?>" class="form-control form-control-sm" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Checked By:</label>
                            <input type="text" name="edit_po_checkedBy" id="po_checkedBy" value="<?php echo $rows['checkedBy'];?>" class="form-control form-control-sm" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Approved By:</label>
                            <input type="text" name="edit_po_approvedBy" id="po_approvedBy" value="<?php echo $rows['approvedBy'];?>" class="form-control form-control-sm" readonly>
                        </div>
                    </div>

                    <!-- <input type="submit" id="editBtn" class="btn btn-success btn-block mt-3" value="Submit"> -->
                    
                </form>
            </div>

                <?php } ?>

            <?php } ?>
        </div>
        
        

        </div>
    </div>

<!-- Sweetalert Cdn Start -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Sweetalert Cdn End -->

<!-- JS SCRIPT -->
<script src="ar.js"></script>


    

<script>

    // Start For Hotel PO

    let hotel_paymentMethod = document.getElementById('hotel_payment_methodChose').value
    
    if(hotel_paymentMethod == "USD"){
        console.log("USD HOTEL HEHE")

        $('#hotel_hotel_php').prop('readonly', true);
        $('#hotel_taxes_php').prop('readonly', true);
        
        $('#hotel_hotel_usd').prop('readonly', false);
        $('#hotel_hotel_arc').prop('readonly', false);

        $('#hotel_taxes_usd').prop('readonly', false);
        $('#hotel_taxes_arc').prop('readonly', false);

    
    }

    else if(hotel_paymentMethod == "PHP"){
        console.log("PHP HOTEL HEHE")

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

    // $('#hotel_hotel_usd').prop('readonly', true);
    // $('#hotel_hotel_arc').prop('readonly', true);

    // $('#hotel_taxes_usd').prop('readonly', true);
    // $('#hotel_taxes_arc').prop('readonly', true);


    // $('#hotel_hotel_php').prop('readonly', true);
    // $('#hotel_taxes_php').prop('readonly', true);




    function calculateDays(){
        var dateIn = document.getElementById("hotel_checkIn").value;
        var dateOut = document.getElementById("hotel_checkOut").value;

        var dateIns = new Date(dateIn);
        var dateOuts = new Date(dateOut);

        var Difference_In_Time = dateOuts.getTime()  -  dateIns.getTime(); 

        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

        var hotel_noOfDays = document.getElementById("hotel_noOfDays");
            hotel_noOfDays.value = Difference_In_Days

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
        
        let hotel_noOfDays = document.getElementById("hotel_noOfDays").value
        let hotel_totalPassenger = document.getElementById("hotel_totalPassenger").value

        let hotel_totalAmount = document.getElementById("hotel_totalAmount")

        let totalAllHotelAmountwPassenger = (parseFloat(hoteltotalSum) + parseFloat(hoteltaxestotalSum)) * hotel_totalPassenger;
        
        let totalAllHotelAmount = totalAllHotelAmountwPassenger * hotel_noOfDays;
        console.log(totalAllHotelAmount)
        hotel_totalAmount.value = parseFloat(totalAllHotelAmount);

        // convertAmountToText(totalAllHotelAmount);


    }


    // End For Hotel PO





    
    // Start For AIRFARE PO

    let payment_methodChose = document.getElementById('payment_methodChose').value
    
    if(payment_methodChose == "USD"){
        console.log("USD HEHE")

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

    else if(payment_methodChose == "PHP"){
        console.log("PHP HEHE")

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
        let airfare_noOfDays = document.getElementById("airfare_noOfDays").value
        let airfare_totalAmount = document.getElementById("airfare_totalAmount")

        let totalAllAmountwPassenger = (parseFloat(airfaretotalSum) + parseFloat(taxestotalSum) + parseFloat(iataretotalSum)) * airfare_totalPassenger; 
        let totalAllAmount = totalAllAmountwPassenger * airfare_noOfDays;
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
                            <input type="text" name="edit_airfare_passengerName[]" class="airfare_passengerName form-control form-control-sm" id="">
                        </td>
                        <td style="" id="container-amount">
                            <input type="button" class=" btn btn-danger btn-sm mb-0" style="border: 0; cursor: pointer;" onclick="" value="Remove" id="removeCheckBtnAirfare">
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
                            <input type="text" name="edit_hotel_passengerName[]" class="form-control form-control-sm" id="">
                        </td>
                        <td style="" id="container-amount-hotel">
                            <input type="button" class=" btn btn-danger btn-sm mb-0" style="border: 0; cursor: pointer;" onclick="" value="Remove" id="removeCheckBtnHotel">
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
        
            $("#editBtn").click(function(e){
                
                    console.log("napindot");
                    e.preventDefault();

                    console.log("Sig");
                    $.ajax({
                        url: "edit_process.php",
                        method: "POST",
                        data: $("#edit_po_Forms").serialize() + "&action=EditPO",
                        success : function (response){
                            if(response == "Success"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Successfully Edited PO!',
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

                        }
                    })
            })
        
        

        
        
        
    });

</script>



<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>