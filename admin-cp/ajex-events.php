<?php

require_once("Api.php");
require_once("config.php");

if (isset($_GET['q'])) {
    if ($_GET['q'] == "createplan") {
?>

<div class="main-container dataTables_wrapper" id="table_view_wrapper">
    <h2 style="font-weight: 300;" align="center">Create new plan</h2>

    <div style="height:350px; overflow:scroll;">

        <form action="process.php?action=creatPlan" method="post" enctype="multipart/form-data">

            <div class="full_width">
                <label class="field_title">Name</label>
                <input name="name" type="text" required="">

            </div>

            <div class="full_width">
                <label class="field_title">Algorithm</label>
                <input name="algo" type="text" required="">

                <!--<img src="#" id="pickedimage" alt="" style="width: 20px; height: 20px;">-->
            </div>

            <div class="full_width">
                <label class="field_title">Speed</label>
                <input name="speed" type="text" required="">
            </div>

            <div class="full_width">
                <label class="field_title">Duration</label>
                <input name="duration" type="number" step="1" onkeypress="if(event.keyCode==101||event.keyCode==46){return false;}else {return true;}" required="">
            </div>

            <div class="full_width">
                <label class="field_title">Earning</label>
                <input name="earning" type="text" required="">
            </div>

            <div class="full_width">
                <label class="field_title">Price</label>
                <input name="price" type="text" required="">
            </div>

            <div class="full_width">
                <label class="field_title">Package</label>
                <input name="package" type="text" required="">

            </div>

            <div class="full_width">
                <label class="field_title">Mining speed (seconds for every 1 satoshi)</label>
                <input name="true_speed" step="1" type="number" onkeypress="if(event.keyCode==101||event.keyCode==46){return false;}else {return true;}" required="">
            </div>

            <div class="full_width">
                <label class="field_title">Withdrawal_limit</label>
                <input name="withdrawal_limit" step="1" type="number" onkeypress="if(event.keyCode==101||event.keyCode==46){return false;}else {return true;}" required="">
            </div>

            <div class="full_width">
                <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;"
                    align="center">
                    Submit
                </button>
            </div>
        </form>



    </div>
</div>



<?php

    }else
    if($_GET['q']=="editplan"){
        $plan_info = getPlanInfo($_GET['id']);
?>

<div class="main-container dataTables_wrapper" id="table_view_wrapper">
    <h2 style="font-weight: 300;" align="center">Edit plan</h2>

    <div style="height:350px; overflow:scroll;">

        <form action="process.php?action=updatePlan&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">

            <div class="full_width">
                <label class="field_title">Name</label>
                <input name="name" type="text" required="" value="<?php echo $plan_info['name'] ?>">

            </div>

            <div class="full_width">
                <label class="field_title">Algorithm</label>
                <input name="algo" type="text" required="" value="<?php echo $plan_info['algo'] ?>">

                <!--<img src="#" id="pickedimage" alt="" style="width: 20px; height: 20px;">-->
            </div>

            <div class="full_width">
                <label class="field_title">Speed</label>
                <input name="speed" type="text" required="" value="<?php echo $plan_info['speed'] ?>">
            </div>

            <div class="full_width">
                <label class="field_title">Duration</label>
                <input name="duration" type="number" step="1" onkeypress="if(event.keyCode==101||event.keyCode==46){return false;}else {return true;}" required="" value="<?php echo $plan_info['duration'] ?>">
            </div>

            <div class="full_width">
                <label class="field_title">Earning</label>
                <input name="earning" type="text" required="" value="<?php echo $plan_info['earning'] ?>">
            </div>

            <div class="full_width">
                <label class="field_title">Price</label>
                <input name="price" type="text" required="" value="<?php echo $plan_info['price'] ?>">
            </div>

            <div class="full_width">
                <label class="field_title">Package</label>
                <input name="package" type="text" required="" value="<?php echo $plan_info['package'] ?>">

            </div>

            <div class="full_width">
                <label class="field_title">Mining speed (seconds for every 1 satoshi)</label>
                <input name="true_speed" step="1" type="number" onkeypress="if(event.keyCode==101||event.keyCode==46){return false;}else {return true;}" required="" value="<?php echo $plan_info['true_speed'] ?>">
            </div>

            <div class="full_width">
                <label class="field_title">Withdrawal_limit</label>
                <input name="withdrawal_limit" step="1" type="number" onkeypress="if(event.keyCode==101||event.keyCode==46){return false;}else {return true;}" required="" value="<?php echo $plan_info['withdrawal_limit'] ?>">
            </div>

            <div class="full_width">
                <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;"
                    align="center">
                    Submit
                </button>
            </div>
        </form>



    </div>
</div>
<?php


    }
}if($_GET['q']=="rejectWithdrawRequest"){

    // $user_details = getuserDetails($_GET['id']);
    // $all_plans = getAllPlans();

    ?>

<div class="main-container dataTables_wrapper" id="table_view_wrapper">
    <h2 style="font-weight: 300;" align="center">Reject Withdraw Request</h2>

    <div style="height:auto; overflow:hidden;">

        <form action="process.php?action=rejectWithdrawRequest&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">

            <div class="full_width">
                <label class="field_title">Reject reason</label>
                <input name="reason" type="text" maxlength="80">
                <input name="id" type="hidden" value="<?php echo $_GET['id'] ;?>">
            </div>

            <div class="full_width" style="margin-top: 20px;">
                <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;"
                    align="center">
                    Submit
                </button>
            </div>
        </form>



    </div>
</div>

<?php
}else 
if($_GET['q']=="rejectTaskRequest"){

    ?>

<div class="main-container dataTables_wrapper" id="table_view_wrapper">
    <h2 style="font-weight: 300;" align="center">Reject Task Request</h2>

    <div style="height:auto; overflow:hidden;">

        <form action="process.php?action=rejectTaskRequest&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">

            <div class="full_width">
                <label class="field_title">Reject reason</label>
                <input name="reason" type="text" maxlength="80">
                <input name="id" type="hidden" value="<?php echo $_GET['id'] ;?>">
            </div>

            <div class="full_width" style="margin-top: 20px;">
                <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;"
                    align="center">
                    Submit
                </button>
            </div>
        </form>



    </div>
</div>

<?php
}else 
if($_GET['q']=="rejectServerPurchaseRequest"){

    ?>

<div class="main-container dataTables_wrapper" id="table_view_wrapper">
    <h2 style="font-weight: 300;" align="center">Reject Server Purchase Request</h2>

    <div style="height:auto; overflow:hidden;">

        <form action="process.php?action=rejectServerPurchaseRequest&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">

            <div class="full_width">
                <label class="field_title">Reject reason</label>
                <input name="reason" type="text" maxlength="80">
                <input name="id" type="hidden" value="<?php echo $_GET['id'] ;?>">
            </div>

            <div class="full_width" style="margin-top: 20px;">
                <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;"
                    align="center">
                    Submit
                </button>
            </div>
        </form>



    </div>
</div>

<?php
    }else 
