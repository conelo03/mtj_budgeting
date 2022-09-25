<script type="text/javascript">
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
        "targets" : [0, 6],
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
        "targets" : [0, 13],
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
        "targets" : [0],
        "orderable" : false,
        "className" : "text-center"
      }],
    });
  }

  function loadReportCostData(){
    table = $('#getReportCostData').DataTable({
      "autoWidth": false,
      "responsive" : true,
      "destroy" : true,
      "processing" : true,
      "serverside" : true,
      "ajax" : {
        "url" : "<?= base_url('Project/get_report_cost_data/'.$project['projectId']) ?>",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0, 4],
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
      url: "<?= base_url("Project/get_user/".$project['projectId']); ?>", 
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

  function loadDetailProject(){
    $.ajax({
      type: "GET", 
      url: "<?= base_url("Project/get_detail_project/".$project['projectId']); ?>", 
      async : true,
      dataType: "JSON",
      success: function(res) {
        if(res.response === true){
          let totalBudget = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(res.budget.budget);
          let reportBudget = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(res.reportBudget.reportCostValue);
          let remainingBudget = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(res.budget.budget - res.reportBudget.reportCostValue);
          let distributionCost = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(res.distributionCost.value);
          let reportCost = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(res.reportCost.reportCostValue);
          let remainingCost = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(res.distributionCost.value - res.reportCost.reportCostValue);
          let budgetUsage = res.reportBudget.reportCostValue / res.budget.budget * 100;

          $('#projectId').html(res.dp.generateId).show();
          $('#projectName').html(res.dp.projectName).show();
          $('#projectGroupName').html(res.dp.projectGroupName).show();
          $('#projectId2').html(res.dp.generateId).show();
          $('#projectName2').html(res.dp.projectName).show();
          $('#projectGroupName2').html(res.dp.projectGroupName).show();
          $('#projectClientName').html(res.dp.clientName).show();
          $('#projectDescription').html(res.dp.description).show();
          $('#projectManagerName').html(res.dp.userName).show();

          let waspang = '';
          res.team.forEach(i => {
            waspang += `<div class="col-md-12"><h6> - ${i.userName} </h6></div>`;
          });

          $('#projectTeam').html(waspang).show();
          
          if(budgetUsage < 60){
            $('#budgetUsage').attr('class', `progress-bar bg-success`);
            $('#budgetUsage').attr('data-width', `${budgetUsage}%`);
            $('#budgetUsage').attr('aria-valuenow', `${budgetUsage}`);
            $('#budgetUsage').attr('style', `width: ${budgetUsage}%`);
            $('#budgetUsage').html(`${budgetUsage}%`).show();
          }else if(budgetUsage >= 60 && budgetUsage < 85){
            $('#budgetUsage').attr('class', `progress-bar bg-warning`);
            $('#budgetUsage').attr('data-width', `${budgetUsage}%`);
            $('#budgetUsage').attr('aria-valuenow', `${budgetUsage}`);
            $('#budgetUsage').attr('style', `width: ${budgetUsage}%`);
            $('#budgetUsage').html(`${budgetUsage}%`).show();
          }else if(budgetUsage >= 85){
            $('#budgetUsage').attr('class', `progress-bar bg-danger`);
            $('#budgetUsage').attr('data-width', `${budgetUsage}%`);
            $('#budgetUsage').attr('aria-valuenow', `${budgetUsage}`);
            $('#budgetUsage').attr('style', `width: ${budgetUsage}%`);
            $('#budgetUsage').html(`${budgetUsage}%`).show();
          }
          console.log(budgetUsage);

          $('#totalBudget').html(totalBudget).show();
          $('#reportBudget').html(reportBudget).show();
          $('#remainingBudget').html(remainingBudget).show();
          $('#distributionCost').html(distributionCost).show();
          $('#reportCost').html(reportCost).show();
          $('#remainingCost').html(remainingCost).show();
          $('#distributionCost2').html(distributionCost).show();
          $('#reportCost2').html(reportCost).show();
          $('#remainingCost2').html(remainingCost).show();
        } else {
          alert('Project not Found!');
        }
      }, 
    });
  }

	$(document).ready(function(){
    loadDetailProject();
    loadProposedCost();
    loadBudget();
    loadUser();
    loadDistributionCost();
    loadBudgetData();
    loadProposedCostData();
    loadDistributionCostData();
    loadRealBudgetData();
    loadReportCostData();
    loadReportBudgetData();
    loadNotesData();

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
            document.getElementById('saveBudgetData').reset();
            loadBudgetData();
            loadBudget();
            loadDetailProject();
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
          $('#orderNoEditBudget').val(data.orderNo);
          if(data.approved == 'PENDING'){
            document.getElementById("budgetEdit").disabled = false;
            $('#budgetEdit').val(data.budget);
          }else{
            document.getElementById("budgetEdit").disabled = true;
            $('#budgetEdit').val(data.budget);
          }
          
          $('#descriptionEditBudget').val(data.description);
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
            loadDetailProject();
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
            loadDetailProject();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //APPROVE
    $('#dataBudgetList').on('click','#btnBudgetApprove',function(){
      var id = $(this).attr('data');
      $('#modalBudgetApprove').modal('show');
      $('#budgetIdApprove').val(id);
      $('#approveBudgetData').attr("data", id);
    });	

    //APPROVE DATA
    $('#approveBudgetData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('approve-budget/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalBudgetApprove').modal('hide');
          loadBudgetData();
          loadBudget();
          loadDetailProject();
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
            loadDetailProject();
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
            loadDetailProject();
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
          loadDetailProject();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA APPROVE
    $('#dataProposedCostList').on('click','#btnProposedCostApprove',function(){
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
          $('#modalProposedCostApprove').modal('show');
          $('#proposedValueApprove').val(data.proposedValue);
          $('#approvedDescriptionApprove').val(data.approvedDescription);
          $('#approvedValueApprove').val(data.approvedValue);
          $('#approveProposedCostData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //APPROVE DATA
    $('#approveProposedCostData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('approve-proposed-cost/')?>" + id,
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
            $('#modalProposedCostApprove').modal('hide');
            loadProposedCostData();
            loadProposedCost();
            loadDetailProject();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA REJECT
    $('#dataProposedCostList').on('click','#btnProposedCostReject',function(){
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
          console.log(data.isFinal);
          $('#modalProposedCostReject').modal('show');
          $('#rejectedDescriptionReject').val(data.rejectedDescription);
          $('#rejectProposedCostData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //REJECT DATA
    $('#rejectProposedCostData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('reject-proposed-cost/')?>" + id,
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
            $('#modalProposedCostReject').modal('hide');
            loadProposedCostData();
            loadProposedCost();
            loadDetailProject();
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
          if(res.error || res.errorValue){
            $('.msgErrorValue').html(res.errorValue).show();
            $('.msgError').html(res.error).show();
          }else{
            if(res.response){
              populateSuccess(res.message);
            }else{
              populateError(res.message);
            }
            $('#modalDistributionCostAdd').modal('hide');
            $('.msgError').html('');
            $('.msgErrorValue').html('');
            document.getElementById('saveDistributionCostData').reset();
            loadProposedCost();
            loadRealBudgetData();
            loadUser();
            loadDistributionCostData();
            loadDistributionCost();
            loadDetailProject();
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
          $('.msgError').html('');
          $('.msgErrorValue').html('');
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
            loadRealBudgetData();
            loadDetailProject();
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
          loadRealBudgetData();
          loadDetailProject();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //REPORT COST
    // SAVE DATA
    $('#saveReportCostData').submit(function(e){
      const formData = new FormData($("#saveReportCostData")[0]); 

      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('add-report-cost/'.$project['projectId'])?>",
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
            $('#modalReportCostAdd').modal('hide');
            document.getElementById('saveReportCostData').reset();
            loadReportCostData();
            loadDistributionCost();
            loadReportBudgetData();
            loadDetailProject();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA DETAIL
    $('#dataReportCostList').on('click','#btnReportCostDetail',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_report_cost_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalReportCostDetail').modal('show');
          $('#reportCostFileName').attr('src',`<?= base_url('assets/upload/report-budget/') ?>${data.fileName}`);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //GET DATA EDIT
    $('#dataReportCostList').on('click','#btnReportCostEdit',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_report_cost_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalReportCostEdit').modal('show');
          $('#selectDistributionCost').selectpicker('val', data.distributionCostId);
          $('#reportCostValueEdit').val(data.reportCostValue);
          $('#descriptionReportCostEdit').val(data.description);
          $('#fileNameEdit').val(data.fileName);
          $('#updateReportCostData').attr("data", id);
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    // EDIT DATA
    $('#updateReportCostData').submit(function(e){
      let id = $(this).attr('data');
      const formData = new FormData($("#updateReportCostData")[0]); 

      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('edit-report-cost/')?>" + id,
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
            $('#modalReportCostEdit').modal('hide');
            loadReportCostData();
            loadReportBudgetData();
            loadDetailProject();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //DELETE
    $('#dataReportCostList').on('click','#btnReportCostDelete',function(){
      var id = $(this).attr('data');
      $('#modalReportCostDelete').modal('show');
      $('#reportCostIdDelete').val(id);
      $('#deleteReportCostData').attr("data", id);
    });	

    //DELETE DATA
    $('#deleteReportCostData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('delete-report-cost/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalReportCostDelete').modal('hide');
          loadReportCostData();
          loadReportBudgetData();
          loadDetailProject();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //REPORT BUDGET
    //GET DATA DETAIL
    $('#dataReportBudgetList').on('click','#btnReportBudgetSelectBudget',function(){
      let id = $(this).attr('data');
      $.ajax({
        type : "GET",
        url  : "<?= base_url('Project/get_report_cost_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('#modalReportBudgetSelectBudget').modal('show');
          $('#selectBudget').selectpicker('val', data.budgetId);
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

      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('edit-report-budget/')?>" + id,
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
            $('#modalReportBudgetSelectBudget').modal('hide');
            loadReportCostData();
            loadReportBudgetData();
            loadDetailProject();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //DELETE
    $('#dataReportBudgetList').on('click','#btnReportBudgetCancelBudget',function(){
      let id = $(this).attr('data');

      $('#modalReportBudgetCancel').modal('show');
      $('#reportCostIdCancel').val(id);
      $('#cancelReportBudgetData').attr("data", id);
    });	

    //DELETE DATA
    $('#cancelReportBudgetData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('cancel-report-budget/')?>" + id,
        dataType : "JSON",
        data : $(this).serialize(),
        success: function(res){
          if(res.response){
            populateSuccess(res.message);
          }else{
            populateError(res.message);
          }
          $('#modalReportBudgetCancel').modal('hide');
          loadNotesData();
          loadReportCostData();
          loadReportBudgetData();
          loadDetailProject();
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });

    //NOTES
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