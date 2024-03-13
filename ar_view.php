<?php 

    require_once "connection.php";
    

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    if(isset($_POST['view'])){
        $arId = $_POST['ar_Id'];
    }

    else{
        header("Location: ar_list.php");
    }

    $name = $_SESSION['name'];

    $event = "Viewed";
    $form = "AR";
    date_default_timezone_set("Asia/Manila");
    $dateEdited = date('Y-m-d');
    $timeEdited = date('H:i:s');

    $sqli = "INSERT INTO audit_trail (user, event, form, date, time) VALUES ('$name', '$event', '$form', '$dateEdited', '$timeEdited')";
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

    <!-- Animation Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Font Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="ar.css">
</head>

<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;700;800;900;1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

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
    <div class="fluid-container py-3" style="min-height: 100vh; width: 100%; background: #fff">
        <div class="" style="height: 100%; width: 100%; flex-direction: column">

        <div class="row">
            <div class="col-md-2" >
                <?php require_once("navphp/arNav.php");?>
            </div>

            <?php 
            
            $sql = "SELECT * FROM ar WHERE ar_Id='$arId'";
            $result = $conn->query($sql);
            
            ?>

            <?php if($result->num_rows > 0){?>
                <?php while($rows = $result->fetch_assoc()){?>
            <div class="col-md-10">
                <div class="bg-success" style="width: 60%; padding: 8px 20px; margin: 0 auto;" >
                    <h5 class="mb-0 text-light">View Acknowledgement Receipt Form</h5>
                </div>
                <form action="" method="" id="" style="width: 60%; margin: 0 auto; border: 1px solid lightgray;" class="p-4" >
                    
                    <div class="row">
                        <input type="text" name="edit_ar_Id" id="" class="d-none form-control form-control-sm " value="<?php echo $rows['ar_Id'];?>">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Received From:</label>
                            <input type="text" name="edit_receive_from" id="" class="form-control form-control-sm " value="<?php echo $rows['received_from'];?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Business Name/Style:</label>
                            <input type="text" name="edit_business_name" id="" class="form-control form-control-sm" value="<?php echo $rows['business_name'];?>" readonly>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Address:</label>
                            <input type="text" name="edit_address" id="" class="form-control form-control-sm" value="<?php echo $rows['address'];?>" readonly>
                        </div>
                        <div class="col-md-6" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>TIN:</label>
                            <input type="text" name="edit_tin" id="" class="form-control form-control-sm" value="<?php echo $rows['tin'];?>" readonly>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>in full/partial payment of:</label>
                            <input type="text" name="edit_full_payment" id="" class="form-control form-control-sm" value="<?php echo $rows['full'];?>" readonly>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Date:</label>
                            <input type="date" name="edit_date" id="" class="form-control form-control-sm" value="<?php echo $rows['date'];?>" readonly>
                        </div>

                        <div class="col-md-6" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Transaction:</label>
                            <select name="edit_transaction" id="" class="form-control form-control-sm" value="<?php echo $rows['transaction'];?>" readonly>
                                <option value="<?php echo $rows['transaction'];?>"><?php echo $rows['transaction'];?></option>
                                <option value="Int'l Travel">Int'l Travel</option>
                                <option value="Int'l Tour Package">Int'l Tour Package</option>
                                <option value="Local Tour">Local Tour</option>
                                <option value="Local Tour Package">Local Tour Package</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>ACR:</label>
                            <input type="number" name="acr" id="acr" oninput="jsfunction();" class="form-control form-control-sm"  value="<?php echo $rows['acr'];?>" readonly>
                            <input type="number" name="edit_acrD" id="acrD" oninput="jsfunction();" class="d-none form-control form-control-sm"  value="<?php echo $rows['acr'];?>">
                        </div>

                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>USD Amount:</label>
                            <input type="number" name="usd" id="usd" oninput="jsfunction();" class="form-control form-control-sm" value="<?php echo $rows['usd_amount'];?>" readonly>
                            <input type="number" name="edit_usdD" id="usdD" oninput="jsfunction();" class="d-none form-control form-control-sm" value="<?php echo $rows['usd_amount'];?>">
                        </div>

                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>PHP Value:</label>
                            <input type="number" name="edit_php" id="php" class="form-control form-control-sm" value="<?php echo $rows['php_val'];?>" readonly>
                        </div> 

                        <div class="col-md-3" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>CASH Amount:</label>
                            <input type="number" name="edit_cash" id="cash" oninput="totalAmount();" class="cashAmount form-control form-control-sm" value="<?php echo $rows['cash_amount'];?>" readonly>
                            <input type="number" name="edit_cashD" id="cashD" oninput="totalAmount();" class="d-none cashAmountD form-control form-control-sm" value="<?php echo $rows['cash_amount'];?>">
                        </div>
                    </div>

                    <?php 
                    $checkBank1Arr = explode(",", $rows['checkBank1']);
                    $checkNo1Arr = explode(",", $rows['check_no1']);
                    $checkAmount1Arr = explode(",", $rows['check_amount1']);
                    
                    // print_r($checkNo1Arr);
                    // print_r($checkAmount1Arr);
                    ?>
                    <div class="row mt-3" id="">

                            <div class="col-md-4">
                                <?php foreach($checkBank1Arr as $checkBank1ArrValue){?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="" class="font-weight-bold mt-3"><span class="text-danger mr-1">*</span>Check Bank:</label>
                                            <input type="text" name="edit_checkBank[]" id=""  class="checkBank form-control form-control-sm" value="<?php echo $checkBank1ArrValue;?>" disabled>
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                    
                            <div class="col-md-4">
                                <?php foreach($checkNo1Arr as $checkNo1ArrValue){?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="" class="font-weight-bold mt-3"><span class="text-danger mr-1">*</span>Check No:</label>
                                            <input type="text" name="edit_checkNo[]" id=""  class="checkNo form-control form-control-sm" value="<?php echo $checkNo1ArrValue;?>" disabled>
                                        </div>
                                    </div>
                                <?php }?>
                            </div>

                            <div class="col-md-4">
                                <?php foreach($checkAmount1Arr as $checkAmount1ArrValue){?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="" class="font-weight-bold mt-3"><span class="text-danger mr-1">*</span>Check Amount:</label>
                                            <input type="text" name="edit_checkAmount[]" id="" oninput="totalAmount();" class="checkAmount form-control form-control-sm" value="<?php echo $checkAmount1ArrValue;?>" disabled>
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                    

                            <!-- <?php foreach($checkAmount1Arr as $checkAmount1ArrValue){?>
                                <div class="col-md-6" >
                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Check Amount:</label>
                                    <input type="text" name="checkAmount[]" id="" oninput="totalAmount();" class="checkAmount form-control form-control-sm" value="<?php echo $checkAmount1ArrValue;?>">
                                </div>       
                            <?php }?> -->
                            

                            <div class="col-md-4 d-none" >
                                <label for="" class="font-weight-bold"></label>
                                <div class="mt-2">
                                    <input type="button" class="checkButton btn btn-dark btn-sm mb-0" style="border: 0; cursor: pointer;" value="Add Fields" id="addCheckBtn">
                                </div>
                            </div>
                         
                    
                    </div> 
                    <!-- <div class="row mt-3" id="">
                        <div class="col-md-4" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Check No:</label>
                            <input type="text" name="checkNo[]" id=""  class="checkNo form-control form-control-sm" value="<?php echo $rows['check_no1'];?>">
                        </div>

                        <div class="col-md-4" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Check Amount:</label>
                            <input type="text" name="checkAmount[]" id="" oninput="totalAmount();" class="checkAmount form-control form-control-sm" value="<?php echo $rows['check_amount1'];?>">
                        </div>

                        <div class="col-md-4" >
                            <label for="" class="font-weight-bold"></label>
                            <div class="mt-2">
                                <input type="button" class="checkButton btn btn-dark btn-sm mb-0" style="border: 0; cursor: pointer;" value="Add Fields" id="addCheckBtn">
                            </div>
                        </div>
                    </div> -->

                    <div id="divNext">

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>TOTAL AMOUNT:</label>
                            <input type="text" name="edit_total" id="totalAmounts" class="form-control form-control-sm" value="<?php echo $rows['total_amount'];?>" readonly>
                        </div>
                    </div>

                    <?php 
                    $paxNameArr = explode(",", $rows['pax_name']);
                    $paxServiceArr = explode(",", $rows['pax_service']);
                    $paxAmountArr = explode(",", $rows['pax_amount']);
                    
                    // print_r($checkNo1Arr);
                    // print_r($checkAmount1Arr);
                    ?>

                    <div class="row mt-3">
                        <div class="col-md-12" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>The sum of Pesos:</label>
                            <input type="text" name="edit_sum_of_pesos" id="edit_sum_of_pesos" style="text-transform: uppercase;" class="form-control form-control-sm" value="<?php echo $rows['sum'];?>" readonly>
                        </div>
                    </div>

                    <div class="row mt-3" id="">
                        <div class="col-md-4" >
                            <?php foreach($paxNameArr as $paxNameArrValue){?>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Pax Name:</label>
                                    <input type="text" name="edit_paxName[]" id=""  class="paxName form-control form-control-sm" value="<?php echo $paxNameArrValue;?>" readonly>
                                </div>
                            </div>

                            <?php } ?>
                            
                        </div>

                        <div class="col-md-4" >
                            <?php foreach($paxServiceArr as $paxServiceValue){?>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Service:</label>
                                    <input type="text" name="edit_paxService[]" id=""  class="paxService form-control form-control-sm" value="<?php echo $paxServiceValue?>" readonly>
                                </div>
                            </div>
                            <?php } ?>
                            
                        </div>

                        <div class="col-md-4" >
                            <?php foreach($paxAmountArr as $paxAmountArrValue){?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Amount:</label>
                                        <input type="number" name="edit_paxAmount[]" id=""  class="paxAmount form-control form-control-sm" value="<?php echo $paxAmountArrValue?>" readonly>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <!-- <div class="col-md-3" >
                            <label for="" class="font-weight-bold"></label>
                            <div class="mt-2">
                                <input type="button" class="paxButton btn btn-dark btn-sm mb-0" style="border: 0; cursor: pointer;" value="Add Pax" id="addPaxBtn">
                            </div>
                            
                        </div> -->
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Reference No:</label>
                            <input type="text" name="edit_pr_no" id="" class="form-control form-control-sm" value="<?php echo $rows['PR_no'];?>" readonly>
                        </div>

                        <div class="col-md-6" >
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>By:</label>
                            <input type="text" name="edit_by" id="" class="form-control form-control-sm" value="<?php echo $name;?>" readonly>
                            <div class="d-flex justify-content-center align-items-center mt-1">
                                <label for="" class="text-center" style="text-align: center">Authorized Signature</label>
                            </div>
                            
                        </div>
                    </div>


                    <!-- <input type="submit" name="editBtn" id="editBtn" class="btn btn-success btn-block mt-3" value="Save"> -->
                    
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

<script src="ar.js"></script>

<script>



    $("#addCheckBtn").click(function(e){
        e.preventDefault();

        $("#divNext").prepend(
            `<div class="row mt-3">
                <div class="col-md-4" >
                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Check No:</label>
                    <input type="text" name="checkNo[]" id=""  class="checkNo form-control form-control-sm" required readonly>
                </div>

                <div class="col-md-4" >
                    <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Check Amount:</label>
                    <input type="number" name="checkAmount[]" id="" oninput="totalAmount();" class="checkAmount form-control form-control-sm" required readonly>
                </div>

                <div class="col-md-4" >
                    <label for="" class="font-weight-bold"></label>
                    <div class="mt-2">
                        <input type="button" class="checkButton btn btn-danger btn-sm mb-0" style="border: 0; cursor: pointer;" value="Remove" id="removeCheckBtn">
                    </div>
                </div>
            </div>`);

        
    })

    
    
    // JSON.stringify(filters);

    $(document).on('click', '#removeCheckBtn', function(e){
            e.preventDefault();

            // let checkAmount = document.getElementById('checkAmount').value = "";

            let row_item = $(this).parent().parent().parent();
            $(row_item).remove();

    })

    $(document).ready(function(){

        console.log("start");

        // console.log("Hello World")
        $("#editBtn").click(function(e){
            console.log("napindot");
            e.preventDefault();

            

            // console.log(values);

            $.ajax({
                url: "edit_process.php",
                method: "POST",
                data: $("#edit_ar_Form").serialize() + "&action=editAR",
                success : function (response){
                    if(response == "Success"){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Successfully Edited AR!',
                            showConfirmButton: false,
                            timer: 1300  
                        }).then(function(){
                            window.location = "ar_list.php";
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
                }
            })

        })

        
        
        
    });


    var cashAmount = document.querySelector('.cashAmount').value;
    console.log(cashAmount);

    if(cashAmount == null || cashAmount == ""){
        // alert("No value");
        var checkNoS = document.querySelectorAll('.checkNo')[0].setAttribute('readonly', true);
        var checkAmountS = document.querySelectorAll('.checkAmount')[0].setAttribute('readonly', true);
        var checkButtonS = document.querySelector('.checkButton').setAttribute('disabled', true);
    }

    else if(cashAmount != null || cashAmount != ""){
        // alert("Yes value");
        var checkNoS = document.querySelectorAll('.checkNo')[0].removeAttribute('readonly');
        var checkAmountS = document.querySelectorAll('.checkAmount')[0].removeAttribute('readonly');
        var checkButtonS = document.querySelector('.checkButton').removeAttribute('disabled');
    }

    

    // $("#acr").blur(function(){
    // alert("This input field has lost its focus.");
    // });

    function totalCash(){
        var cashAmount = document.querySelector('.cashAmount').value;

        if(cashAmount != null || cashAmount != ""){
            // alert("Yes value");
            var checkNoS = document.querySelectorAll('.checkNo')[0].removeAttribute('readonly');
            var checkAmountS = document.querySelectorAll('.checkAmount')[0].removeAttribute('readonly');
            var checkButtonS = document.querySelector('.checkButton').removeAttribute('disabled');
        }

        else if(cashAmount == null || cashAmount == ""){
            var checkNoS = document.querySelectorAll('.checkNo')[0].setAttribute('readonly', true);
            var checkAmountS = document.querySelectorAll('.checkAmount')[0].setAttribute('readonly', true);
            var checkButtonS = document.querySelector('.checkButton').setAttribute('disabled', true);
        }

        

        var cashAmountD = document.querySelector('.cashAmountD');
        var cashAmounts = (Math.round(cashAmount * 100) / 100).toFixed(2);

        var totalAmountInput = document.getElementById('totalAmounts');
        cashAmountD.value = cashAmounts;
        totalAmountInput.value = cashAmounts;

        

        // let acr = document.getElementById("acr").value;
        // let acrD = document.getElementById("acrD");
        // let acrs = (Math.round(acr * 100) / 100).toFixed(2);
        //     acrD.value = acrs;
    }

    //gagawa tayo ng function kapag nag click sa checkamount mag kakaroon ng total
    function totalAmount(){
        var cashAmount = document.querySelector('.cashAmount').value;
        var totalAmountInput = document.getElementById('totalAmounts');
        var elements = document.querySelectorAll('.checkAmount');
        var values = [].map.call(elements, function(e) {
            
            return parseFloat(e.value);
        });
        
        var totalValues = values.reduce((a, b) => parseFloat(a) + parseFloat(b));
        console.log(totalValues);
        var totalAmount = parseFloat(cashAmount) + parseFloat(totalValues);
        totalAmountInput.value = (Math.round(totalAmount * 100) / 100).toFixed(2);
        // if(isNaN(totalAmountInput)){
        //     this.value = '';
        // }
        // console.log(totalAmount);
        
        
        

        // console.log(cashAmount);
    }

    // $('.checkAmount').on('blur', function() {
    // let value = this.value.replace(/,/g, '');
    // value = parseInt(value);
    // if (isNaN(value))
    //     this.value = '';
    // else
    //     this.value = value.toLocaleString('en-US', {
    //     style: 'decimal',
    //     maximumFractionDigits: 2,
    //     minimumFractionDigits: 2
    //     });
    // });

    // let acrInput = document.getElementById("acr");

    // $("#acr").blur(function(){
    //     let acrInput = document.getElementById("acr").value;
    //     let acrInputs = (Math.round(acrInput * 100) / 100).toFixed(2);
    //     console.log(acrInputs);
    //     acrInput.value = acrInputs;
    
    // });


    

    function jsfunction() {
            let acr = document.getElementById("acr").value;
            let acrD = document.getElementById("acrD");
            let acrs = (Math.round(acr * 100) / 100).toFixed(2);
                acrD.value = acrs;

            let usd = document.getElementById("usd").value;
            let usdD = document.getElementById("usdD");
            let usds = (Math.round(usd * 100) / 100).toFixed(2);
                usdD.value = usds;

            let sum = parseFloat(acr) * parseFloat(usd);
            var php = document.getElementById("php").value = (Math.round(sum * 100) / 100).toFixed(2);
    }



</script>



<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>