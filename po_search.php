<?php 
    require_once "connection.php";

    if(!isset($_SESSION['usertype'])){
        header("Location: index.php");
    }

    if(isset($_POST['searchBtn'])){
        $poNoSearch = $_POST['search'];
    }

    else{
        header('Location: po_list.php');
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
                <?php require_once("navphp/poNav.php");?>
            </div>

            <div class="col-md-10">

                <div class="row mt-3">
                    <div class="col-md-6 pl-5 mb-3 ">
                        <a href="po_list.php" class="btn btn-success" style="width: 50%;">Back</a>
                    </div>

                    <div class="col-md-6 d-flex justify-content-end pr-5 mb-3">
                        <!-- <form action="" method="POST" class="d-flex">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search PO No." style="width: 70%;">
                            <input type="submit" value="Search" name="searchBtn" class="ml-3 btn btn-dark">
                        </form> -->
                    </div>
                </div>

                <div class="bg-success" style="width: 90%; padding: 8px 20px; margin: 0 auto;" >
                    <h5 class="mb-0 text-light">Purchase Order List</h5>
                </div>
                

                <table class="table table-bordered table-hover table-sm" style="width: 90%; margin: 0 auto;">
                    <thead style="width: 100%;">
                        <tr>
                            <th scope="col">PO No.</th>
                            <th scope="col">AR No.</th>
                            <th scope="col">Agent</th>
                            <th scope="col">Category</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Particular</th>
                            <th scope="col">CV</th>
                            <th scope="col">SA</th>
                            <th scope="col">Date</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>

                    <?php 
                    
                    // $sql = "SELECT * FROM po ORDER BY po_Id DESC ";
                    $sql = "SELECT * FROM po WHERE archive='No' AND po_Number like '%$poNoSearch%' OR supplier like '%$poNoSearch%' ";
                    $result = $conn->query($sql);
                    ?>
                    <tbody>

                        <?php if($result->num_rows > 0){?>
                            <?php while($rows = $result->fetch_assoc()){?>
                        <tr>
                        <td><?php echo $rows['po_Number'];?></td>
                            <td><?php echo $rows['or_No'];?></td>
                            <td><?php echo $rows['agent'];?></td>
                            <td><?php echo $rows['po_category'];?></td>
                            <td><?php echo $rows['supplier'];?></td>
                            <td><?php echo $rows['particular'];?></td>
                            <td><?php echo $rows['cv'];?></td>
                            <td><?php echo $rows['sa'];?></td>
                            <td><?php echo $rows['date'];?></td>
                            <td class="d-flex" style="justify-content: space-around">
                                <form action="po_edit.php" method="POST">
                                    <input type="text" class="d-none" name="po_Id" value="<?php echo $rows['po_Id'];?>">
                                    <input type="submit" class="btn btn-secondary btn-sm" name="editPrint" value="EDIT">
                                </form>

                                <form action="po_view.php" method="POST">
                                    <input type="text" class="d-none" name="po_Id" value="<?php echo $rows['po_Id'];?>">
                                    <input type="submit" class="btn btn-primary btn-sm" name="viewPo" value="VIEW">
                                </form>

                                <form action="po_view_print.php" method="POST" >
                                    <input type="text" class="d-none" name="po_Id" value="<?php echo $rows['po_Id'];?>">
                                    <input type="submit" class="btn btn-info btn-sm" name="viewPrint" value="PRINT">
                                </form>

                                <button type="button" class="btn btn-danger btn-sm" data-id="<?php echo $rows['po_Id'];?>" onclick="confirmDelete(this);">
                                    Archive
                                </button>

                                <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ar_archive_modal<?php echo $rows['po_Id']?>">
                                Archive
                                </button>

                                
                                <div class="modal fade" id="ar_archive_modal<?php echo $rows['po_Id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                            <input type="text" class="" name="po_archive_Id" value="<?php echo $rows['po_Id']?>">
                                            
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

    <!-- JS SCRIPT -->
<script src="ar.js"></script>


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