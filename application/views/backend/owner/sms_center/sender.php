<!--title-->
<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="page-title">
          <i class="mdi mdi-format-list-numbered title_icon"></i> <?php echo get_phrase('sms_sender'); ?>
        </h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>

<div class="row">
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mb-3"><?php echo get_phrase('choose_sms_receiver'); ?></h4>
        <div class="row">
          <div class="col-md-12 mb-1">
            <select name="receiver" id="receiver" class="form-control select2" data-toggle = "select2" onchange="toggleReceiverWiseOptions(this.value)" required>
              <option value=""><?php echo get_phrase('select_receiver'); ?></option>
              <option value="student"><?php echo get_phrase('student'); ?></option>
              <option value="parent"><?php echo get_phrase('parent'); ?></option>
              <option value="teacher"><?php echo get_phrase('teacher'); ?></option>
            </select>
          </div>
          <div class="col-md-12 mb-1">
            <select name="class_id" id="class_id" class="form-control select2" data-toggle = "select2" required onchange="classWiseSection(this.value)">
              <option value=""><?php echo get_phrase('select_a_class'); ?></option>
              <?php
              $classes = $this->db->get_where('classes', array('school_id' => school_id()))->result_array();
              foreach($classes as $class){
                ?>
                <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-12 mb-1">
            <select name="section_id" id="section_id" class="form-control select2" data-toggle = "select2" required>
              <option value=""><?php echo get_phrase('select_section'); ?></option>
            </select>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-block btn-secondary"  onclick="showAllTheReceivers()"><?php echo get_phrase('show_receivers'); ?></button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mb-3"><?php echo get_phrase('list_of_receivers'); ?></h4>
        <div class="list_of_receivers">
          <?php include APPPATH.'views/backend/empty.php'; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title mb-3"><?php echo get_phrase('message'); ?></h4>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group mb-3">
              <label for="example-textarea"><?php echo get_phrase('message_to_send'); ?></label>
              <textarea class="form-control" id="message_to_send" rows="7" placeholder="<?php echo get_phrase('write_down_your_message_within_160_characters'); ?>..." maxlength="160"></textarea>
              <small><?php echo get_phrase('remaining_characters_is'); ?> <strong id="remaining_character">160</strong> </small>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-block btn-primary" onclick="genericConfirmModal(sendSmsToTheReceiver)"><?php echo get_phrase('send_sms'); ?></button>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="card">
      <div class="card-body">
        <h4 class="header-title mb-3"><?php echo get_phrase('send_sms'); ?></h4>
        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-block btn-primary" onclick="genericConfirmModal(sendSmsToTheReceiver)"><?php echo get_phrase('send_sms'); ?></button>
          </div>
        </div>
      </div>
    </div> -->

    <div class="card">
      <div class="card-body">
        <h4 class="header-title mb-3"><?php echo get_phrase('instruction'); ?></h4>
        <div class="row mt-2">
          <div class="col-md-12">
            <div class="alert alert-success" role="alert">
              <p><?php echo get_phrase('before_sending_sms_to_the_receivers_please_make_sure_that_you_have_set_up_sms_settings_perfectly'); ?>.</p>
              <p><?php echo get_phrase('you_can_set_sms_settings'); ?> <a href="<?php echo site_url('addons/sms_center/settings'); ?>"><?php echo get_phrase('here'); ?></a>.</p>
              <p><?php echo get_phrase('currently_activated'); ?> : <strong><?php echo ucfirst(get_sms('active_sms_service')); ?></strong>.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>


$('document').ready(function(){
  initSelect2(['#class_id', '#section_id', '#receiver']);
});

function classWiseSection(classId) {
  $.ajax({
    url: "<?php echo route('section/list/'); ?>"+classId,
    success: function(response){
      $('#section_id').html(response);
      copyTheMessageToForm();
    }
  });
}

function showAllTheReceivers() {
  var class_id = $('#class_id').val();
  var section_id = $('#section_id').val();
  var receiver = $('#receiver').val();
  if(receiver != ""){
    if (receiver != "teacher") {
      if (class_id != "" && section_id != "") {
        $.ajax({
          type : "post",
          url: "<?php echo site_url('addons/sms_center/show_receivers'); ?>",
          data : {class_id : class_id, section_id : section_id, receiver : receiver},
          success: function(response){
            $('.list_of_receivers').html(response);
            copyTheMessageToForm();
          }
        });
      }else{
        toastr.error('<?php echo get_phrase('please_select_a_class_and_section'); ?>');
        return;
      }
    }else{
      $.ajax({
        type : "post",
        url: "<?php echo site_url('addons/sms_center/show_receivers'); ?>",
        data : {class_id : class_id, section_id : section_id, receiver : receiver},
        success: function(response){
          $('.list_of_receivers').html(response);
          copyTheMessageToForm();
        }
      });
    }
  }else{
    toastr.error('<?php echo get_phrase('please_select_a_receiver'); ?>');
    return;
  }
}


var formClass;

var sendSmsToTheReceiver = function() {
  var class_id = $('#class_id').val();
  var section_id = $('#section_id').val();
  var receiver = $('#receiver').val();
  if(receiver != ""){
    formClass = receiver+"AjaxForm";
    if (receiver != "teacher") {
      if (class_id != "" && section_id != "") {
        $('.'+formClass).submit();
      }else{
        toastr.error('<?php echo get_phrase('please_select_a_class_and_section'); ?>');
        return;
      }
    }else{
      $('.'+formClass).submit();
    }
  }else{
    toastr.error('<?php echo get_phrase('please_select_a_receiver'); ?>');
    return;
  }
}

$('#message_to_send').bind('input propertychange', function() {
  var currentLength = $('#message_to_send').val().length;
  var remaining_character = 160 - currentLength;
  $('#remaining_character').text(remaining_character);
  copyTheMessageToForm();
});

function copyTheMessageToForm() {
  var message = $('#message_to_send').val();
  $('.messages-to-send').val(message);
}

function toggleReceiverWiseOptions(receiver) {
  if (receiver != "") {
    if (receiver === "teacher") {
      $('#class_id').prop('disabled', true);
      $('#section_id').prop('disabled', true);
    }else{
      $('#class_id').prop('disabled', false);
      $('#section_id').prop('disabled', false);
    }
  }else{
    toastr.error('<?php echo get_phrase('receiver_can_not_be_empty'); ?>');
  }
}
</script>
