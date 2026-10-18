<?php
  $student_details = $this->user_model->get_student_details_by_id('student', $param1);
  $parent_details = $this->user_model->get_parent_by_id($student_details['parent_id'])->row_array();
?>


<style media="screen">
/* ID CARD STARTS HERE */
.id-card-holder {
  width: 225px;
  padding: 4px;
  margin: 0 auto;
  background-color: #1f1f1f;
  border-radius: 5px;
  position: relative;
  border: 1px solid #BDBDBD !important;
}
.id-card-holder:after {
  content: '';
  width: 7px;
  display: block;
  background-color: #0a0a0a;
  height: 100px;
  position: absolute;
  top: 105px;
  border-radius: 0 5px 5px 0;
}
.id-card-holder:before {
  content: '';
  width: 7px;
  display: block;
  background-color: #0a0a0a;
  height: 100px;
  position: absolute;
  top: 105px;
  left: 222px;
  border-radius: 5px 0 0 5px;
}
.id-card {
  background-color: #fff;
  padding: 10px;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0 0 1.5px 0px #b9b9b9;
}
.id-card img {
  margin: 0 auto;
}
.header img {
  width: 100px;
  margin-top: 15px;
}
.photo img {
  width: 80px;
  margin-top: 15px;
}
h2 {
  font-size: 17px;
  margin: 8px 0;
}
h3 {
  font-size: 12px;
  margin: 4.5px 0;
  font-weight: 300;
}
.qr-code img {
  width: 50px;
}
p {
  font-size: 5px;
  margin: 2px;
}
.id-card-hook {
  background-color: #000;
  width: 70px;
  margin: 0 auto;
  height: 15px;
  border-radius: 5px 5px 0 0;
}
.id-card-hook:after {
  content: '';
  background-color: #d7d6d3;
  width: 47px;
  height: 6px;
  display: block;
  margin: 0px auto;
  position: relative;
  top: 6px;
  border-radius: 4px;
}
.id-card-tag-strip {
  width: 45px;
  height: 40px;
  background-color: #0950ef;
  margin: 0 auto;
  border-radius: 5px;
  position: relative;
  top: 9px;
  z-index: 1;
  border: 1px solid #0041ad;
}
.id-card-tag-strip:after {
  content: '';
  display: block;
  width: 100%;
  height: 1px;
  background-color: #c1c1c1;
  position: relative;
  top: 10px;
}
.id-card-tag {
  width: 0;
  height: 0;
  border-left: 100px solid transparent;
  border-right: 100px solid transparent;
  border-top: 100px solid #0958db;
  margin: -10px auto -30px auto;
}
.id-card-tag:after {
  content: '';
  display: block;
  width: 0;
  height: 0;
  border-left: 50px solid transparent;
  border-right: 50px solid transparent;
  border-top: 100px solid #d7d6d3;
  margin: -10px auto -30px auto;
  position: relative;
  top: -130px;
  left: -50px;
}
.school_title {
  font-size: 16px;
  margin-top: 5px;
  font-weight: 600;
}
</style>

<!--title-->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <!-- ID CARD STARTS HERE -->
        <div class="id-card-hook"></div>
        <div class="id-card-holder" style="width: 240px; padding: 4px; margin: 0 auto; background-color: #1f1f1f; border-radius: 5px; position: relative; border: 1px solid #BDBDBD !important;">
          <div class="id-card" style="background-color: #fff; padding: 10px; border-radius: 10px; text-align: center; box-shadow: 0 0 1.5px 0px #b9b9b9;">
            <div style="text-align: center;">
              <img src="<?php echo $this->settings_model->get_logo_dark(); ?>" style=" width: 100px; margin-top: 15px;">
            </div>
            <div class="school_title" style="text-align: center;font-size: 16px; margin-top: 5px; font-weight: 600;"><?php echo get_current_school_data('name'); ?></div>
            <div class="photo" style="text-align: center;">
              <img src="<?php echo $this->user_model->get_user_image($student_details['user_id']); ?>" class="rounded-circle" style="width: 80px; margin-top: 15px;">
            </div>
            <h2 style="text-align: center; font-size: 17px; margin: 8px 0;"><?php echo $student_details['name']; ?></h2>
            <div style="text-align: center;">
              <table style="font-size: 11px; text-align: center;">
                <tbody>
                  <tr>
                    <td style="text-align: right; width: 50%;"><?php echo get_phrase('code'); ?> : </td>
                    <td style="text-align: left;"><?php echo null_checker($student_details['code']); ?></td>
                  </tr>
                  <tr>
                    <td style="text-align: right;"><?php echo get_phrase('class'); ?> : </td>
                    <td style="text-align: left; "><?php echo null_checker($student_details['class_name']); ?></td>
                  </tr>
                  <tr>
                    <td style="text-align: right;"><?php echo get_phrase('section'); ?> : </td>
                    <td style="text-align: left; "><?php echo null_checker($student_details['section_name']); ?></td>
                  </tr>
                  <tr>
                    <td style="text-align: right;"><?php echo get_phrase('parent'); ?> : </td>
                    <td style="text-align: left; "><?php echo null_checker($parent_details['name']); ?></td>
                  </tr>
                  <tr>
                    <td style="text-align: right;"><?php echo get_phrase('blood_group'); ?> : </td>
                    <td style="text-align: left; "><?php echo null_checker(strtoupper($student_details['blood_group'])); ?></td>
                  </tr>
                  <tr>
                    <td style="text-align: right;"><?php echo get_phrase('contact'); ?> : </td>
                    <td><?php echo null_checker($parent_details['phone']); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <hr>
            <p style="font-size: 5px; margin: 2px;"><?php echo get_phrase('if_found'); ?>, <?php echo get_phrase('please_return_to'); ?><p>
              <p style="font-size: 5px; margin: 2px;"><strong><?php echo get_current_school_data('address'); ?></strong></p>
              <p style="font-size: 5px; margin: 2px;">Ph: <?php echo get_current_school_data('phone'); ?></p>
              <p style="font-size: 5px; margin: 2px;">Email: <?php echo get_settings('system_email'); ?></p>
            </div>
          </div>
          <!-- ID CARD ENDS HERE -->

          <div class="d-print-none mt-4">
            <div class="text-center">
              <a href="javascript:window.print()" class="btn btn-primary"><i class="mdi mdi-printer"></i> <?php echo get_phrase('print'); ?></a>
            </div>
          </div>
          <!-- end buttons -->

        </div> <!-- end card-body-->
      </div> <!-- end card -->
    </div> <!-- end col-->
  </div>
