<?php
require_once("Api.php");
require_once("config.php");
include("process.php");

$allrequests = [];
$allrequests = getAllInvestPlans();
//

?>

<div class="qr-content">
    <div class="qr-page-content">
        <div class="qr-page zeropadding">
            <div class="qr-content-area">
                <div class="qr-row">
                    <div class="qr-el">

                        <div class="page-title">
                            <h2>Investment Plans</h2>
                            <div class="head-area">
                            </div>
                        </div>


                        <table id="table_view" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Profit %</th>
                                    <th>Duration</th>
                                    <th>Min amount</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if ($allrequests != "") {
                                    foreach ($allrequests as $singleRow) :

                                ?>
                                        <tr>
                                            <td><?php echo $singleRow['id']; ?></td>
                                            <td><?php echo $singleRow['name'] ?></td>

                                            <td><?php echo $singleRow['profit_rate']." %" ?></td>

                                            <td><?php echo $singleRow['duration']; ?></td>


                                            <td>
                                                <?php echo $singleRow['minimum_amount']; ?>
                                            </td>

                                            <td>
                                                <?php echo $singleRow['created']; ?>
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

                                                        <li class="more-menu-item" role="presentation">
                                                            <button type="button" class="more-menu-btn" role="menuitem">Edit</button>
                                                        </li>

                                                            <li class="more-menu-item" role="presentation">
                                                                <a href="process.php?action=delete_refund_request&id=<?php echo $singleRow['id'];?>&from=plans">
                                                                    <button type="button" class="more-menu-btn" role="menuitem">Delete</button>
                                                                </a>
                                                                
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
                                    <th>Name</th>
                                    <th>Profit %</th>
                                    <th>Duration</th>
                                    <th>Min amount</th>
                                    <th>Created</th>
                                    <th>Action</th>
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