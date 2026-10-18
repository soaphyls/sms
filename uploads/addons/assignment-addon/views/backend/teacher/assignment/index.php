<!--title-->
<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="page-title">
            <i class="mdi mdi-book-open-page-variant title_icon"></i> <?php echo get_phrase('assignment'); ?>
            <button type="button" class="btn btn-outline-primary btn-rounded alignToTitle" onclick="rightModal('<?php echo site_url('modal/popup/assignment/create'); ?>', '<?php echo get_phrase('create_assignment'); ?>')"> <i class="mdi mdi-plus"></i> <?php echo get_phrase('add_assignment'); ?></button>
        </h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link <?php if($assignment_type =='published') echo 'active'; ?>" href="<?php echo site_url('addons/assignment/student_assignment/published'); ?>"><i class="dripicons-cloud-upload"></i> <?php echo get_phrase('published_assignments'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($assignment_type =='pending') echo 'active'; ?>" href="<?php echo site_url('addons/assignment/student_assignment/pending'); ?>"><i class="mdi mdi-folder-outline"></i> <?php echo get_phrase('draft_assignments'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($assignment_type =='expired') echo 'active'; ?>" href="<?php echo site_url('addons/assignment/student_assignment/expired'); ?>"><i class=" mdi mdi-folder-clock-outline"></i> <?php echo get_phrase('expired_assignments'); ?></a>
                    </li>
                </ul>
                <form class="mb-3 mt-4 pt-3" action="javascript:void(0)" method="get">
                    <div class="row justify-content-center">
                        <!-- Course subject -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control select2" data-toggle = "select2" id="selected_class_id" name="class_id" onchange="select_section(this.value)">
                                    <option value=""><?php echo get_phrase('select_a_class'); ?></option>
                                    <?php $classes = $this->db->get_where('classes', array('school_id' => school_id()))->result_array(); ?>
                                    <?php foreach($classes as $class): ?>
                                        <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control select2" data-toggle = "select2" id="selected_section_id" name="section_id">
                                    <option value=""><?php echo get_phrase('first_select_a_class'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control select2" data-toggle = "select2" id="selected_subject_id" name="subject_id">
                                    <option value=""><?php echo get_phrase('first_select_a_class'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-block" onclick="filterAssignment()" name="button"><?php echo get_phrase('filter'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body table-responsive assignment_content">
                <?php include 'list.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'common_script.php'; ?>

<script>
    'use strict';

    function filterAssignment(){
        var class_id = $('#selected_class_id').val();
        var section_id = $('#selected_section_id').val();
        var subject_id = $('#selected_subject_id').val();
        $.ajax({
            type : 'post',
            url: '<?php echo site_url('addons/assignment/filter_student_assignment/'.$assignment_type); ?>',
            data: {class_id : class_id, section_id : section_id, subject_id : subject_id},
            success : function(response) {
                $('.assignment_content').html(response);
                initDataTable('basic-datatable');
            }
        });
    }
</script>
