<?php $this->load->view('template/header');?>
<?php $this->load->view('template/sidebar');?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= $title?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Kelola Project Group</a></div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Project Group</h4>
              <div class="card-header-action">
                <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i> Add Data</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="getData">
                  <thead>
                    <tr>
                      <th class="text-center" style="width: 20px;">#</th>
                      <th>Project Group Name</th>
                      <th>Description</th>
                      <th class="text-center" style="width: 200px;">Action</th>
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
            <label class="form-label">Name</label>
            <input name="projectGroupName" id="projectGroupName" class="form-control" type="text" placeholder="Name">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" type="text" placeholder="Description"></textarea>
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
            <input name="projectGroupName" id="projectGroupNameEdit" class="form-control" type="text" placeholder="Name">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="descriptionEdit" class="form-control" type="text" placeholder="Description"></textarea>
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
          <input type="hidden" name="projectGroupId" id="projectGroupIdDelete" value="">
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
        "url" : "<?= base_url('ProjectGroup/get_data') ?>",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0, 3],
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
        url  : "<?php echo base_url('add-project-group')?>",
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
        url  : "<?= base_url('ProjectGroup/get_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalEdit').modal('show');
          $('#projectGroupNameEdit').val(data.projectGroupName);
          $('#descriptionEdit').val(data.description);
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
        url  : "<?= base_url('edit-project-group/')?>" + id,
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
      $('#projectGroupIdDelete').val(id);
      $('#deleteData').attr("data", id);
    });	

    //DELETE DATA
    $('#deleteData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('delete-project-group/')?>" + id,
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

	});
</script>

<?php $this->load->view('template/footer');?>