<?php $this->load->view('template/header');?>
<?php $this->load->view('template/sidebar');?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= $title?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Kelola User</a></div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Project</h4>
              <div class="card-header-action">
                
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4"><h6>Project ID</h6></div>
                <div class="col-md-8"><h6>: <span id="projectId"></span></h6></div>
              </div>
              <div class="row">
                <div class="col-md-4"><h6>Project Name</h6></div>
                <div class="col-md-8"><h6>: <span id="projectName"></span></h6></div>
              </div>
              <div class="row">
                <div class="col-md-4"><h6>Project Group</h6></div>
                <div class="col-md-8"><h6>: <span id="projectGroupName"></span></h6></div>
              </div>
              <hr>
              <ul class="nav nav-tabs" id="myTab3Content" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">
                    Overview
                  </a>
                </li>
                <?php if(is_project_manager() || is_finance()): ?>
                <li class="nav-item">
                  <a class="nav-link" id="budget-tab" data-toggle="tab" href="#budget" role="tab" aria-controls="budget" aria-selected="true">
                    Budget
                  </a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                  <a class="nav-link" id="proposed-cost-tab" data-toggle="tab" href="#proposed-cost" role="tab" aria-controls="proposed-cost" aria-selected="true">
                    Proposed Cost
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="distribution-cost-tab" data-toggle="tab" href="#distribution-cost" role="tab" aria-controls="distribution-cost" aria-selected="true">
                    Distribution Cost
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="report-cost-tab" data-toggle="tab" href="#report-cost" role="tab" aria-controls="report-cost" aria-selected="true">
                    Report Cost
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="real-budget-tab" data-toggle="tab" href="#real-budget" role="tab" aria-controls="real-budget" aria-selected="true">
                    Real Cost
                  </a>
                </li>
                <?php if(is_project_manager() || is_finance()): ?>
                  <li class="nav-item">
                    <a class="nav-link" id="report-budget-tab" data-toggle="tab" href="#report-budget" role="tab" aria-controls="report-budget" aria-selected="true">
                      Report Budget
                    </a>
                  </li>
                <?php endif; ?>
                <li class="nav-item">
                  <a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="true">
                    Notes
                  </a>
                </li>
              </ul>
              <div class="tab-content tab-bordered" id="myTab3Content">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-12">
                      <h4>Overview</h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4"><h6>Project ID</h6></div>
                    <div class="col-md-8"><h6>: <span id="projectId2"></span></h6></div>
                  </div>
                  <div class="row">
                    <div class="col-md-4"><h6>Project Name</h6></div>
                    <div class="col-md-8"><h6>: <span id="projectName2"></span></h6></div>
                  </div>
                  <div class="row">
                    <div class="col-md-4"><h6>Project Group</h6></div>
                    <div class="col-md-8"><h6>: <span id="projectGroupName2"></span></h6></div>
                  </div>
                  <div class="row">
                    <div class="col-md-4"><h6>Project Client</h6></div>
                    <div class="col-md-8"><h6>: <span id="projectClientName"></span></h6></div>
                  </div>
                  <div class="row">
                    <div class="col-md-4"><h6>Project Description</h6></div>
                    <div class="col-md-8"><h6>: <span id="projectDescription"></span></h6></div>
                  </div>
                  <div class="row">
                    <div class="col-md-4"><h6>Project Manager</h6></div>
                    <div class="col-md-8"><h6>: <span id="projectManagerName"></span></h6></div>
                  </div>
                  <div class="row">
                    <div class="col-md-4"><h6>Project Team (Pengawas Lapangan)</h6></div>
                    <div class="col-md-8">
                      <div class="row" id="projectTeam">
                      </div>
                    </div>
                  </div>
                  <br>
                  <?php if(is_project_manager() || is_finance()): ?>
                    <div class="row">
                      <div class="col-12">
                        <h5>Budget Usage</h5>
                        <div class="progress mb-3">
                          <div class="progress-bar bg-secondary" role="progressbar" data-width="0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="budgetUsage">0%</div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <div class="card-icon bg-info">
                            <i class="fas fa-dollar-sign"></i>
                          </div>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Total Budget</h4>
                            </div>
                            <div class="card-body" id="totalBudget">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <div class="card-icon bg-info">
                            <i class="fas fa-dollar-sign"></i>
                          </div>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Report Budget</h4>
                            </div>
                            <div class="card-body" id="reportBudget">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <div class="card-icon bg-warning">
                            <i class="fas fa-dollar-sign"></i>
                          </div>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Remaining Budget</h4>
                            </div>
                            <div class="card-body" id="remainingBudget">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <div class="card-icon bg-info">
                            <i class="fas fa-dollar-sign"></i>
                          </div>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Distribution Cost</h4>
                            </div>
                            <div class="card-body" id="distributionCost">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <div class="card-icon bg-info">
                            <i class="fas fa-dollar-sign"></i>
                          </div>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Report Cost</h4>
                            </div>
                            <div class="card-body" id="reportCost">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <div class="card-icon bg-success">
                            <i class="fas fa-dollar-sign"></i>
                          </div>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Remaining Cost</h4>
                            </div>
                            <div class="card-body" id="remainingCost">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php elseif(is_pengawas_lapangan()): ?>
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <div class="card-icon bg-info">
                            <i class="fas fa-dollar-sign"></i>
                          </div>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Distribution Cost</h4>
                            </div>
                            <div class="card-body" id="distributionCost2">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <div class="card-icon bg-info">
                            <i class="fas fa-dollar-sign"></i>
                          </div>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Report Cost</h4>
                            </div>
                            <div class="card-body" id="reportCost2">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <div class="card-icon bg-info">
                            <i class="fas fa-dollar-sign"></i>
                          </div>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Remaining Cost</h4>
                            </div>
                            <div class="card-body" id="remainingCost2">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="tab-pane fade show" id="budget" role="tabpanel" aria-labelledby="budget-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">
                      <h5>Data Budget</h5>
                    </div>
                    <div class="col-md-6 text-right">
                      <?php if(is_project_manager() && $project['status'] != 'COMPLETED'): ?>
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalBudgetAdd"><i class="fa fa-plus"></i> Add Data</a>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getBudgetData" style="table-layout: fixed; width: 100%;">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th style="width: 100px;">Order No</th>
                          <th style="width: 200px;">Description</th>
                          <th style="width: 100px;">Budget</th>
                          <th style="width: 150px;">Created At</th>
                          <th style="width: 150px;">Last Update</th>
                          <th style="width: 100px;">Approval</th>
                          <th class="text-center" style="width: 250px;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="dataBudgetList">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade show" id="proposed-cost" role="tabpanel" aria-labelledby="proposed-cost-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">
                      <h5>Data Proposed Cost</h5>
                    </div>
                    <div class="col-md-6 text-right">
                      <?php if((is_project_manager() || is_pengawas_lapangan()) && $project['status'] != 'COMPLETED'): ?>
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalProposedCostAdd"><i class="fa fa-plus"></i> Add Data</a>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getProposedCostData" style="table-layout: fixed; width: 100%;">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th style="width: 200px;">Proposed Cost Name</th>
                          <th style="width: 100px;">Proposed Date</th>
                          <th style="width: 100px;">Proposed By</th>
                          <th style="width: 100px;">Proposed Value</th>
                          <th style="width: 200px;">Proposed Desc</th>
                          <th style="width: 100px;">Approval</th>
                          <th style="width: 100px;">Approved Date</th>
                          <th style="width: 200px;">Approved By</th>
                          <th style="width: 100px;">Approved Value</th>
                          <th style="width: 100px;">Approved Desc</th>
                          <th style="width: 100px;">Rejected By</th>
                          <th style="width: 100px;">Rejected Date</th>
                          <th style="width: 200px;">Rejected Desc</th>
                          <th class="text-center" style="width: 320px;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="dataProposedCostList">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade show" id="distribution-cost" role="tabpanel" aria-labelledby="distribution-cost-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">
                      <h5>Data Distribution Cost</h5>
                    </div>
                    <div class="col-md-6 text-right">
                      <?php if(is_finance() && $project['status'] != 'COMPLETED'): ?>
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalDistributionCostAdd"><i class="fa fa-plus"></i> Add Data</a>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getDistributionCostData" style="width: 100%;">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th>PC Name</th>
                          <th>PC Date</th>
                          <th>Dist. By</th>
                          <th>Holder</th>
                          <th>Value</th>
                          <th>Desc</th>
                          <th class="text-center" style="width: 200px;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="dataDistributionCostList">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade show" id="report-cost" role="tabpanel" aria-labelledby="report-cost-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">
                      <h5>Data Report Cost</h5>
                    </div>
                    <div class="col-md-6 text-right">
                      <?php if(is_pengawas_lapangan() && $project['status'] != 'COMPLETED'): ?>
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalReportCostAdd"><i class="fa fa-plus"></i> Add Data</a>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getReportCostData" style="width: 100%;">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th>Value</th>
                          <th>Description</th>
                          <th>File Name</th>
                          <th class="text-center" style="width: 200px;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="dataReportCostList">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade show" id="real-budget" role="tabpanel" aria-labelledby="real-budget-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-12">
                      <h5>Data Real Cost</h5>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getRealBudgetData" style="table-layout: fixed; width: 100%;">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;" rowspan="2">#</th>
                          <th style="width: 100px;" rowspan="2">Holder</th>
                          <th style="width: 100px;" rowspan="2">Description</th>
                          <th style="width: 100px;" rowspan="2">Dist. Value</th>
                          <th style="width: 300px;" class="text-center" colspan="2">Detail Cost</th>
                          <th style="width: 100px;" rowspan="2">Usage Cost</th>
                          <th style="width: 100px;" rowspan="2">Remaining Cost</th>
                        </tr>
                        <tr>
                          <th style="width: 200px;">Desc</th>
                          <th style="width: 100px;">Cost</th>
                        </tr>
                      </thead>
                      <tbody id="dataRealBudgetList">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade show" id="report-budget" role="tabpanel" aria-labelledby="report-budget-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">
                      <h5>Data Report Budget</h5>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getReportBudgetData" style="table-layout: fixed; width: 100%;">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th style="width: 100px;">Value</th>
                          <th style="width: 200px;">Description</th>
                          <th style="width: 100px;">Budget Description</th>
                          <th class="text-center" style="width: 100px;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="dataReportBudgetList">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade show" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">
                      <h5>Notes</h5>
                    </div>
                    <div class="col-md-6 text-right">
                      <?php if ($project['status'] != 'COMPLETED') { ?>
                        <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalNotesAdd"><i class="fa fa-plus"></i> Add Data</a>
                      <?php } ?>
                      </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getNotesData" style="width: 100%;">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th style="width: 100px;">Type</th>
                          <th>Notes</th>
                          <th style="width: 100px;">User</th>
                          <th style="width: 150px;">DateTime</th>
                          <th class="text-center" style="width: 200px;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="dataNotesList">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->load->view('project/modal');?>
<?php $this->load->view('project/js');?>
<?php $this->load->view('template/footer');?>