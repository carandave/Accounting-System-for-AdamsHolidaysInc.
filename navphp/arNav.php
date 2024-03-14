<div class="bg-dark" style="width: 15%; height: 100%; position: fixed; top: 0; overflow: hidden">
    <ul class="nav nav-primarybg-success d-flex justify-content-center align-items-center mb-0 mt-4" style="flex-direction: column; width: 100%;">
        <li style="list-style: none; width: 100%; " class="nav-item p-2 text-center"><a href="" style="text-decoration: none" class="text-light"><img src="img/LogoAdam.png" alt="" style="height: 80px;"></a></li>
        <li style="list-style: none; width: 100%; " class="nav-item bg-success mt-2 p-2 text-center "><a href="" style="text-decoration: none" class="text-light">ADAMS HOLIDAYS, INC.</a></li>
        <!-- <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="ar_list.php" style="text-decoration: none" class="text-light">AR List</a></li>
        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center"><a href="ar_audit_trail.php" style="text-decoration: none" class="text-light">Audit Trail</a></li> -->

        <?php if($_SESSION['usertype'] == "superadmin" || $_SESSION['usertype'] == "admin"){?>
        <li style="list-style: none; width: 100%; " class="nav-item mt-3 p-2 text-center" >
            <div class="dropdownli">
                <a href="official_list.php" style="font-size: 14px; text-decoration: none" class="px-3 py-2 text-light selectli ">Official List </a>
            </div>
        </li>
        <?php } ?>

        <li style="list-style: none; width: 100%; " class="nav-item p-2 text-center">
            <div class="dropdownli">
                <a href="ar_list.php" style="text-decoration: none; font-size: 14px;" class="px-3 py-2 text-light selectli ">AR List</a>
            </div>
            
        </li>

        <?php if($_SESSION['usertype'] == "superadmin" || $_SESSION['usertype'] == "admin"){?>

        <li style="list-style: none; width: 100%; " class="nav-item p-2 text-center">
            <div class="dropdown" >
            <div class="select">
                <span class="selected" style="font-size: 14px;">Activity Logs</span>
                <div class="caret">

                </div>
            </div>

            <ul class="menu">
                <li class=""><a href="ar_audit_add.php" style="font-size: 14px; text-decoration: none; color: #fff">Added</a></li>
                <li><a href="ar_audit_view.php" style="font-size: 14px;text-decoration: none; color: #fff">Viewed</a></li>
                <li><a href="ar_audit_edit.php" style="font-size: 14px;text-decoration: none; color: #fff">Edited</a></li>
                
            </ul>
        </div>

        <?php } ?>

        <div class="dropdown d-none">
            <div class="select">
                <span class="selected">Facebook</span>
                <div class="caret">

                </div>
            </div>

            <ul class="menu">
                <li class="active">Facebook</li>
                <li>Instagram</li>
                <li>Twitted</li>
                <li>Linkedin</li>
                <li>Tiktok</li>
            </ul>
        </div>
        </li>

        <?php if($_SESSION['usertype'] == "user"){?>
            <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center" >
            <div class="dropdownli">
                <a href="ar_request_list.php" style="font-size: 14px; text-decoration: none" class="px-3 py-2 text-light selectli ">Requested List </a>
            </div>
            
            </li>

        <?php } ?>

        <?php if($_SESSION['usertype'] == "superadmin" || $_SESSION['usertype'] == "admin"){?>
            <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center" id="ar-a-notif">
            <div class="dropdownli">
                <a href="ar_request_list_admin.php" style="font-size: 14px; text-decoration: none" class="px-3 py-2 text-light selectli ">AR Requested List <span class="badge badge-danger" id="ar_badge" style="position: absolute; top: -10px; right: 10px; font-size: 12px; padding: 5 5px; ">0</span></a>
            </div>
            
            </li>
        <?php } ?>

        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center">
            <div class="dropdownli">
                <a href="ar_archive_list.php" style="font-size: 14px; text-decoration: none" class="px-3 py-2 text-light selectli ">Archived List</a>
            </div>
            
        </li>

        

        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center">
            <div class="dropdownli">
                <a href="ar_settings.php" style="font-size: 14px; text-decoration: none" class="px-3 py-2 text-light selectli ">Settings</a>
            </div>
            
        </li>

        <li style="list-style: none; width: 100%; " class="nav-item  p-2 text-center">
            <div class="dropdownli">
                <a href="logout.php" style="font-size: 14px; text-decoration: none" class="px-3 py-2 text-light selectli ">Logout</a>
            </div>
            
        </li>

        <li style="list-style: none; width: 100%; " class="nav-item p-2 text-center">
            <div class="dropdownli">
                <a href="dashboard.php" style="font-size: 14px;text-decoration: none" class="px-3 py-2 text-light selectli ">Home</a>
            </div>
            
        </li>
    </ul>
</div>

<script>
                    $(document).ready(function(){
                        $('#ar_badge').hide();
                        setInterval(() => {

                            // For Admin Notification
                            $.ajax({
                                url: './notif_process.php',
                                method: 'POST',
                                data: 'ar-id=<?php echo $_SESSION['officialsId']; ?>',
                                success: function(response){
                                    console.log(response);

                                        if(response != 0){
                                            $('#ar_badge').show();
                                            $('#ar_badge').text(response);
                                        }

                                        else{
                                            $('#ar_badge').hide();
                                            $('#ar_badge').text(0);
                                        }
                                }
                            })


                            // For User Notification
                            // $.ajax({
                            //     url: './notif_user_process.php',
                            //     method: 'POST',
                            //     data: 'user_id=<?php echo $_SESSION['officialsId']; ?>',
                            //     success: function(response){
                            //         console.log(response);

                            //             if(response != 0){
                            //                 // $('#po_user_badge').show();
                            //                 $('#po_user_badge').text(response);
                            //             }

                            //             else{
                            //                 // $('#po_user_badge').hide();
                            //                 $('#po_user_badge').text(0);
                            //             }
                            //     }
                            // })
                            
                        }, 1000);

                        

                    })
                </script>