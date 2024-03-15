<?php 
    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    $officials_Id = $_SESSION['officialsId'];

    if($_SESSION['usertype'] == "user"){
        header("Location: ar_list.php");
    }

    $sqlu = "UPDATE notification SET status='seen' WHERE officials_Id='$officials_Id' AND form='AR'";
    $resultu = $conn->query($sqlu);

    if($resultu){
        
        
    }


    if(isset($_POST['acceptReqBtn'])){
        $officialsId = $_POST['officials_Id'];
        $reqId = $_POST['req_Id'];

        $token = "qwertyuiopasdfghjklzxcvbnm1234567890";
        $token = str_shuffle($token);
        $token = substr($token, 0,10);

        $sqlu = "UPDATE request_list SET status='Confirmed', token='$token', token_expire=DATE_ADD(NOW(), INTERVAL 15 MINUTE) WHERE req_Id='$reqId'";
        $resultu = $conn->query($sqlu);

        if($resultu){
            
        }

        else{
           
        }
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

    <!-- Animation Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Font Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- CSS LINK -->
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



<body style="overflow-x: hidden;">

    <!-- <div class="fluid-container " style="height: 100vh; width: 100%; background: #E1E1E1"> -->
    <div class="fluid-container py-5" style="min-height: 100vh; width: 100%; background: #fff">
        <div class="" style="height: 100%; width: 100%; flex-direction: column">

        <div class="row">
            <div class="col-md-2" >
                <?php require_once("navphp/arNav.php");?>
            </div>

            <div class="col-md-10 qwe">

                <div class="row mt-3">
                    <div class="col-md-6 pl-5 mb-3 ">
                        
                    </div>

                    <div class="col-md-6 d-flex justify-content-end pr-5 mb-3">
                        <!-- <form action="ar_search.php" method="POST" class="d-flex">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search AR No." style="width: 70%;">
                            <input type="submit" value="Search" name="searchBtn" class="ml-3 btn btn-dark">
                        </form> -->
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 pl-5 mb-3 ">
                        
                    </div>

                    <div class="col-md-6 d-flex justify-content-end pr-5 mb-3 ">
                        <!-- <a href="ar_list_export_view.php" class="btn btn-success ">Export to Excel</a> -->
                        <!-- <a href="ar_export_excel.php?form=AR" class="btn btn-success ">Export to Excel</a> -->
                        <!-- <form action="" method="POST" class="mr-4">
                            <input type="submit" class="btn btn-success " value="Export to Excel">
                        </form> -->
                    </div>
                </div>

                

                <div class="bg-success" style="width: 90%; padding: 8px 20px; margin: 0 auto;" >
                    <h5 class="mb-0 text-light">Requested List</h5>
                </div>
                
                <?php 
                    
                    $sql = "SELECT r.req_Id, r.officials_Id, r.form_Id, r.form, r.date_request, r.status, r.token, r.token_expire, o.officials_Id, o.name, a.ar_Id, a.ar_Number FROM request_list r INNER JOIN officials o ON r.officials_Id = o.officials_Id INNER JOIN ar a ON r.form_Id = a.ar_Id WHERE r.status='Pending'";
                    $result = $conn->query($sql);

                ?>

                <table class="table table-bordered table-hover table-sm" style="width: 90%; margin: 0 auto;">
                    <thead style="width: 100%;">
                        <tr>
                        <th scope="col" class="d-none">Request Id.</th>
                        <th scope="col" class="d-none">Official Id.</th>
                        <th scope="col" class="d-none">Form ID</th>
                        <!-- <th scope="col">Token Expire</th> -->
                        <th scope="col">Requested By</th>
                        <th scope="col">AR No.</th>
                        
                        <th scope="col">Form</th>
                        <th scope="col">Date Requested</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>

                    
                    <tbody>

                        <?php if($result->num_rows > 0){?>
                            <?php while($rows = $result->fetch_assoc()){?>
                        <tr>
                            <td class="d-none"><?php echo $rows['req_Id'];?></td>
                            <td class="d-none"><?php echo $rows['officials_Id'];?></td>
                            <td class="d-none"><?php echo $rows['form_Id'];?></td>
                            <!-- <td><?php echo $rows['token_expire'];?></td> -->
                            <td><?php echo $rows['name'];?></td>
                            <td><?php echo $rows['ar_Number'];?></td>
                            <td><?php echo $rows['form'];?></td>
                            <td><?php echo $rows['date_request'];?></td>
                            <td><?php echo $rows['status'];?></td>
                            
                            <td class="d-flex" style="justify-content: space-around">
                                <!-- <form action="" id="ar-accept-form" >
                                    <input type="text" class="d-none" name="req_Id" value="<?php echo $rows['req_Id'];?>">
                                    
                                    <input type="submit" class="btn btn-success btn-sm" name="acceptReqBtn" value="Confirmed">
                                </form> -->

                                <form action="" id="ar-accept-form" method="POST">
                                    <input type="text" class="d-none" name="officials_Id" value="<?php echo $rows['officials_Id'];?>">
                                    <input type="text" class="d-none" name="req_Id" value="<?php echo $rows['req_Id'];?>">
                                    
                                    <input type="submit" class="btn btn-success btn-sm" id="acceptReqBtn" name="acceptReqBtn" value="Confirmed">
                                </form>

                            </td>

                        </tr>
                            <?php }?>
                        <?php }?>
                    </tbody>
                </table>
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

    $(document).ready(function(){

        



        // START FOR CONFIRMED REQUEST AJAX

        // $("#acceptReqBtn").click(function(e){
        //         e.preventDefault();
        //         console.log("napindot si a");
        //         // e.preventDefault();

        //         $.ajax({
        //             url: "request_process.php",
        //             method: "POST",
        //             data: $("#ar-accept-form").serialize() + "&action=confirmedReqAR",
        //             success : function (response){

        //                 console.log(response)

        //                 if(response == "successconfirmedrequest"){
        //                         Swal.fire({
        //                             position: 'center',
        //                             icon: 'success',
        //                             title: 'Successfully Confirmed the Request!',
        //                             showConfirmButton: false,
        //                             timer: 1300  
        //                         }).then(function(){
        //                             window.location = "ar_list.php";
        //                         })
        //                 }

        //                 else if(response == "errorconfirmedrequest"){
        //                         Swal.fire({
        //                             position: 'center',
        //                             icon: 'success',
        //                             title: 'There is an error, Please try again',
        //                             showConfirmButton: false,
        //                             timer: 1300  
        //                         }).then(function(){
        //                             window.location = "ar_list.php";
        //                         })
        //                 }
                        
        //             }
        //         })
        // })
        
    })
</script>



<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>