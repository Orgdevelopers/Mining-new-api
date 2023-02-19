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
}if($_GET['q']=="edituser"){

    $user_details = getuserDetails($_GET['id']);
    $all_plans = getAllPlans();

    ?>

<div class="main-container dataTables_wrapper" id="table_view_wrapper">
    <h2 style="font-weight: 300;" align="center">Edit User</h2>

    <div style="height:350px; overflow:scroll;">

        <form action="process.php?action=updateUser&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">

            <div class="full_width">
                <label class="field_title">Plan</label>
                <select name="plan" id="plan">

                <option value="0" <?php if($user_details['plan']=='0'){echo 'selected';} ?> >NONE</option>
                    <?php 
                    for($i=0;$i<count($all_plans);$i++){

                        if($user_details['plan']==$all_plans[$i]['id']){
                            echo '<option value="'.$all_plans[$i]['id'].'" selected>'.$all_plans[$i]['name'].'</option>';
                        }else{
                            echo '<option value="'.$all_plans[$i]['id'].'">'.$all_plans[$i]['name'].'</option>';
                        }

                    }

                    ?>
                      
                </select>

            </div>

            
            <div class="full_width">
                <label class="field_title">Wallet Balance</label>
                <input name="balance" step="1" type="number" onkeypress="if(event.keyCode==101||event.keyCode==46){return false;}else {return true;}" required="" value="<?php echo $user_details['balance'] ?>">
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
if($_GET['q']=="editWalletAddress"){

    $details = getWalletAddressDetails($_GET['id']);

    ?>

<div class="main-container dataTables_wrapper" id="table_view_wrapper">
    <h2 style="font-weight: 300;" align="center">Edit Wallet Address</h2>

    <div style="height:350px; overflow:scroll;">

        <form action="process.php?action=editwalletaddress&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">

            <div class="full_width">
                <label class="field_title">Name</label>
                <input name="name" step="1" type="text" required="" value="<?php echo $details['name'] ?>">

            </div>

            
            <div class="full_width">
                <label class="field_title">Wallet Address</label>
                <input name="address" step="1" type="text" required="" value="<?php echo $details['address'] ?>">
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
if($_GET['q']=="createwalletaddress"){

    ?>

<div class="main-container dataTables_wrapper" id="table_view_wrapper">
    <h2 style="font-weight: 300;" align="center">Create Wallet Address</h2>

    <div style="height:350px; overflow:scroll;">

        <form action="process.php?action=createwalletaddress" method="post" enctype="multipart/form-data">

            <div class="full_width">
                <label class="field_title">Name</label>
                <input name="name" step="1" type="text" required="">

            </div>

            
            <div class="full_width">
                <label class="field_title">Wallet Address</label>
                <input name="address" step="1" type="text" required="">
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
    }else{
        echo "<script> alert('category not found in database'); window.location='dashboard.php?p=categories&action=error');</script>";
    }

?>