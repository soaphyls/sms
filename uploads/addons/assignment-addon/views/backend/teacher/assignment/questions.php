<!--title-->
<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="page-title">
            <i class="mdi mdi-book-open-page-variant title_icon"></i> <?php echo $assignment_details['title']; ?>
            <a href="<?php echo site_url('addons/assignment/student_assignment/pending'); ?>" class="btn btn-outline-secondary ml-1 btn-rounded alignToTitle"> <i class="mdi mdi-arrow-left"></i> <?php echo get_phrase('drafted_assignment'); ?></a>
            <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle" onclick="rightModal('<?php echo site_url('modal/popup/assignment/add_question/'.$assignment_details['id']); ?>', '<?php echo get_phrase('create_question'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('create_question'); ?></button>
        </h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body assignment_question_content">
                <?php include 'question_list.php'; ?>
            </div>
        </div>
    </div>
</div>

<script>
	'use strict';
    var showAssignmentQuestion = function () {
        var url = "<?php echo site_url('addons/assignment/questions/list/'.$assignment_details['id']); ?>";

        $.ajax({
            type : 'GET',
            url: url,
            success : function(response) {
                $('.assignment_question_content').html(response);
                initDataTable('basic-datatable');
            }
        });
    }
</script>
