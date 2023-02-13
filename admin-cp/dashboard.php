<?php
$sidebar['section'] = 0;
$sidebar['sub-section'] = 0;

require 'includes/autoload.php';
?>



<!-- Main Content -->
<div class="main-content" id="main-contentttttt">
        <section class="section">
          <div class="section-header">
            <h1 onclick="SyncDashboard();">Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Users</h4>
                  </div>
                  <div class="card-body" id="total-users-txt">
                    00
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-money-bill-trend-up"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Invest-ments</h4>
                  </div>
                  <div class="card-body" id="investment-txt">
                    00
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-hourglass-end"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pending Requests</h4>
                  </div>
                  <div class="card-body" id="requests-txt">
                    00
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Online Miners</h4>
                  </div>
                  <div class="card-body" id="miners-txt">
                    00
                  </div>
                </div>
              </div>
            </div>                  
          </div>
          <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Investments</h4>
                  <div class="card-header-action">
                    <div class="btn-group">
                      <a href="#" class="btn btn-primary">Week</a>
                      <a href="#" class="btn">Month</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="myChart" height="182"></canvas>
                  
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
            <div class="card">
                  <div class="card-header">
                    <h4>User's Mining Status</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart3" height="350"></canvas>
                  </div>
                </div>
            </div>
          </div>
          
          
        </section>
      </div>







<?php

require 'includes/footer.php';
?>

<script>SyncDashboard();
</script>
