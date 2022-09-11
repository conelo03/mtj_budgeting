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
              <h4>Data User</h4>
              <div class="card-header-action">
                
              </div>
            </div>
            <div class="card-body">
              <ul class="nav nav-tabs" id="myTab3Content" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="quotation-tab" data-toggle="tab" href="#quotation" role="tab" aria-controls="quotation" aria-selected="true">
                    Quotation
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="budget-tab" data-toggle="tab" href="#budget" role="tab" aria-controls="budget" aria-selected="true">
                    Budget
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="proposed-cost-tab" data-toggle="tab" href="#proposed-cost" role="tab" aria-controls="proposed-cost" aria-selected="true">
                    Proposed Cost
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="proposed-budget-tab" data-toggle="tab" href="#proposed-budget" role="tab" aria-controls="proposed-budget" aria-selected="true">
                    Cost to Budget
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="distribution-cost-tab" data-toggle="tab" href="#distribution-cost" role="tab" aria-controls="distribution-cost" aria-selected="true">
                    Distribution Cost
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="real-budget-tab" data-toggle="tab" href="#real-budget" role="tab" aria-controls="real-budget" aria-selected="true">
                    Real Budget
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="report-budget-tab" data-toggle="tab" href="#report-budget" role="tab" aria-controls="report-budget" aria-selected="true">
                    Report Budget
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="true">
                    Notes
                  </a>
                </li>
              </ul>
              <div class="tab-content tab-bordered" id="myTab3Content">
                <div class="tab-pane fade show active" id="quotation" role="tabpanel" aria-labelledby="quotation-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">
                      <h5>Data Quotation</h5>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalQuotationAdd"><i class="fa fa-plus"></i> Add Data</a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getQuotationData" style="table-layout: fixed; width: 100%;">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th style="width: 100px;">Order No</th>
                          <th style="width: 100px;">PQ Name</th>
                          <th style="width: 200px;">Description</th>
                          <th style="width: 100px;">Value</th>
                          <th style="width: 100px;">Cost</th>
                          <th style="width: 250px;">Detail Description</th>
                          <th style="width: 100px;">Is Final</th>
                          <th class="text-center" style="width: 200px;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="dataQuotationList">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade show" id="budget" role="tabpanel" aria-labelledby="budget-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">
                      <h5>Data Budget</h5>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalBudgetAdd"><i class="fa fa-plus"></i> Add Data</a>
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
                          <th style="width: 100px;">Created At</th>
                          <th style="width: 100px;">Last Update</th>
                          <th style="width: 100px;">Is Final</th>
                          <th class="text-center" style="width: 200px;">Action</th>
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
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalProposedCostAdd"><i class="fa fa-plus"></i> Add Data</a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getProposedCostData" style="table-layout: fixed; width: 100%;">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th style="width: 100px;">Cost Name</th>
                          <th style="width: 100px;">Date</th>
                          <th style="width: 100px;">Proposed By</th>
                          <th style="width: 100px;">Value</th>
                          <th style="width: 200px;">Desc</th>
                          <th style="width: 100px;">Is Final</th>
                          <th style="width: 100px;">Dist. Date</th>
                          <th class="text-center" style="width: 200px;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="dataProposedCostList">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade show" id="proposed-budget" role="tabpanel" aria-labelledby="proposed-budget-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">
                      <h5>Data Cost to Budget</h5>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalProposedBudgetAdd"><i class="fa fa-plus"></i> Add Data</a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getProposedBudgetData" style="table-layout: fixed; width: 100%;">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th style="width: 100px;">Order No</th>
                          <th style="width: 100px;">Budget Value</th>
                          <th style="width: 100px;">PC Date</th>
                          <th style="width: 200px;">PC Name</th>
                          <th style="width: 100px;">PC Value</th>
                          <th style="width: 100px;">PB Date</th>
                          <th style="width: 200px;">PB Desc</th>
                          <th style="width: 100px;">PB By</th>
                          <th style="width: 100px;">PB Value</th>
                          <th style="width: 100px;">Approved Date</th>
                          <th style="width: 200px;">Approved Desc</th>
                          <th style="width: 100px;">Approved By</th>
                          <th style="width: 100px;">Approved Value</th>
                          <th style="width: 100px;">Rejected Date</th>
                          <th style="width: 200px;">Rejected Desc</th>
                          <th style="width: 100px;">Is Final</th>
                          <th class="text-center" style="width: 400px;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="dataProposedBudgetList">
                        
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
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalDistributionCostAdd"><i class="fa fa-plus"></i> Add Data</a>
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
                <div class="tab-pane fade show" id="real-budget" role="tabpanel" aria-labelledby="real-budget-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">
                      <h5>Data Real Budget</h5>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalRealBudgetAdd"><i class="fa fa-plus"></i> Add Data</a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getRealBudgetData" style="table-layout: fixed; width: 100%;">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th style="width: 100px;">DC Holder</th>
                          <th style="width: 100px;">DC Value</th>
                          <th style="width: 100px;">Report By</th>
                          <th style="width: 100px;">Report Date</th>
                          <th style="width: 100px;">Value</th>
                          <th style="width: 200px;">Description</th>
                          <th style="width: 100px;">Order No</th>
                          <th style="width: 100px;">Budget</th>
                          <th class="text-center" style="width: 300px;">Action</th>
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
                    <div class="col-md-6 text-right">
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalReportBudgetAdd"><i class="fa fa-plus"></i> Add Data</a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getReportBudgetData" style="width: 100%;">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th>Value</th>
                          <th>Description</th>
                          <th>File Name</th>
                          <th class="text-center" style="width: 200px;">Action</th>
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
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalNotesAdd"><i class="fa fa-plus"></i> Add Data</a>
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