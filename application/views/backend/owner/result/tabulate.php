
<?php // if($working_page == 'filter'): ?>
    <!--title-->
    <div class="row d-print-none">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="page-title">
                        <i class="mdi mdi-calendar-today title_icon"></i> <?php echo get_phrase('tabulation_sheet'); ?>
                        
                    </h4>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <div class="row d-print-none">
        <div class="col-12">
            <div class="card ">
                <div class="row mt-3">
                    <div class="col-md-1 mb-1"></div>
					<div class="col-md-4 mb-1">
					<select name="exam_id" id="exam_id" class="form-control select2"  required >
                       
		                        <option value=""><?php echo get_phrase('select_an_exam');?></option>
		                        <?php 
								$school_id = school_id();
								$exams = $this->db->get_where('exams', array('school_id' => $school_id, 'session' => active_session()))->result_array();

		                     //   $exams = $this->db->get_where('exam' , array('year' => $running_year))->result_array();
		                        foreach($exams as $row){
		                        ?>
		                            <option value="<?php echo $row['id'];?>">
		                            		<?php echo $row['name'];?>
		                            </option>
		                        <?php
		                        }
		                        ?>
		                    </select>
                    </div>
                    <div class="col-md-4 mb-1">
                        <select name="class" id="class_id" class="form-control select2" data-toggle = "select2" required >
                            <option value=""><?php echo get_phrase('select_a_class'); ?></option>
                            <?php
                            $classes = $this->db->get_where('classes', array('school_id' => school_id()))->result_array();
                            foreach($classes as $class){
                                ?>
                                <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <button class="btn btn-block btn-success" onclick="filter_student_result()" ><?php echo get_phrase('filter'); ?></button>
                    </div>
                </div>
                <div class="card-body result_content">
                    <div class="empty_box">
                        <img class="mb-3" width="150px" src="<?php echo base_url('assets/backend/images/empty_box.png'); ?>" />
                        <br>
                        <span class=""><?php echo get_phrase('no_data_found'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php //elseif($working_page == 'create'): ?>
    <?php// include 'create.php'; ?>
<?php //elseif($working_page == 'edit'): ?>
    <?php// include 'update.php'; ?>
<?php //endif; ?>

<script>
function filter_student_result(){
    var class_id = $('#class_id').val();
    var exam_id = $('#exam_id').val();
    if(class_id != "" && exam_id!= ""){
        showAllStudents();
    }else{
        toastr.error('<?php echo get_phrase('please_select_an_exam_and_class'); ?>');
    }
}

var showAllStudents = function() {
    var class_id = $('#class_id').val();
    var exam_id = $('#exam_id').val();
    if(class_id != "" && exam_id!= ""){
        $.ajax({
            url: '<?php echo route('tabulate/filter/') ?>'+class_id+'/'+exam_id,
            success: function(response){
                $('.result_content').html(response);
            }
        });
    }
}


</script>
