<?php 

    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    // if(isset($_POST['editPrint'])){
    //     $cvId = $_POST['cv_Id'];
    // }

    if(isset($_POST['editBtnReq']) && $_SESSION['usertype'] == 'user' && isset($_POST['token'])){
        $reqId = $_POST['req_Id'];
        $cvId = $_POST['form_Id'];
        $token = $_POST['token'];
        $status = $_POST['status'];
        // $token_expire = $_POST['token_expire'];
        

        $sqlu = "UPDATE request_list SET token='' WHERE req_Id='$reqId'";
        $resultu = $conn->query($sqlu);

    }

    elseif(isset($_POST['editAdminBtn']) && $_SESSION['usertype'] == 'superadmin'){
        $cvId = $_POST['cv_Id'];
      
    }

    elseif(isset($_POST['editAdminBtn']) && $_SESSION['usertype'] == 'admin'){
        $cvId = $_POST['cv_Id'];
    }

    else{
        header("Location: cv_list.php");
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
                    <h5 class="mb-0 text-light">Edit Check Voucher Form</h5>
                </div>
                <form action="" id="edit_cv_Form" style="width: 90%; margin: 0 auto; border: 1px solid lightgray;" class="p-4" >
                    <input type="text" name="by" id="" value="<?php echo $userName;?>" class="d-none form-control form-control-sm" >
                    <input type="text" name="edit_cvId" id="" value="<?php echo $rows['cv_Id'];?>" class="d-none form-control form-control-sm" >
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Payee:</label>
                            <input type="text" name="edit_payee" id="payee" value="<?php echo $rows['payee']?>" class="form-control form-control-sm " >
                        </div>

                        <div class="col-md-6 ">
                            <label for="" class="font-weight-bold"><span class="text-danger ">*</span>Date:</label>
                            <input type="date" name="edit_date" id="" class="form-control form-control-sm " value="<?php echo $rows['date']?>" >
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Agent:</label>
                            <input type="text" name="edit_agent" id="agent" class="form-control form-control-sm " value="<?php echo $rows['agent']?>">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Particular:</label>
                            <textarea name="edit_particular" id="" value="<?php echo $rows['particular']?>" cols="3" rows="3" class="form-control" ><?php echo $rows['particular']?></textarea >
                            <!-- <input type="text" name="payee" id="payee" class="form-control form-control-sm " required> -->
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-9">

                        </div>

                        <div class="col-md-3">
                            <input type="button" onclick="" class="addCheckVoucherBtn btn btn-dark  mb-0 mt-2 p-1" style="border: 0; cursor: pointer; width: 100%;" value="ADD PASSENGER" id="addCheckVoucherBtn">
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
                            <input type="text" name="edit_cv_passengerName[]" id="cv_passengerName" class="ml-3 cv_passengerName form-control ml-0" value="<?php echo $cv_passengerNameArrValue;?>" >
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
                                                <input type="radio" name="edit_cv_paymentMethod" style="height: 50px;" onclick="selectedPaymentMethod()" value="USD" id="usdchose" class="cv_paymentMethodBtn" 
                                                
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
                                                <input type="radio" name="edit_cv_paymentMethod" onclick="selectedPaymentMethod()" value="PHP" id="phpchose" class="cv_paymentMethodBtn" 
                                                
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
                            <input type="number" name="edit_acr" id="acr" value="<?php echo $rows['acr']?>" class="acr form-control form-control-sm " >
                        </div>

                    </div>

                    

                    <div class="p-4 mt-3 bg-dark" >

                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">Total Amount:</span></label>
                                <input type="number" name="edit_total_amount" value="<?php echo $rows['total_amount']?>" id="total_amount" value="0" class="form-control form-control-sm " >
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">The Sum of Peso/Dollar:</span></label>
                                <input type="text" name="edit_sum_of_pesos" value="<?php echo $rows['sum_of_peso']?>" id="amount_in_words" style="text-transform: uppercase;" value="N/A" class="form-control form-control-sm" >
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">Check No/Bank:</span></label>
                                <input type="text" name="edit_check_no" value="<?php echo $rows['check_no']?>" id="" class="form-control form-control-sm " >
                            </div>

                            <div class="col-md-4">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">Received By:</span></label>
                                <input type="text" name="edit_received_by" value="<?php echo $rows['received_by']?>" id="" class="form-control form-control-sm " >
                            </div>

                            <div class="col-md-4">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">Date Received:</span></label>
                                <input type="date" name="edit_date_received" value="<?php echo $rows['date_received']?>" id="" class="form-control form-control-sm " >
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">Prepared By:</span></label>
                                <input type="text" name="edit_prepared_by" value="<?php echo $rows['prepared_by']?>" id="" class="form-control form-control-sm " >
                            </div>

                            <div class="col-md-4">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">Checked By:</span></label>
                                <input type="text" name="edit_checked_by" value="<?php echo $rows['checked_by']?>" id="" class="form-control form-control-sm " >
                            </div>

                            <div class="col-md-4">
                                <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span><span class="text-light">Approved By:</span></label>
                                <input type="text" name="edit_approved_by" value="<?php echo $rows['approved_by']?>" id="" class="form-control form-control-sm " >
                            </div>
                        </div>
                    </div>

                    <input type="submit" id="editBtn" class="btn btn-success btn-block mt-3" value="Save">
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

let acr_Input = document.getElementById('acr');
        let totalamount_Input = document.getElementById('total_amount');
        let totalamount_InputChange = document.getElementById('total_amount');
        // console.log(tourcost1_usdInput)
        
        
        
        acr_Input.addEventListener("change", (event) => {
            if(acr_Input.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                acr_Input.value = 0;
            }
            else{
                // alert("Merong value");
            }
        });

        totalamount_Input.addEventListener("change", (event) => {
            if(totalamount_Input.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                totalamount_Input.value = 0;
            }
            else{
                // alert("Merong value");
            }

            let totalamount_InputValue = totalamount_Input.value;

            // convertAmountToText(totalamount_InputValue)
        });



        totalamount_InputChange.addEventListener("input", (event) => {
            if(totalamount_Input.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                totalamount_Input.value = 0;
            }
            else{
                // alert("Merong value");
            }

            let totalamount_InputValue = totalamount_Input.value;

            convertAmountToText(totalamount_InputValue)
        });


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

            let cv_amountInWords = document.getElementById("amount_in_words");

            // Get all radio buttons with the specified name
            var cv_paymentMethod = document.getElementsByName('edit_cv_paymentMethod');

            // Loop through the radio buttons to find the selected one
            for (var i = 0; i < cv_paymentMethod.length; i++) {

            if (cv_paymentMethod[i].checked) {
                // If a radio button is checked, print its value
                // console.log("Selected radio value: " + cv_paymentMethod[i].value);

                if(cv_paymentMethod[i].value == "USD"){
                    cv_amountInWords.value = result + " DOLLARS ONLY ";
                }

                else if(cv_paymentMethod[i].value == "PHP"){
                    cv_amountInWords.value = result + " PESOS ONLY ";
                }
                break; // Exit the loop once a selected radio button is found
            }
            }

            // cv_amountInWords.value = result + " PESOS ONLY ";

            return result;
        }  
        
        
        function selectedPaymentMethod(){

            let phpchose = document.getElementById("phpchose");
            let acr = document.getElementById("acr");

            if(phpchose.checked){

                acr.value = 0;
            }

            let totalamount_InputValue = totalamount_Input.value;

            convertAmountToText(totalamount_InputValue)
        }

        

   

    $("#addCheckVoucherBtn").click(function(e){
        e.preventDefault();

        console.log("Napindot si CheckVoucherBtn")

        $("#divNextCheckVoucher").append(

            
            
            `
            <div class="row mt-3 mx-3">
                        <div class="col-md-3 d-flex justify-content-center align-items-center bg-success">
                            <label for="" class="font-weight-bold mb-0 text-light"><span class="text-danger ">* </span>Passenger Name:</label>
                            
                        </div>

                        <div class="col-md-7 d-flex justify-content-center align-items-center ml-0 pl-0">
                            <input type="text" name="edit_cv_passengerName[]" id="cv_passengerName" class="ml-3 cv_passengerName form-control ml-0" value="N/A" required>
                        </div>

                        <div class="col-md-2 d-flex justify-content-center align-items-center ml-0 pl-0 ">
                            <input type="button" name="" id="removeCheckVoucherBtn" class="removeCheckVoucherBtn btn btn-danger btn-block ml-0" value="Remove" required>
                        </div>
            </div>`);
 
    })

    $(document).on('click', '#removeCheckVoucherBtn', function(e){
            e.preventDefault();

            let row_item = $(this).parent().parent();
            let input_item = $(this).parent();
            
            $(row_item).remove();

    })


    $(document).ready(function(){

        console.log("start");

        var isAjaxInProgress = false;

        

        // console.log("Hello World")
            $("#editBtn").click(function(e){
                
                    console.log("napindot");
                    e.preventDefault();

                    var sa_acr = $("#sa_acr").val();
                    var cv_paymentMethod = document.getElementsByName('edit_cv_paymentMethod');
                    
                    var cv_paymentMethod_selectedValue = null;

                    // Loop through each radio button to find the selected one
                    for (var i = 0; i < cv_paymentMethod.length; i++) {
                        if (cv_paymentMethod[i].checked) {
                            cv_paymentMethod_selectedValue = cv_paymentMethod[i].value;
                        break; // Exit the loop if a radio button is checked
                        }
                    }

                    // Check if a radio button is selected
                    if (cv_paymentMethod_selectedValue !== null) {
                        // Alert the selected value
                        // alert('Selected value: ' + sa_paymentMethod_selectedValue);

                        let acr = document.getElementById("acr").value;
                        
                        if(cv_paymentMethod_selectedValue == "USD"){
                            // alert("Correct USD")
                            // alert(acr)
                            if(acr == 0){
                                // alert("Walang value")
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Make sure the ACR is not empty when the Payment Method is USD, Please try again Thankyou!',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                                return;
                            }

                            else if(acr <= 0){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Make sure the ACR is not negative, Please try again Thankyou!',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                                return;
                            }

                            else if(acr != 0)[
                                // console.log("Merong value ang Acr")
                                // alert("Merong valuye")
                            ]
                        }

                        else{
                            // alert("No USD")
                        }
                    } else {
                        // Alert if no radio button is selected
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Make sure the Payment Method is not empty, Please try again Thankyou!',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        return;
                    }

                    isAjaxInProgress = true;

                    $.ajax({
                        url: "edit_process.php",
                        method: "POST",
                        data: $("#edit_cv_Form").serialize() + "&action=editCV",
                        success : function (response){
                            if(response == "Success"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Successfully Edited CV!',
                                    showConfirmButton: false,
                                    timer: 1300  
                                }).then(function(){
                                    window.location = "cv_list.php";
                                })
                            }

                            // else if(response == "calculatedError"){
                            //     Swal.fire({
                            //         position: 'center',
                            //         icon: 'error',
                            //         title: "There is an error, the sum of Php Value and Cash Amount is not match in TOTAL AMOUNT field",
                            //         showConfirmButton: false,
                            //         timer: 4000  
                            //     })
                            // }

                            // else if(response == "NaN"){
                            //     Swal.fire({
                            //         position: 'center',
                            //         icon: 'error',
                            //         title: "There is an error, make sure the TOTAL AMOUNT value is not 'NaN'",
                            //         showConfirmButton: false,
                            //         timer: 3000  
                            //     })
                            // }

                            // else if(response == "EmptyCash"){
                            //     Swal.fire({
                            //         position: 'center',
                            //         icon: 'error',
                            //         title: 'There is an error, make sure the CASH AMOUNT Field has a value atleast 0',
                            //         showConfirmButton: false,
                            //         timer: 3000  
                            //     })
                            // }

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