if($_GET['q']=="rejectInvestmentPurchaseRequest"){

    ?>

<div class="main-container dataTables_wrapper" id="table_view_wrapper">
    <h2 style="font-weight: 300;" align="center">Reject Investment Purchase Request</h2>

    <div style="height:auto; overflow:hidden;">

        <form action="process.php?action=rejectInvestmentPurchaseRequest&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">

            <div class="full_width">
                <label class="field_title">Reject reason</label>
                <input name="reason" type="text" maxlength="80">
                <input name="id" type="hidden" value="<?php echo $_GET['id'] ;?>">
            </div>

            <div class="full_width" style="margin-top: 20px;">
                <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;"
                    align="center">
                    Submit
                </button>
            </div>
        </form>



    </div>
</div>

<?php
    }else 
    if($_GET['q']=="editInvestmentPlan"){
    
        $plan = getInvestPlanDetails($_GET['id']);
        ?>
    
    <div class="main-container dataTables_wrapper" id="table_view_wrapper">
        <h2 style="font-weight: 300;" align="center">Edit Investment Plan</h2>
    
        <div style="height:auto; overflow:hidden;">
    
            <form action="process.php?action=editInvestmentPlan&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
    
                <div class="full_width">
                    <label class="field_title">Name</label>
                    <input name="name" type="text" maxlength="40" value="<?php echo $plan['name']; ?>">
                </div>

                <div class="full_width">
                    <label class="field_title">Profit %</label>
                    <input name="profit_rate" type="number" step="any" value="<?php echo $plan['profit_rate']; ?>">
                    
                </div>

                <div class="full_width">
                    <label class="field_title">Duration (days)</label>
                    <input name="duration" type="number" oninput="this.value=this.value.slice(0,3)" value="<?php echo $plan['duration']; ?>">
                </div>

                <div class="full_width">
                    <label class="field_title">Minimum amount ($)</label>
                    <input name="minimum_amount" type="number" oninput="this.value=this.value.slice(0,7)" value="<?php echo $plan['minimum_amount']; ?>">
                </div>
    
                <div class="full_width" style="margin-top: 20px;">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;"
                        align="center">
                        Submit
                    </button>
                </div>
            </form>
    
    
    
        </div>
    </div>
    
    <?php
        }else 
    if($_GET['q']=="editServer"){
    
        $plan = getPlanDetails($_GET['id']);
        ?>
    
    <div class="main-container dataTables_wrapper" id="table_view_wrapper">
        <h2 style="font-weight: 300;" align="center">Edit Server</h2>
    
        <div style="height:400px; overflow-y:scroll;">
    
            <form action="process.php?action=editServer&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
    
                <div class="full_width">
                    <label class="field_title">Name</label>
                    <input name="name" type="text" maxlength="40" value="<?php echo $plan['name']; ?>">
                </div>

                <div class="full_width">
                    <label class="field_title">Algorithm</label>
                    <input name="name" type="text" maxlength="40" value="<?php echo $plan['algo']; ?>">
                </div>

                <div class="full_width">
                    <label class="field_title">Speed (fake)</label>
                    <input name="name" type="text" maxlength="40" value="<?php echo $plan['speed']; ?>">
                </div>

                <div class="full_width">
                    <label class="field_title">Duration (days)</label>
                    <input name="duration" type="number" oninput="this.value=this.value.slice(0,3)" value="<?php echo $plan['duration']; ?>">
                </div>

                <div class="full_width">
                    <label class="field_title">Earning</label>
                    <input name="earning" type="text" value="<?php echo $plan['earning']; ?>">
                </div>

                <div class="full_width">
                    <label class="field_title">Price</label>
                    <input name="price" type="text" value="<?php echo $plan['price']; ?>">
                </div>

                <div class="full_width">
                    <label class="field_title">Sats per minute</label>
                    <input name="price" type="number" oninput="this.value=this.value.slice(0,7)" value="<?php echo $plan['true_speed']; ?>">
                </div>

                <div class="full_width">
                    <label class="field_title">Google package id</label>
                    <input name="package" type="text" value="<?php echo $plan['package']; ?>">
                </div>
    
                <div class="full_width" style="margin-top: 20px; margin-bottom: 10px">
                    <button class="com-button com-submit-button com-button--large " type="submit" style="width: 100%;"
                        align="center">
                        Submit
                    </button>
                </div>
            </form>
    
    
    
        </div>
    </div>
    
    <?php
        }else{
        echo "<script> alert('Something went wrong'); window.location='dashboard.php?p=servers&action=error');</script>";
    }

?>