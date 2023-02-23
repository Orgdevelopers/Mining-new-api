<?php
require_once("Api.php");
$allwallets = [];
$allwallets = getAllTaskRequests();
//$allplans = getAllInvestPlans();

?>

<div class="qr-content">
    <div class="qr-page-content">
        <div class="qr-page zeropadding">
            <div class="qr-content-area">
                <div class="qr-row">
                    <div class="qr-el">

                        <div class="page-title">
                            <h2>Task Complete Requests</h2>
                            <div class="head-area">
                            </div>
                        </div>


                        <table id="table_view" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User ID</th>
                                    <th>Task ID</th>
                                    <th>Attachment</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                             
                                if ($allwallets != null) {
                                    //rsort($allwallets);
                                    foreach ($allwallets as $singleRow) :

                                ?>
                                        <tr>
                                            <td><?php echo $singleRow['id']; ?></td>
                                         
                                            <td><?php  
                                            echo $singleRow['user_id']?></td>
                                            

                                            <td>
                                                <?php echo $singleRow['task_id'];?>
                                            </td>
  
                                            <td>
                                                <?php
                                                $src = loadImage($singleRow['attachment']);
                                                echo '<a target="_blank" href="'.$src.'"><i class="fa fa-paperclip" aria-hidden="true"></i></a>';
                                                ?>
                                                
                                            
                                            </td>

                                            <td><?php echo $singleRow['created']; ?></td>

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

                                                        
                                                            <li class="more-menu-item" role="presentation" onclick="">
                                                                <a href="process.php?action=acceptTaskRequest&id=<?php echo $singleRow['id'];?>">
                                                                    <button type="button" class="more-menu-btn" role="menuitem">Accept</button>
                                                                </a>
                                                            </li>
                                                            
                                                            <li class="more-menu-item" role="presentation">
                                                                <button onclick="rejectTaskRequest('<?php echo $singleRow['id']; ?>')" type="button" class="more-menu-btn" role="menuitem">Reject</button>
                                                                
                                                            </li>

                                                        
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
                                    <th>#</th>
                                    <th>User ID</th>
                                    <th>Task ID</th>
                                    <th>Attachment</th>
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
        $(document).ready(function() {
            $('#table_view').DataTable({
                "pageLength": 10,
                 "ordering": false
            });
            
        });
    </script>