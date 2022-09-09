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
                    <table class="table table-striped" id="getQuotationData">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th>Order No</th>
                          <th>PQ Name</th>
                          <th>Description</th>
                          <th>Value</th>
                          <th>Cost</th>
                          <th>Detail Description</th>
                          <th>Is Final</th>
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
                    <table class="table table-striped" id="getBudgetData" style="width: 100%;">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th>Order No</th>
                          <th>Description</th>
                          <th>Budget</th>
                          <th>Created At</th>
                          <th>Last Update</th>
                          <th>Is Final</th>
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
                    <table class="table table-striped" id="getProposedCostData" style="width: 100%;">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th>Cost Name</th>
                          <th>Date</th>
                          <th>Proposed By</th>
                          <th>Value</th>
                          <th>Desc</th>
                          <th>Is Final</th>
                          <th>Dist. Date</th>
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