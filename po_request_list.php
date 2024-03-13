<?php 
    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    $officials_Id = $_SESSION['officialsId'];

    if($_SESSION['usertype'] == "admin" || $_SESSION['usertype'] == "superadmin"){
        header("Location: po_list.php");
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
                <?php require_once("navphp/poNav.php");?>
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
                    <h5 class="mb-0 text-light">Requested Purchase Order List</h5>
                </div>
                
                <?php 
                    
                    $sql = "SELECT r.req_Id, r.officials_Id, r.form_Id, r.form, r.date_request, r.status, r.token, r.token_expire, o.officials_Id, o.name, p.po_Id, p.po_Number FROM request_list r INNER JOIN officials o ON r.officials_Id = o.officials_Id INNER JOIN po p ON r.form_Id = p.po_Id WHERE r.officials_Id = $officials_Id AND r.token_expire>NOW() ";
                    $result = $conn->query($sql);

                ?>

                <table class="table table-bordered table-hover table-sm" style="width: 90%; margin: 0 auto;">
                    <thead style="width: 100%;">
                        <tr>
                        <th scope="col" class="d-none">Request Id.</th>
                        <th scope="col" class="d-none">Official Id.</th>
                        <th scope="col" class="d-none">Form ID</th>
                        <!-- <th scope="col">Token Expire</th> -->
                        <th scope="col">Name of Official</th>
                        <th scope="col">PO No.</th>
                        
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
                            <td><?php echo $rows['po_Number'];?></td>
                            <td><?php echo $rows['form'];?></td>
                            <td><?php echo $rows['date_request'];?></td>
                            <td><?php echo $rows['status'];?></td>
                            
                            <td class="d-flex" style="justify-content: space-around">
                                <form action="po_edit.php" method="POST">
                                    <input type="text" class="d-none" name="req_Id" value="<?php echo $rows['req_Id'];?>">
                                    <input type="text" class="d-none" name="officials_Id" value="<?php echo $rows['officials_Id'];?>">
                                    <input type="text" class="d-none" name="form_Id" value="<?php echo $rows['form_Id'];?>">
                                    <input type="text" class="d-none" name="status" value="<?php echo $rows['status'];?>">
                                    <input type="text" class="d-none" name="token" value="<?php echo $rows['token'];?>">
                                    <input type="text" class="d-none" name="token_expire" value="<?php echo $rows['token_expire'];?>">
                                    <input type="submit" class="btn btn-secondary btn-sm" name="editBtnReq" value="EDIT">
                                </form>

                                <!-- <button type="button" class="btn btn-secondary btn-sm" data-id="<?php echo $rows['ar_Id'];?>" onclick="requestEditModal(this);">
                                    Request Edit
                                </button>

                                <div id="editModal" class="modal fade" >
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-body d-flex justify-content-center align-items-center" style="height: 200px; width: 100%; flex-direction: column;  ">
                                                <p class="h5">Are you sure you want to Request for edit?</p>
                                                <form action="" id="form-edit-user">
                                                    <input type="text" name="id" class="">
                                                    <input type="text" name="officials_Id" value="<?php echo $officials_Id;?>" class="d-none">
                                                </form>

                                                <div class="d-flex justify-content-center align-items-center mt-3 px-5" style="flow-direction: column; width: 100%;" >
                                                    <button type="button" style="width: 49%;" class="btn btn-default mr-1" data-dismiss="modal">Close</button>
                                                    <button type="submit" style="width: 49%;" form="form-edit-user" class="btn btn-danger ml-1" id="editReq_btn" data-dismiss="modal">Request</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="ar_view.php" method="POST">
                                    <input type="text" class="d-none" name="ar_Id" value="<?php echo $rows['ar_Id'];?>">
                                    <input type="submit" class="btn btn-primary btn-sm" name="view" value="VIEW">
                                </form>

                                
                                <form action="ar_view_print.php" method="POST" >
                                    <input type="text" class="d-none" name="ar_Id" value="<?php echo $rows['ar_Id'];?>">
                                    <input type="submit" class="btn btn-info btn-sm" name="viewPrint" value="PRINT">
                                </form>
                                

                                <button type="button" class="btn btn-danger btn-sm" data-id="<?php echo $rows['ar_Id'];?>" onclick="confirmDelete(this);">
                                    Archive
                                </button>

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

        



        // START FOR EDIT REQUEST AJAX

        $("#editReq_btn").click(function(e){
                e.preventDefault();
                console.log("napindot si a");
                // e.preventDefault();

                $.ajax({
                    url: "request_process.php",
                    method: "POST",
                    data: $("#form-edit-user").serialize() + "&action=requestPO",
                    success : function (response){

                        console.log(response)

                        if(response == "successInsert"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Successfully Requested!',
                                    showConfirmButton: false,
                                    timer: 1300  
                                }).then(function(){
                                    window.location = "po_list.php";
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
                                    window.location = "po_list.php";
                                })
                        }
                        
                    }
                })
        })

        // EDIT FOR EDIT REQUEST AJAX


        // START FOR ARCHIVE AJAX

        $("#archive_btn").click(function(e){
                e.preventDefault();
                console.log("napindot si a");
                // e.preventDefault();

                $.ajax({
                    url: "archive_process.php",
                    method: "POST",
                    data: $("#form-archive-user").serialize() + "&action=archiveAR",
                    success : function (response){

                        if(response == "successArchive"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Successfully Archived!',
                                    showConfirmButton: false,
                                    timer: 1300  
                                }).then(function(){
                                    window.location = "ar_archive_list.php";
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
                                    window.location = "ar_archive_list.php";
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