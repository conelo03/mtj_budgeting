<script type="text/javascript">
  function loadQuotationData(){
    table = $('#getQuotationData').DataTable({
      "autoWidth": false,
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

  function loadBudgetData(){
    table = $('#getBudgetData').DataTable({
      "autoWidth": false,
      "responsive" : true,
      "destroy" : true,
      "processing" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "<?= base_url('Project/get_budget_data/'.$project['projectId']) ?>",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0, 7],
        "orderable" : false,
        "className" : "text-center"
      }],
    });
  }

  function loadProposedCostData(){
    table = $('#getProposedCostData').DataTable({
      "autoWidth": false,
      "responsive" : true,
      "destroy" : true,
      "processing" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "<?= base_url('Project/get_proposed_cost_data/'.$project['projectId']) ?>",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0, 8],
        "orderable" : false,
        "className" : "text-center"
      }],
    });
  }

  function loadProposedBudgetData(){
    table = $('#getProposedBudgetData').DataTable({
      "autoWidth": false,
      "responsive" : true,
      "destroy" : true,
      "processing" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "<?= base_url('Project/get_proposed_budget_data/'.$project['projectId']) ?>",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0, 17],
        "orderable" : false,
        "className" : "text-center"
      }],
    });
  }

  function loadProjectQuotation(){
    $.ajax({
      type: "GET", 
      url: "<?= base_url("Project/get_project_quotation/".$project['projectId']); ?>", 
      async : true,
      dataType: "JSON",
      success: function(res) {
        if(res.response === true){
          $("#selectProjectQuotation").html(res.data_pq.data).selectpicker('refresh');
          $("#selectProjectQuotationEdit").html(res.data_pq.data).selectpicker('refresh');
        } else {
          $('#item-error').html('Access not Found!');
        }
      }, 
    });
  }

  function loadProposedCost(){
    $.ajax({
      type: "GET", 
      url: "<?= base_url("Project/get_proposed_cost/".$project['projectId']); ?>", 
      async : true,
      dataType: "JSON",
      success: function(res) {
        if(res.response === true){
          $("#selectProposedCost").html(res.data_pc.data).selectpicker('refresh');
          $("#selectProposedCostEdit").html(res.data_pc.data).selectpicker('refresh');
        } else {
          $('#item-error').html('Access not Found!');
        }
      }, 
    });
  }

  function loadBudget(){
    $.ajax({
      type: "GET", 
      url: "<?= base_url("Project/get_budget/".$project['projectId']); ?>", 
      async : true,
      dataType: "JSON",
      success: function(res) {
        if(res.response === true){
          $("#selectBudget").html(res.data_budget.data).selectpicker('refresh');
          $("#selectBudgetEdit").html(res.data_budget.data).selectpicker('refresh');
        } else {
          $('#item-error').html('Access not Found!');
        }
      }, 
    });
  }

	$(document).ready(function(){
    loadProjectQuotation();
    loadProposedCost();
    loadBudget();
		loadQuotationData();
    loadBudgetData();
    loadProposedCostData();
    loadProposedBudgetData();

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
            $("#selectQuotationHeader").val('').selectpicker('refresh');
            document.getElementById('saveQuotationData').reset();
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

    // SAVE DATA
    $('#saveBudgetData').submit(function(e){
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('add-budget/'.$project['projectId'])?>",
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
            $('#modalBudgetAdd').modal('hide');
            $("#selectProjectQuotation").val('').selectpicker('refresh');
            document.getElementById('saveBudgetData').reset();
            loadBudgetData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA EDIT
    $('#dataBudgetList').on('click','#btnBudgetEdit',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_budget_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalBudgetEdit').modal('show');
          $('#selectProjectQuotationEdit').selectpicker('val', data.projectQuotationId);
          $('#orderNoEditBudget').val(data.orderNo);
          $('#budgetEdit').val(data.budget);
          $('#descriptionEditBudget').val(data.description);
          $("input[name=isFinal][value=" + data.isFinal + "]").prop('checked', true);
          $('#updateBudgetData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //EDIT DATA
    $('#updateBudgetData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('edit-budget/')?>" + id,
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
            $('#modalBudgetEdit').modal('hide');
            loadBudgetData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //DELETE
    $('#dataBudgetList').on('click','#btnBudgetDelete',function(){
      var id = $(this).attr('data');
      $('#modalBudgetDelete').modal('show');
      $('#budgetIdDelete').val(id);
      $('#deleteBudgetData').attr("data", id);
    });	

    //DELETE DATA
    $('#deleteBudgetData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('delete-budget/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalBudgetDelete').modal('hide');
          loadBudgetData();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    // SAVE DATA
    $('#saveProposedCostData').submit(function(e){
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('add-proposed-cost/'.$project['projectId'])?>",
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
            $('#modalProposedCostAdd').modal('hide');
            document.getElementById('saveProposedCostData').reset();
            loadProposedCostData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA EDIT
    $('#dataProposedCostList').on('click','#btnProposedCostEdit',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_proposed_cost_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalProposedCostEdit').modal('show');
          $('#proposedCostNameEdit').val(data.proposedCostName);
          $('#proposedValueEdit').val(data.proposedValue);
          $('#detailDescriptionEditPC').val(data.detailDescription);
          $('#distributionDateEdit').val(data.distributionDate);
          $("input[name=isFinal][value=" + data.isFinal + "]").prop('checked', true);
          $('#updateProposedCostData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //EDIT DATA
    $('#updateProposedCostData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('edit-proposed-cost/')?>" + id,
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
            $('#modalProposedCostEdit').modal('hide');
            loadProposedCostData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //DELETE
    $('#dataProposedCostList').on('click','#btnProposedCostDelete',function(){
      var id = $(this).attr('data');
      $('#modalProposedCostDelete').modal('show');
      $('#proposedCostIdDelete').val(id);
      $('#deleteProposedCostData').attr("data", id);
    });	

    //DELETE DATA
    $('#deleteProposedCostData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('delete-proposed-cost/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalProposedCostDelete').modal('hide');
          loadProposedCostData();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    // SAVE DATA
    $('#saveProposedBudgetData').submit(function(e){
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('add-proposed-budget/'.$project['projectId'])?>",
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
            $('#modalProposedBudgetAdd').modal('hide');
            document.getElementById('saveProposedBudgetData').reset();
            loadProposedBudgetData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA EDIT
    $('#dataProposedBudgetList').on('click','#btnProposedBudgetEdit',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_proposed_budget_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalProposedBudgetEdit').modal('show');
          $('#selectProposedCostEdit').selectpicker('val', data.proposedCostId);
          $('#selectBudgetEdit').selectpicker('val', data.budgetId);
          $('#proposedBudgetDescriptionEdit').val(data.proposedBudgetDescription);
          $('#proposedBudgetValueEdit').val(data.proposedBudgetValue);
          $('#updateProposedBudgetData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //EDIT DATA
    $('#updateProposedBudgetData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('edit-proposed-budget/')?>" + id,
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
            $('#modalProposedBudgetEdit').modal('hide');
            loadProposedBudgetData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //DELETE
    $('#dataProposedBudgetList').on('click','#btnProposedBudgetDelete',function(){
      var id = $(this).attr('data');
      $('#modalProposedBudgetDelete').modal('show');
      $('#proposedBudgetIdDelete').val(id);
      $('#deleteProposedBudgetData').attr("data", id);
    });	

    //DELETE DATA
    $('#deleteProposedBudgetData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('delete-proposed-budget/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalProposedBudgetDelete').modal('hide');
          loadProposedBudgetData();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA EDIT
    $('#dataProposedBudgetList').on('click','#btnProposedBudgetApprove',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_proposed_budget_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalProposedBudgetApprove').modal('show');
          $('#approvedDescriptionApprove').val(data.approvedDescription);
          $('#approvedValueApprove').val(data.approvedValue);
          $('#approveProposedBudgetData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //EDIT DATA
    $('#approveProposedBudgetData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('approve-proposed-budget/')?>" + id,
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
            $('#modalProposedBudgetApprove').modal('hide');
            loadProposedBudgetData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA EDIT
    $('#dataProposedBudgetList').on('click','#btnProposedBudgetReject',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_proposed_budget_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          console.log(data.isFinal);
          $('#modalProposedBudgetReject').modal('show');
          $('#rejectedDescriptionReject').val(data.rejectedDescription);
          $("input[id=isFinalReject][value=" + data.isFinal + "]").prop('checked', true);
          $('#rejectProposedBudgetData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //EDIT DATA
    $('#rejectProposedBudgetData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('reject-proposed-budget/')?>" + id,
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
            $('#modalProposedBudgetReject').modal('hide');
            loadProposedBudgetData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

	});
</script>