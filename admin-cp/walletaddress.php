<?php
require_once("Api.php");
$allwallets = [];
$allwallets = getAllAdminWallets();

?>

<div class="qr-content">
    <div class="qr-page-content">
        <div class="qr-page zeropadding">
            <div class="qr-content-area">
                <div class="qr-row">
                    <div class="qr-el">

                        <div class="page-title">
                            <h2>Admin Wallet Address</h2>
                            <div class="head-area">
                            </div>
                        </div>

                        <div class="right" style="padding: 10px 0;">
                            <button onclick="createwalletaddress()" class="com-button com-submit-button com-button--large com-button--default">
                                <div class="com-submit-button__content"><span>Add Wallet</span></div>
                            </button>
                        </div>

                        <table id="table_view" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if ($allwallets != null) {
                                    foreach ($allwallets as $singleRow) :

                                ?>
                                        <tr>
                                            <td><?php echo $singleRow['id']; ?></td>
                                            <td><?php echo $singleRow['name'] ?></td>

                                            <td><?php echo $singleRow['address']; ?></td>

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

                                                            <li class="more-menu-item" role="presentation" onclick="editWalletAddress(<?php echo $singleRow['id'] ?>);">
                                                                <button type="button" class="more-menu-btn" role="menuitem">Edit</button>
                                                            </li>
                                                            <li class="more-menu-item" role="presentation">
                                                                <a href="process.php?action=delete_wallet_address&id=<?php echo $singleRow['id'];?>">
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
                                    <th>Address</th>
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