<?php
require_once("Api.php");
require_once("config.php");
include("process.php");

$allplans = [];
$allplans = getAllPlans();

?>

<div class="qr-content">
    <div class="qr-page-content">
        <div class="qr-page zeropadding">
            <div class="qr-content-area">
                <div class="qr-row">
                    <div class="qr-el">

                        <div class="page-title">
                            <h2>All Servers</h2>
                            <div class="head-area">
                            </div>
                        </div>

                        <div class="right" style="padding: 10px 0;">
                            <button onclick="createPlan()" class="com-button com-submit-button com-button--large com-button--default">
                                <div class="com-submit-button__content"><span>Create Plan</span></div>
                            </button>
                        </div>


                        <table id="table_view" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Algorithm</th>
                                    <th>Speed</th>
                                    <th>Duration</th>
                                    <th>Earning</th>
                                    <th>Price</th>
                                    <th>Sat/min</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if ($allplans != "") {
                                    foreach ($allplans as $singleRow) :

                                ?>
                                        <tr>
                                            <td><?php echo $singleRow['id']; ?></td>
                                            <td style="width:100px; overflow:hidden;"><?php echo $singleRow['name'] ?></td>

                                            <td style="width:100px; overflow:hidden;"><?php echo $singleRow['algo'] ?></td>

                                            <td style="width:100px; overflow:hidden;"><?php echo $singleRow['speed']; ?></td>


                                            <td>
                                                <?php echo $singleRow['duration']." Days"; ?>
                                            </td>
                                            <td>
                                                <?php echo $singleRow['earning']; ?>

                                            </td>
                                            <td>
                                                <?php echo $singleRow['price']; ?>
                                            </td>

                                            <td>
                                                <?php echo $singleRow['true_speed']; ?>
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
                                                                <a>
                                                                    <button type="button" onclick="editServer('<?php echo $singleRow['id'] ?>')" class="more-menu-btn" role="menuitem">Edit</button>
                                                                </a>
                                                            </li>
                                                            <li class="more-menu-item" role="presentation">
                                                                <a href="process.php?action=deletePlan&id=<?php echo $singleRow['id']; ?>&from=plans">
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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Algorithm</th>
                                    <th>Speed</th>
                                    <th>Duration</th>
                                    <th>Earning</th>
                                    <th>Price</th>
                                    <th>Sat/min</th>
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