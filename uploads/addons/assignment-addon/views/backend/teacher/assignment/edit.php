<?php $assignment = $this->db->get_where('assignments', array('id' => $param1))->row_array(); ?>
<form method="POST" class="d-block ajaxForm" action="<?php echo site_url('addons/assignment/index/update/'.$param1); ?>">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="title"><?php echo get_phrase('title'); ?></label>
            <input type="text" class="form-control" value="<?php echo $assignment['title']; ?>" id="title" name = "title" required>
            <small id="title_help" class="form-text text-muted"><?php echo get_phrase('provide_assignment_title'); ?></small>
        </div>

        <div class="form-group col-md-12">
            <label for="class_id_on_create"><?php echo get_phrase('class'); ?></label>
            <select class="form-control select2" data-toggle = "select2" id="class_id_on_create" name="class_id" onchange="classWiseSectionOnCreate(this.value)" required>
                <option value=""><?php echo get_phrase('select_a_class'); ?></option>
                <?php $classes = $this->db->get_where('classes', array('school_id' => school_id()))->result_array(); ?>
                <?php foreach($classes as $class): ?>
                    <option value="<?php echo $class['id']; ?>" <?php if($assignment['class_id'] == $class['id']) echo 'selected'; ?>><?php echo $class['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group col-md-12">
            <label for="section_id_on_create"><?php echo get_phrase('section'); ?></label>
            <select class="form-control select2" data-toggle = "select2" id="section_id_on_create" name="section_id" required>
                <option value=""><?php echo get_phrase('select_a_section'); ?></option>
                <?php $sections = $this->crud_model->get_section_details_by_id('class', $assignment['class_id'])->result_array(); ?>
                <?php foreach($sections as $section): ?>
                  <option value="<?php echo $section['id']; ?>" <?php if($section['id'] == $assignment['section_id']) echo 'selected'; ?>><?php echo $section['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group col-md-12">
          <label for="subject_id_on_create"><?php echo get_phrase('subject'); ?></label>
          <select name="subject_id" id = "subject_id_on_create" class="form-control select2" required>
            <option value=""><?php echo get_phrase('select_a_subject'); ?></option>
            <?php $subjects = $this->db->get_where('subjects', array('class_id' => $assignment['class_id'], 'session' => active_session()))->result_array(); ?>
            <?php foreach($subjects as $subject): ?>
                <option value="<?php echo $subject['id']; ?>" <?php if($assignment['subject_id'] == $subject['id']) echo 'selected'; ?>><?php echo $subject['name']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group col-md-12">
            <label for="deadline"><?php echo get_phrase('deadline'); ?></label>
            <input type="text" value="<?php echo date('m/d/Y', $assignment['deadline']); ?>" class="form-control date" id="deadline" data-toggle="date-picker" data-single-date-picker="true" name = "deadline" value="" required>
        </div>

        <div class="form-group mt-2 col-md-12">
            <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('update_assignment'); ?></button>
        </div>
    </div>
</form>

<?php include 'common_script.php'; ?>

<script>
  'use strict';

  $(".ajaxForm").validate({}); // Jquery form validation initialization
  $(".ajaxForm").submit(function(e) {
      var form = $(this);
      ajaxSubmit(e, form, showAssignments);
  });

  $(function(){
      $('.select2').select2();
  });

  if($('select').hasClass('select2') == true){
      $('div').attr('tabindex', "");
      $(function(){$(".select2").select2()});
  }


  $('#deadline').daterangepicker();
</script>
