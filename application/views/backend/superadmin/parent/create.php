<form method="POST" class="d-block ajaxForm" action="<?php echo route('parent/create'); ?>">
    <div class="form-row">
        <div class="form-group mb-1">
            <label for="name"><?php echo get_phrase('name'); ?></label>
            <input type="text" class="form-control" id="name" name = "name" required>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_name'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label for="email"><?php echo get_phrase('email'); ?></label>
            <input type="email" class="form-control" id="email" name = "email" required>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_email'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label for="password"><?php echo get_phrase('password'); ?></label>
            <input type="password" class="form-control" id="password" name = "password" required>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_password'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label for="phone"><?php echo get_phrase('phone'); ?></label>
            <input type="text" class="form-control" id="phone" name = "phone" required>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_phone_number'); ?></small>
        </div>

        <div class="form-group mb-1">
            <label for="gender"><?php echo get_phrase('gender'); ?></label>
            <select name="gender" id="gender" class="form-control select2" data-toggle = "select2">
                <option value=""><?php echo get_phrase('select_a_gender'); ?></option>
                <option value="Male"><?php echo get_phrase('male'); ?></option>
                <option value="Female"><?php echo get_phrase('female'); ?></option>
                <option value="Others"><?php echo get_phrase('others'); ?></option>
            </select>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_gender'); ?></small>
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
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_blood_group'); ?></small>
        </div>
		<!-- COUNTRY STATE LGA CODE ADDED BY SOAP START -->


						<div class="form-group col-md-12">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('country');?></label>

						<div class="col-sm-12">
							<select name="country_id" class="form-control" data-validate="required" id="country_id"
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
		                        <select name="state_id" class="form-control" id="state_selector_holder" data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="return get_state_locals(this.value)">
		                            <option value=""><?php echo get_phrase('select_country_first');?></option>
										
			                    </select>
			                </div>
					</div>

						<div class="form-group col-md-12">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('LGA');?></label>
		                    <div class="col-sm-12">
		                        <select name="local_id" class="form-control" id="local_selector_holder">
		                            <option value=""><?php echo get_phrase('select_state_first');?></option>

			                    </select>
			                </div>
					</div>




			<!-- COUNTRY STATE LGA CODE ADDED BY SOAP END -->

        <div class="form-group mb-1">
            <label for="address"><?php echo get_phrase('address'); ?></label>
            <textarea class="form-control" id="address" name = "address" rows="5" required></textarea>
            <small id="" class="form-text text-muted"><?php echo get_phrase('provide_address'); ?></small>
        </div>
			
			<div class="form-group col-md-12">
            <label for="image_file"><?php echo get_phrase('upload_image'); ?></label>
            <input type="file" class="form-control" id="image_file" name = "image_file">
			</div><br>
        <div class="form-group  col-md-12">
            <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('create_parent'); ?></button>
        </div>
    </div>
</form>

<script>
$(document).ready(function () {
    $('select.select2:not(.normal)').each(function () { $(this).select2({ dropdownParent: '#right-modal' }); }); //initSelect2(['#gender', '#blood_group']);
});
$(".ajaxForm").validate({}); // Jquery form validation initialization
$(".ajaxForm").submit(function(e) {
    var form = $(this);
    ajaxSubmit(e, form, showAllParents);
});



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
