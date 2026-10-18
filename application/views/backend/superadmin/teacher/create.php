<form method="POST" class="d-block ajaxForm" action="<?php echo route('teacher/create'); ?>" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group mb-1">
            <input type="hidden" name="school_id" value="<?php echo school_id(); ?>">
            <label for="name"><?php echo get_phrase('name'); ?></label>
            <input type="text" class="form-control" id="name" name = "name" required>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_name'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label for="email"><?php echo get_phrase('email'); ?></label>
            <input type="email" class="form-control" id="email" name = "email" required>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_email'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label for="password"><?php echo get_phrase('password'); ?></label>
            <input type="password" class="form-control" id="password" name = "password" required>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_password'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label for="designation"><?php echo get_phrase('designation'); ?></label>
            <input type="text" class="form-control" id="designation" name = "designation" required>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_designation'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label for="department"><?php echo get_phrase('department'); ?></label>
            <select name="department" id="department" class="form-control select2" data-toggle = "select2" required>
                <option value=""><?php echo get_phrase('select_a_department'); ?></option>
                <?php $departments = $this->db->get_where('departments', array('school_id' => school_id()))->result_array();
                foreach($departments as $department){
                    ?>
                    <option value="<?php echo $department['id']; ?>"><?php echo $department['name']; ?></option>
                <?php } ?>
            </select>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_a_department'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label for="phone"><?php echo get_phrase('phone_number'); ?></label>
            <input type="text" class="form-control" id="phone" name = "phone" required>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_phone_number'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label for="gender"><?php echo get_phrase('gender'); ?></label>
            <select name="gender" id="gender" class="form-control select2" data-toggle = "select2">
                <option value=""><?php echo get_phrase('select_a_gender'); ?></option>
                <option value="Male"><?php echo get_phrase('male'); ?></option>
                <option value="Female"><?php echo get_phrase('female'); ?></option>
                <option value="Others"><?php echo get_phrase('others'); ?></option>
            </select>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_gender'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label for="blood_group"><?php echo get_phrase('blood_group'); ?></label>
            <select name="blood_group" id="blood_group" class="form-control select2" data-toggle = "select2">
                <option value=""><?php echo get_phrase('select_a_blood_group'); ?></option>
                <option value="a+">A+</option>
                <option value="a-">A-</option>
                <option value="b+">B+</option>
                <option value="b-">B-</option>
                <option value="ab+">AB+</option>
                <option value="ab-">AB-</option>
                <option value="o+">O+</option>
                <option value="o-">O-</option>
            </select>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_blood_group'); ?></small>
        </div>
		<!-- COUNTRY STATE LGA CODE ADDED BY SOAP START -->


						<div class="form-group col-md-12">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('country');?></label>

						<div class="col-sm-12">
							<select name="country_id" class="form-control select2" data-validate="required" id="country_id"
								data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="return get_country_states(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php
								$countrys = $this->db->get('country')->result_array();
								foreach($countrys as $row):
									?>
                            		<option value="<?php echo $row['country_id'];?>">
											<?php echo $row['country_name'];?>
                                            </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div>
					</div>


                  		<div class="form-group col-md-12">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('State');?></label>
		                    <div class="col-sm-12">
		                        <select name="state_id" class="form-control select2" id="state_selector_holder" data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="return get_state_locals(this.value)">
		                            <option value=""><?php echo get_phrase('select_country_first');?></option>
										
			                    </select>
			                </div>
					</div>

						<div class="form-group col-md-12">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('LGA');?></label>
		                    <div class="col-sm-12">
		                        <select name="local_id" class="form-control select2" id="local_selector_holder">
		                            <option value=""><?php echo get_phrase('select_state_first');?></option>

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
                <input type="text" class="form-control" name="facebook_link">
            </div>
            <small id="" class="form-text text-muted"><?php echo get_phrase('facebook_profile_link'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label><?php echo get_phrase('twitter_profile_link'); ?></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="mdi mdi-twitter"></i></span>
                </div>
                <input type="text" class="form-control" name="twitter_link">
            </div>
            <small id="" class="form-text text-muted"><?php echo get_phrase('twitter_profile_link'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label><?php echo get_phrase('linkedin_profile_link'); ?></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="mdi mdi-linkedin"></i></span>
                </div>
                <input type="text" class="form-control" name="linkedin_link">
            </div>
            <small id="" class="form-text text-muted"><?php echo get_phrase('linkedin_profile_link'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label for="phone"><?php echo get_phrase('address'); ?></label>
            <textarea class="form-control" id="address" name = "address" rows="5" required></textarea>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_teacher_address'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label for="about"><?php echo get_phrase('about'); ?></label>
            <textarea class="form-control" id="about" name = "about" rows="5" required></textarea>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_a_small_about'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label for="image_file"><?php echo get_phrase('upload_image'); ?></label>
            <input type="file" class="form-control" id="image_file" name = "image_file">
        </div>

        <div class="form-group mt-2 col-md-12">
            <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('create_teacher'); ?></button>
        </div>
    </div>
</form>

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
