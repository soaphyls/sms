<!--title-->
<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="page-title">
            <i class="mdi mdi-book-open-page-variant title_icon"></i> <?php echo get_phrase('my_assignment'); ?>
        </h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body assignment_content">
                <?php include 'list.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'common_script.php'; ?>

<script>
    'use strict';
    
    function filterAssignmentBySubject(){
        var subject_id = $('#subject_id').val();
        var teacher_id = $('#teacher_id').val();
        $.ajax({
            type : 'post',
            url: '<?php echo site_url('addons/assignment/filter_my_'.$deadline_status.'_assignment'); ?>',
            data: {subject_id : subject_id, teacher_id : teacher_id},
            success : function(response) {
                $('.assignment_content').html(response);
                initDataTable('basic-datatable');
            }
        });
    }
</script>
