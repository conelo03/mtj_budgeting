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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="modalQuotationAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="saveQuotationData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="form-label">Select Quotation Header</label>
            <select name="quotationHeaderId" class="form-control" id="selectQuotationHeader" data-live-search="true" required>

            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Order No</label>
            <input name="orderNo" id="orderNo" class="form-control" type="text" placeholder="Order No">
          </div>

          <div class="form-group">
            <label class="form-label">Project Quotation Name</label>
            <input name="projectQuotationName" id="projectQuotationName" class="form-control" type="text" placeholder="Project Quotation Name">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Value</label>
            <input name="quoteValue" id="quoteValue" class="form-control" type="number">
          </div>

          <div class="form-group">
            <label class="form-label">Cost</label>
            <input name="estCost" id="estCost" class="form-control" type="number">
          </div>

          <div class="form-group">
            <label class="form-label">Detail Description</label>
            <textarea name="detailDescription" id="detailDescription" class="form-control" type="text" placeholder="Detail Description"></textarea>
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

<div class="modal fade" id="modalQuotationEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="updateQuotationData">
        <div class="modal-body">
          <span class="text-danger msgError" style="display: none"></span>
          <div class="form-group">
            <label class="form-label">Select Quotation Header</label>
            <select name="quotationHeaderId" class="form-control" id="selectQuotationHeaderEdit" data-live-search="true" required>

            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Order No</label>
            <input name="orderNo" id="orderNoEdit" class="form-control" type="text" placeholder="Order No">
          </div>

          <div class="form-group">
            <label class="form-label">Project Quotation Name</label>
            <input name="projectQuotationName" id="projectQuotationNameEdit" class="form-control" type="text" placeholder="Project Quotation Name">
          </div>

          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" id="descriptionEdit" class="form-control" type="text" placeholder="Description"></textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Value</label>
            <input name="quoteValue" id="quoteValueEdit" class="form-control" type="number">
          </div>

          <div class="form-group">
            <label class="form-label">Cost</label>
            <input name="estCost" id="estCostEdit" class="form-control" type="number">
          </div>

          <div class="form-group">
            <label class="form-label">Detail Description</label>
            <textarea name="detailDescription" id="detailDescriptionEdit" class="form-control" type="text" placeholder="Detail Description"></textarea>
          </div>

          <div class="form-group">
            <label class="d-block">Final</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="isFinal" value="1" id="isFinalEdit" >
              <label class="form-check-label" for="exampleRadios3">
                Yes
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="isFinal" value="0" id="isFinalEdit">
              <label class="form-check-label" for="exampleRadios4">
                No
              </label>
            </div>
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

<div class="modal fade" id="modalQuotationDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteQuotationData">
        <div class="modal-body">
          <input type="hidden" name="projectQuotationId" id="projectQuotationIdDelete" value="">
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
  function loadQuotationData(){
    table = $('#getQuotationData').DataTable({
      "responsive" : true,
      "destroy" : true,
      "processing" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "<?= base_url('Project/get_quotation_data/'.$project['projectId']) ?>",
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
		loadQuotationData();

    // SAVE DATA
    $('#saveQuotationData').submit(function(e){
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('add-project-quotation/'.$project['projectId'])?>",
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
            $('#modalQuotationAdd').modal('hide');
            loadQuotationData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA EDIT
    $('#dataQuotationList').on('click','#btnQuotationEdit',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_quotation_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalQuotationEdit').modal('show');
          $('#selectQuotationHeaderEdit').selectpicker('val', data.quotationHeaderId);
          $('#orderNoEdit').val(data.orderNo);
          $('#projectQuotationNameEdit').val(data.projectQuotationName);
          $('#descriptionEdit').val(data.description);
          $('#quoteValueEdit').val(data.quoteValue);
          $('#estCostEdit').val(data.estCost);
          $('#detailDescriptionEdit').val(data.detailDescription);
          $("input[name=isFinal][value=" + data.isFinal + "]").prop('checked', true);
          $('#updateQuotationData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //EDIT DATA
    $('#updateQuotationData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('edit-project-quotation/')?>" + id,
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
            $('#modalQuotationEdit').modal('hide');
            loadQuotationData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //DELETE
    $('#dataQuotationList').on('click','#btnQuotationDelete',function(){
      var id = $(this).attr('data');
      $('#modalQuotationDelete').modal('show');
      $('#projectQuotationIdDelete').val(id);
      $('#deleteQuotationData').attr("data", id);
    });	

    //DELETE DATA
    $('#deleteQuotationData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('delete-project-quotation/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalQuotationDelete').modal('hide');
          loadQuotationData();
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