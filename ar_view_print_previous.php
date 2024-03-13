<?php 
    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    if(isset($_POST['viewPrint'])){
       echo $arId = $_POST['ar_Id'];
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
    <!-- bootstrap css and js -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- JQUERY Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Animation Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Font Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
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



<body style="overflow-x: hidden; " class="pb-5">

    <!-- <div class="fluid-container " style="height: 100vh; width: 100%; background: #E1E1E1"> -->
    <div class="fluid-container py-5" style="min-height: 100vh; width: 100%; background: #fff">
        <div class="" style="height: 100%; width: 100%; flex-direction: column">

        <div class="row">
            <div class="col-md-2" >
                <div class="bg-dark" style="width: 15%; height: 100%; position: fixed; top: 0; overflow: hidden">
                    <ul class="nav nav-primarybg-success d-flex justify-content-center align-items-center mb-0 mt-5" style="flex-direction: column; width: 100%;">
                        <li style="list-style: none; width: 100%; " class="nav-item bg-success p-2 text-center"><a href="" style="text-decoration: none" class="text-light">Logo Here</a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center mt-5"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="ar_list.php" style="text-decoration: none" class="text-light">AR List</a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="ar_audit_trail.php" style="text-decoration: none" class="text-light">Audit Trail</a></li>
                        
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="" style="text-decoration: none" class="text-light"></a></li>
                        
                        

                        <li style="list-style: none; width: 100%; " class="nav-item p-2 text-center"><a href="ar_list.php" style="text-decoration: none" class="text-light">Back</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-10 pl-0">

                <div class="bg-success" style="width: 90%; padding: 8px 20px; margin: 0 auto;" >
                    <h5 class="mb-0 text-light">Acknowledgement Receipt Print</h5>
                </div>

                <div class="printThis" id="printThis">

                    <!-- Header -->
                <div class="row ml-5 mt-4">
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

                <div class="text-center ml-5 mt-3">
                    <p class="mb-0" style="font-size: 14px;">2nd Floor, Unit 4B, Arquiza Trade Center, 1214 Arquiza corner M.H. Del Pilar Streets, Ermita, Manila 1000 Philippines</p>
                    <p class="mb-0" style="font-size: 14px;">Tel: (632) 840 39110 | Mobile: (63) 921 361 0333</p>
                    <p class="mb-0" style="font-size: 14px;">E-mail: adamsholidayinc@gmail.com | reservations@adamsholidays.com</p>
                </div>
                <!-- Header -->



                <!-- Body --> 
                <?php 
                
                $sql = "SELECT * FROM ar WHERE ar_Id='$arId'";
                $result = $conn->query($sql);
                
                ?>

                <?php if($result->num_rows > 0){?>
                    <?php while($rows = $result->fetch_assoc()){?>
                <div class="row mt-4" style="width: 90%; margin: 0 auto;">
                    <div class="col-md-4">
                        <div>
                            <div class="bg-success d-flex justify-content-center">
                                <p class="text-light mb-0 p-1" style="font-size: 14px;">IN PAYMENT OF THE FOLLOWING</p>
                            </div>
                            <table class="table table-sm" style="border: 1px solid lightgray">
                                <thead >
                                    <tr >
                                        <th colspan="" style="border: 1px solid lightgray"></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" style="font-size: 14px;">PESOS</th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                        <th colspan="" ></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="pr-0" style="font-size: 14px;">Initial Travel</td>
                                        <td colspan="9" style="border: 1px solid lightgray"></td>
                                        <td colspan="6" style="border: 1px solid lightgray"></td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px;">Local Tours</td>
                                        <td colspan="9" style="border: 1px solid lightgray"></td>
                                        <td colspan="6" style="border: 1px solid lightgray"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px;">Domestic Tours</td>
                                        <td colspan="9" style="border: 1px solid lightgray"></td>
                                        <td colspan="6" style="border: 1px solid lightgray"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px;">Others</td>
                                        <td colspan="9" style="border: 1px solid lightgray"></td>
                                        <td colspan="6" style="border: 1px solid lightgray"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px;">TOTAL</td>
                                        <td colspan="9" style="border: 1px solid lightgray"></td>
                                        <td colspan="6" style="border: 1px solid lightgray"></td>
                                    </tr>
                                        
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <div class="bg-success d-flex justify-content-center">
                                <p class="text-light mb-0 p-1" style="font-size: 14px;">FORM OF PAYMENT</p>
                            </div>
                            <table class="table table-sm" style="border: 1px solid lightgray">
                                <thead >
                                    <tr >
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="pr-0 " style="font-size: 14px;">US$ <span class="font-weight-bold text-center ml-2 mr-0"><?php echo $rows['usd_amount']?></span></td>
                                        <td colspan="9" style="border: 1px solid lightgray" class="text-center"><span class="font-weight-bold text-center ml-2 mr-0" style="font-size: 14px;"><?php echo $rows['acr']?></span></td>
                                        <td colspan="6" style="border: 1px solid lightgray" class="text-center"><span class="font-weight-bold text-center ml-2 mr-0" style="font-size: 14px;"><?php echo $rows['php_val']?></span></td>
                                        
                                    </tr>
                                    
                                    <tr class="mt-5">
                                        
                                        <td style="font-size: 14px;">CASH AMOUNT</td>
                                        <td colspan="9" style="border: 1px solid lightgray"></td>
                                        <td colspan="6" style="font-size: 14px;border: 1px solid lightgray " class="font-weight-bold text-center"><?php echo $rows['cash_amount'];?></td>
                                    </tr>

                                    <?php 
                                    
                                    
                                    $checkNo1Arr = explode(",", $rows['check_no1']);
                                    $checkAmount1Arr = explode(",", $rows['check_amount1']);
                                    
                                    // print_r($checkNo1Arr);
                                    // print_r($checkAmount1Arr);
                                    
                                    ?>

                                    <?php foreach($checkAmount1Arr as $checkAmount1ArrValue){?>
                                    <tr>
                                        <td style="font-size: 14px;">CHECK AMOUNT </td>
                                        <td colspan="9" style="border: 1px solid lightgray"></td>
                                        <td colspan="6" style="font-size: 14px;border: 1px solid lightgray" class="font-weight-bold text-center"><?php echo $checkAmount1ArrValue?></td>
                                    </tr>
                                    <?php }?>
                                    
                                    <?php foreach($checkNo1Arr as $checkNo1ArrValue){?>
                                       
                                    <tr>
                                        
                                        <td style="font-size: 14px;">CHECK NO.</td>
                                        <td colspan="9" style="font-size: 14px;border: 1px solid lightgray" class="text-center"><?php echo $checkNo1ArrValue?></td>
                                        
                                        <td colspan="6" style="border: 1px solid lightgray"></td>
                                        
                                    </tr>
                                    <?php }?>
                                    
                                    
                                    
                                        <td style="font-size: 14px;">TOTAL</td>
                                        <td colspan="9" style="border: 1px solid lightgray" class="text-center"></td>
                                        <td colspan="6" style="font-size: 14px;border: 1px solid lightgray" class="text-center font-weight-bold">PHP <span class="font-weight-bold text-center ml-2 mr-0"><?php echo $rows['total_amount']?></span></td>
                                    </tr>
                                        
                                </tbody>
                            </table>
                        </div>
                        
                        
                    </div>
                        
                    <div class="col-md-8">
                        <div class="" style="width: 100%;">
                            <h4 class="m-0" style="text-align: left; width: 100%;">OFFICIAL RECEIPT</h4>

                            <div class="row">
                                <div class="col-md-4 ">

                                </div>

                                <div class="col-md-4 ">

                                </div>

                                <div class="col-md-4 ">
                                    <div class="row">
                                        <div class="col-md-5 ">
                                            <span>AR No.: </span>
                                        </div>

                                        <div class="col-md-7">
                                            <span class="font-weight-bold"><?php echo $rows['ar_Id']?></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                        <span>Date.</span>
                                        </div>

                                        <div class="col-md-7">
                                            <span class="font-weight-bold"><?php echo $rows['date']?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <h4 class="m-0" style="text-align: right">No. <?php echo $rows['ar_Id']?></h4>
                            <h4 class="m-0" style="text-align: right">Date: <?php echo $rows['date']?></h4> -->
                            <div class="row mt-3">
                                <div class="col-md-3 d-flex justify-content-end px-0">
                                    <span class="" style="">Received from</span>
                                </div>

                                <div class="col-md-9 px-0">
                                    <input type="text" style="font-weight: bold; text-align: center; width: 100%; border: 0px; border-bottom: 1px solid gray" value="<?php echo $rows['received_from']?>" class="" readonly>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-3 d-flex justify-content-start px-0">
                                    <span class="" style="">Business Name/Style</span>
                                </div>

                                <div class="col-md-5 px-0">
                                    <input type="text" style="font-weight: bold; text-align: center; width: 100%; border: 0px; border-bottom: 1px solid gray" value="<?php echo $rows['business_name']?>" class="" readonly>
                                </div>

                                <div class="col-md-1 d-flex justify-content-center align-items-center px-0">
                                    <span class="" style="">TIN</span>
                                </div>

                                <div class="col-md-3 px-0">
                                    <input type="text" style="font-weight: bold; text-align: center; width: 100%; border: 0px; border-bottom: 1px solid gray" value="<?php echo $rows['tin']?>" class="" readonly>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-2 d-flex justify-content-start px-0">
                                    <span class="pr-1" style="">Address</span>
                                </div>

                                <div class="col-md-10 px-0">
                                    <input type="text" style="font-weight: bold; text-align: center; width: 100%; border: 0px; border-bottom: 1px solid gray" value="<?php echo $rows['address']?>" class="" readonly>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-3 d-flex justify-content-start px-0">
                                    <span class="" style="">the sum of pesos</span>
                                </div>

                                <div class="col-md-9 px-0">
                                    <input type="text" style="font-weight: bold; text-align: center; width: 100%; border: 0px; border-bottom: 1px solid gray" value="<?php echo $rows['sum']?>" class="" readonly>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-4 d-flex justify-content-start px-0">
                                    <span class="" style="">in full/partial payment of</span>
                                </div>

                                <div class="col-md-8 px-0">
                                    <input type="text" style="font-weight: bold; text-align: center; width: 100%; border: 0px; border-bottom: 1px solid gray" value="<?php echo $rows['full']?>" class="" readonly>
                                </div>
                            </div>

                            <!-- <div class="row mt-1">
                                <div class="col-md-12 px-0" style="width: 100%;">
                                    <span style="width: 10%;">Address</span>
                                    <input type="text" style="text-align: center; width: 90%; border: 0px; border-bottom: 1px solid gray" value="<?php echo $rows['address']?>" class="pr-0" readonly>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-12 px-0" style="width: 100%;">
                                    <span style="width: 20%;">The sum of pesos</span>
                                    <input type="text" style="text-align: center; width: 80%; border: 0px; border-bottom: 1px solid gray" value="<?php echo $rows['address']?>" class="pr-0" readonly>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-12 px-0" style="width: 100%;">
                                    <span style="width: 30%;">in full/partial payment of</span>
                                    <input type="text" style="text-align: center; width: 70%; border: 0px; border-bottom: 1px solid gray" value="<?php echo $rows['address']?>" class="pr-0" readonly>
                                </div>
                            </div>


                            <p class=" mt-3 mr-0" style="width: 100%;"><span class="ml-5">Received from</span> __________________________________________________________________ Business Name/Style ____________________________________________________________________ TIN _________________ Address ______________________________________________________ the sum of Pesos ___________________________________________________________ in full/partial payment of _______________________________________________________________</p> -->


                            <div class="row mt-4">
                                <div class="col-md-6 d-flex justify-content-center align-items-center " style="flex-direction: column">
                                    <h6 class="m-0">VAT SALES</h6>
                                    <h6 class="m-0 mt-2">12% TAX</h6>
                                </div>

                                <div class="col-md-6 d-flex justify-content-center align-items-center " style="flex-direction: column">
                                    <h6 class="m-0">LESS W/TAX</h6>
                                    <h6 class="m-0 mt-2">TOTAL</h6>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-6 " >
                                    
                                    <div class="row">
                                        <div class="col-md-6  d-flex justify-content-center align-items-center px-0">
                                            <span class="">P.R No.</span>
                                        </div>
                                        <div class="col-md-6  px-0">
                                            <input type="text" style="font-weight: bold; width: 100%; border: 0px; " value="<?php echo $rows['PR_no']?>" class="" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 " style="">

                                    <div class="row">
                                        <div class="col-md-2 d-flex justify-content-center align-items-center px-0">
                                            <span class="">By:</span>
                                        </div>
                                        <div class="col-md-10 px-0">
                                            <input type="text" style="font-weight: bold;text-align: center; width: 100%; border: 0px; border-bottom: 1px solid gray " value="<?php echo $rows['by_signature']?>" class="" readonly>
                                            <!-- <p class="text-center">Authorized Signature</p> -->
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2 d-flex justify-content-end align-items-center px-0">
                                            <span class=""></span>
                                        </div>
                                        <div class="col-md-10 px-0">
                                            <!-- <input type="text" style="width: 100%; border: 0px; border-bottom: 1px solid gray " value="<?php echo $rows['full']?>" class="" readonly> -->
                                            <p class="text-center">Authorized Signature</p>
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

                    <?php }?>
                <?php }?>
                
                <!-- Body -->

                </div>

                <button class="btn btn-primary btn-block mb-5" onclick="printDiv('printThis')">
                    Print
                </button>

                

                

                
            </div>
        </div>

        
        
        

        </div>
    </div>



<script>
    $(document).ready(function(){

        
    })

    function printDiv(divName) {
        console.log("Hello");
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
            
    }

        


</script>



<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>