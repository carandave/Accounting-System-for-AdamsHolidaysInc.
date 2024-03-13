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
                <?php require_once("navphp/saNav.php");?>
            </div>

            <div class="col-md-10 qwe">

                <div class="row mt-3">
                    <div class="col-md-6 pl-5 mb-3 ">
                        
                    </div>

                    <div class="col-md-6 d-flex justify-content-end pr-5 mb-3 ">
                        <a href="sa_export_excel.php?form=SA" class="btn btn-success ">Export to Excel</a>
                        <!-- <form action="" method="POST" class="mr-4">
                            <input type="submit" class="btn btn-success " value="Export to Excel">
                        </form> -->
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-8 pl-5 mb-3 ">
                        <form action="sa_list_export_filter_view.php" method="POST">
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
                    <h5 class="mb-0 text-light">Statement of Account List</h5>
                </div>
                

                <table class="table table-bordered table-hover table-sm" style="width: 90%; margin: 0 auto;">
                    <thead style="width: 100%;">
                        <tr>
                            <th scope="col" class="d-none">SA ID.</th>
                            <th scope="col">SA No.</th>
                            <th scope="col">AR No.</th>
                            <th scope="col">PO No.</th>
                            <th scope="col">Name of Client</th>
                            <th scope="col">Agent</th>
                            <th scope="col">Group Name</th>
                            <!-- <th scope="col">Particular</th> -->
                            <th scope="col">C/O</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>

                    <?php 
                    
                    $sql = "SELECT * FROM sa WHERE archive='No' ORDER BY sa_Id DESC";
                    $result = $conn->query($sql);
                    ?>
                    <tbody>

                        <?php if($result->num_rows > 0){?>
                            <?php while($rows = $result->fetch_assoc()){?>
                        <tr>
                        <td class="d-none"><?php echo $rows['sa_Id'];?></td>
                            <td><?php echo $rows['sa_Number'];?></td>
                            <td><?php echo $rows['or_No'];?></td>
                            <td><?php echo $rows['po_No'];?></td>
                            <td><?php echo $rows['name_of_client'];?></td>
                            <td><?php echo $rows['agent'];?></td>
                            <td><?php echo $rows['group_name'];?></td>
                            <!-- <td><?php echo $rows['particulars'];?></td> -->
                            
                            
                            <td><?php echo $rows['co'];?></td>
                            <td><?php echo $rows['date'];?></td>
                        </tr>
                            <?php }?>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        
        

        </div>
    </div>

    <div id="myModal" class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- <div class="modal-header">
                <h4 class="modal-title">Archive User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div> -->

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

            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="form-delete-user" class="btn btn-danger" id="restore_archive_btn" data-dismiss="modal">Archive</button>
            </div> -->
            
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

    $(document).ready(function(){

        $("#archive_btn").click(function(e){
                e.preventDefault();
                console.log("napindot si a");
                // e.preventDefault();

                $.ajax({
                    url: "archive_process.php",
                    method: "POST",
                    data: $("#form-archive-user").serialize() + "&action=archivePO",
                    success : function (response){

                        if(response == "successArchive"){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Successfully Archived!',
                                    showConfirmButton: false,
                                    timer: 1300  
                                }).then(function(){
                                    window.location = "po_archive_list.php";
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
                                    window.location = "po_archive_list.php";
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