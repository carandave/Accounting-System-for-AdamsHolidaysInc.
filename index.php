<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adams Holidays, Inc</title>

    <!-- Css Link -->
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap Links  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- JQUERY Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

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

</style>



<body>

    <div class="section-one fluid-container">
        <div class="container">
            <div class="box-container d-flex justify-content-center align-items-center">
                

                <div class="row" style="width: 100%; min-height: 70%">
                    
                    <div class="col-md-12">

                        <form action="" method="POST" id="login_form" class="form d-flex justify-content-center p-5 animate__bounceIn" style="flex-direction: column">
                            <h2>ADAMS HOLIDAYS</h2> 
                            <hr class="line mb-3" >   
                            <h4 class="text-center">LOGIN</h4>
                            
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-user mr-2"></i>
                                <input type="text" name="username" class="username" placeholder="Username" required autofocus>
                            </div>

                            <div class="mt-3 d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-lock mr-2"></i>
                                <input type="password" name="password" class="password" placeholder="Password" required>
                            </div>
              
                            <input type="submit" id="login_btn" class="login mt-4" value="LOGIN">
                        </form>

                    </div>
                </div>

                
            </div>
        </div>
    </div>

<!-- Sweetalert Cdn Start -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Sweetalert Cdn End -->

<script>
    $(document).ready(function(){
        // console.log("Hello World")

        $("#login_btn").click(function(e){
            e.preventDefault();

           $.ajax({
                url: "login_process.php",
                method: "POST",
                data: $("#login_form").serialize() + "&action=login",
                success: function(response){
                    if(response == "Valid"){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Successfully Log in!',
                            showConfirmButton: false,
                            timer: 1300  
                        }).then(function(){
                            window.location = "dashboard.php";
                        })
                    }

                    else if(response == "Invalid"){
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Invalid Credentials!',
                            showConfirmButton: false,
                            timer: 1300  
                        })
                        // }).then(function(){
                        //     window.location = "index.php";
                        // })
                    }
                }
           });

        })


    })
</script>



<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>