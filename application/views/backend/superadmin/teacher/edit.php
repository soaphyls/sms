<?php
$users = $this->db->get_where('users', array('id' => $param1))->result_array();
foreach($users as $user):
  $teacher = $this->db->get_where('teachers', array('user_id' => $user['id']))->row_array();
  $social_links = json_decode($teacher['social_links'], true);
  ?>
  <form method="POST" class="d-block ajaxForm" action="<?php echo route('teacher/update/'.$param1); ?>">
    <div class="form-row">
      <div class="form-group mb-1">
        <input type="hidden" name="school_id" value="<?php echo school_id(); ?>">
        <label for="name"><?php echo get_phrase('name'); ?></label>
        <input type="text" value="<?php echo $user['name']; ?>" class="form-control" id="name" name = "name" required>
        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_name'); ?></small>
      </div>

      <div class="form-group mb-1">
        <label for="email"><?php echo get_phrase('email'); ?></label>
        <input type="email" value="<?php echo $user['email']; ?>" class="form-control" id="email" name = "email" required>
        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_email'); ?></small>
      </div>

      <div class="form-group mb-1">
        <label for="designation"><?php echo get_phrase('designation'); ?></label>
        <input type="text" value="<?php echo $teacher['designation']; ?>" class="form-control" id="designation" name = "designation" required>
        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_designation'); ?></small>
      </div>

      <div class="form-group mb-1">
        <label for="department"><?php echo get_phrase('department'); ?></label>
        <select name="department" id="department" class="form-control select2" data-toggle = "select2" required>
          <option value=""><?php echo get_phrase('select_a_department'); ?></option>
          <?php $departments = $this->db->get_where('departments', array('school_id' => school_id()))->result_array();
          foreach($departments as $department){
            ?>
            <option value="<?php echo $department['id']; ?>" <?php if($department['id'] == $teacher['department_id']) echo 'selected'; ?>><?php echo $department['name']; ?></option>
          <?php } ?>
        </select>
        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_a_department'); ?></small>
      </div>

      <div class="form-group mb-1">
        <label for="phone"><?php echo get_phrase('phone_number'); ?></label>
        <input type="text" value="<?php echo $user['phone']; ?>" class="form-control" id="phone" name = "phone" required>
        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_phone_number'); ?></small>
      </div>

      <div class="form-group mb-1">
        <label for="gender"><?php echo get_phrase('gender'); ?></label>
        <select name="gender" id="gender" class="form-control select2" data-toggle = "select2">
          <option value=""><?php echo get_phrase('select_a_gender'); ?></option>
          <option value="Male" <?php if($user['gender'] == 'Male') echo 'selected'; ?>><?php echo get_phrase('male'); ?></option>
          <option value="Female" <?php if($user['gender'] == 'Female') echo 'selected'; ?>><?php echo get_phrase('female'); ?></option>
          <option value="Others" <?php if($user['gender'] == 'Others') echo 'selected'; ?>><?php echo get_phrase('others'); ?></option>
        </select>
        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_gender'); ?></small>
      </div>

      <div class="form-group mb-1">
        <label for="blood_group"><?php echo get_phrase('blood_group'); ?></label>
        <select name="blood_group" id="blood_group" class="form-control select2" data-toggle = "select2">
          <option value=""><?php echo get_phrase('select_a_blood_group'); ?></option>
          <option value="a+" <?php if($user['blood_group'] == 'a+') echo 'selected'; ?>>A+</option>
          <option value="a-" <?php if($user['blood_group'] == 'a-') echo 'selected'; ?>>A-</option>
          <option value="b+" <?php if($user['blood_group'] == 'b+') echo 'selected'; ?>>B+</option>
          <option value="b-" <?php if($user['blood_group'] == 'b-') echo 'selected'; ?>>B-</option>
          <option value="ab+" <?php if($user['blood_group'] == 'ab+') echo 'selected'; ?>>AB+</option>
          <option value="ab-" <?php if($user['blood_group'] == 'ab-') echo 'selected'; ?>>AB-</option>
          <option value="o+" <?php if($user['blood_group'] == 'o+') echo 'selected'; ?>>O+</option>
          <option value="o-" <?php if($user['blood_group'] == '0-') echo 'selected'; ?>>O-</option>
        </select>
        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_blood_group'); ?></small>
      </div>
		<!-- COUNTRY STATE LGA CODE ADDED BY SOAP START -->

					<!-- new update for country, state and lga  -->
					<div class="form-group row mb-3">
						<label class="col-md-3 col-form-label" for="country"><?php echo get_phrase('country');?></label>
                        
						<div class="col-sm-5">
							<select name="country_id" class="form-control select2" required >
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
									$country = $this->db->get('country')->result_array();
									$country_id = $user['country_id'];
									foreach($country as $row3){
										?>
                                		<option value="<?php echo $row3['country_id'];?>"
                                        	<?php if($row3['country_id'] == $country_id)echo 'selected';?>>
													<?php echo $row3['country_name'];?>
                                                </option>
	                                <?php } ?>
                          </select>
						</div> 
					</div>
					
					<!-- new update for state  -->
					<div class="form-group row mb-3">
						<label class="col-md-3 col-form-label" for="state"><?php echo get_phrase('state');?></label>
                        
						<div class="col-sm-5">
							<select name="state_id" class="form-control select2" required data-message-required="<?php echo get_phrase('value_required');?>" onchange="return get_state_locals(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
									$state = $this->db->get('state')->result_array();
									$state_id = $user['state_id'];
									foreach($state as $row3){
										?>
                                		<option value="<?php echo $row3['state_id'];?>"
                                        	<?php if($row3['state_id'] == $state_id)echo 'selected';?>>
													<?php echo $row3['state_name'];?>
                                                </option>
	                                <?php } ?>
                          </select>
						</div> 
					</div>
					
					
					<!-- new update for LGA  -->
					<div class="form-group row mb-3">
						<label class="col-md-3 col-form-label" for="LGA"><?php echo get_phrase('LGA');?></label>
                        
						<div class="col-sm-5">
							<select name="local_id" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" id="local_selector_holder">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
									$lga = $this->db->get('locals')->result_array();
									$local_id = $user['local_id'];
									foreach($lga as $row3){
										?>
                                		<option value="<?php echo $row3['local_id'];?>"
                                        	<?php if($row3['local_id'] == $local_id)echo 'selected';?>>
													<?php echo $row3['local_name'];?>
                                                </option>
	                                <?php } ?>
                          </select>
						</div> 
					</div>




			<!-- COUNTRY STATE LGA CODE ADDED BY SOAP END -->
      <div class="form-group mb-1">
        <label><?php echo get_phrase('facebook_profile_link'); ?></label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="mdi mdi-facebook"></i></span>
          </div>
          <input type="text" class="form-control" name="facebook_link" value="<?php echo $social_links['facebook']; ?>">
        </div>
        <small id="" class="form-text text-muted"><?php echo get_phrase('facebook_profile_link'); ?></small>
      </div>

      <div class="form-group mb-1">
        <label><?php echo get_phrase('twitter_profile_link'); ?></label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="mdi mdi-twitter"></i></span>
          </div>
          <input type="text" class="form-control" name="twitter_link" value="<?php echo $social_links['twitter']; ?>">
        </div>
        <small id="" class="form-text text-muted"><?php echo get_phrase('twitter_profile_link'); ?></small>
      </div>

      <div class="form-group mb-1">
        <label><?php echo get_phrase('linkedin_profile_link'); ?></label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="mdi mdi-linkedin"></i></span>
          </div>
          <input type="text" class="form-control" name="linkedin_link" value="<?php echo $social_links['linkedin']; ?>">
        </div>
        <small id="" class="form-text text-muted"><?php echo get_phrase('linkedin_profile_link'); ?></small>
      </div>

      <div class="form-group mb-1">
        <label for="phone"><?php echo get_phrase('address'); ?></label>
        <textarea class="form-control" id="address" name = "address" rows="5" required><?php echo $user['address']; ?></textarea>
        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_address'); ?></small>
      </div>

      <div class="form-group mb-1">
        <label for="about"><?php echo get_phrase('about'); ?></label>
        <textarea class="form-control" id="about" name = "about" rows="5" required><?php echo $teacher['about']; ?></textarea>
        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_a_small_about'); ?></small>
      </div>

      <div class="form-group mb-1">
          <label for="image_file"><?php echo get_phrase('upload_image'); ?></label>
          <input type="file" class="form-control" id="image_file" name = "image_file">
      </div>

      <div class="form-group mt-2 col-md-12">
        <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('update_teacher'); ?></button>
      </div>
    </div>
  </form>
<?php endforeach; ?>

<script>

$(document).ready(function () {
  $('select.select2:not(.normal)').each(function () { $(this).select2({ dropdownParent: '#right-modal' }); }); //initSelect2(['#department', '#gender', '#blood_group', '#show_on_website']);
});
$(".ajaxForm").validate({}); // Jquery form validation initialization
$(".ajaxForm").submit(function(e) {
  var form = $(this);
  ajaxSubmit(e, form, showAllTeachers);
});

// initCustomFileUploader();
function get_country_states(country_id) {

    	$.ajax({
            url: '<?php echo site_url('superadmin/get_country_state/');?>' + country_id,
            success: function(response)
            {
                jQuery('#state_selector_holder').html(response);
				
            }
        });

    }



function get_state_locals(state_id) {

    	$.ajax({
            url: '<?php echo site_url('superadmin/get_state_local/');?>' + state_id,
            success: function(response)
            {
                jQuery('#local_selector_holder').html(response);
				
            }
        });

    }
</script>

