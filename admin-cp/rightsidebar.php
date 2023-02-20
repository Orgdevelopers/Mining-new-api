
<?php
//include("header.php");
?>

<div class="qr-sidebar">
    <div class="qr-sidebar-title-area">
        <div class="logo-area">
            <div class="qr-logo">
                <a href="#"> <img src="frontend_public/uploads/attachment/main_logo.png" alt=""> </a>
            </div>
        </div>
        <div class="burger-icon"> ☰</div>
    </div>

  
        <div class="not-mobile">
            <ul>
                
                <li>
                    <a href="dashboard.php?p=servers" class="<?php if (strpos($_SERVER['REQUEST_URI'], "servers") !== false) { echo "router-link-active ";} ?>"> 
                    <i class="fas fa-server"></i> Servers
                    </a>
                </li>
            
                <li>
                    <a href="dashboard.php?p=users" class="<?php if (strpos($_SERVER['REQUEST_URI'], "users") !== false) { echo "router-link-active ";} ?>"> 
                    <i class="fa-solid fa-users"></i> Users
                    </a>
                </li>

                <li>
                    <a href="dashboard.php?p=investmentPlans" class="<?php if (strpos($_SERVER['REQUEST_URI'], "investmentPlans") !== false) { echo "router-link-active ";} ?>"> 
                    <i class="fa-solid fa-hand-holding-dollar"></i> Investment Plans
                    </a>

                </li>


                <li>
                    <a href="dashboard.php?p=tasks" class="<?php if (strpos($_SERVER['REQUEST_URI'], "tasks") !== false) { echo "router-link-active ";} ?>"> 
                    <i class="fas fa-tasks"></i> Tasks (CPA)
                    </a>

                </li>


                <li>
                    <a href="dashboard.php?p=investmentRequests" class="<?php if (strpos($_SERVER['REQUEST_URI'], "investmentRequests") !== false) { echo "router-link-active ";} ?>"> 
                    <i class="fa-solid fa-hand-holding-dollar"></i> Investment Requests
                    </a>
                </li>
                
                
                <li>
                    <a href="dashboard.php?p=purchaserequests" class="<?php if (strpos($_SERVER['REQUEST_URI'], "purchaserequests") !== false) { echo "router-link-active ";} ?>"> 
                        <i class="fas fa-server"></i> Server requests
                    </a>
                </li>

                <li>
                    <a href="dashboard.php?p=taskRequests" class="<?php if (strpos($_SERVER['REQUEST_URI'], "taskRequests") !== false) { echo "router-link-active ";} ?>"> 
                    <i class="fas fa-tasks"></i> Task Requests
                    </a>

                </li>
            

                <li>
                    <a href="dashboard.php?p=withdrawalrequests" class="<?php if (strpos($_SERVER['REQUEST_URI'], "withdrawalrequests") !== false) { echo "router-link-active ";} ?>"> 
                        <i class="fa-solid fa-landmark"></i> Withdrawal requests
                    </a>
                </li>
                
            
                <li>
                    <a href="dashboard.php?p=appSettings" class="<?php if (strpos($_SERVER['REQUEST_URI'], "appSettings") !== false) { echo "router-link-active ";} ?>"> 
                        <i class="fa-solid fa-gear"></i> Settings
                    </a>
                </li>
                
                
                <li>
                    <a href="dashboard.php?p=logout" class="<?php if (strpos($_SERVER['REQUEST_URI'], "logout") !== false) { echo "router-link-active ";} ?>"> 
                        <i aria-hidden="true" class="right-align fa fa-sign-out-alt"></i> Logout
                    </a>
                </li>
                
            </ul>
            <div class='clear'></div>
        </div>
        <div class="mobile-only"></div>
        
</div>