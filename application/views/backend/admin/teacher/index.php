<!--title-->
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
<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body py-2">
        <h4 class="page-title d-inline-block">
          <i class="mdi mdi-account-circle title_icon"></i> <?php echo get_phrase('teachers'); ?>
        </h4>
        <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle float-end mt-1" onclick="rightModal('<?php echo site_url('modal/popup/teacher/create'); ?>', '<?php echo get_phrase('create_teacher'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('create_teacher'); ?></button>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body teacher_content">
        <?php include 'list.php'; ?>
      </div>
    </div>
  </div>
</div>

<script>
var showAllTeachers = function () {
  var url = '<?php echo route('teacher/list'); ?>';

  $.ajax({
    type : 'GET',
    url: url,
    success : function(response) {
      $('.teacher_content').html(response);
      initDataTable('basic-datatable');
    }
  });
}

$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: true,
        buttons: [
            
                {
			"extend": "copyHtml5",
			"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
			"className": "btn btn-white btn-primary btn-bold"
		  },
		  {
			"extend": "csvHtml5",
			"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
			"className": "btn btn-white btn-primary btn-bold"
		  },
		  {
			"extend": "excelHtml5",
			"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
			"className": "btn btn-white btn-primary btn-bold"
		  },
		  {
			"extend": "pdfHtml5",
			"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
			"className": "btn btn-white btn-primary btn-bold"
		  },
		  {
			"extend": "print",
			"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
			"className": "btn btn-white btn-primary btn-bold",
			autoPrint: true,
			message: 'This is a table for admin'
		  }	
            
            
			]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>
