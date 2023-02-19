<?php

require_once("Api.php");

function Format_nubbbmbers($num) {

    if($num>1000) {
  
          $x = round($num);
          $x_number_format = number_format($x);
          $x_array = explode(',', $x_number_format);
          $x_parts = array('k', 'm', 'b', 't');
          $x_count_parts = count($x_array) - 1;
          $x_display = $x;
          $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
          $x_display .= $x_parts[$x_count_parts - 1];
  
          return $x_display;
  
    }else{
        return $num;
    }
  
  }


  if($_GET['text']!=null){
  
    echo html_entity_decode(htmlspecialchars_decode($_GET['text'] ));//json_encode(htmlentities(htmlspecialchars($_GET['text'])));
  }

  //echo Format_numbers(getallapps()[0]['downloads'])."             ".getallapps()[0]['downloads'];
/*
  $conn=create_conn();

  $qry=mysqli_query($conn,"select * from home_banners");

  
  $row=mysqli_fetch_all($qry,1);

  echo json_encode($row);


  $conn=create_conn();
  $qry="delete from apps where id='37'";

  if($conn->query($qry)){
      echo "done";
  }else{

    echo "failed";
  }
*/



  ?>



<script type="text/javascript">
  const all_images=new Array();
  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      var div= document.createElement('div');
      var img = document.createElement('img');
      img.src=e.target.result;
      img.style.width='auto';
      img.style.height=100;

      div.append(img);
      document.getElementById('all_images').append(div);
      all_images[all_images.length]=input;
      for(i=0;i<all_images.length;i++){
        document.getElementById('all_images').value.append(all_images[i]);
      }
      //document.getElementById('pickedimage').src=(e.target.result);//attr('src', e.target.result).width(150).height(200);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function countimages(){
  document.getElementById('form').append(all_images);
  document.getElementById('form').submit();
  //const fd = new FormData(document.getElementById('form'));
  //return all_images.length+fd.values.bind();

}
</script>
<form id="form" action="test.php" method="GET">
<textarea type="text" name="text"></textarea>
<div id="all_images" style="display: flex; overflow: scroll;"></div>
<input value="click me" type="submit">

</form>


<select name="test" id="test">
    <option value="">
        <option value="1">test</option>
        <option value="2" selected>test2</option>
    </option>
</select>



































<div class="qr-content">
    <div class="qr-page-content">
        <div class="qr-page zeropadding">
            <div class="qr-content-area">

                <div class="qr-row">
                    <div class="qr-el">

                        <div class="page-title">
                            <h2>All Sliders</h2>
                            <div class="head-area">
                            </div>
                        </div>

                        <div class="qr-row1">

                            <?php
                            foreach ($all_uploads as $single_slider) :
                            ?>
                                <div class="qr-el qr-el-1" style="float: left;">
                                    <div style="height: 160px;">
                                        <a href="process.php?action=deleteSlider&id=<?php echo $single_slider['id']; ?>" class="hover_image">
                                            <div class="deleteIcon">
                                                <i class="fa fa-trash" style="margin-top: 5px;"></i>
                                            </div>
                                        </a>
                                        <img src="<?php if(strpos($single_slider['url'],"http")){
                                            echo $single_slider['url'];
                                        }else{
                                            echo $imagebaseurl . $single_slider['url']; 
                                        } ?>" alt="slider image" style="width: 100%; height: 100%">
                                    </div>

                                    

                                </div>
                            <?php
                            endforeach;
                            ?>

                            <form id="sliderImageform" action="process.php?action=addAppSliderImage" method="POST" enctype="multipart/form-data">
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
        $(document).ready(function() {
            $('#table_view').DataTable({
                "pageLength": 100
            });
            $('#table_view2').DataTable({
                "pageLength": 35
            });
        });



        document.getElementById("uploadFile").onchange = function() {
            appSlider();
        };


        function appSlider() {

            var fileUpload = document.getElementById("uploadFile");


            var regex = new RegExp("(.jpg|.png|.jpeg)$");
            if (regex.test(fileUpload.value.toLowerCase())) {


                if (typeof(fileUpload.files) != "undefined") {

                    var reader = new FileReader();

                    reader.readAsDataURL(fileUpload.files[0]);
                    reader.onload = function(e) {

                        var image = new Image();


                        image.src = e.target.result;


                        image.onload = function() {
                            var height = this.height;
                            var width = this.width;


                            if (height == 350 && width == 610) {

                                document.getElementById("sliderImageform").submit();

                            } else {

                                alert("Size 610x350");
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
