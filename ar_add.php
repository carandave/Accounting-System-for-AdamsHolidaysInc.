<?php 

    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    $userName = $_SESSION['name'];

    if($_SESSION['usertype'] == "user"){
        header("Location: ar_list.php");
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
                
                <?php require_once("navphp/arNav.php");?>
                
                
            </div>

            <div class="col-md-10">
                
                <div class="bg-success" style="width: 60%; padding: 8px 20px; margin: 0 auto;" >
                    <h5 class="mb-0 text-light">Acknowledgement Receipt Form</h5>
                </div>
                <form action="" id="ar_Form" style="width: 60%; margin: 0 auto; border: 1px solid lightgray;" class="p-4" >
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Received From:</label>
                            <input type="text" name="receive_from" id="" class="form-control form-control-sm " required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Business Name/Style:</label>
                            <input type="text" name="business_name" id="" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Address:</label>
                            <input type="text" name="address" id="" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>TIN:</label>
                            <input type="text" name="tin" id="" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>in full/partial payment of:</label>
                            <input type="text" name="full_payment" id="" class="form-control form-control-sm" required>
                        </div>
                    </div>

                    <?php
                        $timestamp = time();
                        $date = date( "Y-m-d", $timestamp );
                    ?>
                    <div class="row mt-3">
                        <div class="col-md-6" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Date:</label>
                            <input type="date" name="date" id="" value="<?php echo $date;?>" class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-6" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Transaction:</label>
                            <select name="transaction" id="" class="form-control form-control-sm" required>
                                <option value=""></option>
                                <option value="Int'l Travel">Int'l Travel</option>
                                <option value="Local Tours">Local Tours</option>
                                <option value="Domestic Tours">Domestic Tours</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>
                            <input type="number" name="acr" id="acr" oninput="jsfunction();" class="arc_Input form-control form-control-sm" value="0.00" required>
                            <input type="number" name="acrD" id="acrD" oninput="jsfunction();" class="d-none form-control form-control-sm"  >
                        </div>

                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>USD Amount:</label>
                            <input type="number" name="usd" id="usd" oninput="jsfunction();" class="usd_Input form-control form-control-sm" value="0.00" required>
                            <input type="number" name="usdD" id="usdD" oninput="jsfunction();" class="d-none form-control form-control-sm" >
                        </div>

                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>PHP Value:</label>
                            <input type="number" name="php" id="php" class="php_Input form-control form-control-sm" value="0.00" readonly>
                        </div> 

                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>CASH Amount:</label>
                            <input type="number" name="cash" id="cash" oninput="totalCash();" class="cashAmount cashAmount_Input form-control form-control-sm"  value="0.00" required>
                            <input type="number" name="cashD" id="cashD" oninput="totalCash();" class="d-none cashAmountD form-control form-control-sm"  value="0.00">
                        </div>
                    </div>
                    
                    <div class="row mt-3" id="">
                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Check Bank:</label>
                            <input type="text" name="checkBank[]" id="" value="N/A" class="checkBank form-control form-control-sm" >
                        </div>
                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Check No:</label>
                            <input type="text" name="checkNo[]" id="" value="N/A" class="checkNo form-control form-control-sm" >
                        </div>

                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Check Amount:</label>
                            <input type="number" name="checkAmount[]" id="checkAmount" oninput="totalAmount();" class="checkAmount checkAmount_Input form-control form-control-sm" value="0.00">
                        </div>

                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"></label>
                            <div class="mt-2 d-flex justify-content-center align-items-center">
                                <input type="button" class="checkButton btn btn-dark btn-sm mb-0" style="border: 0; cursor: pointer; width: 100%;" value="ADD CHECK" id="addCheckBtn">
                            </div>
                            
                        </div>
                    </div>

                    <div id="divNext">

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>TOTAL AMOUNT:</label>
                            <input type="text" name="total" id="totalAmounts" class="form-control form-control-sm" readonly value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>The sum of Pesos:</label>
                            <input type="text" name="sum_of_pesos" id="sum_of_pesos" style="text-transform: uppercase;" value="N/A" class="form-control form-control-sm" readonly>
                        </div>
                    </div>

                    <div class="row mt-3" id="">
                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Pax Name:</label>
                            <input type="text" name="paxName[]" id="" value="N/A" class="paxName form-control form-control-sm" >
                        </div>
                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Service:</label>
                            <input type="text" name="paxService[]" id="" value="N/A" class="paxService form-control form-control-sm" >
                        </div>

                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Amount:</label>
                            <input type="number" name="paxAmount[]" id="" value="0.00" class="paxAmount form-control form-control-sm" >
                        </div>

                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"></label>
                            <div class="mt-2">
                                <input type="button" class="paxButton btn btn-dark btn-sm mb-0" style="border: 0; cursor: pointer; width: 100%;" value="ADD PAX" id="addPaxBtn">
                            </div>
                            
                        </div>
                    </div>

                    <div id="divNextSumofPesos">

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Reference No:</label>
                            <input type="text" name="pr_no" id="" class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-6" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>By:</label>
                            <input type="text" name="by" id="" value="<?php echo $userName;?>" class="form-control form-control-sm" readonly>
                            <div class="d-flex justify-content-center align-items-center mt-1">
                                <label for="" class="text-center" style="text-align: center">Authorized Signature</label>
                            </div>
                            
                        </div>
                    </div>


                    <input type="submit" id="addBtn" class="addArBtn btn btn-success btn-block mt-3" value="Submit">
                    
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

        let arc_Input = document.querySelector('.arc_Input');
            arc_Input.addEventListener("change", (event) => {
            if(arc_Input.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                arc_Input.value = 0.00;
                
                totalCash();
                
            }
            else{
                // alert("Merong value");
            }
        });

        let usd_Input = document.querySelector('.usd_Input');
            usd_Input.addEventListener("change", (event) => {
            if(usd_Input.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                usd_Input.value = 0.00;
                
                totalCash();
                
            }
            else{
                // alert("Merong value");
            }
        });

        let cashAmount_Input = document.querySelector('.cashAmount_Input');
            cashAmount_Input.addEventListener("change", (event) => {
            if(cashAmount_Input.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                cashAmount_Input.value = 0.00;
                
                totalCash();
                
            }
            else{
                // alert("Merong value");
            }
        });


                    // arc_Input
                    // usd_Input
                    // php_Input
                    // cashAmount_Input


    //Add Check Button

    $("#addCheckBtn").click(function(e){
        e.preventDefault();

        $("#divNext").append(
            `<div class="row mt-3">
                <div class="col-md-3" >
                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Check Bank:</label>
                    <input type="text" name="checkBank[]" id=""  class="checkBank form-control form-control-sm" value="N/A" >
                </div>
                <div class="col-md-3" >
                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Check No:</label>
                    <input type="text" name="checkNo[]" id=""  class="checkNo form-control form-control-sm" value="N/A" >
                </div>

                <div class="col-md-3" id="container-amount">
                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Check Amount:</label>
                    <input type="number" name="checkAmount[]" id="" oninput="totalAmount();" class="checkAmount checkAmount_Input form-control form-control-sm " value="0.00"  >
                </div>

                <div class="col-md-3" >
                    <label for="" class="font-weight-bold"></label>
                    <div class="mt-2 d-flex justify-content-center align-items-center">
                        <input type="button" class=" btn btn-danger btn-sm mb-0" style="border: 0; cursor: pointer; width: 100%;" onclick="totalAmount();" value="REMOVE" id="removeCheckBtn">
                    </div>
                </div>
            </div>`);


            let checkAmount_Input = document.querySelectorAll('.checkAmount_Input');
                // console.log(tourcost1_usdInput)
                checkAmount_Input.forEach(function(checkAmount_Input_Item, index) {
        
        
            checkAmount_Input_Item.addEventListener("change", (event) => {
            if(checkAmount_Input_Item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                checkAmount_Input_Item.value = 0;
                totalAmount();
                
            }
            else{
                // alert("Merong value");
            }
            });
        });

        

        
    })

    let checkAmount_Input = document.querySelectorAll('.checkAmount_Input');
        // console.log(tourcost1_usdInput)
        checkAmount_Input.forEach(function(checkAmount_Input_Item, index) {
        
        
            checkAmount_Input_Item.addEventListener("change", (event) => {
            if(checkAmount_Input_Item.value == ""){
                // alert("Walang value si " + tourcost1_usdInput_item.value);
                checkAmount_Input_Item.value = 0;
                totalAmount();
                
            }
            else{
                // alert("Merong value");
            }
            });
        });


    //Add Pax Button

    $("#addPaxBtn").click(function(e){
        e.preventDefault();

        console.log("PAX")

        $("#divNextSumofPesos").append(
            `<div class="row mt-3" id="">
                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Pax Name:</label>
                            <input type="text" name="paxName[]" id=""  class="paxName form-control form-control-sm" value="N/A">
                        </div>
                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Service:</label>
                            <input type="text" name="paxService[]" id=""  class="paxService form-control form-control-sm" value="N/A" >
                        </div>

                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Amount:</label>
                            <input type="number" name="paxAmount[]" id=""  class="paxAmount form-control form-control-sm" value="0.00" >
                        </div>

                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"></label>
                            <div class="mt-2">
                                <input type="button" class="btn btn-danger btn-sm mb-0" style="border: 0; cursor: pointer; width: 100%;" value="REMOVE" id="removePaxBtn">
                            </div>
                            
                        </div>
                    </div>`);

    })

    
    
    // JSON.stringify(filters);
    //Remove Check Button
    $(document).on('click', '#removeCheckBtn', function(e){
            e.preventDefault();

            

            // let checkAmount = document.getElementById('checkAmount').value = "";

            let conAmount = document.getElementById('container-amount');
            conAmount.children[1];
            console.log(conAmount.children[1]);
            let amountVal = conAmount.children[1].value;
            console.log(amountVal);



            let row_item = $(this).parent().parent().parent();
            let input_item = $(this).parent();
            console.log("Hsa been")
            console.log(input_item);
            $(row_item).remove();

            totalAmount();

    })

    //Remove Pax Button

    $(document).on('click', '#removePaxBtn', function(e){
            e.preventDefault();

            let row_item = $(this).parent().parent().parent();
            let input_item = $(this).parent();
            console.log("Hsa been")
            console.log(input_item);
            $(row_item).remove();

            // totalAmount();

    })


    $(document).ready(function(){

        console.log("start");

        var isAjaxInProgress = false;

        // console.log("Hello World")
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
                        data: $("#ar_Form").serialize() + "&action=AddAR",
                        success : function (response){
                            if(response == "Success"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Successfully Added AR!',
                                    showConfirmButton: false,
                                    timer: 1300  
                                }).then(function(){
                                    window.location = "ar_list.php";
                                })

                                
                            }

                            else if(response == "calculatedError"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: "There is an error, the sum of Php Value and Cash Amount is not match in TOTAL AMOUNT field",
                                    showConfirmButton: false,
                                    timer: 4000  
                                })
                            }

                            else if(response == "NaN"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: "There is an error, make sure the TOTAL AMOUNT value is not 'NaN'",
                                    showConfirmButton: false,
                                    timer: 3000  
                                })
                            }

                            else if(response == "EmptyCash"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'There is an error, make sure the CASH AMOUNT Field has a value atleast 0',
                                    showConfirmButton: false,
                                    timer: 3000  
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

    
    var cashAmount = document.querySelector('.cashAmount').value;
    console.log(cashAmount);

    if(cashAmount == null || cashAmount == ""){
        var checkBankS = document.querySelectorAll('.checkBank')[0].setAttribute('readonly', true);
        var checkNoS = document.querySelectorAll('.checkNo')[0].setAttribute('readonly', true);
        var checkAmountS = document.querySelectorAll('.checkAmount')[0].setAttribute('readonly', true);
        var checkButtonS = document.querySelector('.checkButton').setAttribute('disabled', true);
    }

    else if(cashAmount != null || cashAmount != ""){
        var checkBankS = document.querySelectorAll('.checkBank')[0].removeAttribute('readonly');
        var checkNoS = document.querySelectorAll('.checkNo')[0].removeAttribute('readonly');
        var checkAmountS = document.querySelectorAll('.checkAmount')[0].removeAttribute('readonly');
        var checkButtonS = document.querySelector('.checkButton').removeAttribute('disabled');
    }


    

    

    // $("#acr").blur(function(){
    // alert("This input field has lost its focus.");
    // });

    function totalCash(){

        jsfunction();
        var phpAmount = document.getElementById('php').value;
        var cashAmount = document.querySelector('.cashAmount').value;
        // var checkAmount = document.querySelectorAll('.checkAmount').value;
        

        

        if(cashAmount != null || cashAmount != ""){
            // alert("Yes value");
            var checkBankS = document.querySelectorAll('.checkBank')[0].removeAttribute('readonly');
            var checkNoS = document.querySelectorAll('.checkNo')[0].removeAttribute('readonly');
            var checkAmountS = document.querySelectorAll('.checkAmount')[0].removeAttribute('readonly');
            var checkButtonS = document.querySelector('.checkButton').removeAttribute('disabled');
        }

        else if(cashAmount == null || cashAmount == ""){
            var checkBankS = document.querySelectorAll('.checkBank')[0].setAttribute('readonly', true);
            var checkNoS = document.querySelectorAll('.checkNo')[0].setAttribute('readonly', true);
            var checkAmountS = document.querySelectorAll('.checkAmount')[0].setAttribute('readonly', true);
            var checkButtonS = document.querySelector('.checkButton').setAttribute('disabled', true);
        }

        

        
        
        var cashAmountD = document.querySelector('.cashAmountD');
        var cashAmounts = (Math.round(cashAmount * 100) / 100).toFixed(2);
        // var phpAmounts = (Math.round(phpAmount * 100) / 100).toFixed(2);

        let phpAmounts = new Intl.NumberFormat('en-US', {
                style: 'decimal',
                maximumFractionDigits: 2,
                minimumFractionDigits: 2,
            });
            phpAmounts.format(phpAmount);

        var elements = document.querySelectorAll('.checkAmount');
        var values = [].map.call(elements, function(e) {
            
            return parseFloat(e.value);
        });
        
        var totalValues = values.reduce((a, b) => parseFloat(a) + parseFloat(b));
        console.log(totalValues);


        // var checkAmounts = (Math.round(checkAmount * 100) / 100).toFixed(2);
        // console.log(checkAmounts)
        // console.log(cashAmounts);
        var totalAmountInput = document.getElementById('totalAmounts');
        cashAmountD.value = cashAmounts;
        totalAmountInput.value = parseFloat(cashAmounts) + parseFloat(totalValues) + parseFloat(phpAmount);
        
        totalAmountInputs = totalAmountInput.value;

        let nf = new Intl.NumberFormat('en-US', {
                style: 'decimal',
                maximumFractionDigits: 2,
                minimumFractionDigits: 2,
            });
        nf.format(totalAmountInputs); // "1,234,567,890"

        totalAmountInput.value = nf.format(totalAmountInputs);
        // console.log(totalAmountInput.value)
        convertAmountToText(totalAmountInputs);

        

        // let acr = document.getElementById("acr").value;
        // let acrD = document.getElementById("acrD");
        // let acrs = (Math.round(acr * 100) / 100).toFixed(2);
        //     acrD.value = acrs;
    }


    // var php = document.getElementById('php').value;

    //     console.log("ang value ng php value is" + php);

    // $("#php").oninput(function(){
        
    // })

    // let number = 1234567890;
    //     let nf = new Intl.NumberFormat('en-US');
    //     nf.format(number); // "1,234,567,890"

    //     console.log(nf.format(number))

    //gagawa tayo ng function kapag nag click sa checkamount mag kakaroon ng total
    function totalAmount(){
        
        var phpAmount = document.getElementById('php').value;
        var cashAmount = document.querySelector('.cashAmount').value;
        var totalAmountInput = document.getElementById('totalAmounts');
        var elements = document.querySelectorAll('.checkAmount');
        var values = [].map.call(elements, function(e) {
            
            return parseFloat(e.value);
        });
        
        var totalValues = values.reduce((a, b) => parseFloat(a) + parseFloat(b));
        // console.log(totalValues);
        var totalAmount = parseFloat(phpAmount) + parseFloat(cashAmount) + parseFloat(totalValues);
        // totalAmountInput.value = (Math.round(totalAmount * 100) / 100).toFixed(2);
        console.log(totalAmount);
        let nf = new Intl.NumberFormat('en-US', {
                style: 'decimal',
                maximumFractionDigits: 2,
                minimumFractionDigits: 2,
            });
        nf.format(totalAmount);
        console.log(nf.format(totalAmount))

        totalAmountInput.value = nf.format(totalAmount);
        

        

        // var amount = totalAmountInput.value;

        // console.log(amount + "qwe");

        convertAmountToText(totalAmount);
        
        
        

        // console.log(cashAmount);
    }

    // Function to convert a number into text
function convertAmountToText(totalAmount) {
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
        words = convertNumberToWordsLessThanThousand(numLessThanThousand) + (scale ? ' ' + scale : '') + (words ? ' ' + words : '');
      }
      num = Math.floor(num / 1000);
      scaleIndex++;
    }
    return words;
  }

  // Split the input number into millions and centavos parts
  const millions = Math.floor(totalAmount);
  const centavos = Math.round((totalAmount - millions) * 100);

  // Convert millions and centavos parts into words
  const millionsText = convertNumberToWords(millions);
  const centavosText = convertNumberToWords(centavos);

  // Combine the results and format the final text
  let result = millionsText;
  if (centavos > 0) {
    result += ' and ' + centavosText + ' centavos ';
  }

  let sumofpesos = document.getElementById("sum_of_pesos");
 
 sumofpesos.value = result + " PESOS ONLY ";

  return result;
}   

    function jsfunction() {
            var totalAmountInput = document.getElementById('totalAmounts');
            let acr = document.getElementById("acr").value;
            let acrD = document.getElementById("acrD");
            let acrs = (Math.round(acr * 100) / 100).toFixed(2);
                acrD.value = acrs;

            let usd = document.getElementById("usd").value;
            let usdD = document.getElementById("usdD");
            let usds = (Math.round(usd * 100) / 100).toFixed(2);
                usdD.value = usds;

            let sum = parseFloat(acr) * parseFloat(usd);
            var totalAmountInputs = document.getElementById("php").value = (Math.round(sum * 100) / 100).toFixed(2);

            let nf = new Intl.NumberFormat('en-US', {
                style: 'decimal',
                maximumFractionDigits: 2,
                minimumFractionDigits: 2,
            });

            nf.format(totalAmountInputs); // "1,234,567,890"

            totalAmountInput.value = nf.format(totalAmountInputs);



            convertAmountToText(totalAmountInputs);

    }

    

    
    

// let sumofpesos = document.getElementById("edit_sum_of_pesos");
//     let totalamts = document.getElementById("totalAmounts");


// const amount = 1234567.00;
// let totalamts = document.getElementById("totalAmounts");
// // const textAmount = convertAmountToText(amount);
// // console.log(textAmount);


</script>



<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>