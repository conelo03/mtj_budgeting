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
      loadClient();
      loadGroupProject();
      loadTeam();
      loadUserAccess();
      
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
