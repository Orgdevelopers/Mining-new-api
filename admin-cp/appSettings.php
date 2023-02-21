<?php
require_once("Api.php");
$allusers = [];

$appSettings = getAppSettings();

?>

<style>
.card {
    box-shadow: 0 1px 3px rgb(0 0 0 / 15%);
    border-radius: 10px;
    background-color: #fff;
    padding: 20px;
    margin-top: 20px;
}

h6.card-title {
    margin-bottom: 2rem;
    font-size: 1.1rem;
    font-weight: 600;
}

.admin-info {
    margin-top: 3px;
    margin-bottom: 10px;
    display: block;
    color: #555;
    font-weight: 500;
}
.small, small {
    font-size: 12px;
}
.label {
    font-weight: 500 !important;
    display: inline-block;
    margin-bottom: .2rem;
}

.form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: rgb(73, 80, 87);
    background-color: rgb(255, 255, 255);
    background-clip: padding-box;
    border: 1px solid rgb(206, 212, 218);
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
}

.form-control, .swal-modal input.swal-content__input, .custom-select {
    font-size: 0.875rem;
    border-color: rgb(225, 225, 225);
    border-radius: 0.2rem;
}

.btn-submit-appsettings {
    background: rgb(22, 160, 133);
    border-color: rgb(22, 160, 133);
    cursor: pointer;
    color: white !important;

    font-size: 14px;
    width: auto;
    display: inline-flex;
    font-weight: 600;
    align-items: center;
    padding: 12px 45px;
    line-height: 14px;
    border-radius: 0.2rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}


</style>

<div class="qr-content">
    <div class="qr-page-content">
        <div class="qr-page zeropadding">
            <div class="qr-content-area">
                <div class="qr-row">
                    <div class="qr-el" style="background-color: #f9f9f9;">

                        <div class="page-title">
                            <h2>App Settings</h2>
                            <div class="head-area">
                            </div>
                        </div>

                        
                        <div class="row">
                            
        <div class="col-lg-6 col-md-6 pull-left">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Wallet Address Settings</h6>
                    <div class="site-settings-alert"></div>
                    <form class="site-settings" method="POST" action="process.php?action=updateCryptoModel">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Title</label>
                                <input required type="text" name="title" class="form-control" value="<?php echo $appSettings['CryptoModel']['title'] ;?>">
                                <small class="admin-info">This will be the title of purchase dialog in app. ex- Buy with Crypto.</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Subtitle</label>
                                <textarea required name="subtitle" id="subtitle" class="form-control" cols="30" rows="3"><?php echo $appSettings['CryptoModel']['subtitle'] ;?></textarea>
                                <small class="admin-info">text/instruction for user to complete transaction</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Wallet Address</label>
                                <input required type="text" name="wallet_address" class="form-control" value="<?php echo $appSettings['CryptoModel']['wallet_address'] ;?>">
                                <small class="admin-info">Sysetm wallet address to show users</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Crypto Network</label>
                                <input required type="text" name="network" class="form-control" value="<?php echo $appSettings['CryptoModel']['network'] ;?>">
                                <small class="admin-info">Crypto network ex- USDT-TRC, USDT-ETH</small>
                                
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>

                        <div style="text-align: center;">
                            <div class="form-line">
                                <!-- <label class="form-label">Crypto Network</label> -->
                                <input type="submit" class="btn btn-success m-t-15 waves-effect" value="Update">
                                <!-- <small class="admin-info">Crypto network ex- USDT-TRC, USDT-ETH</small> -->
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            
            <!-- <div class="card">
                <div class="card-body">
                <h6 class="card-title">Wallet Address Settings</h6>
                    <div class="site-settings-alert"></div>
                    <form class="site-settings" method="POST" action="process.php?p=updateCryptoModel">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="">
                                <small class="admin-info">This will be the title of purchase dialog in app. ex- Buy with Crypto.</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                    </form>
                </div>
            </div> -->

        </div>

        <div class="col-lg-6 col-md-6 pull-left">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">App Settings</h6>
                    <div class="point-settings-alert"></div>
                    <form class="point-settings" method="POST" action="process.php?action=updateAppSettings">
                        
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Active Miners</label>
                                <input type="number" name="active_miners" class="form-control" value="<?php echo $appSettings['AppSettings']['active_miners']; ?>">
                                <small class="admin-info"><?php if($appSettings['AppSettings']['active_miners']<999){echo "Inside app a random value from ".($appSettings['AppSettings']['active_miners']-20)." to ".($appSettings['AppSettings']['active_miners']+20)." will be shown";} ?></small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="quantity" class="form-control" value="<?php echo $appSettings['AppSettings']['quantity']; ?>">
                                <small class="admin-info"></small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Task View Mode</label>
                                <select name="task_mode" id="task_mode" class="form-control">
                                    <option value="0" <?php if($appSettings['AppSettings']['task_mode'] == 0 ){echo "selected";} ?>>API</option>
                                    <option value="1" <?php if($appSettings['AppSettings']['task_mode'] == 1 ){echo "selected";} ?>>HTML</option>
                                </select>
                                <small class="admin-info">Task(CPA) mode</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Investment Withdraw Fees %</label>
                                <input type="number" name="fee_invest" class="form-control" value="<?php echo $appSettings['AppSettings']['fee_invest']; ?>">
                                <small class="admin-info"></small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Mining Withdraw Fees %</label>
                                <input type="number" name="fee_mine" class="form-control" value="<?php echo $appSettings['AppSettings']['fee_mine']; ?>">
                                <small class="admin-info"></small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">TP Value $</label>
                                <input type="number" name="points_value" class="form-control" value="<?php echo $appSettings['AppSettings']['points_value']; ?>">
                                <small class="admin-info">1TP = --$. example:- 1TP = 0.01 (this way 1$ / 100TP)</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Withdraw Limit ($)</label>
                                <input type="number" name="withdraw_limit" class="form-control" value="<?php echo $appSettings['AppSettings']['withdraw_limit']; ?>">
                                <small class="admin-info"></small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div style="text-align: center;">
                            <div class="form-line">
                                <!-- <label class="form-label">Crypto Network</label> -->
                                <input type="submit" class="btn btn-success m-t-15 waves-effect" value="Update">
                                <!-- <small class="admin-info">Crypto network ex- USDT-TRC, USDT-ETH</small> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>


                        <!---- --->
                    </div>
                </div>
            </div>
        </div>

    </div>