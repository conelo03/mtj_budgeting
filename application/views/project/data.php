<?php $this->load->view('template/header');?>
<?php $this->load->view('template/sidebar');?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= $title?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Kelola Project</a></div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Project</h4>
              <div class="card-header-action">
                <?php if(is_project_manager() || is_finance()): ?>
                  <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i> Add Data</a>
                <?php endif; ?>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="getData" style="table-layout: fixed; width: 100%;">
                  <thead>
                    <tr>
                      <th class="text-center" style="width: 20px;">#</th>
                      <th style="width: 100px;">ID</th>
                      <th style="width: 100px;">Project Group</th>
                      <th style="width: 200px;">Project Name</th>
                      <th style="width: 100px;">Client</th>
                      <th style="width: 200px;">Description</th>
                      <th style="width: 100px;">Value</th>
                      <th style="width: 100px;">Approval</th>
                      <th style="width: 100px;">Status</th>
                      <th class="text-center" style="width: 250px;">Action</th>
                    </tr>
                  </thead>
                  <tbody id="dataList">
                    
                  </tbody>
                </table>
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
            <label class="form-label">Select Client</label>
            <select name="clientId" class="form-control" id="selectClient" data-live-search="true" required>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Select Group Project</label>
            <select name="projectGroupId" class="form-control" id="selectGroupProject" data-live-search="true" required>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Select Team</label>
            <select name="userId[]" class="form-control" id="selectTeam" data-live-search="true" multiple>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Project Name</label>
            <input name="projectName" id="projectName" class="form-control" type="text" placeholder="Project Name">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Value</label>
            <input name="value" id="value" class="form-control" type="text" onkeyup="rupiah(this)">
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
            <label class="form-label">Select Client</label>
            <select name="clientId" class="form-control" id="selectClientEdit" data-live-search="true" required>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Select Group Project</label>
            <select name="projectGroupId" class="form-control" id="selectGroupProjectEdit" data-live-search="true">

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Select Team</label>
            <select name="userId[]" class="form-control" id="selectTeamEdit" data-live-search="true" multiple>

            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Project Name</label>
            <input name="projectName" id="projectNameEdit" class="form-control" type="text" placeholder="Project Name">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="descriptionEdit" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Value</label>
            <input name="value" id="valueEdit" class="form-control" type="text" onkeyup="rupiah(this)">
          </div>
          <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" id="statusEdit" data-live-search="true">
              <option value="PENDING">PENDING</option>
              <option value="ON GOING">ON GOING</option>
              <option value="COMPLETED">COMPLETED</option>
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
          <input type="hidden" name="projectId" id="projectIdDelete" value="">
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

<div class="modal fade" id="modalApprove" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="approveData">
        <div class="modal-body">
          <input type="hidden" name="projectId" id="projectIdApprove" value="">
          <p>Are you sure want to Approve this data?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Approve</button>
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
        "url" : "<?= base_url('Project/get_data') ?>",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0, 8],
        "orderable" : false,
        "className" : "text-center"
      }],
    });
  }

  

	$(document).ready(function(){
		loadData();

    // SAVE DATA
    $('#saveData').submit(function(e){
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('add-project')?>",
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
            document.getElementById('saveData').reset();
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
        url  : "<?= base_url('Project/get_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalEdit').modal('show');
          $('#selectClientEdit').selectpicker('val', data.clientId);
          $('#selectGroupProjectEdit').selectpicker('val', data.projectGroupId);
          $('#selectTeamEdit').selectpicker('val', res.arr_team);
          $('#projectNameEdit').val(data.projectName);
          $('#descriptionEdit').val(data.description);
          if(data.approved == 'PENDING'){
            document.getElementById("valueEdit").disabled = false;
            $('#valueEdit').val(formatRupiah(data.value, ''));
          }else{
            document.getElementById("valueEdit").disabled = true;
            $('#valueEdit').val(formatRupiah(data.value, ''));
          }
          $('#statusEdit').val(data.status);
          $('#selectApprovedEdit').selectpicker('val', data.projectGroupId);
          $('#selectStatusEdit').selectpicker('val', data.projectGroupId);
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
      $.ajax({
        type : "POST",
        url  : "<?= base_url('edit-project/')?>" + id,
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
            document.getElementById('updateData').reset();
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
      $('#projectIdDelete').val(id);
      $('#deleteData').attr("data", id);
    });	

    //DELETE DATA
    $('#deleteData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('delete-project/')?>" + id,
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

    //APPROVE
    $('#dataList').on('click','#btnApprove',function(){
      var id = $(this).attr('data');
      $('#modalApprove').modal('show');
      $('#projectIdApprove').val(id);
      $('#approveData').attr("data", id);
    });	

    //Approve DATA
    $('#approveData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('approve-project/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalApprove').modal('hide');
          loadData();
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