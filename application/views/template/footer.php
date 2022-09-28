      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2020 <div class="bullet"></div> <a href="#">Stisla</a>
        </div>
        <div class="footer-right">
          Version 1.1
        </div>
      </footer>
    </div>
  </div>

  <div class="modal fade" id="modalEditAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editAccountData">
          <div class="modal-body">
            <span class="text-danger msgError" style="display: none"></span>
            <div class="form-group">
              <label class="form-label">Name</label>
              <input name="userName" id="userNameEditAccount" class="form-control" type="text" placeholder="Nama">
            </div>

            <div class="form-group">
              <label class="form-label">Email</label>
              <input name="userEmail" id="userEmailEditAccount" class="form-control" type="text" placeholder="Email">
            </div>

            <hr>
            <span class="text-danger">*) Kosongkan jika tidak ingin mengubah password</span>
            <div class="form-group">
              <label class="form-label">Password</label>
              <input name="userPassword" id="userPassword" class="form-control" type="password" placeholder="Password">
            </div>

            <div class="form-group">
              <label class="form-label">Password Confirm</label>
              <input name="userPasswordConfirm" id="userPasswordConfirm" class="form-control" type="password" placeholder="Confirm Password">
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

  <!-- General JS Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="<?= base_url(); ?>assets/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/vendor/izitoast/js/iziToast.min.js'?>"></script>

  <!-- Template JS File -->
  <script src="<?= base_url(); ?>assets/js/scripts.js"></script>
  <script src="<?= base_url(); ?>assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?= base_url(); ?>assets/js/page/index-0.js"></script>
  <script type="text/javascript">
    function loadDashboard(){
      $.ajax({
        type: "GET", 
        url: "<?= base_url("Dashboard/get_data"); ?>", 
        async : true,
        dataType: "JSON",
        success: function(res) {
          if(res.response === true){
            $("#jmlPendingPorject").html(res.pendingProject).show();
            $("#jmlOnGoingProject").html(res.onGoingProject).show();
            $("#jmlCompletedProject").html(res.completedProject).show();
            $("#jmlTotalProject").html(res.totalProject).show();
            $("#jmlAdministrator").html(res.admin).show();
            $("#jmlFinance").html(res.finance).show();
            $("#jmlPM").html(res.pm).show();
            $("#jmlWaspang").html(res.waspang).show();
          } else {
            $('#item-error').html('Data not Found!');
          }
        }, 
      });
    }

    function loadClient(){
      $.ajax({
        type: "GET", 
        url: "<?= base_url("Project/get_client"); ?>", 
        async : true,
        dataType: "JSON",
        success: function(res) {
          if(res.response === true){
            $("#selectClient").html(res.data_client.data).selectpicker('refresh');
            $("#selectClientEdit").html(res.data_client.data).selectpicker('refresh');
          } else {
            $('#item-error').html('Client not Found!');
          }
        }, 
      });
    }

    function loadGroupProject(){
      $.ajax({
        type: "GET", 
        url: "<?= base_url("Project/get_group_project"); ?>", 
        async : true,
        dataType: "JSON",
        success: function(res) {
          if(res.response === true){
            $("#selectGroupProject").html(res.data_group_project.data).selectpicker('refresh');
            $("#selectGroupProjectEdit").html(res.data_group_project.data).selectpicker('refresh');
          } else {
            $('#item-error').html('Group Project not Found!');
          }
        }, 
      });
    }

    function loadTeam(){
      $.ajax({
        type: "GET", 
        url: "<?= base_url("Project/get_team"); ?>", 
        async : true,
        dataType: "JSON",
        success: function(res) {
          if(res.response === true){
            $("#selectTeam").html(res.data_team.data).selectpicker('refresh');
            $("#selectTeamEdit").html(res.data_team.data).selectpicker('refresh');
          } else {
            $('#item-error').html('User not Found!');
          }
        }, 
      });
    }

    function loadUserAccess(){
      $.ajax({
        type: "GET", 
        url: "<?= base_url("User/get_user_access"); ?>", 
        async : true,
        dataType: "JSON",
        success: function(res) {
          if(res.response === true){
            $("#selectUserAccess").html(res.data_access.data).selectpicker('refresh');
            $("#selectUserAccessEdit").html(res.data_access.data).selectpicker('refresh');
          } else {
            $('#item-error').html('Access not Found!');
          }
        }, 
      });
    }

    $(document).ready( function () { 
      loadDashboard();
      loadClient();
      loadGroupProject();
      loadTeam();
      loadUserAccess();

      $('#dataUser').on('click','#btnEditAccount',function(){
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
            $('#modalEditAccount').modal('show');
            $('#userNameEditAccount').val(data.userName);
            $('#userEmailEditAccount').val(data.userEmail);
            $('#editAccountData').attr("data", id);
          },
          error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
          }
        });
        return false;
      });

      //EDIT DATA
    $('#editAccountData').submit(function(e){
      let id = $(this).attr('data');
      console.log(id);
      $.ajax({
        type : "POST",
        url  : "<?= base_url('edit-user-account/')?>" + id,
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
            $('#modalEditAccount').modal('hide');
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    });
      
      $('#select-kota').selectpicker({
        search : true,
      });
      $('#select-pelanggan').selectpicker({
        search : true,
      });
      $('#select-produk').selectpicker({
        search : true,
      });
      $('#select-pegawai').selectpicker({
        search : true,
      });
      $('#select-atasan').selectpicker({
        search : true,
      });
      $('#select-pejabat').selectpicker({
        search : true,
      });
    });

  </script>
  <script type="text/javascript">
    function populateSuccess(message) {
      iziToast.success({
        title: 'Success!',
        message: message,
        position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
      });
    }

    function populateError(message) {
      iziToast.error({
        title: 'Error!',
        message: message,
        position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
      });
    }

    function populateInfo(message) {
      iziToast.error({
        title: 'Info!',
        message: message,
        position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
      });
    }
</script>
</body>
</html>
