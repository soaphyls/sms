<!--title-->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-video title_icon"></i> <?php echo get_phrase('add_a_new_live_class'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" class="d-block ajaxForm" action="<?php echo site_url('addons/live_class/store'); ?>" enctype="multipart/form-data">
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="date"><?php echo get_phrase('date'); ?></label>
                            <input type="text" name="date" class="form-control date" id="date" data-toggle="date-picker" data-single-date-picker="true" value="<?php echo date('m/d/Y', strtotime(date('m/d/Y'))); ?>" required>
                            <small id="" class="form-text text-muted"><?php echo get_phrase('live_class_schedule').' ('.get_phrase('date').')'; ?></small>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="time"><?php echo get_phrase('time'); ?></label>
                            <input type="text" name="time" id="time" class="form-control" data-toggle="timepicker" value="<?php echo date('h:i:s A', strtotime('d/M/Y')); ?>" required>
                            <small id="" class="form-text text-muted"><?php echo get_phrase('live_class_schedule').' ('.get_phrase('time').')'; ?></small>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="class_id"><?php echo get_phrase('class'); ?></label>
                            <select name="class_id" id="class_id" class="form-control select2" data-toggle = "select2" required onchange="classWiseSubject(this.value)">
                                <option value="0"><?php echo get_phrase('select_a_class'); ?></option>
                                <?php
                                $classes = $this->db->get_where('classes', array('school_id' => school_id()))->result_array();
                                foreach($classes as $class){
                                    ?>
                                    <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                                <?php } ?>
                            </select>
                            <small id="" class="form-text text-muted"><?php echo get_phrase('select_a_class'); ?></small>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="subject_id"><?php echo get_phrase('subject'); ?></label>
                            <select name="subject_id" id="subject_id" class="form-control select2" data-toggle = "select2" required>
                                <option value=""><?php echo get_phrase('select_subject'); ?></option>
                            </select>
                            <small id="" class="form-text text-muted"><?php echo get_phrase('select_a_subject'); ?></small>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="zoom_meeting_id"><?php echo get_phrase('zoom_meeting_id'); ?></label>
                            <input type="text" class="form-control" id="zoom_meeting_id" name = "zoom_meeting_id" required>
                            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_zoom_meeting_id'); ?></small>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="zoom_meeting_password"><?php echo get_phrase('zoom_meeting_password'); ?></label>
                            <input type="text" class="form-control" id="zoom_meeting_password" name = "zoom_meeting_password" required>
                            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_zoom_meeting_password'); ?></small>
                        </div>

                        <div class="form-group">
                            <label class="m-0"><?php echo get_phrase('upload_attachment'); ?> <small id="" class="text-muted">(<?php echo get_phrase('you_can_upload_attachments'); ?>)</small> </label>
                            <div class="custom-file-upload">
                                <input type="file" id="attachment" class="form-control" name="attachment">
                            </div>

                        </div>

                        <div class="form-group col-md-12">
                            <label for="topic"><?php echo get_phrase('topic'); ?></label>
                            <textarea class="form-control" id="topic" name = "topic" rows="5"></textarea>
                            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_topic'); ?></small>
                        </div>

                        <div class="form-group col-md-12 text-center">
                            <button class="btn btn-primary" type="submit"><?php echo get_phrase('create_meeting'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('document').ready(function(){
        initSelect2(['#class_id', '#section_id', '#subject_id']);
        initCustomFileUploader();
    });

    var form;
    $(".ajaxForm").submit(function(e) {
      form = $(this);
      ajaxSubmit(e, form, refreshForm);
    });
    var refreshForm = function () {
        form.trigger("reset");
    }

    function classWiseSubject(classId) {
        $.ajax({
            url: "<?php echo route('class_wise_subject/'); ?>"+classId,
            success: function(response){
                $('#subject_id').html(response);
            }
        });
    }
</script>
