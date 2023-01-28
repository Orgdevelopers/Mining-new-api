<?php 
if(isset($_SESSION[PRE_FIX.'id']))
{       
    
        $url=$baseurl . 'showUsers';
        $data =array();
        
        $json_data=@curl_request($data,$url);
        
        $allusers = [];
        if ($json_data['code'] == 200) {
            $allusers = $json_data['msg'];
        }

        ?>

        <div class="qr-content">
            <div class="qr-page-content">
                <div class="qr-page zeropadding">
                    <div class="qr-content-area">
                        <div class="qr-row">
                            <div class="qr-el">

                                <div class="page-title">
                                    <h2>All Users</h2>
                                    <div class="head-area">
                                    </div>
                                </div>
                                
                               
                                <table id="table_view" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Gender</th>
                                            <th>Brithday</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        if($json_data!="")
                                        {
                                            foreach ($json_data['msg'] as $singleRow): 
                                                    
                                                if($singleRow['User']['role']=="user" || $singleRow['User']['role']=="store")
                                                {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $singleRow['User']['id']; ?></td>
                                                        <td style="width:100px; overflow:hidden;"><?php echo $singleRow['User']['first_name'] . " " . $singleRow['User']['last_name']; ?></td>
                                                        <td style="width:100px; overflow:hidden;"><?php echo $singleRow['User']['username']; ?></td>
                                                        <td>
                                                            <?php echo $singleRow['User']['gender']; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if($singleRow['User']['dob']=="0000-00-00")
                                                                {
                                                                    echo "-";
                                                                }
                                                                else
                                                                {
                                                                    echo $singleRow['User']['dob'];
                                                                }
                                                            ?>
                                                            
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if($singleRow['User']['active']=="1")
                                                                {
                                                                    echo "Active";
                                                                }
                                                                else
                                                                if($singleRow['User']['active']=="2")
                                                                {
                                                                    echo "Blocked";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $singleRow['User']['created']; ?>
                                                        </td>
                                                        
                                                        
                                                        <td>
                                                            <div class="more">
                                                                <button id="more-btn" class="more-btn">
                                                                    <span class="more-dot"></span>
                                                                    <span class="more-dot"></span>
                                                                    <span class="more-dot"></span>
                                                                </button>
                                                                <div class="more-menu">
                                                                    <div class="more-menu-caret">
                                                                        <div class="more-menu-caret-outer"></div>
                                                                        <div class="more-menu-caret-inner"></div>
                                                                    </div>
                                                                    <ul class="more-menu-items" tabindex="-1" role="menu" aria-labelledby="more-btn" aria-hidden="true">
                                                                        <li class="more-menu-item" role="presentation" onclick="pushNotificationToUser('<?php echo $singleRow['User']['id']; ?>')">
                                                                            <button type="button" class="more-menu-btn" role="menuitem">Push Notification</button>
                                                                        </li>
                                                                        <li class="more-menu-item" role="presentation" onclick="viewUserDetails('<?php echo $singleRow['User']['id']; ?>')">
                                                                            <button type="button" class="more-menu-btn" role="menuitem">View Details</button>
                                                                        </li>
                                                                        <li class="more-menu-item" role="presentation" onclick="userInbox('<?php echo $singleRow['User']['id']; ?>')">
                                                                            <button type="button" class="more-menu-btn" role="menuitem">Inbox</button>
                                                                        </li>
                                                                        <li class="more-menu-item" role="presentation">
                                                                            <a href="process.php?action=deleteUser&user_id=<?php echo $singleRow['User']['id']; ?>">
                                                                                <button type="button" class="more-menu-btn" role="menuitem">Delete</button>
                                                                            </a>
                                                                        </li>
                                                                        
                                                                        <li class="more-menu-item" role="presentation">
                                                                            <?php
                                                                                if($singleRow['User']['active']=="1")
                                                                                {
                                                                                    ?>
                                                                                        <a href="process.php?action=blockUser&user_id=<?php echo $singleRow['User']['id']; ?>&active=2" >
                                                                                            <button type="button" class="more-menu-btn" role="menuitem">Block</button>
                                                                                        </a>
                                                                                    <?php
                                                                                }
                                                                                else
                                                                                if($singleRow['User']['active']=="2")
                                                                                {
                                                                                    ?>
                                                                                        <a href="process.php?action=blockUser&user_id=<?php echo $singleRow['User']['id']; ?>&active=1">
                                                                                            <button type="button" class="more-menu-btn" role="menuitem">Active</button>
                                                                                        </a>
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                            
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        
                                                        
                                                    </tr>
                                                <?php 
                                                }
                                            endforeach; 
                                        }
                                        
                                        
                                    ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Gender</th>
                                            <th>Brithday</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        
    <script>
        $(document).ready(function () {
            $('#table_view').DataTable({
                    "pageLength": 15
                }
            );
        });
    </script>
    <?php
    
} 
else 
{
	
	echo "<script>window.location='index.php'</script>";
    die;
    
} 

?>