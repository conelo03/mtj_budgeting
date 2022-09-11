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

  function loadDistributionCostData(){
    table = $('#getDistributionCostData').DataTable({
      "autoWidth": false,
      "responsive" : true,
      "destroy" : true,
      "processing" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "<?= base_url('Project/get_distribution_cost_data/'.$project['projectId']) ?>",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0, 7],
        "orderable" : false,
        "className" : "text-center"
      }],
    });
  }

  function loadRealBudgetData(){
    table = $('#getRealBudgetData').DataTable({
      "autoWidth": false,
      "responsive" : true,
      "destroy" : true,
      "processing" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "<?= base_url('Project/get_real_budget_data/'.$project['projectId']) ?>",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0, 9],
        "orderable" : false,
        "className" : "text-center"
      }],
    });
  }

  function loadReportBudgetData(){
    table = $('#getReportBudgetData').DataTable({
      "autoWidth": false,
      "responsive" : true,
      "destroy" : true,
      "processing" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "<?= base_url('Project/get_report_budget_data/'.$project['projectId']) ?>",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0, 4],
        "orderable" : false,
        "className" : "text-center"
      }],
    });
  }

  function loadNotesData(){
    table = $('#getNotesData').DataTable({
      "autoWidth": false,
      "responsive" : true,
      "destroy" : true,
      "processing" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "<?= base_url('Project/get_notes_data/'.$project['projectId']) ?>",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0, 5],
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
          $("#selectProposedCostForDC").html(res.data_pc.data).selectpicker('refresh');
          $("#selectProposedCostForDCEdit").html(res.data_pc.data).selectpicker('refresh');
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
          $("#selectBudgetRBEdit").html(res.data_budget.data).selectpicker('refresh');
          $("#selectBudgetRepBudget").html(res.data_budget.data).selectpicker('refresh');
          $("#selectBudgetRepBudgetEdit").html(res.data_budget.data).selectpicker('refresh');
        } else {
          $('#item-error').html('Access not Found!');
        }
      }, 
    });
  }

  function loadUser(){
    $.ajax({
      type: "GET", 
      url: "<?= base_url("Project/get_user"); ?>", 
      async : true,
      dataType: "JSON",
      success: function(res) {
        if(res.response === true){
          $("#selectUser").html(res.data_user.data).selectpicker('refresh');
          $("#selectUserEdit").html(res.data_user.data).selectpicker('refresh');
        } else {
          $('#item-error').html('Access not Found!');
        }
      }, 
    });
  }

  function loadDistributionCost(){
    $.ajax({
      type: "GET", 
      url: "<?= base_url("Project/get_distribution_cost/".$project['projectId']); ?>", 
      async : true,
      dataType: "JSON",
      success: function(res) {
        if(res.response === true){
          $("#selectDistributionCost").html(res.data_dc.data).selectpicker('refresh');
          $("#selectDistributionCostEdit").html(res.data_dc.data).selectpicker('refresh');
        } else {
          $('#item-error').html('Access not Found!');
        }
      }, 
    });
  }

  function loadRealBudget(){
    $.ajax({
      type: "GET", 
      url: "<?= base_url("Project/get_real_budget/".$project['projectId']); ?>", 
      async : true,
      dataType: "JSON",
      success: function(res) {
        if(res.response === true){
          $("#selectRealBudget").html(res.data_rb.data).selectpicker('refresh');
          $("#selectRealBudgetEdit").html(res.data_rb.data).selectpicker('refresh');
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
    loadUser();
    loadDistributionCost();
    loadRealBudget();
		loadQuotationData();
    loadBudgetData();
    loadProposedCostData();
    loadProposedBudgetData();
    loadDistributionCostData();
    loadRealBudgetData();
    loadReportBudgetData();
    loadNotesData();

    //QUOTATION
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
            loadProjectQuotation();
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
            loadProjectQuotation();
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
          loadProjectQuotation();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    // BUDGET
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
            loadBudget();
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
            loadBudget();
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
          loadBudget();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //PROPOSED COST
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
            loadProposedCost();
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
            loadProposedCost();
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
          loadProposedCost();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //PROPOSED BUDGET
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

    //APPROVE DATA
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

    //REJECT DATA
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

    //DISTRIBUTION COST
    // SAVE DATA
    $('#saveDistributionCostData').submit(function(e){
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('add-distribution-cost/'.$project['projectId'])?>",
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
            $('#modalDistributionCostAdd').modal('hide');
            document.getElementById('saveDistributionCostData').reset();
            loadDistributionCostData();
            loadDistributionCost();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA EDIT
    $('#dataDistributionCostList').on('click','#btnDistributionCostEdit',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_distribution_cost_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalDistributionCostEdit').modal('show');
          $('#selectProposedCostForDCEdit').selectpicker('val', data.proposedCostId);
          $('#selectUserEdit').selectpicker('val', data.holder);
          $('#valueEdit').val(data.value);
          $('#descriptionDCEdit').val(data.description);
          $('#updateDistributionCostData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //EDIT DATA
    $('#updateDistributionCostData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('edit-distribution-cost/')?>" + id,
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
            $('#modalDistributionCostEdit').modal('hide');
            loadDistributionCostData();
            loadDistributionCost();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //DELETE
    $('#dataDistributionCostList').on('click','#btnDistributionCostDelete',function(){
      var id = $(this).attr('data');
      $('#modalDistributionCostDelete').modal('show');
      $('#distributionCostIdDelete').val(id);
      $('#deleteDistributionCostData').attr("data", id);
    });	

    //DELETE DATA
    $('#deleteDistributionCostData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('delete-distribution-cost/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalDistributionCostDelete').modal('hide');
          loadDistributionCostData();
          loadDistributionCost();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //REAL BUDGET
    // SAVE DATA
    $('#saveRealBudgetData').submit(function(e){
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('add-real-budget/'.$project['projectId'])?>",
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
            $('#modalRealBudgetAdd').modal('hide');
            document.getElementById('saveRealBudgetData').reset();
            loadRealBudgetData();
            loadRealBudget();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA EDIT
    $('#dataRealBudgetList').on('click','#btnRealBudgetEdit',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_real_budget_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalRealBudgetEdit').modal('show');
          $('#selectDistributionCostEdit').selectpicker('val', data.distributionCostId);
          $('#realBudgetValueEdit').val(data.realBudgetValue);
          $('#descriptionRBEdit').val(data.description);
          $('#updateRealBudgetData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //EDIT DATA
    $('#updateRealBudgetData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('edit-real-budget/')?>" + id,
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
            $('#modalRealBudgetEdit').modal('hide');
            loadRealBudgetData();
            loadRealBudget();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //DELETE
    $('#dataRealBudgetList').on('click','#btnRealBudgetDelete',function(){
      var id = $(this).attr('data');
      $('#modalRealBudgetDelete').modal('show');
      $('#realBudgetIdDelete').val(id);
      $('#deleteRealBudgetData').attr("data", id);
    });	

    //DELETE DATA
    $('#deleteRealBudgetData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('delete-real-budget/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalRealBudgetDelete').modal('hide');
          loadRealBudgetData();
          loadRealBudget();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA EDIT
    $('#dataRealBudgetList').on('click','#btnRealBudgetSelectBudget',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_real_budget_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalRealBudgetSelectBudget').modal('show');
          $('#selectBudgetRBEdit').selectpicker('val', data.budgetId);
          $('#updateBudgetRealBudgetData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //EDIT DATA
    $('#updateBudgetRealBudgetData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('select-budget-real-budget/')?>" + id,
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
            $('#modalRealBudgetSelectBudget').modal('hide');
            loadRealBudgetData();
            loadRealBudget();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //REPORT BUDGET
    // SAVE DATA
    $('#saveReportBudgetData').submit(function(e){
      const formData = new FormData($("#saveReportBudgetData")[0]); 

      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('add-report-budget/'.$project['projectId'])?>",
        dataType : "JSON",
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        data: formData,
        success: function(res){
          if(res.error){
            $('.msgError').html(res.error).show();
          }else{
            if(res.response){
              populateSuccess(res.message);
            }else{
              populateError(res.message);
            }
            $('#modalReportBudgetAdd').modal('hide');
            document.getElementById('saveReportBudgetData').reset();
            loadReportBudgetData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA DETAIL
    $('#dataReportBudgetList').on('click','#btnReportBudgetDetail',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_report_budget_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalReportBudgetDetail').modal('show');
          $('#reportBudgetFileName').attr('src',`<?= base_url('assets/upload/report-budget/') ?>${data.fileName}`);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA EDIT
    $('#dataReportBudgetList').on('click','#btnReportBudgetEdit',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_report_budget_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalReportBudgetEdit').modal('show');
          $('#selectRealBudgetEdit').selectpicker('val', data.realBudgetId);
          $('#reportBudgetValueEdit').val(data.reportBudgetValue);
          $('#descriptionReportBudgetEdit').val(data.description);
          $('#fileNameEdit').val(data.fileName);
          $('#updateReportBudgetData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    // EDIT DATA
    $('#updateReportBudgetData').submit(function(e){
      let id = $(this).attr('data');
      const formData = new FormData($("#updateReportBudgetData")[0]); 

      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('edit-report-budget/')?>" + id,
        dataType : "JSON",
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        data: formData,
        success: function(res){
          if(res.error){
            $('.msgError').html(res.error).show();
          }else{
            if(res.response){
              populateSuccess(res.message);
            }else{
              populateError(res.message);
            }
            $('#modalReportBudgetEdit').modal('hide');
            loadReportBudgetData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //DELETE
    $('#dataReportBudgetList').on('click','#btnReportBudgetDelete',function(){
      var id = $(this).attr('data');
      $('#modalReportBudgetDelete').modal('show');
      $('#reportBudgetIdDelete').val(id);
      $('#deleteReportBudgetData').attr("data", id);
    });	

    //DELETE DATA
    $('#deleteReportBudgetData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('delete-report-budget/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalReportBudgetDelete').modal('hide');
          loadReportBudgetData();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //REAL BUDGET
    // SAVE DATA
    $('#saveNotesData').submit(function(e){
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('add-notes/'.$project['projectId'])?>",
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
            $('#modalNotesAdd').modal('hide');
            document.getElementById('saveNotesData').reset();
            loadNotesData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA EDIT
    $('#dataNotesList').on('click','#btnNotesEdit',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_notes_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalNotesEdit').modal('show');
          $("input[name=notesType][value=" + data.notesType + "]").prop('checked', true);
          $('#notesEdit').val(data.notes);
          $('#updateNotesData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //EDIT DATA
    $('#updateNotesData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('edit-notes/')?>" + id,
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
            $('#modalNotesEdit').modal('hide');
            loadNotesData();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //DELETE
    $('#dataNotesList').on('click','#btnNotesDelete',function(){
      var id = $(this).attr('data');
      $('#modalNotesDelete').modal('show');
      $('#notesIdDelete').val(id);
      $('#deleteNotesData').attr("data", id);
    });	

    //DELETE DATA
    $('#deleteNotesData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('delete-notes/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalNotesDelete').modal('hide');
          loadNotesData();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });


	});
</script>