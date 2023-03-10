<?php

require_once("Api.php");
require_once("config.php");
$allcategories = getallWithdrawalRequests();

?>

<div class="qr-content">
    <div class="qr-page-content">
        <div class="qr-page zeropadding">
            <div class="qr-content-area">
                <div class="qr-row">
                    <div class="qr-el">

                        <div class="page-title">
                            <h2>Withdrawal Requests</h2>
                            <div class="head-area">
                            </div>
                        </div>

                        <!--start of datatable here-->

                        <table id="table_view" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Amount (Total)</th>
                                    <th>Fees</th>
                                    <th>Wallet Type</th>
                                    <th>Method</th>
                                    <th>Created</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (is_array($allcategories) || is_object($allcategories)) {
                                    foreach ($allcategories as $singleRow) :

                                ?>
                                        <tr>
                                            <td><?php echo $singleRow['id']; ?></td>
                                            <td>
                                                <?php echo $singleRow['username']; ?>
                                            </td>

                                            <td><?php echo '$'.$singleRow['amount']; ?></td>
                                            <td><?php echo '$'.$singleRow['charge']; ?></td>
                                            <td>
                                                <?php if($singleRow['wallet_type'] == '0'){echo "Invest";}else if($singleRow['wallet_type'] == '1'){echo "Task";}else{ echo "Mine";} ?>
                                            </td>

                                            <td>
                                                <?php
                                                    echo $singleRow['message'];
                                                ?>
                                            </td>

                                            <td><?php echo $singleRow['created'];?></td>

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
                                                        <?php
                                                            if($singleRow['status']=="0"){
                                                                echo '<li class="more-menu-item" role="presentation" >
                                                                        <a  href="process.php?action=acceptWithdrawRequest&id='.$singleRow['id'].'">
                                                                            <button type="button" class="more-menu-btn" role="menuitem">Accept</button>
                                                                        </a>
                                                                    </li>';
                                                            }

                                                            if( $singleRow['status']=="0"){
                                                                echo '<li class="more-menu-item" role="presentation" >
                                                                            <button type="button" class="more-menu-btn" onClick="rejectWithdrawRequest(\''.$singleRow['id'].'\')" role="menuitem">Reject</button>
                                                                        
                                                                    </li>';
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

                                    <th>#</th>
                                    <th>User</th>
                                    <th>Amount (Total)</th>
                                    <th>Fees</th>
                                    <th>Wallet Type</th>
                                    <th>Method</th>
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
                "pageLength": 10
            });
        });
    </script>