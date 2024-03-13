<?php 

    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    if(isset($_POST['view'])){
        $cvId = $_POST['cv_Id'];
    }

    else{
        header("Location: cv_list.php");
    }


    $userName = $_SESSION['name'];

    $event = "Viewed";
    $form = "CV";
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

.cv_paymentMethodBtn{
    -ms-transform: scale(2.5); /* IE 9 */
    -webkit-transform: scale(2.5); /* Chrome, Safari, Opera */
    transform: scale(2.5);
}
</style>



<body style="overflow-x: hidden;">

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
                <div class="bg-success" style="width: 90%; padding: 8px 20px; margin: 0 auto;" >
                    <h5 class="mb-0 text-light">View Check Voucher Form</h5>
                </div>
                <form action="" id="cv_Form" style="width: 90%; margin: 0 auto; border: 1px solid lightgray;" class="p-4" >
                    <input type="text" name="by" id="" value="<?php echo $userName;?>" class="d-none form-control form-control-sm" readonly>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Payee:</label>
                            <input type="text" name="payee" id="payee" value="<?php echo $rows['payee']?>" class="form-control form-control-sm " readonly>
                        </div>

                        <div class="col-md-6 ">
                            <label for="" class="font-weight-bold"><span class="text-danger ">*</span>Date:</label>
                            <input type="date" name="date" id="" class="form-control form-control-sm " value="<?php echo $rows['date']?>" readonly>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Agent:</label>
                            <input type="text" name="edit_agent" id="agent" class="form-control form-control-sm " value="<?php echo $rows['agent']?>" readonly>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Particular:</label>
                            <textarea name="particular" id="" value="<?php echo $rows['particular']?>" cols="3" rows="3" class="form-control" readonly><?php echo $rows['particular']?></textarea >
                            <!-- <input type="text" name="payee" id="payee" class="form-control form-control-sm " required> -->
                        </div>
                    </div>


                    <?php 
                    
                    $cv_passengerNameArr = explode(",", $rows['cv_passengerName']);
                    
                    
                    ?>

                    <?php foreach($cv_passengerNameArr as $cv_passengerNameArrValue){?>

                    <div class="row mt-3 mx-3">
                        <div class="col-md-3 d-flex justify-content-center align-items-center bg-success">
                            <label for="" class="font-weight-bold mb-0 text-light"><span class="text-danger ">* </span>Passenger Name:</label>
                            
                        </div>

                        <div class="col-md-9 d-flex justify-content-center align-items-center ml-0 pl-0">
                            <input type="text" name="cv_passengerName[]" id="cv_passengerName" class="ml-3 cv_passengerName form-control ml-0" value="<?php echo $cv_passengerNameArrValue;?>" readonly>
                        </div>
                    </div>

                    <!-- Dun na tayo sa pag eedit ng cv -->

                    <?php } ?>

                    <div id="divNextCheckVoucher">

                    </div>

                    <div class="row mt-5">

                        <div class="col-md-6 " style="border: 1px solid lightgray">
                            <div class="row p-3" >
                                <div class="col-md-6 d-flex justify-content-center align-items-center bg-success p-2" style="width: 100%;">
                                    <h6 class="font-weight-bold mb-0 pb-0 text-light"><span class="text-danger font-weight-bold">* </span>PAYMENT METHOD: </h6>
                                </div>

                                <div class="col-md-6">
                                    <div class="row" style="height: 100%;">
                                        <div class="col-md-6 d-flex justify-content-center align-items-center">

                                            <div class="d-flex justify-content-center align-items-center">
                                                <label for="" class="font-weight-bold mb-0 mr-3"><span class="text-danger mr-1">*</span>USD:</label>
                                                <input type="radio" name="cv_paymentMethod" style="height: 50px;" onclick="selectedPaymentMethod()" value="USD" id="usdchose" disabled="true" class="cv_paymentMethodBtn" 
                                                
                                                <?php 
                                                    $cv_paymentMethod = $rows['payment_method'];
                                                    if($cv_paymentMethod == "USD"){
                                                        echo "checked";
                                                    }
                                                    
                                                    ?>
                                                
                                                >
                                            </div>
                                            
                                        </div>

                                        <div class="col-md-6 d-flex justify-content-center align-items-center">

                                            <div class="d-flex justify-content-center align-items-center">
                                                <label for="" class="font-weight-bold mb-0 mr-3"><span class="text-danger mr-1">*</span>PHP:</label>
                                                <input type="radio" name="cv_paymentMethod" onclick="selectedPaymentMethod()" value="PHP" id="phpchose" disabled="true"  class="cv_paymentMethodBtn" 
                                                
                                                <?php 
                                                    $cv_paymentMethod = $rows['payment_method'];
                                                    if($cv_paymentMethod == "PHP"){
                                                        echo "checked";
                                                    }
                                                
                                                ?>
                                                
                                                >
                                            </div>
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>
                            <input type="number" name="acr" id="acr" value="<?php echo $rows['acr']?>" class="acr form-control form-control-sm " readonly>
                        </div>

                    </div>

                    

                    <div class="p-4 mt-3 bg-dark" >

                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">Total Amount:</span></label>
                                <input type="number" name="total_amount" value="<?php echo $rows['total_amount']?>" id="total_amount" value="0" class="form-control form-control-sm " readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">The Sum of Peso/Dollar:</span></label>
                                <input type="text" name="sum_of_pesos" value="<?php echo $rows['sum_of_peso']?>" id="amount_in_words" style="text-transform: uppercase;" value="N/A" class="form-control form-control-sm" readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">Check No/Bank:</span></label>
                                <input type="text" name="check_no" value="<?php echo $rows['check_no']?>" id="" class="form-control form-control-sm " readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">Received By:</span></label>
                                <input type="text" name="received_by" value="<?php echo $rows['received_by']?>" id="" class="form-control form-control-sm " readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">Date Received:</span></label>
                                <input type="date" name="date_received" value="<?php echo $rows['date_received']?>" id="" class="form-control form-control-sm " readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">Prepared By:</span></label>
                                <input type="text" name="prepared_by" value="<?php echo $rows['prepared_by']?>" id="" class="form-control form-control-sm " readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">Checked By:</span></label>
                                <input type="text" name="checked_by" value="<?php echo $rows['checked_by']?>" id="" class="form-control form-control-sm " readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">Approved By:</span></label>
                                <input type="text" name="approved_by" value="<?php echo $rows['approved_by']?>" id="" class="form-control form-control-sm " readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

            <?php } ?>
        <?php } ?>
        

        </div>
    </div>

<!-- Sweetalert Cdn Start -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Sweetalert Cdn End -->

<!-- JS SCRIPT -->
<script src="ar.js"></script>


    

<script>

</script>



<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>