<?php if ($receiver == 'parent'):
  $students = $this->user_model->get_student_details_by_id('section', $section_id); ?>
  <div class="table-responsive-sm">
    <form class="parentAjaxForm" action="<?php echo site_url('addons/sms_center/send'); ?>" method="post" enctype="multipart/form-data">
      <table class="table table-bordered table-centered table-sm mb-0">
        <thead>
          <tr>
            <th><?php echo get_phrase('parent').' ('.get_phrase('receiver').')'; ?> <span style="float: right"> <a href="javascript:void(0);" onclick="checkAll()"><?php echo get_phrase('check_all'); ?></a> </span> </th>
            <th><?php echo get_phrase('student'); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($students as $key => $student):
            $parent_details = $this->user_model->get_parent_by_id($student['parent_id'])->row_array(); ?>
            <tr>
              <td>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="<?php echo $key; ?>" name="phones[]" value="<?php echo $parent_details['phone']; ?>">
                  <label class="custom-control-label" for="<?php echo $key; ?>">
                    <?php echo "<b>".$parent_details['name']."</b><br/><small>".get_phrase('phone').': <strong>'.$parent_details['phone']."</strong></small>"; ?>
                  </label>
                </div>
                <input type="hidden" class="messages-to-send" name="messages[]" value="">
              </td>
              <td>
                <?php echo $student['name']; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </form>
  </div>
<?php elseif ($receiver == 'student'):
  $students = $this->user_model->get_student_details_by_id('section', $section_id); ?>
  <div class="table-responsive-sm">
    <form class="studentAjaxForm" action="<?php echo site_url('addons/sms_center/send'); ?>" method="post" enctype="multipart/form-data">
      <table class="table table-bordered table-centered table-sm mb-0">
        <thead>
          <tr>
            <th><?php echo get_phrase('student').' ('.get_phrase('receiver').')'; ?> <span style="float: right"> <a href="javascript:void(0);" onclick="checkAll()"><?php echo get_phrase('check_all'); ?></a> </span> </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($students as $key => $student): ?>
            <tr>
              <td>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="<?php echo $key; ?>" name="phones[]" value="<?php echo $student['phone']; ?>">
                  <label class="custom-control-label" for="<?php echo $key; ?>">
                    <?php echo "<b>".$student['name']."</b><br/><small>".get_phrase('phone').": <strong>".$student['phone']."</strong></small>"; ?>
                  </label>
                </div>
                <input type="hidden" class="messages-to-send" name="messages[]" value="">
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </form>
  </div>

<?php elseif ($receiver == 'teacher'):
  $teachers = $this->user_model->get_teachers()->result_array(); ?>
  <div class="table-responsive-sm">
    <form class="teacherAjaxForm" action="<?php echo site_url('addons/sms_center/send'); ?>" method="post" enctype="multipart/form-data">
      <table class="table table-bordered table-centered table-sm mb-0">
        <thead>
          <tr>
            <th><?php echo get_phrase('teacher').' ('.get_phrase('receiver').')'; ?> <span style="float: right"> <a href="javascript:void(0);" onclick="checkAll()"><?php echo get_phrase('check_all'); ?></a> </span> </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($teachers as $key => $teacher): ?>
            <tr>
              <td>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="<?php echo $key; ?>" name="phones[]" value="<?php echo $teacher['phone']; ?>">
                  <label class="custom-control-label" for="<?php echo $key; ?>">
                    <?php echo "<b>".$teacher['name']."</b><br/><small>".get_phrase('phone').": <strong>".$teacher['phone']."</strong></small>"; ?>
                  </label>
                </div>
                <input type="hidden" class="messages-to-send" name="messages[]" value="">
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </form>
  </div>
<?php else: ?>
  <?php include APPPATH.'views/backend/empty.php'; ?>
<?php endif; ?>

<script type="text/javascript">

$(".parentAjaxForm").submit(function(e) {
  var form = $(this);
  ajaxSubmit(e, form, doNothing);
});

$(".studentAjaxForm").submit(function(e) {
  var form = $(this);
  ajaxSubmit(e, form, doNothing);
});

$(".teacherAjaxForm").submit(function(e) {
  var form = $(this);
  ajaxSubmit(e, form, doNothing);
});

function checkAll() {
  $('input:checkbox').prop('checked', "checked");
}

function doNothing() {

}
</script>
