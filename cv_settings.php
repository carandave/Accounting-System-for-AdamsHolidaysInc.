<?php 
    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    else{
        $officialId =  $_SESSION['officialsId'];
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

    
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="assets/jquery.signature.css" rel="stylesheet">

    

</head>

<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;700;800;900;1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

body{
    font-family: 'Nunito', sans-serif;
    font-family: 'Roboto', sans-serif;
}


.kbw-signature { 
    width: 400px; height: 150px;
}

#sig canvas{
    width: 100% !important;
    height: auto;
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

            <div class="col-md-10 qwe">

                <div class="bg-success" style="width: 80%; padding: 8px 20px; margin: 0 auto;" >
                    <h5 class="mb-0 text-light">Settings </h5>
                </div>

                <?php 
                
                $sql = "SELECT * FROM officials WHERE officials_Id='$officialId'";
                $result = $conn->query($sql);
                
                ?>
                
                <?php if($result->num_rows > 0){?>
                    <?php while($rows = $result->fetch_assoc()){?>
                <form action="" method="POST" id="acc-form" style="width: 80%; margin: 0 auto;" >
                    <div class="row mb-3 mt-3">
                        <div class="col-md-6">
                            <input type="text" name="official_Id" id="" value="<?php echo $rows['officials_Id'];?>" class="d-none form-control" required>
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Username:</label>
                            <input type="text" name="username" id="" value="<?php echo $rows['username'];?>" class="form-control " required>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Name:</label>
                            <input type="text" name="name" id="" value="<?php echo $rows['name'];?>" class="form-control " required>
                        </div>
                    </div>

                    <small class="mt-5 text-danger">Note: If you don't want to change your password just leave it blank.</small>
                    <div class="row mt-1">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Password:</label>
                            <input type="text" name="new_password" id="" class="form-control " >
                            <input type="text" name="real_password" id="" class="d-none form-control" value="<?php echo $rows['password'];?>">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Confirm Password:</label>
                            <input type="text" name="confirm_password" id="" class="form-control form-control" >
                        </div>
                    </div>

                    <input type="submit" name="editAcc" value="Save" id="editAccBtn" class="btn btn-success mt-3">
                </form>

                    <?php } ?>
                <?php } ?>






                <?php 
                
                $sqld = "SELECT * FROM officials WHERE officials_Id='$officialId'";
                $resultd = $conn->query($sqld);
                
                ?>
                
                <?php if($resultd->num_rows > 0){?>
                    <?php while($rowsd = $resultd->fetch_assoc()){?>
                <form action="" method="POST" id="sign-form" class="mt-5" style="width: 80%; margin: 0 auto;" >
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" name="official_Id" id="" value="<?php echo $rowsd['officials_Id'];?>" class="d-none form-control" required>
                            
                            <label class="" for="">Signature:</label>

                            <div>
                                <div id="sig"></div>
                                
                                <textarea name="signed" id="signature64" style="display: none"></textarea>
                            </div>

                            <div>
                                <button id="clear" class="btn btn-primary">Clear Signature</button>
                                <!-- <button class="btn btn-success">Update Signature</button> -->

                                <input type="submit" name="editSignBtn" value="Update Signature" id="editSignBtn" class="btn btn-success">
                            </div>
                            
                            

                        </div>

                        <div class="col-md-6">
                            
                        </div>
                    </div>

                    <!-- <input type="submit" name="editAcc" value="Save" id="editAccBtn" class="btn btn-success mt-3"> -->
                </form>

                    <?php } ?>
                <?php } ?>
            

                
            </div>
        </div>

            </div>
        </div>


        
        

        </div>
    </div>

<!-- Sweetalert Cdn Start -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Sweetalert Cdn End -->


<!-- JS SCRIPT -->
<script src="ar.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="assets/jquery.signature.js"></script>
<script>

    $(document).ready(function(){

    var sig = $('#sig').signature({
	syncField: '#signature64', 
	syncFormat: 'PNG'
    });

    $('#clear').click(function (e){
        e.preventDefault();
        sig.signature('clear');
        $('#signature64').val('');
    })  

    $("#editSignBtn").click(function (e){
            e.preventDefault();

            $.ajax({
                url: "edit_process.php",
                method:"POST",
                data: $("#sign-form").serialize() + "&action=editSign",
                success : function (response) {
                    if(response == "SuccessSign"){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Signature Edited Successfully!',
                            showConfirmButton: false,
                            timer: 1300  
                        }).then(function(){
                            window.location = "ar_settings.php";
                        })
                    }

                    // else if(response == "Fail"){
                    //     Swal.fire({
                    //         position: 'center',
                    //         icon: 'error',
                    //         title: 'The New Password and Confirm Password must be same!',
                    //         showConfirmButton: false,
                    //         timer: 2000  
                    //     })
                    // }

                    
                }

            })
        });

        // var sig = $('#sig').signature({
        //     syncField: '#signature64', 
	    //     syncFormat: 'PNG'
        // });
        // $('#disable').click(function() {
        //     var disable = $(this).text() === 'Disable';
        //     $(this).text(disable ? 'Enable' : 'Disable');
        //     sig.signature(disable ? 'disable' : 'enable');
        // });
        // $('#clear').click(function() {
        //     sig.signature('clear');
        // });
        // $('#json').click(function() {
        //     alert(sig.signature('toJSON'));
        // });
        // $('#svg').click(function() {
        //     alert(sig.signature('toSVG'));
        // });

        

        $("#editAccBtn").click(function (e){
            e.preventDefault();

            $.ajax({
                url: "edit_process.php",
                method:"POST",
                data: $("#acc-form").serialize() + "&action=editAcc",
                success : function (response) {
                    if(response == "Success"){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Edited Successfully!',
                            showConfirmButton: false,
                            timer: 1300  
                        }).then(function(){
                            window.location = "ar_settings.php";
                        })
                    }

                    else if(response == "Fail"){
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'The New Password and Confirm Password must be same!',
                            showConfirmButton: false,
                            timer: 2000  
                        })
                    }

                    
                }

            })
        });

        
    })
</script>



<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>