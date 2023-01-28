<?php 
if(isset($_SESSION[PRE_FIX.'id']))
{       
    
        $url=$baseurl . 'showVideos';
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
                                    <h2>All Videos</h2>
                                    <div class="head-area">
                                    </div>
                                </div>
                                
                                <!--start of datatable here-->


                                <table id="table_view" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Description</th>
                                            <th>Video</th>
                                            <th>Views</th>
                                            <th>Comments</th>
                                            <th>Likes</th>
                                            <th>Hide Video</th>
                                            <th>Promoted</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        if(is_array($json_data['msg']) || is_object($json_data['msg']))
                                        {
                                            foreach ($json_data['msg'] as $singleRow): 
                                                
                                                ?>
                                                    <tr>
                                                        <td><?php echo $singleRow['Video']['id']; ?></td>
                                                        <td>
                                                                <?php 
                                                                    if($singleRow['Video']['description']=="")
                                                                    {
                                                                        echo "-";
                                                                    }
                                                                    else
                                                                    {
                                                                        echo substr($singleRow['Video']['description'],0,15);
                                                                    }
                                                                ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo checkVideoUrl($singleRow['Video']['video']); ?>" target="_blank">
                                                                <span class="fas fa-play-circle" style="color:black;"></span>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <?php echo $singleRow['Video']['view']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $singleRow['Video']['comment_count']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $singleRow['Video']['like_count']; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if($singleRow['Video']['block']=="1")
                                                                {
                                                                    echo"Blocked";
                                                                }
                                                                else
                                                                {
                                                                    echo "Active";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                           <?php
                                                                if($singleRow['Video']['promote']=="1")
                                                                {
                                                                    ?>
                                                                        <span class="fas fa-check" style="color:green;"></span>
                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    echo "-";
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
                                                                        <li class="more-menu-item" role="presentation" onclick="pushNotification('<?php echo $singleRow['Video']['id']; ?>')">
                                                                            <button type="button" class="more-menu-btn" role="menuitem">Push Notification</button>
                                                                        </li>
                                                                        
                                                                        <li class="more-menu-item" role="presentation" onclick="viewVideoDetails('<?php echo $singleRow['Video']['id']; ?>')">
                                                                            <button type="button" class="more-menu-btn" role="menuitem">View Details</button>
                                                                        </li>
                                                                        
                                                                        <li class="more-menu-item" role="presentation">
                                                                            <a href="process.php?action=deleteVideo&video_id=<?php echo $singleRow['Video']['id']; ?>">
                                                                                <button type="button" class="more-menu-btn" role="menuitem">Delete</button>
                                                                            </a>
                                                                        </li>
                                                                        
                                                                        <?php
                                                                            if($singleRow['Video']['promote']=="0")
                                                                            {
                                                                                ?>
                                                                                    <li class="more-menu-item" role="presentation">
                                                                                        <a href="process.php?action=promoteVideo&video_id=<?php echo $singleRow['Video']['id']; ?>&promote=1">
                                                                                            <button type="button" class="more-menu-btn" role="menuitem">Promote</button>
                                                                                        </a>
                                                                                    </li>
                                                                                <?php
                                                                            }
                                                                            else
                                                                            {
                                                                                ?>
                                                                                    <li class="more-menu-item" role="presentation">
                                                                                        <a href="process.php?action=promoteVideo&video_id=<?php echo $singleRow['Video']['id']; ?>&promote=0">
                                                                                            <button type="button" class="more-menu-btn" role="menuitem">UnPromote</button>
                                                                                        </a>
                                                                                    </li>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                        
                                                                        
                                                                        <?php
                                                                            if($singleRow['Video']['block']=="0")
                                                                            {
                                                                                ?>
                                                                                    <li class="more-menu-item" role="presentation">
                                                                                        <a href="process.php?action=blockVideo&video_id=<?php echo $singleRow['Video']['id']; ?>&status=1">
                                                                                            <button type="button" class="more-menu-btn" role="menuitem">Block Video</button>
                                                                                        </a>
                                                                                    </li>
                                                                                <?php
                                                                            }
                                                                            else
                                                                            {
                                                                                ?>
                                                                                    <li class="more-menu-item" role="presentation">
                                                                                        <a href="process.php?action=blockVideo&video_id=<?php echo $singleRow['Video']['id']; ?>&status=0">
                                                                                            <button type="button" class="more-menu-btn" role="menuitem">Unblock Video</button>
                                                                                        </a>
                                                                                    </li>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                        
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        
                                                        
                                                    </tr>
                                                <?php
                                            
                                            endforeach; 
                                        }
                                        
                                        
                                    ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Description</th>
                                            <th>Video</th>
                                            <th>Views</th>
                                            <th>Comments</th>
                                            <th>Likes</th>
                                            <th>Hide Video</th>
                                            <th>Promoted</th>
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