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
        "targets" : [0, 4],
        "orderable" : false,
        "className" : "text-center"
      }],
    });
  }

  function loadAccessData(){
    $('#getAccessData').DataTable({
      "autoWidth": false,
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

  // function loadGroupData(){
  //   table = $('#getGroupData').DataTable({
  //     "autoWidth": false,
  //     "responsive" : true,
  //     "destroy" : true,
  //     "processing" : true,
  //     "serverside" : true,
  //     "ajax" : {
  //       "url" : "<?= base_url('User/get_group_data') ?>",
  //       "type" : "POST"
  //     },
  //     "columnDefs" : [{
  //       "targets" : [0, 2],
  //       "orderable" : false,
  //       "className" : "text-center"
  //     }],
  //   });
  // }

	$(document).ready(function(){
		loadData();
    loadAccessData();
    //loadGroupData();

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
            //$("#selectUserGroup").val('').selectpicker('refresh');
            $("#selectUserAccess").val('').selectpicker('refresh');
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
        url  : "<?= base_url('User/get_data_by_id')?>",
        dataType : "JSON",
        data : {
          id : id
        },
        success: function(res){
          let data = res.data;
          $('.msgError').html('').show();
          $('#modalEdit').modal('show');
          $('#userNameEdit').val(data.userName);
          $('#userEmailEdit').val(data.userEmail);
          //$('#selectUserGroupEdit').selectpicker('val', res.arr_group);
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
      $('.msgError').html('').show();
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

    $('#dataList').on('click','#btnChangePassword',function(){
      var id = $(this).attr('data');
      $('.msgError').html('').show();
      $('#modalChangePassword').modal('show');
      $('#changePasswordData').attr("data", id);
    });	

    $('#changePasswordData').submit(function(e){
      let id = $(this).attr('data');
      $.ajax({
        type : "POST",
        url  : "<?= base_url('change-password-user/')?>" + id,
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
            $('#modalChangePassword').modal('hide');
            loadData();
          }
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
            document.getElementById('saveAccessData').reset();
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

    // // SAVE DATA
    // $('#saveGroupData').submit(function(e){
    //   $.ajax({
    //     type : "POST",
    //     url  : "<?php echo base_url('add-user-group')?>",
    //     dataType : "JSON",
    //     data : $(this).serialize(),
    //     success: function(res){
    //       if(res.error){
    //         $('.msgError').html(res.error).show();
    //       }else{
    //         if(res.response){
    //           populateSuccess(res.message);
    //         }else{
    //           populateError(res.message);
    //         }
    //         $('#modalGroupAdd').modal('hide');
    //         document.getElementById('saveGroupData').reset();
    //         loadGroupData();
    //       }
    //     },
    //     error: function(xhr, ajaxOptions, thrownError){
    //       alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //     }
    //   });
    //   return false;
    // });

    //  //GET DATA EDIT
    //  $('#dataGroupList').on('click','#btnGroupEdit',function(){
    //   let id = $(this).attr('data');
    //   $.ajax({
    //     type : "GET",
    //     url  : "<?= base_url('User/get_group_data_by_id')?>",
    //     dataType : "JSON",
    //     data : {
    //       id : id
    //     },
    //     success: function(res){
    //       let data = res.data;
    //       $('#modalGroupEdit').modal('show');
    //       $('#groupNameEdit').val(data.groupName);
    //       $('#updateGroupData').attr("data", id);
    //     },
    //     error: function(xhr, ajaxOptions, thrownError){
    //       alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //     }
    //   });
    //   return false;
    // });

    // //EDIT DATA
    // $('#updateGroupData').submit(function(e){
    //   let id = $(this).attr('data');
    //   console.log(id);
    //   $.ajax({
    //     type : "POST",
    //     url  : "<?= base_url('edit-user-group/')?>" + id,
    //     dataType : "JSON",
    //     data : $(this).serialize(),
    //     success: function(res){
    //       if(res.error){
    //         $('.msgError').html(res.error).show();
    //       }else{
    //         if(res.response){
    //           populateSuccess(res.message);
    //         }else{
    //           populateError(res.message);
    //         }
    //         $('#modalGroupEdit').modal('hide');
    //         loadGroupData();
    //       }
    //     },
    //     error: function(xhr, ajaxOptions, thrownError){
    //       alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //     }
    //   });
    //   return false;
    // });

    // //DELETE
    // $('#dataGroupList').on('click','#btnGroupDelete',function(){
    //   var id = $(this).attr('data');
    //   $('#modalGroupDelete').modal('show');
    //   $('#groupIdDelete').val(id);
    //   $('#deleteGroupData').attr("data", id);
    // });	

    // //DELETE DATA
    // $('#deleteGroupData').submit(function(e){
    //   let id = $(this).attr('data');
    //   $.ajax({
    //     type : "POST",
    //     url  : "<?= base_url('delete-user-group/')?>" + id,
    //     dataType : "JSON",
    //     data : $(this).serialize(),
    //     success: function(res){
    //       if(res.response){
    //         populateSuccess(res.message);
    //       }else{
    //         populateError(res.message);
    //       }
    //       $('#modalGroupDelete').modal('hide');
    //       loadGroupData();
    //     },
    //     error: function(xhr, ajaxOptions, thrownError){
    //       alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //     }
    //   });
    //   return false;
    // });

	});
</script>