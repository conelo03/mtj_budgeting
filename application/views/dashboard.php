<?php $this->load->view('template/header');?>
<?php $this->load->view('template/sidebar');?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>

    <div class="section-header">
      <h6>Welcome to Budget Monitoring App MTJ Group</h6>

    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-stats">
              <div class="card-stats-title">
                <h5>PENDING PROJECT</h5>
              </div>
            </div>
            <div class="card-icon shadow-warning bg-warning">
              <i class="fas fa-clock"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Amount</h4>
              </div>
              <div class="card-body" id="jmlPendingPorject">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-stats">
              <div class="card-stats-title">
                <h5>ON GOING PROJECT</h5>
              </div>
            </div>
            <div class="card-icon shadow-info bg-info">
              <i class="fas fa-tools"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Amount</h4>
              </div>
              <div class="card-body" id="jmlOnGoingProject">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-stats">
              <div class="card-stats-title">
                <h5>COMPLETED PROJECT</h5>
              </div>
            </div>
            <div class="card-icon shadow-success bg-success">
              <i class="fas fa-check"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Amount</h4>
              </div>
              <div class="card-body" id="jmlCompletedProject">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-stats">
              <div class="card-stats-title">
                <h5>TOTAL PROJECT</h5>
              </div>
            </div>
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-building"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Amount</h4>
              </div>
              <div class="card-body" id="jmlTotalProject">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-info">
              <i class="fas fa-user-cog"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Administrator</h4>
              </div>
              <div class="card-body" id="jmlAdministrator">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-info">
              <i class="fas fa-wallet"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Finance</h4>
              </div>
              <div class="card-body" id="jmlFinance">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-info">
              <i class="fas fa-users-cog"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Project Manager</h4>
              </div>
              <div class="card-body" id="jmlPM">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-info">
              <i class="fas fa-hard-hat"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Pengawas Lapangan</h4>
              </div>
              <div class="card-body" id="jmlWaspang">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
</div>
<?php $this->load->view('template/footer');?>