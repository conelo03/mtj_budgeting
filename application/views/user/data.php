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
                  <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="true">
                    User
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="access-tab" data-toggle="tab" href="#access" role="tab" aria-controls="access" aria-selected="false">
                    User Access
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" id="group-tab" data-toggle="tab" href="#group" role="tab" aria-controls="group" aria-selected="false">
                    User Group
                  </a>
                </li> -->
              </ul>
              <div class="tab-content tab-bordered" id="myTab3Content">
                <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">
                      <h5>Data User</h5>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i> Add Data</a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getData">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Access</th>
                          <th class="text-center" style="width: 350px;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="dataList">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade" id="access" role="tabpanel" aria-labelledby="access-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">
                      <h5>Data User Access</h5>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalAccessAdd"><i class="fa fa-plus"></i> Add Data</a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getAccessData" width="100%">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th>Access</th>
                          <th class="text-center" style="width: 200px;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="dataAccessList">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- <div class="tab-pane fade" id="group" role="tabpanel" aria-labelledby="group-tab">
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">
                      <h5>Data User Group</h5>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalGroupAdd"><i class="fa fa-plus"></i> Add Data</a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="getGroupData" width="100%">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 20px;">#</th>
                          <th>Group Name</th>
                          <th class="text-center" style="width: 200px;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="dataGroupList">
                        
                      </tbody>
                    </table>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->load->view('user/modal') ?>
<?php $this->load->view('user/js') ?>
<?php $this->load->view('template/footer');?>