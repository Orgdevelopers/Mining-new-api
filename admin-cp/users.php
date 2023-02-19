<?php
require_once("Api.php");
$allusers = [];

$allusers = getAllUsers();
$allplans = getAllPlans();

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
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Plan</th>
                                    <!-- <th>Wallet Balance</th> -->
                                    <th>Plan Purchased</th>
                                    <!-- <th>Created</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if ($allusers != "") {
                                    foreach ($allusers as $singleRow) :

                                ?>
                                        <tr>
                                            <td><?php echo $singleRow['id']; ?></td>

                                            <td><?php echo $singleRow['username'] ?></td>
                                            
                                            <td><?php echo $singleRow['email'] ?></td>

                                            
                                            <td>
                                                <?php if($singleRow['plan']=="0"){echo "NONE";}else if($singleRow['plan']=="1"){echo "Free";}else{ findPlan($allplans,$singleRow);} ?>
                                            </td>
                                            
                                            <td>
                                                <?php echo $singleRow['plan_purchased'];?>
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

                                                            <li class="more-menu-item" role="presentation" onclick="edituser(<?php echo $singleRow['id'] ?>)">
                                                                <button type="button" class="more-menu-btn" role="menuitem">Edit</button>
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
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Plan</th>
                                    <!-- <th>Wallet Balance</th> -->
                                    <th>Plan Purchased</th>
                                    <!-- <th>Created</th> -->
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
                "pageLength": 15
            });
        });
    </script>