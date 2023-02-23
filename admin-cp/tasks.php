<?php

if(isset($_SESSION[PRE_FIX.'id']))
{
    require_once("Api.php");

        // $url=$baseurl . 'showAppSlider';
        // $data = [];
        
        // $json_data=@curl_request($data,$url);
        
        $allusers = getAllTasks();

        ?>

        <div class="qr-content">
            <div class="qr-page-content">
                <div class="qr-page zeropadding">
                    <div class="qr-content-area">
                        
                        <div class="qr-row">
                            <div class="qr-el">

                                <div class="page-title">
                                    <h2>All Tasks</h2>
                                    <div class="head-area">
                                    </div>
                                </div>
                                
                                <div class="qr-row1">
                                    
                                    <?php 
                                        foreach ($allusers as $single_user): 
                                            ?>
                                                <div class="qr-el qr-el-1" style="float: left;">
                                                <div style="height: 160px;">
                                                    <a href="process.php?action=deleteTask&id=<?php echo $single_user['id']; ?>" class="hover_image">
                                                        <div class="deleteIcon">
                                                            <i class="fa fa-trash" style="margin-top: 5px;"></i>
                                                        </div>
                                                    </a>
                                                    <img src="<?php echo loadImage($single_user['img']); ?>" alt="slider image" style="width: 100%; height: 100%">
                                                </div>
                                                
                                                <div style="margin-top: 10px;">
                                			        <form action="process.php?action=updateTask" method="POST" enctype="multipart/form-data">
                                                        <label class="field_title">ID</label>
                                    			        <input readonly name="id" value="<?php echo $single_user['id']; ?>" style="width: 100%;border: solid 1px #d9d4d4;font-size: 14px;padding:2px 8px; border-radius: 3px;height: 30px;">
                                                        <label class="field_title">Link</label>
                                    			        <input type="text" name="link" value="<?php echo $single_user['link']; ?>" style="width: 100%;border: solid 1px #d9d4d4;font-size: 14px;padding:2px 8px; border-radius: 3px;height: 30px;">
                                                        <label class="field_title">Amount (TP)</label>
                                                        <input type="number" name="amount" value="<?php echo $single_user['amount']; ?>" style="width: 100%;border: solid 1px #d9d4d4;font-size: 14px;padding:2px 8px; border-radius: 3px;height: 30px;">
                                    			        <input type="submit" value="Update" style="border: solid 0px;font-size: 12px;color: white;background: #dd3636;padding: 7px 10px; border-radius: 3px;width: 100%;margin-top: 10px;">
                                			        </form>
                                			    </div>
                                			    
                                            </div>
                                            <?php 
                                        endforeach; 
                                    ?>
                                    
                                    <form id="sliderImageform" action="process.php?action=addTask" method="POST" enctype="multipart/form-data">
                                        <div class="qr-el qr-el-1" style="float: left;">
                                            <label for="uploadFile" class="hoviringdell uploadBox" id="uploadTrigger" style="height: 160px;">
                                                <img src="frontend_public/uploads/attachment/upload.png">
                                                <div class="uploadText">
                                                    <span style="color:#F69518;">Browse</span><br>
                                                    Size 610x350px 
                                                </div>
                                            </label>
                                        </div>
                                        <input name="image" class="hidden" id="uploadFile" type="file" accept=".jpg,.png,.jpeg" required="required">
                                        <input value="Submit" class="buttoncolor full_width" style="border: 0px;" type="hidden">
                                    </form>
                                   <div style="clear:both;"></div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        
    <script>
        $(document).ready(function () {
            $('#table_view').DataTable({
                    "pageLength": 100
                }
            );
            $('#table_view2').DataTable({
                    "pageLength": 35
                }
            );
        });
        
        
        
        document.getElementById("uploadFile").onchange = function () {
            appSlider();
        };
        
        
        function appSlider() {

            var fileUpload = document.getElementById("uploadFile");
    
    
            var regex = new RegExp("(.jpg|.png|.jpeg)$");
            if (regex.test(fileUpload.value.toLowerCase())) {
    
    
                if (typeof (fileUpload.files) != "undefined") {
    
                    var reader = new FileReader();
    
                    reader.readAsDataURL(fileUpload.files[0]);
                    reader.onload = function (e) {
    
                        var image = new Image();
    
    
                        image.src = e.target.result;
    
    
                        image.onload = function () {
                            var height = this.height;
                            var width = this.width;
                            
                            
                            if (height >= 360 && height <= 1080) 
                            {
                                //if((width/height) <= (16/8) && (width/height) >= (16/10)){
                                    document.getElementById("sliderImageform").submit();
                                //}else{
                                  //  alert("height 360-1080  Ratio 16:8 - 16:10");
                                 //   return false;
                                //}
    
                            } else {
    
                                alert("height 360-1080");
                                return false;
                            }
                        };
    
                    }
                } else {
                    alert("This browser does not support HTML5.");
                    return false;
                }
            } else {
                alert("Please select a valid Image file.");
                return false;
            }
        }
        
    </script>
    <?php
    
} 
else 
{
	
	@header("Location: index.php");
    echo "<script>window.location='index.php'</script>";
    die;
    
} ?>