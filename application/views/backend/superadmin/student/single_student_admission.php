<?php $school_id = school_id(); ?>

<form method="POST" class="p-3 d-block ajaxForm" action="<?php echo route('student/create_single_student'); ?>" id = "student_admission_form" enctype="multipart/form-data">
    <div class="col-md-12">
        <div class="form-group row mb-3">
            <label class="col-md-3 col-form-label" for="name"><?php echo get_phrase('name'); ?></label>
            <div class="col-md-9">
                <input type="text" id="name" name="name" class="form-control" placeholder="name" required>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3 col-form-label" for="email"><?php echo get_phrase('email'); ?></label>
            <div class="col-md-9">
                <input type="email" class="form-control" id="email" name="email" placeholder="email" required>
            </div>
        </div>
		
		<div class="form-group row mb-3">
            <label class="col-md-3 col-form-label" for="RegNo"><?php echo get_phrase('Reg No'); ?></label>
            <div class="col-md-9">
                <input type="RegNo" class="form-control" id="RegNo" name="RegNo" placeholder="Reg No" required>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3 col-form-label" for="password"><?php echo get_phrase('password'); ?></label>
            <div class="col-md-9">
                <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3 col-form-label" for="parent_id"><?php echo get_phrase('parent'); ?></label>
            <div class="col-md-9">
                <select id="parent_id" name="parent_id" class="form-control select2" data-toggle = "select2"  required onchange="return parents_address(this.value)" >
                    <option value=""><?php echo get_phrase('select_a_parent'); ?></option>
                    <?php $parents = $this->db->get_where('parents', array('school_id' => $school_id))->result_array(); ?>
                    <?php foreach($parents as $parent):?>
									
                        <option value="<?php echo $parent['user_id']; ?>"><?php echo $this->user_model->get_user_details($parent['user_id'], 'name'); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
		<div class="form-group row mb-3">
            <label class="col-md-3 col-form-label" for="class_id_g"><?php echo get_phrase('class Group'); ?></label>
            <div class="col-md-9">
                <select name="class_id_g" id="class_id_g" class="form-control select2" data-toggle = "select2" required >
                    <option value=""><?php echo get_phrase('select_class_group'); ?></option>
                    <?php $class_group = $this->db->get_where('class_group', array('school_id' => $school_id))->result_array(); ?>
                    <?php foreach($class_group as $class_g){ ?>
                        <option value="<?php echo $class_g['id']; ?>"><?php echo $class_g['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-md-3 col-form-label" for="class_id"><?php echo get_phrase('class'); ?></label>
            <div class="col-md-9">
                <select name="class_id" id="class_id" class="form-control select2" data-toggle = "select2" required onchange="classWiseSection(this.value)">
                    <option value=""><?php echo get_phrase('select_a_class'); ?></option>
                    <?php $classes = $this->db->get_where('classes', array('school_id' => $school_id))->result_array(); ?>
                    <?php foreach($classes as $class){ ?>
                        <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3 col-form-label" for="section_id"><?php echo get_phrase('section'); ?></label>
            <div class="col-md-9" id = "section_content">
                <select name="section_id" id="section_id" class="form-control select2" data-toggle = "select2" required >
                    <option value=""><?php echo get_phrase('select_section'); ?></option>
                </select>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3 col-form-label" for="birthdatepicker"><?php echo get_phrase('birthday'); ?></label>
            <div class="col-md-9 position-relative" id="datepicker4">
                <input type="text" class="form-control" data-provide="datepicker" data-date-autoclose="true" data-date-container="#datepicker4" name = "birthday"   value="<?php echo date('m/d/Y'); ?>" required>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3 col-form-label" for="gender"><?php echo get_phrase('gender'); ?></label>
            <div class="col-md-9">
                <select name="gender" id="gender" class="form-control select2" data-toggle = "select2"  required>
                    <option value=""><?php echo get_phrase('select_gender'); ?></option>
                    <option value="Male"><?php echo get_phrase('male'); ?></option>
                    <option value="Female"><?php echo get_phrase('female'); ?></option>
                    <option value="Others"><?php echo get_phrase('others'); ?></option>
                </select>
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-md-3 col-form-label" for="blood_group"><?php echo get_phrase('blood_group'); ?></label>
            <div class="col-md-9">
                <select name="blood_group" id="blood_group" class="form-control select2" data-toggle = "select2"  required>
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
            </div>
        </div>
		 <!-- COUNTRY STATE LGA CODE ADDED BY SOAP START -->
		 <div class="form-group row mb-3">
            <label class="col-sm-3 col-form-label" for="country_id"><?php echo get_phrase('country');?></label>
					<div class="col-sm-5">
                        <select name="country_id" id="country_id" class="form-control select2" data-toggle = "select2" required>
                            <option value=""><?php echo get_phrase('select_country'); ?></option>
                        </select>
                    </div>
					</div>					

                  		<div class="form-group row mb-3">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('State');?></label>
		                    <div class="col-sm-5">
		                        <select name="state_id" class="form-control select2" id="state_selector_holder" data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="return get_state_locals(this.value)">
		                            <option value=""><?php echo get_phrase('select_country_first');?></option>
										
			                    </select>
			                </div>
					</div>

						<div class="form-group row mb-3">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('LGA');?></label>
		                    <div class="col-sm-5">
		                        <select name="local_id" class="form-control select2" id="local_selector_holder">
		                            <option value=""><?php echo get_phrase('select_state_first');?></option>

			                    </select>
			                </div>
					</div>




			<!-- COUNTRY STATE LGA CODE ADDED BY SOAP END -->
			
        <div class="form-group row mb-3">
            <label class="col-md-3 col-form-label" for="example-textarea"><?php echo get_phrase('address'); ?></label>
            <div class="col-md-9">
                <textarea class="form-control" id="example-textarea" rows="5" name = "address" placeholder="address"></textarea>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3 col-form-label" for="phone"><?php echo get_phrase('phone'); ?></label>
            <div class="col-md-9">
                <input type="text" id="phone" name="phone" class="form-control" placeholder="phone" required>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3 col-form-label" for="example-fileinput"><?php echo get_phrase('student_profile_image'); ?></label>
            <div class="col-md-9 custom-file-upload">
                <div class="wrapper-image-preview" style="margin-left: -6px;">
                    <div class="box" style="width: 250px;">
                        <div class="js--image-preview" style="background-image: url(<?php echo base_url('uploads/users/placeholder.jpg'); ?>); background-color: #F5F5F5;"></div>
                        <div class="upload-options">
                            <label for="student_image" class="btn"> <i class="mdi mdi-camera"></i> <?php echo get_phrase('upload_an_image'); ?> </label>
                            <input id="student_image" style="visibility:hidden;" type="file" class="image-upload" name="student_image" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-secondary col-md-4 col-sm-12 mb-4"><?php echo get_phrase('add_student'); ?></button>
        </div>
    </div>
</form>

<script type="text/javascript">
var form;
$(".ajaxForm").submit(function(e) {
  form = $(this);
  ajaxSubmit(e, form, refreshForm);
});
var refreshForm = function () {
    form.trigger("reset");
}

function parents_address(parent_id) {
			filter_parent();
			
			$.ajax({
            url: '<?php echo site_url('superadmin/parents_address/');?>' + parent_id,
            success: function(response)
            {
                jQuery('#example-textarea').html(response);
				
            }
        });

    }

function get_country_states() {
		var parent_id = $('#parent_id').val();
		
    	$.ajax({
            url: '<?php echo route('list_state/list_st/');?>' + parent_id,
            success: function(response)
            {
                jQuery('#state_selector_holder').html(response);
				get_state_locals();
            }
        });

    }



function get_state_locals(state_id) {
		var parent_id = $('#parent_id').val();
    	$.ajax({
            url: '<?php echo route('list_lga/list_lg/');?>' + parent_id,
            success: function(response)
            {
                jQuery('#local_selector_holder').html(response);
				
            }
        });

    }
	
		
 function filter_parent() {
    var parent_id = $('#parent_id').val();
    if(parent_id != ""){
	//get_country_states();
        $.ajax({
            url: '<?php echo route('list_country/list_co/') ?>'+ parent_id,
            success: function(response){
                $('#country_id').html(response);
				get_country_states();
            }
        });
    }
}
</script>
