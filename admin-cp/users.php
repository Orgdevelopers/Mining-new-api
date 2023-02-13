<?php
$sidebar['section'] = 1;
$sidebar['sub-section'] = 0;

require 'includes/autoload.php';
?>



<!-- Main Content -->
<div class="main-content" id="main-contentttttt">
<section class="section">
          <div class="section-header">
            <h1>All users</h1>
            <!-- <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Components</a></div>
              <div class="breadcrumb-item">Table</div>
            </div> -->
          </div>

          <div class="section-body">
        
            <div class="row">
              
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All users</h4>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-md" id="user-table">
                        <tr>
                          <th>#</th>
                          <th>Username</th>
                          <th>Upgraded</th>
                          <th style="text-align: center">Investments</th>
                          <th style="text-align: center">Public Chat</th>
                          <th>Status</th>
                          <th>Created</th>
                          <th>Action</th>
                        </tr>
                        

                      </table>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <nav class="d-inline-block">
                      <ul class="pagination mb-0">
                        <li class="page-item disabled">
                          <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li class="page-item">
                          <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                          <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>

        </div>
        </section>
</div>







<?php

require 'includes/footer.php';
?>

<script>
  var pageCount = 0;
  //load users
  var obj = {page:pageCount};
  jQueryRequest("showAllUsers",obj,function(data){

    if(data != false){
      if(data.code == 200){

        for (let index = 0; index < data.msg.length; index++) {
          const element = data.msg[index];
          var upgraded = "";
          var toggle = "";
          var status = "";
          var date = element.created;
          var details = "";

          //plan
          if(element.plan == 1){
            upgraded = '<div class="badge badge-info">Free</div>';
          }else if(element.plan > 1){
            upgraded = '<div class="badge badge-success">Upgraded</div>';

          }else{
            upgraded = '<div class="badge badge-light">none</div>';
          }

          //public chat
          if(element.allow_public_chat == 1){
            toggle = '<td style="display: flex; justify-content: center; align-items: center;"><div class="containerSwitch active" onchange="onSwitchClick(0,this);"><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></td>';
          }else{
            toggle = '<td  style="display: flex; justify-content: center; align-items: center;><div class="containerSwitch" onchange="onSwitchClick(0,this);"><label class="switch"><input type="checkbox"><span class="slider round"></span></label></div></td>';
          }

          //status
          if(element.status == 0){
            status = '<div class="badge badge-info">Unverified</div>';

          }else if(element.status == 1){
            status = '<div class="badge badge-success">Active</div>';
          }else{
            status = '<div class="badge badge-danger">Blocked</div>';
          }


          //format date
          date = dateFormat(new Date(element.created));

          details = '<td><div onClick="" class="btn btn-secondary">Detail</div></td>'

          var e = '<tr><td>'+element.id+'</td><td>'+element.username+'</td><td>'+upgraded+'</td><td style="text-align: center;">'+element.investments+'</td>'+toggle+'<td>'+status+'</td><td>'+date+'</td>'+details+'</tr>';
          $("#user-table").append(e);

        }

      }else{
        
        ToastInfo('','No more records found');
      }
      
    }else{
      
      ToastError('error','Something went wrong');
    }

  },true);
  

  function onSwitchClick(id,containerSwitch){
    //console.log(containerSwitch.classList);
    let checked = containerSwitch.classList.contains('active');
    let loading = true;

      containerSwitch.classList.add("loading");

      var obj = {user_id: id};
      jQueryRequest("togglePublicChat",obj,function(data){
        loading = false;
        containerSwitch.classList.remove("loading");

        if(data != false){
          if(data.public_chat == 1) {
            containerSwitch.classList.add("active");
          } else {
            containerSwitch.classList.remove("active");
          }
        }else{
          if(checked){
            containerSwitch.classList.add("active");
          }else{
            containerSwitch.classList.remove("active");
          }
          
          ToastError('Error!','Something went wrong please try again later');
        }

      },false);
      
  }
  
</script>
