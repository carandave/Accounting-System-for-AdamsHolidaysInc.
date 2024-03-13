<?php 

    session_start();

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
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

.greet{
    position: absolute;
    top: 15%;
    padding: 8px 20px;
    font-size: 18px;
    border-radius: 5px;
}
</style>



<body style="overflow-y: hidden;">

    



    <div class="fluid-container " style="height: 100vh; width: 100%; background: #E1E1E1">
        <div class="container" style="height: 100%; width: 100%;">

                <h4 class="greet bg-dark text-light animate__bounceIn">Hi! <?php echo $_SESSION['name'];?></h4>
            
                <div class="row " style="height: 100%; width: 100%; " >
                    <div class="col-md-3 d-flex justify-content-center align-items-center " style="height: 100%; width: 100%;">
                        <div class="box p-3 animate__bounceIn d-flex justify-content-center align-items-center" style="background: #B8CABA; flex-direction: column; min-height: 50%; width: 100%; border-radius: 20px;" >
                            <i class="icon fa-solid fa-plane" ></i>
                            <h3 class="heading-box my-4">P O</h3>
                            <a href="po_list.php" class="button">VIEW</a>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex justify-content-center align-items-center" style="height: 100%; width: 100%;">
                        <div class="box p-3 bg-dark animate__bounceIn d-flex justify-content-center align-items-center" style="flex-direction: column; min-height: 50%; width: 100%; border-radius: 20px;">
                            <i class="icon fa-sharp fa-solid fa-file-invoice"></i>
                            <h3 class="heading-box my-4">S O A</h3>
                            <a href="sa_list.php" class="button">VIEW</a>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex justify-content-center align-items-center" style="height: 100%; width: 100%;">
                        <div class="box p-3 bg-success animate__bounceIn d-flex justify-content-center align-items-center" style="flex-direction: column; min-height: 50%; width: 100%; border-radius: 20px;">
                            <i class="icon fa-solid fa-receipt"></i>
                            <h3 class="heading-box my-4">A R</h3>
                            <a href="ar_add.php" class="button">VIEW</a>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex justify-content-center align-items-center" style="height: 100%; width: 100%;">
                        <div class="box p-3 bg-danger animate__bounceIn d-flex justify-content-center align-items-center" style="flex-direction: column; min-height: 50%; width: 100%; border-radius: 20px;">
                            <i class="icon fa-solid fa-money-check"></i>
                            <h3 class="heading-box my-4">C V</h3>
                            <a href="cv_list.php" class="button">VIEW</a>
                        </div>
                    </div>
                </div>

        </div>
    </div>



<script>
    $(document).ready(function(){
        // console.log("Hello World")
    })
</script>



<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>