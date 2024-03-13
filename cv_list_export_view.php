<?php 
    require_once "connection.php";

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
                <?php require_once("navphp/cvNav.php");?>
            </div>

            <div class="col-md-10 qwe">

            <div class="row mt-3">
                    <div class="col-md-6 pl-5 mb-3 ">
                        
                    </div>

                    <div class="col-md-6 d-flex justify-content-end pr-5 mb-3 ">
                        <a href="cv_export_excel.php?form=CV" class="btn btn-success ">Export to Excel</a>
                        <!-- <form action="" method="POST" class="mr-4">
                            <input type="submit" class="btn btn-success " value="Export to Excel">
                        </form> -->
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-8 pl-5 mb-3 ">
                        <form action="cv_list_export_filter_view.php" method="POST">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="" class="font-weight-bold">From Date:</label>
                                    <input type="date" name="from" class="form-control">
                                </div>

                                <div class="col-md-5">
                                    <label for="" class="font-weight-bold">To Date:</label>
                                    <input type="date" name="to" class="form-control">
                                </div>

                                <div class="col-md-2">
                                    <label for="" class="font-weight-bold">Filter Export:</label>
                                    <input type="submit" name="exportBtn" value="Filter" class="btn-secondary form-control">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-4 d-flex justify-content-end pr-5 mb-3 ">
                        
                        <!-- <a href="ar_export_excel.php?form=AR" class="btn btn-success ">Export to Excel</a> -->
                        <!-- <form action="" method="POST" class="mr-4">
                            <input type="submit" class="btn btn-success " value="Export to Excel">
                        </form> -->
                    </div>
                </div>

                

                <div class="bg-success" style="width: 90%; padding: 8px 20px; margin: 0 auto;" >
                    <h5 class="mb-0 text-light">Check Voucher List</h5>
                </div>
                

                <table class="table table-bordered table-hover table-sm" style="width: 90%; margin: 0 auto;">
                    <thead style="width: 100%;">
                        <tr>
                        <th scope="col" class="d-none">CV ID.</th>
                        <th scope="col" class="">CV No.</th>
                        <th scope="col">Payee</th>
                        <th scope="col">Date</th>
                        <th scope="col">Agent</th>
                        <!-- <th scope="col">Particular</th> -->
                        <!-- <th scope="col">Date</th> -->
                        <th scope="col">Payment Method</th>
                        <!-- <th scope="col">Status</th> -->
                        <th scope="col">Total Amount</th>
                        <th scope="col">Date Received</th>
                        </tr>
                    </thead>

                    <?php 
                    
                    $sql = "SELECT * FROM cv WHERE archive='No' ORDER BY payment_method='PHP' DESC";
                    $result = $conn->query($sql);
                    ?>
                    <tbody>

                        <?php if($result->num_rows > 0){?>
                            <?php while($rows = $result->fetch_assoc()){?>
                        <tr>
                            
                            
                            <td class="d-none"><?php echo $rows['cv_Id'];?></td>
                            <td><?php echo $rows['cv_Number'];?></td>
                            <td><?php echo $rows['payee'];?></td>
                            <td><?php echo $rows['date'];?></td>
                            <td><?php echo $rows['agent'];?></td>
                            <!-- <td><?php echo $rows['particular'];?></td> -->
                            <!-- <td><?php echo $rows['date'];?></td> -->
                            
                            
                            <td><?php echo $rows['payment_method'];?></td>
                            <td><?php echo $rows['total_amount'];?></td>
                            <td><?php echo $rows['date_received'];?></td>
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

</script>



<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>