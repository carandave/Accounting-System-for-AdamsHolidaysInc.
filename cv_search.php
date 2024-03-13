<?php 
    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    if(isset($_POST['searchBtn'])){
        $cvNoSearch = $_POST['search'];

        $officials_Id = $_SESSION['officialsId'];
    }

    else{
        header('Location: cv_list.php');
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
                <?php require_once("navphp/cvNav.php");?>
            </div>

            <div class="col-md-10">

                <div class="row mt-3">
                    <div class="col-md-6 pl-5 mb-3 ">
                        <a href="cv_list.php" class="btn btn-success" style="width: 50%;">Back</a>
                    </div>

                    <div class="col-md-6 d-flex justify-content-end pr-5 mb-3">
                        <!-- <form action="" method="POST" class="d-flex">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search CV No." style="width: 70%;">
                            <input type="submit" value="Search" name="searchBtn" class="ml-3 btn btn-dark">
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
                        <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>

                    <?php 
                    
                    $sql = "SELECT * FROM cv WHERE archive='No' AND cv_Number like '%$cvNoSearch%' OR payee like '%$cvNoSearch%' ORDER BY cv_Id DESC";
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
                            <td class="d-flex" style="justify-content: space-around">
                                <?php if($_SESSION['usertype'] == "superadmin" || $_SESSION['usertype'] == "admin"){?>
                                <form action="cv_edit.php" method="POST">
                                    <input type="text" class="d-none" name="cv_Id" value="<?php echo $rows['cv_Id'];?>">
                                    <input type="submit" class="btn btn-secondary btn-sm" name="editPrint" value="EDIT">
                                </form>
                                <?php } ?>

                                <?php if($_SESSION['usertype'] == "user"){?>
                                <button type="button" class="btn btn-success btn-sm" data-id="<?php echo $rows['cv_Id'];?>" onclick="requestEditModal(this);">
                                    Request Edit
                                </button>

                                <div id="editModal" class="modal fade" >
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-body d-flex justify-content-center align-items-center" style="height: 200px; width: 100%; flex-direction: column;  ">
                                                <p class="h5">Are you sure you want to Request for edit?</p>
                                                <form action="" id="form-edit-user">
                                                    <input type="text" name="id" class="d-none">
                                                    <input type="text" name="officials_Id" value="<?php echo $officials_Id;?>" class="d-none">
                                                </form>

                                                <div class="d-flex justify-content-center align-items-center mt-3 px-5" style="flow-direction: column; width: 100%;" >
                                                    <button type="button" style="width: 49%;" class="btn btn-danger mr-1" data-dismiss="modal">Close</button>
                                                    <button type="submit" style="width: 49%;" form="form-edit-user" class="btn btn-success ml-1" id="editReq_btn" data-dismiss="modal">Request</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>

                                <form action="cv_view.php" method="POST">
                                    <input type="text" class="d-none" name="cv_Id" value="<?php echo $rows['cv_Id'];?>">
                                    <input type="submit" class="btn btn-primary btn-sm" name="view" value="VIEW">
                                </form>

                                <?php if($_SESSION['usertype'] == "superadmin" || $_SESSION['usertype'] == "admin"){?>

                                <form action="cv_view_print.php" method="POST" >
                                    <input type="text" class="d-none" name="cv_Id" value="<?php echo $rows['cv_Id'];?>">
                                    <input type="submit" class="btn btn-info btn-sm" name="viewPrint" value="PRINT">
                                </form>

                                <?php } ?>

                                <?php if($_SESSION['usertype'] == "superadmin" || $_SESSION['usertype'] == "admin"){?>

                                <button type="button" class="btn btn-danger btn-sm" data-id="<?php echo $rows['cv_Id'];?>" onclick="confirmDelete(this);">
                                    Archive
                                </button>

                                <?php } ?>

                                <div id="myModal" class="modal fade" >
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-body d-flex justify-content-center align-items-center" style="height: 200px; width: 100%; flex-direction: column;  ">
                                                <p class="h5">Are you sure you want to Archive?</p>
                                                <form action="" id="form-archive-user">
                                                    <input type="text" name="id" class="d-none">
                                                </form>

                                                <div class="d-flex justify-content-center align-items-center mt-3 px-5" style="flow-direction: column; width: 100%;" >
                                                    <button type="button" style="width: 49%;" class="btn btn-default mr-1" data-dismiss="modal">Close</button>
                                                    <button type="submit" style="width: 49%;" form="form-delete-user" class="btn btn-danger ml-1" id="archive_btn" data-dismiss="modal">Archive</button>
                                                </div>
                                            </div>

                                        </div>
                                </div>

                               
                                <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cv_archive_modal<?php echo $rows['cv_Id']?>">
                                Archive
                                </button>

                                
                                <div class="modal fade" id="cv_archive_modal<?php echo $rows['cv_Id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Do you want to Archive?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body d-flex justify-content-center align-items-center" style="flow-direction: column">
                                        <form action="" id="archive_form" style="width: 50%">
                                            <input type="text" class="" name="cv_archive_Id" value="<?php echo $rows['cv_Id']?>">
                                            
                                            <input type="submit" id="archive_btn" class="btn btn-success"  style="width: 100%" value="Save">
                                        </form>
                                    
                                        

                                        <button type="button" class="btn btn-danger ml-2" style="width: 50%" data-dismiss="modal">Close</button>
                                    </div>
                                    
                                    </div>
                                </div>
                                </div> -->
                                


                                
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

    function confirmDelete(self){
        var id = self.getAttribute("data-id");

        document.getElementById("form-archive-user").id.value = id;
        $("#myModal").addClass("animate__fadeInDown");
        $("#myModal").modal("show");
        
    }

    function requestEditModal(self){
        var id = self.getAttribute("data-id");

        document.getElementById("form-edit-user").id.value = id;
        $("#editModal").addClass("animate__fadeInDown");
        $("#editModal").modal("show");
        
    }

    $(document).ready(function(){
        // console.log("Hello World")

        // START FOR EDIT REQUEST AJAX

        $("#editReq_btn").click(function(e){
                e.preventDefault();
                console.log("napindot si a");
                // e.preventDefault();

                $.ajax({
                    url: "request_process.php",
                    method: "POST",
                    data: $("#form-edit-user").serialize() + "&action=requestCV",
                    success : function (response){

                        if(response == "successInsert"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Successfully Requested!',
                                    showConfirmButton: false,
                                    timer: 1300  
                                }).then(function(){
                                    window.location = "cv_search.php";
                                })
                        }

                        else if(response == "stillpending"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'warning',
                                    title: 'Can not request because your request is still pending',
                                    showConfirmButton: false,
                                    timer: 2000  
                                }).then(function(){
                                    window.location = "cv_search.php";
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
                                    window.location = "cv_search.php";
                                })
                        }
                        
                    }
                })
        })

        // EDIT FOR EDIT REQUEST AJAX

        $("#archive_btn").click(function(e){
                e.preventDefault();
                console.log("napindot si a");
                // e.preventDefault();

                $.ajax({
                    url: "archive_process.php",
                    method: "POST",
                    data: $("#form-archive-user").serialize() + "&action=archiveCV",
                    success : function (response){

                        if(response == "successArchive"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Successfully Archived!',
                                    showConfirmButton: false,
                                    timer: 1300  
                                }).then(function(){
                                    window.location = "cv_archive_list.php";
                                })
                        }

                        else if(response == "errorArchive"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'There is an error, Please try again',
                                    showConfirmButton: false,
                                    timer: 1300  
                                }).then(function(){
                                    window.location = "cv_archive_list.php";
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