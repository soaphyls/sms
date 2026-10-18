<?php
    $live_class_data = $this->db->get_where('live_classes',['id'=>$param1, 'school_id'=>school_id(), 'teacher_id' => $this->session->userdata('user_id')])->row_array();
    $subjects = $this->db->get_where('subjects', ['class_id' => $live_class_data['class_id'], 'school_id' => school_id(), 'session' => active_session()])->result_array();
    $classes = $this->db->get_where('classes', array('school_id' => school_id()))->result_array();
 ?>
<form method="POST" class="d-block ajaxForm" action="<?php echo site_url('addons/live_class/update'); ?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $param1; ?>">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="live-class-date"><?php echo get_phrase('date'); ?></label>
            <input type="text" name="date" class="form-control date" id="live-class-date" data-toggle="date-picker" data-single-date-picker="true" value="<?php echo date('m/d/Y', $live_class_data['date']); ?>" required>
            <small id="" class="form-text text-muted"><?php echo get_phrase('live_class_schedule').' ('.get_phrase('date').')'; ?></small>
        </div>

        <div class="form-group col-md-12">
            <label for="live-class-time"><?php echo get_phrase('time'); ?></label>
            <input type="text" name="time" id="live-class-time" class="form-control" data-toggle="timepicker" value="<?php echo date('h:i:s A', $live_class_data['time']); ?>" required>
            <small id="" class="form-text text-muted"><?php echo get_phrase('live_class_schedule').' ('.get_phrase('time').')'; ?></small>
        </div>
        <div class="form-group col-md-12">
            <label for="class_id_on_update"><?php echo get_phrase('class'); ?></label>
            <select class="form-control select2" data-toggle = "select2" id="class_id_on_update" name="class_id" onchange="classWiseSubjectOnCreate(this.value)" required>
                <option value=""><?php echo get_phrase('select_a_class'); ?></option>
                <?php foreach($classes as $class): ?>
                    <option value="<?php echo $class['id']; ?>" <?php if ($class['id'] == $live_class_data['class_id']) echo "selected"; ?>><?php echo $class['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group col-md-12">
            <label for="subject_id_on_update"><?php echo get_phrase('subject'); ?></label>
            <select class="form-control select2" data-toggle = "select2" id="subject_id_on_update" name="subject_id" requied>
                <option><?php echo get_phrase('select_a_subject'); ?></option>
                <?php foreach ($subjects as $subject): ?>
                    <option value="<?php echo $subject['id']; ?>" <?php if($subject['id'] == $live_class_data['subject_id']) echo "selected"; ?>><?php echo $subject['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group col-md-12">
            <label for="zoom_meeting_id"><?php echo get_phrase('zoom_meeting_id'); ?></label>
            <input type="text" class="form-control" id="zoom_meeting_id" name = "zoom_meeting_id" value="<?php echo $live_class_data['zoom_meeting_id']; ?>" required>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_zoom_meeting_id'); ?></small>
        </div>

        <div class="form-group col-md-12">
            <label for="zoom_meeting_password"><?php echo get_phrase('zoom_meeting_password'); ?></label>
            <input type="text" class="form-control" id="zoom_meeting_password" name = "zoom_meeting_password" value="<?php echo $live_class_data['zoom_meeting_password']; ?>" required>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_zoom_meeting_password'); ?></small>
        </div>

        <div class="form-group col-md-12">
            <label for="attachment"><?php echo get_phrase('upload_attachment'); ?></label>
            <div class="custom-file-upload">
                <input type="file" class="form-control" id="attachment" name = "attachment">
            </div>
        </div>

        <div class="form-group col-md-12">
            <label for="topic"><?php echo get_phrase('topic'); ?></label>
            <textarea class="form-control" id="topic" name = "topic" rows="5"><?php echo $live_class_data['topic']; ?></textarea>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_topic'); ?></small>
        </div>

        <div class="form-group col-md-12 mt-2">
            <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('update_live_class'); ?></button>
        </div>
    </div>
</form>

<script>
$(".ajaxForm").validate({}); // Jquery form validation initialization
$(".ajaxForm").submit(function(e) {
    var form = $(this);
    ajaxSubmit(e, form, showAllLiveClasses);
});

$('document').ready(function(){
    initSelect2(['#class_id_on_update', '#subject_id_on_update']);
    $("#live-class-date" ).daterangepicker();
    initTimepicker(['#live-class-time']);
});


function classWiseSubjectOnCreate(classId) {
    $.ajax({
        url: "<?php echo route('class_wise_subject/'); ?>"+classId,
        success: function(response){
            $('#subject_id_on_update').html(response);
        }
    });
}
</script>


<script type="text/javascript">
  initCustomFileUploader();
</script>
