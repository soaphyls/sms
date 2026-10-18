<style>
.btn-secondary {
    color: #343a40;
    background-color: #f3f7f9;
    border-color: #fff;
}
.btn-group-vertical>.btn, .btn-group>.btn {
    position: relative;
    flex: none;
}

.btn-light {
    box-shadow: 0 0 0 rgb(243 247 249 / 50%);
}

.btn-secondary {
    -webkit-box-shadow: 0px 0px 0px 0px rgb(108 117 125 / 50%);
    box-shadow: 0px 0px 0px 0px rgb(108 117 125 / 50%);
}
</style>
<!--title-->
<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body py-2">
        <h4 class="page-title d-inline-block">
          <i class="mdi mdi-account-circle title_icon"></i> <?php echo get_phrase('accountant'); ?>
        </h4>
        <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle float-end mt-1" onclick="rightModal('<?php echo site_url('modal/popup/accountant/create'); ?>', '<?php echo get_phrase('create_accountant'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('add_accountant'); ?></button>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body accountant_content">
        <?php include 'list.php'; ?>
      </div>
    </div>
  </div>
</div>

<script>
var showAllAccountants = function () {
  var url = '<?php echo route('accountant/list'); ?>';

  $.ajax({
    type : 'GET',
    url: url,
    success : function(response) {
      $('.accountant_content').html(response);
      initDataTable('basic-datatable');
    }
  });
}
$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: true,
        buttons: [
            
                'csv','pdf', 'print',
            
			]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>
