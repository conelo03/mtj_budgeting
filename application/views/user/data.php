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
                <li class="nav-item">
                  <a class="nav-link" id="group-tab" data-toggle="tab" href="#group" role="tab" aria-controls="group" aria-selected="false">
                    User Group
                  </a>
                </li>
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
                          <th>Group</th>
                          <th>Access</th>
                          <th class="text-center" style="width: 200px;">Aksi</th>
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
                          <th class="text-center" style="width: 200px;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="dataAccessList">
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade" id="group" role="tabpanel" aria-labelledby="group-tab">
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
                          <th class="text-center" style="width: 200px;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="dataGroupList">
                        
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

<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="saveData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="form-label">Name</label>
            <input name="userName" id="userName" class="form-control" type="text" placeholder="Nama">
          </div>

          <div class="form-group">
            <label class="form-label">Email</label>
            <input name="userEmail" id="userEmail" class="form-control" type="text" placeholder="Email">
          </div>

          <div class="form-group">
            <label class="form-label">Select User Access</label>
            <select name="accessRightId[]" class="form-control" id="selectUserAccess" data-live-search="true" multiple>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Select User Group</label>
            <select name="groupId[]" class="form-control" id="selectUserGroup" data-live-search="true" multiple>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Password</label>
            <input name="userPassword" id="userPassword" class="form-control" type="text" placeholder="Password">
          </div>

          <div class="form-group">
            <label class="form-label">Password</label>
            <input name="userPasswordConfirm" id="userPasswordConfirm" class="form-control" type="text" placeholder="Confirm Password">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="form-label">Name</label>
            <input name="userName" id="userNameEdit" class="form-control" type="text" placeholder="Name">
          </div>

          <div class="form-group">
            <label class="form-label">Email</label>
            <input name="userEmail" id="userEmailEdit" class="form-control" type="text" placeholder="Email">
          </div>

          <div class="form-group">
            <label class="form-label">Select User Access</label>
            <select name="accessRightId[]" class="form-control" id="selectUserAccessEdit" data-live-search="true" multiple>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Select User Group</label>
            <select name="groupId[]" class="form-control" id="selectUserGroupEdit" data-live-search="true" multiple>

            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteData">
        <div class="modal-body">
          <input type="hidden" name="userId" id="userIdDelete" value="">
          <p>Are you sure want to delete this data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAccessAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="saveAccessData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="form-label">Access Name</label>
            <input name="accessName" id="accessName" class="form-control" type="text" placeholder="Access Name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAccessEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateAccessData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="form-label">Access Name</label>
            <input name="accessName" id="accessNameEdit" class="form-control" type="text" placeholder="Access Name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAccessDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteAccessData">
        <div class="modal-body">
          <input type="hidden" name="accessRightId" id="accessRightIdDelete" value="">
          <p>Are you sure want to delete this data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalGroupAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="saveGroupData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="form-label">Group Name</label>
            <input name="groupName" id="groupName" class="form-control" type="text" placeholder="Group Name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalGroupEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateGroupData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="form-label">Group Name</label>
            <input name="groupName" id="groupNameEdit" class="form-control" type="text" placeholder="Group Name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalGroupDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteGroupData">
        <div class="modal-body">
          <input type="hidden" name="groupId" id="groupIdDelete" value="">
          <p>Are you sure want to delete this data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  function loadData(){
    table = $('#getData').DataTable({
      "responsive" : true,
      "destroy" : true,
      "processing" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "<?= base_url('User/get_data') ?>",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0, 5],
        "orderable" : false,
        "className" : "text-center"
      }],
    });
  }

  function loadAccessData(){
    table = $('#getAccessData').DataTable({
      "responsive" : true,
      "destroy" : true,
      "processing" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "<?= base_url('User/get_access_data') ?>",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0, 2],
        "orderable" : false,
        "className" : "text-center"
      }],
    });
  }

  function loadGroupData(){
    table = $('#getGroupData').DataTable({
      "responsive" : true,
      "destroy" : true,
      "processing" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "<?= base_url('User/get_group_data') ?>",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0, 2],
        "orderable" : false,
        "className" : "text-center"
      }],
    });
  }

	$(document).ready(function(){
		loadData();
    loadAccessData();
    loadGroupData();

    // SAVE DATA
    $('#saveData').submit(function(e){
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('add-user')?>",
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.error){
            $('.msgError').html(res.error).show();
          }else{
            if(res.response){
              populateSuccess(res.message);
            }else{
              populateError(res.message);
            }
            $('#modalAdd').modal('hide');
            loadData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA EDIT
    $('#dataList').on('click','#btnEdit',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('User/get_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalEdit').modal('show');
          $('#userNameEdit').val(data.userName);
          $('#userEmailEdit').val(data.userEmail);
          $('#selectUserGroupEdit').selectpicker('val', res.arr_group);
          $('#selectUserAccessEdit').selectpicker('val', res.arr_access);
          $('#updateData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //EDIT DATA
    $('#updateData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('edit-user/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.error){
            $('.msgError').html(res.error).show();
          }else{
            if(res.response){
              populateSuccess(res.message);
            }else{
              populateError(res.message);
            }
            $('#modalEdit').modal('hide');
            loadData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //DELETE
    $('#dataList').on('click','#btnDelete',function(){
      var id = $(this).attr('data');
      $('#modalDelete').modal('show');
      $('#userIdDelete').val(id);
      $('#deleteData').attr("data", id);
    });	

    //DELETE DATA
    $('#deleteData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('delete-user/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalDelete').modal('hide');
          loadData();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    // SAVE DATA
    $('#saveAccessData').submit(function(e){
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('add-access-right')?>",
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.error){
            $('.msgError').html(res.error).show();
          }else{
            if(res.response){
              populateSuccess(res.message);
            }else{
              populateError(res.message);
            }
            $('#modalAccessAdd').modal('hide');
            loadAccessData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

     //GET DATA EDIT
    $('#dataAccessList').on('click','#btnAccessEdit',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('User/get_access_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalAccessEdit').modal('show');
          $('#accessNameEdit').val(data.accessName);
          $('#updateAccessData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //EDIT DATA
    $('#updateAccessData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('edit-access-right/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.error){
            $('.msgError').html(res.error).show();
          }else{
            if(res.response){
              populateSuccess(res.message);
            }else{
              populateError(res.message);
            }
            $('#modalAccessEdit').modal('hide');
            loadAccessData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //DELETE
    $('#dataAccessList').on('click','#btnAccessDelete',function(){
      var id = $(this).attr('data');
      $('#modalAccessDelete').modal('show');
      $('#accessRightIdDelete').val(id);
      $('#deleteAccessData').attr("data", id);
    });	

    //DELETE DATA
    $('#deleteAccessData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('delete-access-right/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalAccessDelete').modal('hide');
          loadAccessData();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    // SAVE DATA
    $('#saveGroupData').submit(function(e){
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('add-user-group')?>",
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.error){
            $('.msgError').html(res.error).show();
          }else{
            if(res.response){
              populateSuccess(res.message);
            }else{
              populateError(res.message);
            }
            $('#modalGroupAdd').modal('hide');
            loadGroupData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

     //GET DATA EDIT
     $('#dataGroupList').on('click','#btnGroupEdit',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('User/get_group_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalGroupEdit').modal('show');
          $('#groupNameEdit').val(data.groupName);
          $('#updateGroupData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //EDIT DATA
    $('#updateGroupData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('edit-user-group/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.error){
            $('.msgError').html(res.error).show();
          }else{
            if(res.response){
              populateSuccess(res.message);
            }else{
              populateError(res.message);
            }
            $('#modalGroupEdit').modal('hide');
            loadGroupData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //DELETE
    $('#dataGroupList').on('click','#btnGroupDelete',function(){
      var id = $(this).attr('data');
      $('#modalGroupDelete').modal('show');
      $('#groupIdDelete').val(id);
      $('#deleteGroupData').attr("data", id);
    });	

    //DELETE DATA
    $('#deleteGroupData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('delete-user-group/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalGroupDelete').modal('hide');
          loadGroupData();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

	});
</script>

<?php $this->load->view('template/footer');?>