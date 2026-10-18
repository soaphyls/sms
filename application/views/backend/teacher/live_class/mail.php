<?php
    $live_class_data = $this->db->get_where('live_classes',['id'=>$param1, 'school_id'=>school_id(), 'teacher_id' => $this->session->userdata('user_id')])->row_array();
 ?>
<form method="POST" class="d-block ajaxForm" action="<?php echo site_url('addons/live_class/sendmail'); ?>" enctype="multipart/form-data">
    <input type="hidden" name="class_id" value="<?php echo $live_class_data['class_id']; ?>">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="subject"><?php echo get_phrase('subject'); ?></label>
            <input type="text" class="form-control" name="subject" value="" required>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_a_subject'); ?></small>
        </div>

        <div class="form-group col-md-12">
            <label for="message"><?php echo get_phrase('message'); ?></label>
            <textarea class="form-control" id="message" name = "message" rows="5" required></textarea>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_a_message'); ?></small>
        </div>

        <div class="form-group col-md-12 mt-2">
            <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('send_mail'); ?></button>
        </div>
    </div>
</form>

<script>
$(".ajaxForm").validate({}); // Jquery form validation initialization
$(".ajaxForm").submit(function(e) {
    var form = $(this);
    ajaxSubmit(e, form, showAllLiveClasses);
});
</script>
