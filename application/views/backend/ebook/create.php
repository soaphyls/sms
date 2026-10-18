<?php $school_id = school_id(); ?>
<form method="POST" class="d-block ajaxForm" action="<?php echo site_url('addons/ebooks/index/create'); ?>" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group mb-1">
            <label for="name"><?php echo get_phrase('book_name'); ?></label>
            <input type="text" class="form-control" id="name" name = "name" required>
        </div>
		<div class="form-group mb-1">
            <label class="col-md-3 col-form-label" for="class_id"><?php echo get_phrase('class'); ?></label>
                    <select name="class_id" id="class_id" class="form-control select2" data-toggle = "select2" required onchange="filter_class(this.value)">
                    <option value=""><?php echo get_phrase('select_a_class'); ?></option>
                    <?php $classes = $this->db->get_where('classes', array('school_id' => $school_id))->result_array(); ?>
                    <?php foreach($classes as $class){ ?>
                        <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                    <?php } ?>
					<option value="0"><?php echo 'N/A'; ?></option>
                </select>
            
        </div>
		<div class="form-group mb-1">
		<label for="field-2" class="col-md-3 control-label"><?php echo get_phrase('Subject');?></label>
			
				<select name="subject_id" class="form-control select2 subject_content"  data-message-required="<?php echo get_phrase('value_required');?>">
					<option value=""><?php echo get_phrase('select_class_first');?></option>
						
				</select>
			
			</div>
			
			
		<div class="form-group mb-1">
            <label class="col-md-3 col-form-label" for="staff_type"><?php echo get_phrase('User_group'); ?></label>
                    <select name="staff_type" id="staff_type" class="form-control select2" data-bs-toggle = "select2"  required>
                    <option value=""><?php echo get_phrase('select_a_user_group'); ?></option>
                    <option value="student">Student</option>
					<option value="admin">Admin</option>
                    <option value="teacher">Teacher</option>
                    <option value="accountant">Accountant</option>
                    <option value="parent">Guardian</option>
                    </select>
            
        </div>
        <div class="form-group mb-1">
            <label for="author"><?php echo get_phrase('author'); ?></label>
            <input type="text" class="form-control" id="author" name = "author" required>
        </div>
		<div class="form-group mb-1">
            <label for="language"><?php echo get_phrase('Language'); ?></label>
            <input  class="form-control col-md-7 col-xs-12"  name="language"  id="language"  placeholder="<?php echo get_phrase('Language'); ?>"  type="text" autocomplete="off">
        </div>
		<div class="form-group mb-1">
            <label for="Edition"><?php echo get_phrase('Edition'); ?></label>
            <input  class="form-control col-md-7 col-xs-12"  name="edition"  id="edition"  placeholder="<?php echo get_phrase('edition'); ?>"  type="text" autocomplete="off">
        </div>
        <div class="form-group row mb-2">
		<label class="control-label"><?php echo get_phrase('e_book_cover'); ?>
                                    </label>
            <div class="box" style="width: 250px;">
			
			<img class="js--image-preview" id="blah" src="<?php echo base_url('uploads/book_cover/placeholder.jpg'); ?>" alt="your image" style="background-color: #F5F5F5;" />
			<input type='file'  onchange="readURL(this);" id="file" class="image-upload " name="cover_image" accept="image/*" required/>
			<label for="file"><i class="mdi mdi-fingerprint  title_icon" width=30 height=30></i>Cover Page...</label>
		</div>
		</div>
		
		<div class="item form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo get_phrase('e-book_file'); ?>
                                    </label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="btn btn-default btn-file">
				<i class="fa fa-paperclip"></i> <?php echo get_phrase('upload'); ?>
				<input  class="form-control col-md-7 col-xs-12"  name="file_name"  id="file_name" type="file" required />
			</div>
			<div class="text-info"><?php echo get_phrase('file_format: pdf, .doc, .docx or .txt'); ?></div>
			
		</div>
                                </div>
        <div class="form-group  col-md-12">
            <button class="btn btn-block btn-primary" type="submit"><?php echo get_phrase('save_ebook_info'); ?></button>
        </div>
    </div>
</form>

<script>
     'use strict';

    $(".ajaxForm").validate({}); // Jquery form validation initialization
    $(".ajaxForm").submit(function(e) {
        var form = $(this);
        ajaxSubmit(e, form, showAssignments);
    });

    $(document).ready(function() {
   $('select.select2:not(.normal)').each(function () { $(this).select2({ dropdownParent: '#right-modal' }); }); //initSelect2(['#department', '#gender', '#blood_group', '#show_on_website']);
});

	
  function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
		
		
function filter_class(){
    var class_id = $('#class_id').val();
    if(class_id != ""){
        showAllSubjects();
    }else{
        toastr.error('<?php echo get_phrase('please_select_a_class'); ?>');
    }
}

var showAllSubjects = function () {
    var class_id = $('#class_id').val();
	
    if(class_id != ""){
        $.ajax({
            url: '<?php echo site_url('addons/ebooks/subject/list/') ?>'+class_id,
            success: function(response){
               $('.subject_content').html(response);
			   // alert('Hello');
            }
        });
    }
}		
		
</script>
<style type= text/css >
img{
  max-width:250px;
  max-height:250px;
}
input[type=file]{
padding:10px;
background:#eee;}
.custom-file-input {
color: transparent; cursor: pointer!important;
}
.image-upload {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}
.image-upload + label {
    font-size: 1.25em;
    font-weight: 700;
    color: white;
    background-color: #dc3545;
    display: inline-block;
}

.image-upload:focus + label,
.image-upload + label:hover {
    background-color: #0d6efd;
}
.image-upload + label {
	cursor: pointer; /* "hand" cursor */
}
</style>
