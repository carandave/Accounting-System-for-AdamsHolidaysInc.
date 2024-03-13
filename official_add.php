<?php 
    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    if($_SESSION['usertype'] == "user"){
        header("Location: index.php");
    }

    $officials_Id = $_SESSION['officialsId'];

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
                <?php require_once("navphp/defaultNav.php");?>
            </div>

            <div class="col-md-10 qwe">

            <div class="bg-success" style="width: 85%; padding: 8px 20px; margin: 0 auto;" >
                    <h5 class="mb-0 text-light">Official Entry Form</h5>
                </div>
                <form action="" id="createOfficials_Form" style="width: 85%; margin: 0 auto; border: 1px solid lightgray;" class="p-4" >
                    <input type="text" name="official_by" id="" value="<?php echo $officials_Id;?>" class="d-none form-control form-control-sm" readonly>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Name:</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm " required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>User Name:</label>
                            <input type="text" name="user_name" id="user_name" class="form-control "  required>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>User Type:</label>
                            <select name="user_type" id="" class="form-control">
                                <option value="">Select Type</option>
                                <option value="superadmin">Super Admin</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Password:</label>
                            <input type="password" name="password" id="password" class="form-control "  required>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bold"><span class="text-danger mr-1">*</span>Confirm Password:</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control "  required>
                        </div>
                    </div>

                    <input type="submit" id="addBtn" class="btn btn-success btn-block mt-3" value="Submit">
                    
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

    $(document).ready(function(){

        // START FOR EDIT REQUEST AJAX

        $("#addBtn").click(function(e){
                e.preventDefault();
                console.log("napindot si a");
                // e.preventDefault();

                $.ajax({
                    url: "add_process.php",
                    method: "POST",
                    data: $("#createOfficials_Form").serialize() + "&action=addOfficial",
                    success : function (response){

                        if(response == "successInsert"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Successfully Created!',
                                    showConfirmButton: false,
                                    timer: 1300  
                                }).then(function(){
                                    window.location = "official_list.php";
                                })
                        }
                        
                        else if(response == "Mismatch"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'The Password and Confirm Password are not match, Please try again!',
                                    showConfirmButton: false,
                                    timer: 3000  
                                }).then(function(){
                                    
                                })
                        }

                        else if(response == "EmptyInput"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Make sure the input fields are not empty, Please try again!',
                                    showConfirmButton: false,
                                    timer: 3000  
                                }).then(function(){
                                    
                                })
                        }


                        else if(response == "errorInsert"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'There is an error, Please try again',
                                    showConfirmButton: false,
                                    timer: 1300  
                                }).then(function(){
                                    window.location = "official_add.php";
                                })
                        }
                        
                    }
                })
        })

        
    })
</script>



<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>