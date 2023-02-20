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
                    <form class="site-settings" method="POST">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $appSettings['CryptoModel']['title'] ;?>">
                                <small class="admin-info">This will be the title of purchase dialog in app. ex- Buy with Crypto.</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Subtitle</label>
                                <textarea name="subtitle" id="subtitle" class="form-control" cols="30" rows="3"></textarea>
                                <small class="admin-info">text/instruction for user to complete transaction</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Wallet Address</label>
                                <input type="text" name="wallet_address" class="form-control" value="">
                                <small class="admin-info">Syset wallet address to show users</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Crypto Network</label>
                                <input type="text" name="network" class="form-control" value="">
                                <small class="admin-info">Crypto network ex- USDT-TRC, USDT-ETH</small>
                                
                            </div>
                        </div>

                        <div style="margin-top: 20px; text-align: center;">
                            <div class="form-line">
                                <!-- <label class="form-label">Crypto Network</label> -->
                                <input type="submit" class="btn btn-success m-t-15 waves-effect" value="Update">
                                <!-- <small class="admin-info">Crypto network ex- USDT-TRC, USDT-ETH</small> -->
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            
            <div class="card">
                <div class="card-body">
                <button type="submit" class="btn btn-success m-t-15 waves-effect" onclick="GetSupportedCoins()">Get Supported Coins</button>
                </div>
            </div>

        </div>

        <div class="col-lg-6 col-md-6 pull-right">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Point System Settings</h6>
                    <div class="point-settings-alert"></div>
                    <form class="point-settings" method="POST">
                        <div class="float-left">
                            <label for="point_level_system" class="main-label">Point System</label>
                            <br><small class="admin-info">Gives the ability for users to earn points from liking, sharing, commenting and posting.</small>
                        </div>
                        <div class="form-group float-right switcher">
                            <input type="hidden" name="point_level_system" value="0">
                            <input type="checkbox" name="point_level_system" id="chck-point_level_system" value="1">
                            <label for="chck-point_level_system" class="check-trail"><span class="check-handler"></span></label>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="float-left">
                            <label for="point_allow_withdrawal" class="main-label">Allow user to withdrawal earned points as currency?</label>
                            <br><small class="admin-info">Allow users to transfer earned points into money and withdrawal.</small>
                        </div>
                        <div class="form-group float-right switcher">
                            <input type="hidden" name="point_allow_withdrawal" value="0">
                            <input type="checkbox" name="point_allow_withdrawal" id="chck-point_allow_withdrawal" value="1">
                            <label for="chck-point_allow_withdrawal" class="check-trail"><span class="check-handler"></span></label>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">$1.00 = ? Point</label>
                                <input type="text" name="dollar_to_point_cost" class="form-control" value="100">
                                <small class="admin-info">How much does 1 dollar equal in points?</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Commenting on Videos</label>
                                <input type="text" name="comments_point" class="form-control" value="10">
                                <small class="admin-info">How many points does a user earn by creating comments?</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Liking Videos</label>
                                <input type="text" name="likes_point" class="form-control" value="5">
                                <small class="admin-info">How many points does a user earn by liking videos?</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Disliking Videos</label>
                                <input type="text" name="dislikes_point" class="form-control" value="2">
                                <small class="admin-info">How many points does a user earn by disliking videos?</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Watching Videos</label>
                                <input type="text" name="watching_point" class="form-control" value="2">
                                <small class="admin-info">How many points does a user earn by wondering videos?</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Uploading Videos</label>
                                <input type="text" name="upload_point" class="form-control" value="20">
                                <small class="admin-info">How many points does a user earn by uploading videos?</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Free Users Daily Limit</label>
                                <input type="text" name="free_day_limit" class="form-control" value="1000">
                                <small class="admin-info">How many points can a free user earn in a day?</small>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Pro Members Daily Limit</label>
                                <input type="text" name="pro_day_limit" class="form-control" value="2000">
                                <small class="admin-info">How many points can a pro user earn in a day?</small>
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