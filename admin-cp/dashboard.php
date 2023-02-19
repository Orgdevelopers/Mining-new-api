<?php 
include("header.php"); 
if(isset($_SESSION[PRE_FIX.'id']))
{
?>
<div class="mainwrapper allusers">
    <div class="qr-layout">
	
	<?php require_once("rightsidebar.php"); ?>
	
		<?php 
		
		if(isset($_GET['p']) ) 
		{ 
		    if( $_GET['p'] == "servers" ) 
           	{ 
    			include("allplans.php");
    		}
    		
    		if( $_GET['p'] == "users" ) 
           	{ 
    			include("users.php");
    		}
    		
    		if( $_GET['p'] == "investmentPlans" ) 
           	{ 
    			include("investmentPlans.php");
    		}
    		
    		if( $_GET['p'] == "investmentRequests" ) 
           	{ 
    			include("investmentRequests.php");
    		}

			if( $_GET['p'] == "tasks" ) 
           	{ 
    			include("tasks.php");
    		}
    		
    		if( $_GET['p'] == "purchaserequests" ) 
           	{ 
    			include("purchaserequests.php");
    		}
    		
    		if( $_GET['p'] == "withdrawalrequests" ) 
           	{ 
    			include("withdrawalrequests.php");
    		}

			if( $_GET['p'] == "taskRequests" ) 
           	{ 
    			include("taskRequests.php");
    		}

    		
    		// if( $_GET['p'] == "review_aps" ) 
           	// { 
    		// 	include("review_apps.php");
    		// }

			// if( $_GET['p'] == "editappimages"){
			// 	include("editappimages.php");
			// }
    		
		}else{
			echo "<script>window.location='dashboard.php?p=plans'</script>";
		}
		
		?>
	</div>
</div>

<?php 
require_once("footer.php"); 
}
else
{
    echo "<script>window.location='index.php'</script>";
}


?>