<?php

    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    if(isset($_POST['viewPrint'])){
        $arId = $_POST['ar_Id'];
    }
    
    else{
        header("Location: ar_list.php");
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
                <?php require_once("navphp/arNav.php");?>
            </div>


            <?php 
                
            $sql = "SELECT * FROM ar WHERE ar_Id='$arId'";
            $result = $conn->query($sql);
            
            ?>

            <?php if($result->num_rows > 0){?>
                <?php while($rows = $result->fetch_assoc()){?>
            <div class="col-md-10">
                <div class="container mb-5">
                <div class="card ">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0 mr-3">Print Acknowledgement Receipt</h5>

                        <div>

                        <button class="btn btn-success btn-border btn-round" onclick="printDiv('printThis')">
                            Print
                        </button>
                        </div>
                        
                        
                    </div>       
                </div>
                
                <div class="card-body m-5" id="printThis">
                    <div class="d-flex flex-wrap justify-content-center pb-3" >
                        <div class="" style="width: 100%">

                            <div class="row " style="visibility: hidden">
                                <div class="col-md-4">
                                    <div style="" class="d-flex justify-content-end align-items-center">
                                        <img src="./img/LogoAdam.png" class="" alt="" style="width: 80px; height: 80px;">
                                    </div>
                                </div>

                                <div class="col-md-5 d-flex justify-content-center align-items-center" style="flex-direction: column">
                                    <h3 style="font-weight: 900" class="mb-0">ADAMS HOLIDAY, INC</h3>
                                    <h5 style="font-weight: 700" class="font-italic">"Creating Lifetime Memories"</h5>
                                </div>

                                <div class="col-md-3 d-flex justify-content-center " style="flex-direction: column">
                                    
                                </div>
                                
                            </div>

                            <div class="text-center ml-5 mt-3" style="visibility: hidden">
                                <p class="mb-0" style="font-size: 14px;">2nd Floor, Unit 4B, Arquiza Trade Center, 1214 Arquiza corner M.H. Del Pilar Streets, Ermita, Manila 1000 Philippines</p>
                                <p class="mb-0" style="font-size: 14px;">Tel: (632) 840 39110 || (632) 700 08443 | Mobile: (63) 917 1569 9214 || (63) 921 361 0333 </p>
                                <p class="mb-0" style="font-size: 14px;">E-mail: adamsholidayinc@gmail.com | reservations@adamsholidays.com</p>
                                <p class="mb-0" style="font-size: 14px;">NON-VAT REG TIN 757-923-556-000</p>
                            </div>
                                
                        </div>
                    </div>


                <div class="row mt-4" style="width: 100%; margin: 0 auto;">
                    <div class="col-md-4">
                        <div>
                            <div class="bg-success d-flex justify-content-center" style="border: 1px solid lightgray; visibility: hidden">
                                <p class="text-light mb-0 p-1" style="font-size: 14px;">IN PAYMENT OF THE FOLLOWING</p>
                            </div>

                            <?php $transaction = $rows['transaction'];?>
                            <input type="text" value="<?php echo $transaction?>" class="d-none" id="transactionCheck" >
                            <table class="table table-sm" style="border: 0px;">
                                <thead style="border: 0px;">
                                    <tr style="border: 0px;">
                                        <th colspan="" style="border: 0px;"></th>
                                        <th colspan="" style="border: 0px;"></th>
                                        <th colspan="" style="border: 0px;"></th>
                                        <th colspan="" style="border: 0px;"></th>
                                        <th colspan="" style="border: 0px;"></th>
                                        <th colspan="" style="border: 0px;"></th>
                                        <th colspan="" style="border: 0px;"></th>
                                        <th colspan="" style="border: 0px;"></th>
                                        <th  style="font-size: 14px;visibility: hidden; border: 0px;" >PESOS</th>
                                        <th colspan="" style="border: 0px;"></th>
                                        <th colspan="" style="border: 0px;"></th>
                                        <th colspan="" style="border: 0px;"></th>
                                        <th colspan="" style="border: 0px;"></th>
                                        <th colspan="" style="border: 0px;"></th>
                                        <th colspan="" style="border: 0px;"></th>
                                        <th colspan="" style="border: 0px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="pr-0" style="font-size: 14px; visibility: hidden; border: 0px;" >Initial Travel</td>
                                        <td colspan="9" style="visibility: hidden; border: 0px;"></td>
                                        <td colspan="6" style="border: 0px;">
                                            <input type="checkbox" id="initial_travel" class="form-control mb-0"
                                            
                                            <?php 
                                    
                                                if($rows['transaction'] == "Int'l Travel"){
                                                        echo "checked";
                                                }
                                                

                                            ?>
                                            
                                            >
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px; visibility: hidden; border: 0px;">Local Tours</td>
                                        <td colspan="9" style="visibility: hidden; border: 0px;"></td>
                                        <td colspan="6" style="border: 0px;">
                                            <input type="checkbox" id="local_tours" style="" class="form-control mb-0"
                                            
                                            <?php 
                                    
                                                if($rows['transaction'] == "Local Tours"){
                                                        echo "checked";
                                                }
                                                

                                            ?>
                                            
                                            >
                                        </td>
                                    </tr>
                                    <tr>
                                    
                                        <td style="font-size: 14px; visibility: hidden; border: 0px;">Domestic Tours</td>
                                        <td colspan="9" style="border: visibility: hidden; border: 0px;"></td>
                                        <td colspan="6" style="border: 0px;">
                                            <input type="checkbox" id="domestic_tours"  class="form-control mb-0" 
                                            
                                            <?php 
                                    
                                                if($rows['transaction'] == "Domestic Tours"){
                                                        echo "checked";
                                                }
                                                

                                            ?>
                                            
                                            >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px; visibility: hidden; border: 0px;" >Others</td>
                                        <td colspan="9" style="visibility: hidden; border: 0px;"></td>
                                        <td colspan="6" style="border: 0px;">
                                            <input type="checkbox" id="others"  class="form-control mb-0"
                                            <?php 
                                    
                                                if($rows['transaction'] == "Others"){
                                                        echo "checked";
                                                }
                                                

                                            ?>
                                            
                                            >
                                        </td>
                                    </tr>
                                    <tr style="border: 0px;">
                                        <td style="font-size: 14px; visibility: hidden; border: 0px;">TOTAL</td>
                                        <td colspan="9" style="visibility: hidden; border: 0px;"></td>
                                        <td colspan="6" style="visibility: hidden; border: 0px;">
                                            
                                        </td>
                                    </tr>
                                        
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <div class="bg-success d-flex justify-content-center" style="visibility: hidden">
                                <p class="text-light mb-0 p-1" style="font-size: 14px;">FORM OF PAYMENT</p>
                            </div>
                            <table class="table table-sm" style="">
                                <thead style="">
                                    <!-- <tr >
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                    </tr> -->
                                </thead>
                                <tbody>
                                    <tr style="border: 0px;">
                                        <td class="pr-0 " style="font-size: 14px; border: 0px;"><span style="visibility: hidden">US$</span> <span class="font-weight-bold text-center ml-2 mr-0"><?php echo $rows['usd_amount']?></span></td>
                                        <td colspan="9" style="border: 0px;" class="text-center"><span class="font-weight-bold text-center ml-2 mr-0" style="font-size: 14px;"><?php echo $rows['acr']?></span></td>
                                        <td colspan="6" style="border: 0px;" class="text-center"><span class="font-weight-bold text-center ml-2 mr-0" style="font-size: 14px;"><?php echo $rows['php_val']?></span></td>
                                        
                                    </tr>
                                    
                                    <tr class="mt-5" style="border: 0px;">
                                        
                                        <td style="font-size: 14px; visibility: hidden; border: 0px;">CASH AMOUNT</td>
                                        <td colspan="9" style="border: 0px;"></td>
                                        <td colspan="6" style="font-size: 14px; border: 0px;" class="font-weight-bold text-center"><?php echo $rows['cash_amount'];?></td>
                                    </tr>

                                    <?php 
                                    
                                    
                                    $checkNo1Arr = explode(",", $rows['check_no1']);
                                    $checkAmount1Arr = explode(",", $rows['check_amount1']);
                                    
                                    // print_r($checkNo1Arr);
                                    // print_r($checkAmount1Arr);
                                    
                                    ?>

                                    <tr>
                                        <td style="font-size: 14px;">CHECK AMOUNT </td>
                                        <td colspan="9" style="border: 1px solid lightgray"></td>
                                        <td colspan="6" style="font-size: 14px;border: 1px solid lightgray" class="font-weight-bold text-center">
                                            <?php foreach($checkAmount1Arr as $checkAmount1ArrValue){?>
                                                <?php 
                                                echo $checkAmount1ArrValue;
                                                echo ',';
                                                ?>
                                                
                                            <?php }?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td style="font-size: 14px;">CHECK NO.</td>
                                        <td colspan="9" style="font-size: 14px;border: 1px solid lightgray" class="text-center font-weight-bold">
                                            <?php foreach($checkNo1Arr as $checkNo1ArrValue){?>
                                                <?php echo $checkNo1ArrValue;
                                                echo ',';
                                                ?>
                                            <?php }?>
                                        </td>
                                        
                                        <td colspan="6" style="border: 1px solid lightgray"></td>
                                        
                                    </tr>
                                   
                                    </tr style="border: 0px;">
                                        <td style="font-size: 14px; visibility: hidden; border: 0px;">TOTAL</td>
                                        <td colspan="9" style="border: 0px;" class="text-center"></td>
                                        <td colspan="6" style="font-size: 14px; border: 0px;" class="text-center font-weight-bold">PHP <span class="font-weight-bold text-center ml-2 mr-0"><?php echo $rows['total_amount']?></span></td>
                                    </tr>
                                        
                                </tbody>
                            </table>
                        </div>
                        
                        
                    </div>
                        
                    <div class="col-md-8">
                        <div class="" style="width: 100%;">
                            <h4 class="m-0" style="text-align: left; width: 100%; visibility: hidden">ACKNOWLEDGEMENT RECEIPT</h4>

                            <div class="row">
                                <div class="col-md-4 ">

                                </div>

                                <div class="col-md-4 ">
                                <input type="text" style="font-weight: bold; text-align: center; width: 100%; border: 0px; border-bottom: 1px solid gray" value="<?php echo $rows['status']?>" class="d-none" readonly>
                                </div>

                                <div class="col-md-4 ">
                                    <div class="row">
                                        <div class="col-md-5 ">
                                            <span style="visibility: hidden">AR No.: </span>
                                        </div>

                                        <div class="col-md-7">
                                            <span class="font-weight-bold"><?php echo $rows['ar_Number']?></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                        <span style="visibility: hidden">Date.</span>
                                        </div>

                                        <div class="col-md-7">
                                            <span class="font-weight-bold">
                                                <?php 
                                                    
                                                    $date=date_create($rows['date']);
                                                    echo date_format($date,"m/d/Y");
                                                    
                                                ?>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <h4 class="m-0" style="text-align: right">No. <?php echo $rows['ar_Id']?></h4>
                            <h4 class="m-0" style="text-align: right">Date: <?php echo $rows['date']?></h4> -->
                            <div class="row mt-3">
                                
                                <div class="col-md-3 d-flex justify-content-end px-0">
                                    <span class="" style="visibility: hidden">Received from</span>
                                </div>

                                <div class="col-md-9 px-0">
                                    <input type="text" style="font-weight: bold; text-align: center; width: 100%; border: 0px;" value="<?php echo $rows['received_from']?>" class="" readonly>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-3 d-flex justify-content-start px-0">
                                    <span class="" style="visibility: hidden">Business Name/Style</span>
                                </div>

                                <div class="col-md-5 px-0">
                                    <input type="text" style="font-weight: bold; text-align: center; width: 100%; border: 0px; " value="<?php echo $rows['business_name']?>" class="" readonly>
                                </div>

                                <div class="col-md-1 d-flex justify-content-center align-items-center px-0">
                                    <span class="" style="visibility: hidden">TIN</span>
                                </div>

                                <div class="col-md-3 px-0">
                                    <input type="text" style="font-weight: bold; text-align: center; width: 100%; border: 0px;" value="<?php echo $rows['tin']?>" class="" readonly>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-2 d-flex justify-content-start px-0">
                                    <span class="pr-1" style="visibility: hidden">Address</span>
                                </div>

                                <div class="col-md-10 px-0">
                                    <input type="text" style="font-weight: bold; text-align: center; width: 100%; border: 0px; " value="<?php echo $rows['address']?>" class="" readonly>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-3 d-flex justify-content-start px-0">
                                    <span class="" style="visibility: hidden">the sum of pesos</span>
                                </div>

                                <div class="col-md-9 px-0">
                                    <input type="text" style="font-size: 15px; text-transform: uppercase; font-weight: bold; text-align: center; width: 100%; border: 0px; " value="<?php echo $rows['sum']?>" class="" readonly>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-4 d-flex justify-content-start px-0">
                                    <span class="" style="visibility: hidden">in full/partial payment of</span>
                                </div>

                                <div class="col-md-8 px-0">
                                    <input type="text" style="font-size: 15px; font-weight: bold; text-align: center; width: 100%; border: 0px;" value="<?php echo $rows['full']?>" class="" readonly>
                                </div>
                            </div>

                            <!-- <div class="row mt-1">
                                <div class="col-md-12 px-0" style="width: 100%;">
                                    <span style="width: 10%;">Address</span>
                                    <input type="text" style="text-align: center; width: 90%; border: 0px; border-bottom: 1px solid gray" value="<?php echo 123?>" class="pr-0" readonly>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-12 px-0" style="width: 100%;">
                                    <span style="width: 20%;">The sum of pesos</span>
                                    <input type="text" style="text-align: center; width: 80%; border: 0px; border-bottom: 1px solid gray" value="<?php echo 123?>" class="pr-0" readonly>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-12 px-0" style="width: 100%;">
                                    <span style="width: 30%;">in full/partial payment of</span>
                                    <input type="text" style="text-align: center; width: 70%; border: 0px; border-bottom: 1px solid gray" value="<?php echo 123?>" class="pr-0" readonly>
                                </div>
                            </div>


                            <p class=" mt-3 mr-0" style="width: 100%;"><span class="ml-5">Received from</span> __________________________________________________________________ Business Name/Style ____________________________________________________________________ TIN _________________ Address ______________________________________________________ the sum of Pesos ___________________________________________________________ in full/partial payment of _______________________________________________________________</p> -->


                            <!-- <div class="row mt-4">
                                <div class="col-md-6 d-flex justify-content-center align-items-center " style="flex-direction: column">
                                    <h6 class="m-0">VAT SALES</h6>
                                    <h6 class="m-0 mt-2">12% TAX</h6>
                                </div>

                                <div class="col-md-6 d-flex justify-content-center align-items-center " style="flex-direction: column">
                                    <h6 class="m-0">LESS W/TAX</h6>
                                    <h6 class="m-0 mt-2">TOTAL</h6>
                                </div>
                            </div> -->

                            <div class="row mt-5">
                                <div class="col-md-6 " >
                                    
                                    <div class="row">
                                        <div class="col-md-6  d-flex justify-content-center align-items-center px-0">
                                            <span style="visibility: hidden">OR No.</span>
                                        </div>
                                        <div class="col-md-6  px-0">
                                            <input type="text" style="font-weight: bold; width: 100%; border: 0px; " value="<?php echo $rows['PR_no']?>" class="" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 " style="">

                                    <div class="row">
                                        <div class="col-md-2 d-flex justify-content-center align-items-center px-0">
                                            <span class=""></span>
                                        </div>
                                        <?php 
                                        
                                        $sqlh = "SELECT * FROM officials WHERE officials_Id='$officialId'";
                                        $resulth = $conn->query($sqlh);
                                        
                                        ?>

                                        <?php if($resulth->num_rows > 0){?>
                                            <?php while($rowsh = $resulth->fetch_assoc()){?>
                                        <div class="col-md-10 px-0" style="position: absolute;">
                                            <!-- <img src="<?php echo $rowsh['signature_data'];?>" alt="qwe" style="height: 100px; width: 100px; position:absolute; left:50%; "> -->
                                            <!-- <p class="text-center">Authorized Signature</p> -->
                                        </div>

                                            <?php } ?>
                                        <?php } ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2 d-flex justify-content-center align-items-center px-0">
                                            <span class="" style="visibility: hidden">By:</span>
                                        </div>
                                        <div class="col-md-10 px-0">
                                            <input type="text" style="font-weight: bold;text-align: center; width: 100%; border: 0px; border-bottom: 1px solid gray: background-color: red !important;" value="<?php echo $rows['by_signature']?>" class="" readonly>
                                            <!-- <p class="text-center">Authorized Signature</p> -->
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2 d-flex justify-content-end align-items-center px-0">
                                            <span class=""></span>
                                        </div>
                                        <div class="col-md-10 px-0">
                                            <!-- <input type="text" style="width: 100%; border: 0px; border-bottom: 1px solid gray " value="<?php echo 123?>" class="" readonly> -->
                                            <p class="text-center " style="visibility: hidden">Authorized Signature</p>
                                        </div>
                                    </div>


                                     <!-- <div class="">
                                        <h6 class="text-center m-0 mt-3">By: __________________________</h6>
                                        
                                    </div> -->
                                </div>
                            </div>


                            <!-- <p class="mr-0">Business Name/Style _______________________________ TIN _______________________________</p>
                            <p class="mr-0">Address _______________________________________________________________________________</p>
                            <p class="mr-0">the sum of Pesos ______________________________________________________________________</p>
                            <p class="mr-0">in full/partial payment of _______________________________________________________________</p> -->
                        </div>
                    </div>
                    
                </div>

                
                <!-- Body -->

                </div>

                

                <div class="row">
                    <div class="col-md-6">

                    </div>

                    <div class="col-md-6 text-right" >
                        <?php date_default_timezone_set('Asia/Manila'); ?>
                        <p style="font-weight: bold" class="text-right"><?php echo date("Y-m-d  h:i:sa") ?></p>
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

        let transactionCheck = document.getElementById("transactionCheck").value

        // let initial_travel = document.getElementById("initial_travel")
        // let local_tours = document.getElementById("local_tours")
        // let domestic_tours = document.getElementById("domestic_tours")
        // let others = document.getElementById("others")

                                    
        // console.log(transactionCheck)

        // if(transactionCheck == "In't Travel"){
        //     $("#initial_travel").prop("checked", true);
        // }
        // else if(transactionCheck == "Local Tours"){
        //     $("#local_tours").prop("checked", true);
        // }

        // else if(transactionCheck == "Domestic Tours"){
        //     $("#domestic_tours").prop("checked", true);
        // }
        // else if(transactionCheck == "Others"){
        //     $("#others").prop("checked", true);
        // }

        


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