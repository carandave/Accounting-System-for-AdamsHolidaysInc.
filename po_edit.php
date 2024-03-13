<?php 

    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    if(isset($_POST['editPrint'])){
        $poId = $_POST['po_Id'];
    }

    if(isset($_POST['editBtnReq']) && $_SESSION['usertype'] == 'user' && isset($_POST['token'])){
        $reqId = $_POST['req_Id'];
        $poId = $_POST['form_Id'];
        $token = $_POST['token'];
        $status = $_POST['status'];
        // $token_expire = $_POST['token_expire'];
        

        $sqlu = "UPDATE request_list SET token='' WHERE req_Id='$reqId'";
        $resultu = $conn->query($sqlu);

    }

    elseif(isset($_POST['editAdminBtn']) && $_SESSION['usertype'] == 'superadmin'){
        $poId = $_POST['po_Id'];
      
    }

    elseif(isset($_POST['editAdminBtn']) && $_SESSION['usertype'] == 'admin'){
        $poId = $_POST['po_Id'];
      
    }

    else{
        header("Location: po_list.php");
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

            <?php 
            
            $sql = "SELECT * FROM po WHERE po_Id='$poId'";
            $result = $conn->query($sql);
            
            ?>

            <?php if($result->num_rows > 0){?>
                <?php while($rows = $result->fetch_assoc()){?>

            <div class="col-md-10">
                <div class="bg-success" style="width: 85%; padding: 8px 20px; margin: 0 auto;" >
                    <h5 class="mb-0 text-light">Purchase Order Entry Form</h5>
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
                            <input type="text" name="edit_supplier" id="supplier" value="<?php echo $rows['supplier'];?>" class="form-control form-control-sm " required>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Address:</label>
                            <input type="text" name="edit_address" id="address" value="<?php echo $rows['address'];?>" class="form-control form-control-sm" required>
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Agent:</label>
                            <input type="text" name="edit_agent" id="agent" value="<?php echo $rows['agent'];?>" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Particular:</label>
                            <textarea cols="10" rows="5" name="edit_particular" value="<?php echo $rows['particular'];?>" id="particular" class="form-control form-control-sm" required><?php echo $rows['particular'];?></textarea>
                            <!-- <input type="text" name="particular" id="particular" class="form-control form-control-sm" required> -->
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Rec. Locator:</label>
                            <input type="text" name="edit_rec_locator" id="rec_locator" value="<?php echo $rows['rec_locator'];?>" class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Conjunction:</label>
                            <input type="text" name="edit_conjunction" id="conjunction" value="<?php echo $rows['conjunction'];?>" class="form-control form-control-sm " required>
                        </div>
                    </div>
            

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Date:</label>
                            <input type="date" name="edit_date" id="date" value="<?php echo $rows['date'];?>" class="form-control form-control-sm " required>
                        </div>

                        

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Amount Deposit:</label>
                            <input type="number" name="edit_amount_deposit" id="amount_deposit" value="<?php echo $rows['amount_deposit'];?>" class="form-control form-control-sm" value="0" required>
                        </div>

                        <!-- <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>
                            <input type="number" name="acr" id="acr" class="form-control form-control-sm" required>
                        </div> -->
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>AR:</label>
                            <input type="text" name="edit_or" id="or" value="<?php echo $rows['or_No'];?>" class="form-control form-control-sm " required>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>CV:</label>
                            <input type="text" name="edit_cv" id="cv" value="<?php echo $rows['cv'];?>" class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>SA:</label>
                            <input type="text" name="edit_sa" id="sa" value="<?php echo $rows['sa'];?>" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <input type="text" name="edit_category" id="category" class="form-control form-control-sm d-none" value="<?php echo $rows['po_category'];?>" required>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <ul class="nav nav-pills mb-3 bg-success d-flexalign-items-center" style="justify-content: space-around" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link text-white" id="airfare" data-toggle="pill" href="#pills-airfare" role="tab" aria-controls="pills-home" aria-selected="true">AIRFARE</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-white" id="hotel_landarrangement" data-toggle="pill" href="#pills-hotel_landarrangement" role="tab" aria-controls="pills-profile" aria-selected="false">HOTEL / LAND ARRANGEMENT</a>
                                </li>

                    
                            </ul>

                            <?php 
                                $airfare_passengerNameArr = explode(",", $rows['airfare_passengerName']);
                            ?>

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
                                            <textarea cols="5" rows="3" value="<?php echo $rows['airfare_groupName'];?>" name="edit_airfare_groupName" id="airfare_groupName" class="form-control form-control-sm"  required>
                                            <?php echo $rows['airfare_groupName'];?>
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="row p-3">
                                        <div class="col-md-4 pl-4">
                                            
                                        </div>

                                        <div class="col-md-4">

                                        </div>

                                        <div class="col-md-4 d-flex justify-content-end align-items-end pr-0 ">
                                            <input type="button" class="addPassengerTab btn btn-block btn-dark mb-0 mt-3" onclick="" style="border: 0; cursor: pointer;" value="ADD PASSENGER" id="addPassengerTab">
                                        </div>
                                    </div>  

                                    <div class="row m-1 mt-3 bg-primary">
                                        <div class="col-md-12 mx-0">
                                            <div class="row p-3 mx-0">
                                                <div class="col-md-6 mx-0" style="border-right: 3px solid white">
                                                    <div class="d-flex ">
                                                        <label for="" class="font-weight-bold text-light mb-0"><span class="text-danger mr-1 ">*</span>USD:</label>
                                                        <input type="radio" name="edit_airfare_paymentMethod" onclick="selectedUsdPhpAirfare()" value="USD" id="usdChosePaymentMethod" class="form-control " required 
                                                        
                                                        <?php if($rows['airfare_paymentMethod'] == "USD"){
                                                            echo "checked";
                                                        }?>
                                                        
                                                        >
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mx-0" style="border-left: 3px solid white">
                                                    <div class="d-flex ">
                                                        <label for="" class="font-weight-bold text-light mb-0"><span class="text-danger mr-1">*</span>PHP:</label>
                                                        <input type="radio" name="edit_airfare_paymentMethod" onclick="selectedUsdPhpAirfare()" value="PHP" id="phpChosePaymentMethod" class="form-control " required 
                                                        
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
                                            <input type="number" name="edit_airfare_acr" value="<?php echo $rows['airfare_acr'];?>" id="acr" class="form-control form-control-sm" required >
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
                                                    
                                                    <input type="text" name="edit_airfare_passengerName[]" value="<?php echo $airfare_passengerNameArr[$airfare_passengerNameArrIndex]?>" oninput="" style="height: 35px;" id="passengername_airfare" class="passengername_airfare form-control form-control-sm" required >
                                                </div>

                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">AIRFARE</span></label>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">USD: </span></label>
                                                    <input type="number" name="edit_airfare_usd[]" oninput="subtotalusd()" value="<?php echo $airfare_airfare_usdArr[$airfare_passengerNameArrIndex]?>" style="height: 35px;" id="airfare_usd" class="airfare_usd form-control form-control-sm input-sm" required >
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">PHP: </span></label>
                                                    <input type="number" name="edit_airfare_php[]" oninput="subtotalphp()" value="<?php echo $airfare_airfare_phpArr[$airfare_passengerNameArrIndex]?>" id="airfare_php" style="height: 35px;" class="airfare_php form-control" required >
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">TAXES</span></label>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">USD: </span></label>
                                                    <input type="number" name="edit_taxes_usd[]" oninput="subtotalusd()" value="<?php echo $airfare_taxes_usdArr[$airfare_passengerNameArrIndex]?>" id="taxes_usd" style="height: 35px;" class="taxes_usd form-control" required >
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">PHP: </span></label>
                                                    <input type="number" name="edit_taxes_php[]" oninput="subtotalphp()" value="<?php echo $airfare_taxes_phpArr[$airfare_passengerNameArrIndex]?>" id="taxes_php" style="height: 35px;" class="taxes_php form-control" required >
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">IATA</span></label>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">USD: </span></label>
                                                    <input type="number" name="edit_iata_usd[]" oninput="subtotalusd()" id="iata_usd" value="<?php echo $airfare_iata_usdArr[$airfare_passengerNameArrIndex]?>" style="height: 35px;" class="iata_usd form-control" required >
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">PHP: </span></label>
                                                    <input type="number" name="edit_iata_php[]" oninput="subtotalphp()" id="iata_php" value="<?php echo $airfare_iata_phpArr[$airfare_passengerNameArrIndex]?>" style="height: 35px;" class="iata_php form-control form-control-sm" required >
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                </div>

                                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white mb-0  d-flex justify-content-center align-items-center" style="font-size: 12px; height: 35px;" ><span class="mb-0">TOTAL USD: </span></label>
                                                    <input type="number" name="edit_airfare_sub_total_usd[]" oninput="" value="<?php echo $airfare_sub_total_usdArr[$airfare_passengerNameArrIndex]?>" id="sub_total_usd" style="height: 35px;" class="sub_total_usd form-control" readonly>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white mb-0 d-flex justify-content-center align-items-center" style="font-size: 12px; height: 35px;" ><span >TOTAL PHP: </span></label>
                                                    <input type="number" name="edit_airfare_sub_total_php[]" oninput="" value="<?php echo $airfare_sub_total_phpArr[$airfare_passengerNameArrIndex]?>" id="sub_total_php" style="height: 35px;" class="sub_total_php form-control form-control-sm" readonly>
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
                                            <input type="number" name="edit_airfare_final_sub_total_usd" oninput="" value="<?php echo $rows['airfare_final_sub_total_usd'];?>" id="final_sub_total_usd" style="height: 40px;" class="final_sub_total_usd form-control" readonly>
                                        </div>

                                        <div class="col-md-4 d-flex">
                                            <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white"><span class="text-center">PHP: </span></label>
                                            <input type="number" name="edit_airfare_final_sub_total_php" oninput="" value="<?php echo $rows['airfare_final_sub_total_php'];?>" id="final_sub_total_php" style="height: 40px;" class="final_sub_total_php form-control form-control-sm" readonly>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Total Amount:</label>
                                                <input type="text" name="edit_airfare_totalAmount" value="<?php echo $rows['airfare_totalAmount'];?>" id="airfare_totalAmount" class="form-control form-control-sm" readonly>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Amount in Words:</label>
                                                <input type="text" name="edit_airfare_amountInWords" value="<?php echo $rows['airfare_amountInWords'];?>" style="text-transform: uppercase;" id="airfare_amountInWords" class="form-control form-control-sm" readonly>
                                            </div>
                                            
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade" id="pills-hotel_landarrangement" role="tabpanel" style="background-color: white" >
                               
                                    <div class="row p-3">
                                        <div class="col-md-4 pl-4">
                                            
                                        </div>

                                        <div class="col-md-4">

                                        </div>

                                        <div class="col-md-4 d-flex justify-content-end align-items-end pr-0 ">
                                            <input type="button" class="addLocalfareBtn btn btn-block btn-dark mb-0 mt-3" onclick="" style="border: 0; cursor: pointer;" value="ADD PASSENGER" id="addLocalfareBtn">
                                        </div>
                                    </div>

                                    <div class="row m-1 mt-3 bg-primary">
                                        <div class="col-md-12 mx-0">
                                            <div class="row p-3 mx-0">
                                                <div class="col-md-6 mx-0" style="border-right: 3px solid white">
                                                    <div class="d-flex ">
                                                        <label for="" class="font-weight-bold text-light mb-0"><span class="text-danger mr-1 ">*</span>USD:</label>
                                                        <input type="radio" name="edit_hotel_paymentMethod" onclick="selectedUsdPhpHotelLand()" value="USD" id="usdChoseHotel" class="form-control " required 
                                                        
                                                            <?php if($rows['hotel_paymentMethod'] == "USD"){
                                                                echo "checked";
                                                            }?>

                                                        >
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mx-0" style="border-left: 3px solid white">
                                                    <div class="d-flex ">
                                                        <label for="" class="font-weight-bold text-light mb-0"><span class="text-danger mr-1">*</span>PHP:</label>
                                                        <input type="radio" name="edit_hotel_paymentMethod" onclick="selectedUsdPhpHotelLand()" value="PHP" id="phpChoseHotel" class="form-control " required 
                                                        
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
                                            <input type="number" name="edit_hotel_acr" oninput="" value="<?php echo $rows['hotel_acr'];?>" id="hotel_acr" class="form-control form-control-sm" required >
                                        </div>
                                    </div>

                                    <?php 

                                        $hotel_passengerNameArr = explode(",", $rows['hotel_passengerName']);

                                    ?>

                                    

                                    <div class="row bg-success p-3 pb-4 mt-3" style="margin: 0 5px;">
                                        <div class="col-md-12">
                                            <?php foreach($hotel_passengerNameArr as $hotel_passengerNameArrValue){ ?>
                                                <div class="row mt-3">
                                                    <div class="col-md-4">
                                                        <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">PASSENGER NAME: </span></label>
                                                    </div>
                                                    <div class="col-md-8 d-flex">
                                                        <input type="text" name="edit_hotel_passengerName[]" value="<?php echo $hotel_passengerNameArrValue?>" style="height: 35px;" id="hotel_passengerName" class="hotel_passengerName form-control form-control-sm" required >
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
                                                    <input type="number" name="edit_hotel_hotel_usd" value="<?php echo $rows['hotel_hotel_usd'];?>" oninput="hotellandusd()" style="height: 35px;" id="hotel_hotel_usd" class="hotel_hotel_usd form-control form-control-sm input-sm" required >
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">PHP: </span></label>
                                                    <input type="number" name="edit_hotel_hotel_php" value="<?php echo $rows['hotel_hotel_php'];?>" oninput="hotellandphp()" id="hotel_hotel_php" style="height: 35px;" class="hotel_hotel_php form-control" required >
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">TAXES</span></label>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">USD: </span></label>
                                                    <input type="number" name="edit_hotel_taxes_usd" value="<?php echo $rows['hotel_taxes_usd'];?>" oninput="hotellandusd()" id="hotel_taxes_usd" style="height: 35px;" class="hotel_taxes_usd form-control" required >
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">PHP: </span></label>
                                                    <input type="number" name="edit_hotel_taxes_php" value="<?php echo $rows['hotel_taxes_php'];?>" oninput="hotellandphp()" id="hotel_taxes_php" style="height: 35px;" class="hotel_taxes_php form-control" required >
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                </div>

                                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white mb-0  d-flex justify-content-center align-items-center" style="font-size: 12px; height: 35px;" ><span class="mb-0">TOTAL USD: </span></label>
                                                    <input type="number" name="edit_hotel_sub_total_usd" value="<?php echo $rows['hotel_sub_total_usd'];?>" oninput="" id="hotel_sub_total_usd" style="height: 35px;" class="hotel_sub_total_usd form-control" value="0" readonly>
                                                </div>

                                                <div class="col-md-4 d-flex">
                                                <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white mb-0 d-flex justify-content-center align-items-center" style="font-size: 12px; height: 35px;" ><span >TOTAL PHP: </span></label>
                                                    <input type="number" name="edit_hotel_sub_total_php" value="<?php echo $rows['hotel_sub_total_php'];?>" oninput="" id="hotel_sub_total_php" style="height: 35px;" class="hotel_sub_total_php form-control form-control-sm" value="0" readonly>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row mt-3" >
                                        <div class="col-md-12">
                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Total Amount:</label>
                                            <input type="text" name="edit_hotel_totalAmount" value="<?php echo $rows['hotel_totalAmount'];?>" id="hotel_totalAmount" class="form-control form-control-sm" readonly>
                                        </div>

                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Amount in Words:</label>
                                            <input type="text" name="edit_hotelland_amountInWords" value="<?php echo $rows['hotelland_amountInWords'];?>" style="text-transform: uppercase;" id="hotelland_amountInWords" class="form-control form-control-sm" value="N/A" readonly>
                                        </div>
                                    </div>

                                </div>

                        
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Prepared By:</label>
                            <input type="text" name="edit_po_preparedBy" id="ar_preparedBy" value="<?php echo $rows['preparedBy'];?>" class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Checked By:</label>
                            <input type="text" name="edit_po_checkedBy" id="ar_checkedBy" value="<?php echo $rows['checkedBy'];?>" class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-4">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Approved By:</label>
                            <input type="text" name="edit_po_approvedBy" id="ar_approvedBy" value="<?php echo $rows['approvedBy'];?>" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <input type="submit" id="editBtn" class="btn btn-success btn-block mt-3" value="Submit">
                    
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

    defaultZero();

    if(document.getElementById('usdChosePaymentMethod').checked) {
        $('.passengername_airfare').prop('readonly', false);

        $('.airfare_usd').prop('readonly', false);
        $('.airfare_php').prop('readonly', true);
        $('.airfare_php').val(0);

        $('.taxes_usd').prop('readonly', false);
        $('.taxes_php').prop('readonly', true);
        $('.taxes_php').val(0);

        $('.iata_usd').prop('readonly', false);
        $('.iata_php').prop('readonly', true);
        $('.iata_php').val(0);

        $('#acr-div').show();


    }

    else if(document.getElementById('phpChosePaymentMethod').checked) {

        $('.passengername_airfare').prop('readonly', false);

        $('.airfare_usd').prop('readonly', true);
        $('.airfare_usd').val(0);
        $('.airfare_php').prop('readonly', false);

        $('.taxes_usd').prop('readonly', true);
        $('.taxes_usd').val(0);
        $('.taxes_php').prop('readonly', false);

        $('.iata_usd').prop('readonly', true);
        $('.iata_usd').val(0);
        $('.iata_php').prop('readonly', false);

        $('#acr').val(0);
        $('#acr-div').hide();

    }

    else{

        $('.passengername_airfare').prop('readonly', true);

        $('.airfare_usd').prop('readonly', true);
        $('.airfare_php').prop('readonly', true);
        $('.airfare_usd').val(0);
        $('.airfare_php').val(0);

        $('.taxes_usd').prop('readonly', true);
        $('.taxes_php').prop('readonly', true);
        $('.taxes_usd').val(0);
        $('.taxes_php').val(0);

        $('.iata_usd').prop('readonly', true);
        $('.iata_php').prop('readonly', true);
        $('.iata_usd').val(0);
        $('.iata_php').val(0);

        $('#acr-div').val(0);
        $('#acr-div').hide();

    }
    // selectedUsdPhpHotelLand()

    if(document.getElementById('usdChoseHotel').checked) {

        $('.hotel_passengerName').prop('readonly', false);

        $('.hotel_hotel_usd').prop('readonly', false);
        $('.hotel_hotel_php').prop('readonly', true);
        $('.hotel_hotel_php').val(0);

        $('.hotel_taxes_usd').prop('readonly', false);
        $('.hotel_taxes_php').prop('readonly', true);
        $('.hotel_taxes_php').val(0); 

        // $('#airfare_amountInWords').val("N/A");
        $('#hotel-acr-div').show();


        }

    else if(document.getElementById('phpChoseHotel').checked) {

        $('.hotel_passengerName').prop('readonly', false);

        $('.hotel_hotel_usd').prop('readonly', true);
        $('.hotel_hotel_php').prop('readonly', false);
        $('.hotel_hotel_usd').val(0);

        $('.hotel_taxes_usd').prop('readonly', true);
        $('.hotel_taxes_php').prop('readonly', false);
        $('.hotel_taxes_usd').val(0);

        // $('#airfare_amountInWords').val("N/A");
        $('#hotel_acr').val(0);
        $('#hotel-acr-div').hide();

        }

    else{
        $('.hotel_passengerName').prop('readonly', true);

        $('.hotel_hotel_usd').prop('readonly', true);
        $('.hotel_hotel_php').prop('readonly', true);
        $('.hotel_hotel_usd').val(0);
        $('.hotel_hotel_php').val(0);

        $('.hotel_taxes_usd').prop('readonly', true);
        $('.hotel_taxes_php').prop('readonly', true);
        $('.hotel_taxes_usd').val(0); 
        $('.hotel_taxes_php').val(0); 

        // $('#airfare_amountInWords').val("N/A");
        $('#hotel-acr-div').hide();
    }




    

    let hotel_hotel_usd = document.querySelector('.hotel_hotel_usd');
    // console.log(tourcost1_usdInput)
        hotel_hotel_usd.addEventListener("change", (event) => {
        if(hotel_hotel_usd.value == ""){
            // alert("Walang value si " + tourcost1_usdInput_item.value);
            hotel_hotel_usd.value = 0;
            hotellandusd();
        }
        else{
            // alert("Merong value");
        }
    }); 

    let hotel_taxes_usd = document.querySelector('.hotel_taxes_usd');
    // console.log(tourcost1_usdInput)
        hotel_taxes_usd.addEventListener("change", (event) => {
        if(hotel_taxes_usd.value == ""){
            // alert("Walang value si " + tourcost1_usdInput_item.value);
            hotel_taxes_usd.value = 0;
            hotellandusd();
        }
        else{
            // alert("Merong value");
        }
    });

    let hotel_hotel_php = document.querySelector('.hotel_hotel_php');
    // console.log(tourcost1_usdInput)
        hotel_hotel_php.addEventListener("change", (event) => {
        if(hotel_hotel_php.value == ""){
            // alert("Walang value si " + tourcost1_usdInput_item.value);
            hotel_hotel_php.value = 0;
            hotellandphp();
        }
        else{
            // alert("Merong value");
        }
         
    }); 

    let hotel_taxes_php = document.querySelector('.hotel_taxes_php');
    // console.log(tourcost1_usdInput)
        hotel_taxes_php.addEventListener("change", (event) => {
        if(hotel_taxes_php.value == ""){
            // alert("Walang value si " + tourcost1_usdInput_item.value);
            hotel_taxes_php.value = 0;
            hotellandphp();
        }
        else{
            // alert("Merong value");
        }

    });

    let hotel_acr = document.getElementById('hotel_acr');

    hotel_acr.addEventListener("change", (event) => {
        if(hotel_acr.value == ""){
            // alert("Walang value si " + tourcost1_usdInput_item.value);
            hotel_acr.value = 0;
            // hotellandusd();
        }
        else{
            // alert("Merong value");
        }

        hotellandusd();
    });

    // $("#hotel_acr").on('change', function(e){
    //     alert("qwe" + e.value)
    //     if(e.value == "" || e.value == null || e.value == 0){
    //         e.value = 0;
    //         hotellandusd();
    //     }
    //     else{
           
    //     }

    //     hotellandusd();
    // })

    function hotellandusd(){
        let hotel_hotel_usd = document.getElementById('hotel_hotel_usd').value;
        let hotel_taxes_usd = document.getElementById('hotel_taxes_usd').value;
        let hotel_acr = document.getElementById('hotel_acr').value;

        let hotel_sub_total_usd = document.getElementById('hotel_sub_total_usd');
        let hotel_totalAmount = document.getElementById('hotel_totalAmount');

        
        let calcualtelandsubtotalusd = parseFloat(hotel_hotel_usd) + parseFloat(hotel_taxes_usd);
        // let calculatelandfinaltotalusd = calcualtelandsubtotalusd * parseFloat(hotel_acr);
        // hotel_sub_total_usd.value = calcualtelandsubtotalusd;
        // hotel_totalAmount.value = calculatelandfinaltotalusd;

        displayHotelSubTotal = parseFloat(calcualtelandsubtotalusd);
        hotel_sub_total_usd.value = displayHotelSubTotal.toFixed(2);

        displayHotelTotal = parseFloat(displayHotelSubTotal) * parseFloat(hotel_acr);
        hotel_totalAmount.value = displayHotelTotal.toFixed(2);

        convertAmountToTextHotel(hotel_totalAmount.value)

    }

    function hotellandphp(){
        let hotel_hotel_php = document.getElementById('hotel_hotel_php').value;
        let hotel_taxes_php = document.getElementById('hotel_taxes_php').value;

        let hotel_sub_total_php = document.getElementById('hotel_sub_total_php');
        let hotel_totalAmount = document.getElementById('hotel_totalAmount');

        
        let calcualtelandsubtotalphp = parseFloat(hotel_hotel_php) + parseFloat(hotel_taxes_php);

        displayHotelSubTotal = parseFloat(calcualtelandsubtotalphp);
        hotel_sub_total_php.value = displayHotelSubTotal.toFixed(2);

        displayHotelTotal = displayHotelSubTotal;
        hotel_totalAmount.value = displayHotelTotal.toFixed(2);

        // let calculatelandfinaltotalphp = calcualtelandsubtotalphp;
        // hotel_sub_total_php1.value = calculatelandfinaltotalphp;
        // hotel_totalAmount.value = calculatelandfinaltotalphp;



        convertAmountToTextHotel(hotel_totalAmount.value)

    }

    function convertAmountToTextHotel(hotel_totalAmount) {
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
        const millions = Math.floor(hotel_totalAmount);
        const centavos = Math.round((hotel_totalAmount - millions) * 100);

        // Convert millions and centavos parts into words
        const millionsText = convertNumberToWords(millions);
        const centavosText = convertNumberToWords(centavos);

        // Combine the results and format the final text
        let result = millionsText;
        if (centavos > 0) {
            result += ' and ' + centavosText + ' centavos ';
        }

        let hotelland_amountInWords = document.getElementById("hotelland_amountInWords");

        hotelland_amountInWords.value = result + " PESOS ONLY ";

        return result;
        }  

    

    function readonlyinputsHotel(){

        $('.hotel_passengerName').prop('readonly', true);

        $('.hotel_hotel_usd').prop('readonly', true);
        $('.hotel_hotel_php').prop('readonly', true);

        $('.hotel_taxes_php').prop('readonly', true);
        $('.hotel_taxes_usd').prop('readonly', true);

        $('#hotel-acr-div').hide();
    }

    function selectedUsdPhpHotelLand(){
        //Validate the USD OR PHP Radio Button
        if(document.getElementById('usdChoseHotel').checked) {

            $('.hotel_passengerName').prop('readonly', false);
        
            $('.hotel_hotel_usd').prop('readonly', false);
            $('.hotel_hotel_php').prop('readonly', true);
            $('.hotel_hotel_php').val(0);

            $('.hotel_taxes_usd').prop('readonly', false);
            $('.hotel_taxes_php').prop('readonly', true);
            $('.hotel_taxes_php').val(0); 
            $('.hotel_sub_total_php').val(0);
            $('#hotel_totalAmount').val(0);

            // $('#airfare_amountInWords').val("N/A");
            $('#hotel_acr').val(0);
            $('#hotel-acr-div').show();
            $('#hotelland_amountInWords').val("N/A");
            

        }
        
        else if(document.getElementById('phpChoseHotel').checked) {

            $('.hotel_passengerName').prop('readonly', false);
        
            $('.hotel_hotel_usd').prop('readonly', true);
            $('.hotel_hotel_php').prop('readonly', false);
            $('.hotel_hotel_usd').val(0);

            $('.hotel_taxes_usd').prop('readonly', true);
            $('.hotel_taxes_php').prop('readonly', false);
            $('.hotel_taxes_usd').val(0);
            $('.hotel_sub_total_usd').val(0);
            $('#hotel_totalAmount').val(0);

            // $('#airfare_amountInWords').val("N/A");
            $('#hotel_acr').val(0);
            $('#hotel-acr-div').hide();
            $('#hotelland_amountInWords').val("N/A");

        }

        else{
            $('.hotel_passengerName').prop('readonly', true);
        }

    }

    $("#addLocalfareBtn").click(function(e){
        e.preventDefault();

        console.log("Napindot si addAirfareBtn")

        $("#divNextLocalfare").append(
            `<div class="row mt-3">
                <div class="col-md-4">
                    <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">PASSENGER NAME: </span></label>
                </div>
                <div class="col-md-6 d-flex">
                    <input type="text" name="edit_hotel_passengerName[]" style="height: 35px;" id="hotel_passengerName" class="hotel_passengerName form-control form-control-sm" value="" required>
                </div>
                <div class="col-md-2 d-flex" id="container-amount-landhotel">
                    <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="" value="Remove" id="removePassengerHotelBtn">'
                </div>
            </div>`);

            if(document.getElementById('usdChoseHotel').checked) {

            $('.hotel_passengerName').prop('readonly', false);

            $('.hotel_hotel_usd').prop('readonly', false);
            $('.hotel_hotel_php').prop('readonly', true);
            $('.hotel_hotel_php').val(0);

            $('.hotel_taxes_usd').prop('readonly', false);
            $('.hotel_taxes_php').prop('readonly', true);
            $('.hotel_taxes_php').val(0); 

            // $('#airfare_amountInWords').val("N/A");
            $('#hotel-acr-div').show();

            }

            else if(document.getElementById('phpChoseHotel').checked) {

            $('.hotel_passengerName').prop('readonly', false);

            $('.hotel_hotel_usd').prop('readonly', true);
            $('.hotel_hotel_php').prop('readonly', false);
            $('.hotel_hotel_usd').val(0);

            $('.hotel_taxes_usd').prop('readonly', true);
            $('.hotel_taxes_php').prop('readonly', false);
            $('.hotel_taxes_usd').val(0);

            // $('#airfare_amountInWords').val("N/A");
            $('#hotel-acr-div').hide();

            }

            else{
                $('.hotel_passengerName').prop('readonly', true);
            }

        // defaultZero();
        // readonlyinputs();
        // selectedUsdPhpHotelLand();
    })

    $(document).on('click', '#removePassengerHotelBtn', function(e){
            e.preventDefault();

            let conAmount = document.getElementById('container-amount-landhotel');
            conAmount.children[0];
            // console.log(conAmount.children[0]);
            let amountVal = conAmount.children[0].value;
            // console.log(amountVal);

            let row_item = $(this).parent().parent();
            // console.log("Hsa been")
            // console.log(row_item);

            $(row_item).remove();

    })
    
    // Start For AIRFARE PO

    // AIRFARE

    function selectedUsdPhpAirfare(){
    //Validate the USD OR PHP Radio Button
    if(document.getElementById('usdChosePaymentMethod').checked) {

        $('.passengername_airfare').prop('readonly', false);

        $('.airfare_usd').prop('readonly', false);
        $('.airfare_php').prop('readonly', true);
        $('.airfare_php').val(0);

        $('.taxes_usd').prop('readonly', false);
        $('.taxes_php').prop('readonly', true);
        $('.taxes_php').val(0);

        $('.iata_usd').prop('readonly', false);
        $('.iata_php').prop('readonly', true);
        $('.iata_php').val(0);

        $('.sub_total_php').val(0);
        $('.final_sub_total_php').val(0);
        $('#airfare_totalAmount').val(0);
        $('#airfare_amountInWords').val("N/A");
        $('#acr').val(0);
        $('#acr-div').show();
        

    }

    else if(document.getElementById('phpChosePaymentMethod').checked) {

        $('.passengername_airfare').prop('readonly', false);

        $('.airfare_usd').prop('readonly', true);
        $('.airfare_usd').val(0);
        $('.airfare_php').prop('readonly', false);

        $('.taxes_usd').prop('readonly', true);
        $('.taxes_usd').val(0);
        $('.taxes_php').prop('readonly', false);

        $('.iata_usd').prop('readonly', true);
        $('.iata_usd').val(0);
        $('.iata_php').prop('readonly', false);


        
        $('.sub_total_usd').val(0);
        $('.final_sub_total_usd').val(0);
        $('#airfare_totalAmount').val(0);
        $('#airfare_amountInWords').val("N/A");
        
        $('#acr').val(0);
        $('#acr-div').hide();

    }

}


    $('.addPassengerTab').click(function(e){
        e.preventDefault();

        var cols    = ""
            cols += '    <div class="row bg-success p-3 pb-4 mt-3" style="margin: 0 5px;">'
            cols += '        <div class="col-md-12">'

            cols += '            <div class="row">'
            cols += '                <div class="col-md-9">'

            cols += '                </div>'

            cols += '                <div class="col-md-3 d-flex">'
            cols += '                    <input type="button" class="btn btn-danger btn-block" style="border: 0; cursor: pointer; margin-bottom: 0.5rem" onclick="" value="Remove" id="removePassengerBtn">'
            cols += '                </div>'

            cols += '            </div>'

            cols += '            <div class="row mt-2">'
            cols += '                <div class="col-md-4">'
            cols += '                    <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">PASSENGER NAME: </span></label>'
            cols += '                </div>'

            cols += '                <div class="col-md-8 d-flex">'
                                
            cols += '                    <input type="text" name="edit_airfare_passengerName[]" oninput="" style="height: 35px;" id="passengername_airfare" class="passengername_airfare form-control form-control-sm" value="" required>'
            cols += '                </div>'

            cols += '            </div>'

            cols += '            <div class="row mt-3">' 
            cols += '                    <div class="col-md-4">' 
            cols += '                       <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">AIRFARE</span></label>'
            cols += '                    </div>' 

            cols += '                    <div class="col-md-4 d-flex" id="container-amount">' 
            cols += '                        <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">USD: </span></label>'
            cols += '                        <input type="number" name="edit_airfare_usd[]" oninput="subtotalusd()" style="height: 35px;" id="airfare_usd" class="airfare_usd form-control form-control-sm input-sm" value="0" required>'
            cols += '                    </div>' 

            cols += '                    <div class="col-md-4 d-flex" id="container-amount-php">' 
            cols += '                        <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">PHP: </span></label>'
            cols += '                        <input type="number" name="edit_airfare_php[]" oninput="subtotalphp()" id="airfare_php" style="height: 35px;" class="airfare_php form-control" value="0" required>'
            cols += '                    </div>' 
            cols += '                </div>' 

            cols += '                <div class="row mt-3">' 
            cols += '                    <div class="col-md-4">' 
            cols += '                        <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">TAXES</span></label>'
            cols += '                    </div>' 

            cols += '                    <div class="col-md-4 d-flex" id="container-amount">' 
            cols += '                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">USD: </span></label>'
            cols += '                        <input type="number" name="edit_taxes_usd[]" oninput="subtotalusd()" id="taxes_usd" style="height: 35px;" class="taxes_usd form-control" value="0" required>'
            cols += '                    </div>' 

            cols += '                    <div class="col-md-4 d-flex" id="container-amount-php">' 
            cols += '                        <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">PHP: </span></label>'
            cols += '                        <input type="number" name="edit_taxes_php[]" oninput="subtotalphp()" id="taxes_php" style="height: 35px;" class="taxes_php form-control" value="0" required>'
            cols += '                    </div>' 
            cols += '                </div>' 

            cols += '                <div class="row mt-3">' 
            cols += '                    <div class="col-md-4">' 
            cols += '                        <label for="" class="font-weight-bold bg-dark p-2 w-100 text-center text-white" style="font-size: 13px"><span class="text-center">IATA</span></label>'
            cols += '                    </div>' 

            cols += '                    <div class="col-md-4 d-flex" id="container-amount">' 
            cols += '                    <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">USD: </span></label>'
            cols += '                        <input type="number" name="edit_iata_usd[]" oninput="subtotalusd()" id="iata_usd" style="height: 35px;" class="iata_usd form-control" value="0" required>'
            cols += '                    </div>' 

            cols += '                    <div class="col-md-4 d-flex" id="container-amount-php">' 
            cols += '                        <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white" style="font-size: 13px"><span class="text-center">PHP: </span></label>'
            cols += '                        <input type="number" name="edit_iata_php[]" oninput="subtotalphp()" id="iata_php" style="height: 35px;" class="iata_php form-control form-control-sm" value="0" required>'
            cols += '                    </div>' 
            cols += '                </div>' 

            cols += '                <div class="row mt-3">' 
            cols += '                    <div class="col-md-4">' 
            cols += '                    </div>' 

            cols += '                    <div class="col-md-4 d-flex justify-content-center align-items-center">'
            cols += '                        <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white mb-0  d-flex justify-content-center align-items-center" style="font-size: 12px; height: 35px;" ><span class="mb-0">TOTAL USD: </span></label>'
            cols += '                        <input type="number" name="edit_airfare_sub_total_usd[]" oninput="" id="sub_total_usd" style="height: 35px;" class="sub_total_usd form-control" value="0" readonly>'
            cols += '                    </div>' 

            cols += '                    <div class="col-md-4 d-flex">' 
            cols += '                       <label for="" class="font-weight-bold bg-dark p-2 w-50 text-center text-white mb-0 d-flex justify-content-center align-items-center" style="font-size: 12px; height: 35px;" ><span >TOTAL PHP: </span></label>'
            cols += '                        <input type="number" name="edit_airfare_sub_total_php[]" oninput="" id="sub_total_php" style="height: 35px;" class="sub_total_php form-control form-control-sm" value="0" readonly>'
            cols += '                    </div>' 
            cols += '                </div>' 
            cols += '        </div>'
            cols += '    </div>'
            
            // Kapag naikiclick ang remove sa USDCHOOSEPAYMENTMETHOD nag 0 lang ang total


            $("#divNextPassengerTab").append(cols)

            if(document.getElementById('usdChosePaymentMethod').checked) {

                $('.passengername_airfare').prop('readonly', false);

                $('.airfare_usd').prop('readonly', false);
                $('.airfare_php').prop('readonly', true);
                $('.airfare_php').val(0);

                $('.taxes_usd').prop('readonly', false);
                $('.taxes_php').prop('readonly', true);
                $('.taxes_php').val(0);

                $('.iata_usd').prop('readonly', false);
                $('.iata_php').prop('readonly', true);
                $('.iata_php').val(0);

                }

            else if(document.getElementById('phpChosePaymentMethod').checked) {

                $('.passengername_airfare').prop('readonly', false);

                $('.airfare_usd').prop('readonly', true);
                $('.airfare_usd').val(0);
                $('.airfare_php').prop('readonly', false);

                $('.taxes_usd').prop('readonly', true);
                $('.taxes_usd').val(0);
                $('.taxes_php').prop('readonly', false);

                $('.iata_usd').prop('readonly', true);
                $('.iata_usd').val(0);
                $('.iata_php').prop('readonly', false);

            }

            else{
                $('.passengername_airfare').prop('readonly', true);

                $('.airfare_usd').prop('readonly', true);
                $('.airfare_usd').val(0);
                $('.airfare_php').prop('readonly', true);

                $('.taxes_usd').prop('readonly', true);
                $('.taxes_usd').val(0);
                $('.taxes_php').prop('readonly', true);

                $('.iata_usd').prop('readonly', true);
                $('.iata_usd').val(0);
                $('.iata_php').prop('readonly', true);
            }

            defaultZero()
            
            // selectedUsdPhpAirfare()
            // subtotalusd()
            // subtotalphp()
    })

    function defaultZero(){

    let airfare_usdInput = document.querySelectorAll('.airfare_usd');
    // console.log(tourcost1_usdInput)
    airfare_usdInput.forEach(function(airfare_usdInput_item, index) {


        airfare_usdInput_item.addEventListener("change", (event) => {
        if(airfare_usdInput_item.value == ""){
            // alert("Walang value si " + tourcost1_usdInput_item.value);
            airfare_usdInput_item.value = 0;
            subtotalusd();
        }
        else{
            // alert("Merong value");
        }
        });
    });


    let taxes_usdInput = document.querySelectorAll('.taxes_usd');
    // console.log(tourcost1_usdInput)
    taxes_usdInput.forEach(function(taxes_usdInput_item, index) {


        taxes_usdInput_item.addEventListener("change", (event) => {
        if(taxes_usdInput_item.value == ""){
            // alert("Walang value si " + tourcost1_usdInput_item.value);
            taxes_usdInput_item.value = 0;
            subtotalusd();
        }
        else{
            // alert("Merong value");
        }
        });
    });

    let iata_usdInput = document.querySelectorAll('.iata_usd');
    // console.log(tourcost1_usdInput)
    iata_usdInput.forEach(function(iata_usdInput_item, index) {


        iata_usdInput_item.addEventListener("change", (event) => {
        if(iata_usdInput_item.value == ""){
            // alert("Walang value si " + tourcost1_usdInput_item.value);
            iata_usdInput_item.value = 0;
            subtotalusd();
        }
        else{
            // alert("Merong value");
        }
        });
    });




    let airfare_phpInput = document.querySelectorAll('.airfare_php');
    // console.log(tourcost1_usdInput)
    airfare_phpInput.forEach(function(airfare_phpInput_item, index) {


        airfare_phpInput_item.addEventListener("change", (event) => {
        if(airfare_phpInput_item.value == ""){
            // alert("Walang value si " + tourcost1_usdInput_item.value);
            airfare_phpInput_item.value = 0;
            subtotalphp();
        }
        else{
            // alert("Merong value");
        }
        });
    });

    let taxes_phpInput = document.querySelectorAll('.taxes_php');
    // console.log(tourcost1_usdInput)
    taxes_phpInput.forEach(function(taxes_phpInput_item, index) {


        taxes_phpInput_item.addEventListener("change", (event) => {
        if(taxes_phpInput_item.value == ""){
            // alert("Walang value si " + tourcost1_usdInput_item.value);
            taxes_phpInput_item.value = 0;
            subtotalphp();
        }
        else{
            // alert("Merong value");
        }
        });
    });


    let iata_phpInput = document.querySelectorAll('.iata_php');
    // console.log(tourcost1_usdInput)
    iata_phpInput.forEach(function(iata_phpInput_item, index) {


        iata_phpInput_item.addEventListener("change", (event) => {
        if(iata_phpInput_item.value == ""){
            // alert("Walang value si " + tourcost1_usdInput_item.value);
            iata_phpInput_item.value = 0;
            subtotalphp();
        }
        else{
            // alert("Merong value");
        }
        });
    });




    let sub_total_phpInput = document.querySelectorAll('.sub_total_php');
    // console.log(tourcost1_usdInput)
    sub_total_phpInput.forEach(function(sub_total_phpInput_item, index) {


        sub_total_phpInput_item.addEventListener("change", (event) => {
        if(sub_total_phpInput_item.value == "" || sub_total_phpInput_item.value == "isNaN" || isNaN(sub_total_phpInput_item.value)){
            // alert("Walang value si " + tourcost1_usdInput_item.value);
            alert("qwe")
            sub_total_phpInput_item.value = 0;
            subtotalphp();
        }
        else{
            // alert("Merong value");
        }
        });
    });



    }

    let acr = document.getElementById('acr');

    acr.addEventListener("change", (event) => {
    if(acr.value == ""){
        // alert("Walang value si " + tourcost1_usdInput_item.value);
        acr.value = 0;
        // hotellandusd();
    }
    else{
        // alert("Merong value");
    }

    subtotalusd();
    });



    // Dito na tayo kapag walang laman ang acr ang mag didisplay ng zero

    $(document).on('click', '#removePassengerBtn', function(e){
        e.preventDefault();

        let conAmount = document.getElementById('container-amount');
        conAmount.children[1];
        console.log(conAmount.children[1]);
        let amountVal = conAmount.children[1].value;
        console.log(amountVal);

        

        let row_item = $(this).parent().parent().parent().parent();
        let input_item = $(this).parent();
        
        $(row_item).remove();

        let acr = document.getElementById('acr').value;

        if(acr >= 1){
            subtotalusd();
        }

        else if(acr <= 0){
            subtotalphp();
        }

        // subtotalusd();
        
        
        
        // subtotalselectUsd()
        // subtotalselectPhp()
        // totalAmount();

    })



    function subtotalphp(){

    var airfare_phpElement = document.querySelectorAll('.airfare_php');
    var taxes_phpElement = document.querySelectorAll('.taxes_php');
    var iata_phpElement = document.querySelectorAll('.iata_php');

    var sub_total_phpElement = document.querySelectorAll('.sub_total_php');

    var valuesTourCostPhp = [];
    var valuesTaxesPhp = [];
    var valuesIataPhp = [];

    for (var i = 0; i < airfare_phpElement.length; i++) {
        valuesTourCostPhp.push(parseFloat(airfare_phpElement[i].value));
    }

    for (var i = 0; i < taxes_phpElement.length; i++) {
        valuesTaxesPhp.push(parseFloat(taxes_phpElement[i].value));
    }

    for (var i = 0; i < iata_phpElement.length; i++) {
        valuesIataPhp.push(parseFloat(iata_phpElement[i].value));
    }

    console.log(valuesTourCostPhp)
    console.log(valuesTaxesPhp)
    console.log(valuesIataPhp)

    let resultAllArrayPhp = [];

    let length = valuesTourCostPhp.length

    // Dito naman is ipag aadd nya yung bawat cost ng isang passenger
    for (let i = 0; i < length; i++) {
        let sum = parseFloat(valuesTourCostPhp[i]) + parseFloat(valuesTaxesPhp[i]) + parseFloat(valuesIataPhp[i]);
        resultAllArrayPhp.push(sum);
    }

    let resultAddNestedSubTotalArray = []

    for (var i = 0; i < sub_total_phpElement.length; i++) {
        let sumNestedSubTotal = parseFloat(resultAllArrayPhp[i]);
        resultAddNestedSubTotalArray.push(sumNestedSubTotal)
    }

    // Dito is mag aassign or display ng value dun sa total usd ng bawat passenger
    for (var i = 0; i < sub_total_phpElement.length; i++) {
        sub_total_phpElement[i].value = resultAddNestedSubTotalArray[i].toFixed(2) || ''; 
        // if(isNaN(sub_total_phpElement[i])){
        //     sub_total_phpElement[i] = 0;
        // }

        // else{
        //     sub_total_phpElement[i].value = resultAddNestedSubTotalArray[i] || ''; 
        // }



        
    }

    console.log("Sum of all: " + resultAddNestedSubTotalArray)

    // let acr = document.getElementById('acr').value;
    var final_sub_total_php = document.querySelector('.final_sub_total_php');
    var airfare_totalAmount = document.getElementById('airfare_totalAmount');
    let sumofAllSubTotal = resultAddNestedSubTotalArray.reduce((accumulator, currentValue) => accumulator + currentValue, 0);

    displayAirfareSubTotal = parseFloat(sumofAllSubTotal);
    final_sub_total_php.value = displayAirfareSubTotal.toFixed(2);


    displayAirfareTotal = parseFloat(sumofAllSubTotal);
    airfare_totalAmount.value = displayAirfareTotal.toFixed(2);
    // console.log("Displat Toal" + displayAirfareTotal)
    // airfare_totalAmount.value = sumofAllSubTotal * acr;
    // console.log("Sum of all Sub Total: " + sumofAllSubTotal)

    convertAmountToText(airfare_totalAmount.value);


    }

    function subtotalusd(){
    var airfare_usdElement = document.querySelectorAll('.airfare_usd');
    var taxes_usdElement = document.querySelectorAll('.taxes_usd');
    var iata_usdElement = document.querySelectorAll('.iata_usd');

    // var sub_total_usd = document.querySelector('.sub_total_usd');
    // var sub_total_php = document.querySelector('.sub_total_php').value; 

    var sub_total_usdElement = document.querySelectorAll('.sub_total_usd');


    var valuesTourCostUsd = [];
    var valuesTaxesUsd = [];
    var valuesIataUsd = [];

    for (var i = 0; i < airfare_usdElement.length; i++) {
        valuesTourCostUsd.push(parseFloat(airfare_usdElement[i].value));
    }

    for (var i = 0; i < airfare_usdElement.length; i++) {
        valuesTaxesUsd.push(parseFloat(taxes_usdElement[i].value));
    }

    for (var i = 0; i < airfare_usdElement.length; i++) {
        valuesIataUsd.push(parseFloat(iata_usdElement[i].value));
    }

    console.log(valuesTourCostUsd)
    console.log(valuesTaxesUsd)
    console.log(valuesIataUsd)

    let resultAllArrayUsd = [];

    let length = valuesTourCostUsd.length

    // Dito naman is ipag aadd nya yung bawat cost ng isang passenger
    for (let i = 0; i < length; i++) {
        let sum = parseFloat(valuesTourCostUsd[i]) + parseFloat(valuesTaxesUsd[i]) + parseFloat(valuesIataUsd[i]);
        resultAllArrayUsd.push(sum);
    }

    let resultAddNestedSubTotalArray = []

    for (var i = 0; i < sub_total_usdElement.length; i++) {
        let sumNestedSubTotal = parseFloat(resultAllArrayUsd[i]);
        resultAddNestedSubTotalArray.push(sumNestedSubTotal)
    }

    // Dito is mag aassign or display ng value dun sa total usd ng bawat passenger
    for (var i = 0; i < sub_total_usdElement.length; i++) {
        sub_total_usdElement[i].value = resultAddNestedSubTotalArray[i].toFixed(2) || ''; 
    }

    console.log("Sum of all: " + resultAddNestedSubTotalArray)

    let acr = document.getElementById('acr').value;
    var final_sub_total_usd = document.querySelector('.final_sub_total_usd');
    var airfare_totalAmount = document.getElementById('airfare_totalAmount');
    let sumofAllSubTotal = resultAddNestedSubTotalArray.reduce((accumulator, currentValue) => accumulator + currentValue, 0);
    // final_sub_total_usd.value = sumofAllSubTotal;

    displayAirfareSubTotal = parseFloat(sumofAllSubTotal);
    final_sub_total_usd.value = displayAirfareSubTotal.toFixed(2);

    displayAirfareTotal = parseFloat(sumofAllSubTotal) * parseFloat(acr);
    airfare_totalAmount.value = displayAirfareTotal.toFixed(2);


    convertAmountToText(airfare_totalAmount.value);
    }

    defaultZero()

    function convertAmountToText(airfare_totalAmount) {
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
    const millions = Math.floor(airfare_totalAmount);
    const centavos = Math.round((airfare_totalAmount - millions) * 100);

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

    $(document).ready(function(){

        console.log("start");
        
            $("#editBtn").click(function(e){
                
                    console.log("napindot");
                    e.preventDefault();

                    var acr = document.getElementById("acr").value;
                    var hotel_acr = document.getElementById("hotel_acr").value;

                    var airfare = document.getElementById("airfare");
                    var hotel_landarrangement = document.getElementById("hotel_landarrangement");

                    var category = document.getElementById("category");
                    var airfare_totalAmount = document.getElementById("airfare_totalAmount").value;
                    var hotel_totalAmount = document.getElementById("hotel_totalAmount").value;

                    if (airfare.classList.contains("active")) {
                        // The element has the class "active"
                        category.value = "Airfare";

                        if(document.getElementById('usdChosePaymentMethod').checked) {

                            if(acr == 0 || acr <= 0){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Make sure the ACR fields is not less than zero. Please try again Thankyou!',
                                    showConfirmButton: false,
                                    timer: 2000  
                                })

                                return 1;
                            }

                            else{
                                if(airfare_totalAmount <= 0 ){
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'Make sure the Total Amount is not zero. Please try again Thankyou!',
                                        showConfirmButton: false,
                                        timer: 2000  
                                    })

                                    return 1;
                                }
                            }
                        }

                        else if(document.getElementById('phpChosePaymentMethod').checked){
                            if(airfare_totalAmount <= 0 ){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Make sure the Total Amount is not zero. Please try again Thankyou!',
                                    showConfirmButton: false,
                                    timer: 2000  
                                })

                                return 1;
                            }
                        }

                    } 
                    
                    else if(hotel_landarrangement.classList.contains("active")) {
                        // The element does not have the class "active"
                        category.value = "Hotel";

                        if(document.getElementById('usdChoseHotel').checked) {

                            if(hotel_acr == 0 || hotel_acr <= 0){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Make sure the ACR fields is not less than zero. Please try again Thankyou!',
                                    showConfirmButton: false,
                                    timer: 2000  
                                })

                                return 1;
                            }

                            else{
                                if(hotel_totalAmount <= 0 ){
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'Make sure the Total Amount is not zero. Please try again Thankyou!',
                                        showConfirmButton: false,
                                        timer: 2000  
                                    })

                                    return 1;
                                }
                            }
                        }

                        else if(document.getElementById('phpChoseHotel').checked){
                            if(hotel_totalAmount <= 0 ){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Make sure the Total Amount is not zero. Please try again Thankyou!',
                                    showConfirmButton: false,
                                    timer: 2000  
                                })

                                return 1;
                            }
                        }


                        
                    }

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