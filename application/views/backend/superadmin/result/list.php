<?php
$school_id = school_id();
$session = active_session();
?>
<form method="POST" class="d-block ajaxForm" action="<?php echo route('tabulate/publish'); ?>">
<div class="row justify-content-center">
  <div class="col-md-12">

    <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
      <thead>
        <tr style="background-color:#313a46; color:#eee;">
          <td style="text-align: center;">
		  
		  
							<input type="hidden"  name="exam_id"  value =" <?php echo $exam_id;?>">
							<input type="hidden"  name="class_id" value ="<?php echo $class_id;?>">
							<?php echo get_phrase('students');?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('subjects');?> <i class="entypo-right-thin"></i>
						</td>
						<?php 
							$subjects = $this->db->get_where('subjects' , array('class_id' => $class_id ,'session' => $session ))->result_array();
							foreach($subjects as $row):
						?>
							<td style="text-align: center;"><?php echo $row['name'];?></td>
						<?php endforeach;?>
						<td style="text-align: center;"><?php echo get_phrase('total');?></td>
						<td style="text-align: center;"><?php echo get_phrase('average_score');?></td>
        </tr>
      </thead>
	  
      <tbody>
						<?php
						$enrols = $this->db->get_where('enrols', array('class_id' => $class_id, 'school_id' => $school_id, 'session' => $session))->result_array();
						foreach($enrols as $enroll){
						$student = $this->db->get_where('students', array('id' => $enroll['student_id']))->row_array();
         				?>
						<tr>
							<td style="text-align: center;">
							<?php echo $this->user_model->get_user_details($student['user_id'], 'name'); ?>
							</td>
						<?php
							$total_marks = 0;
							$total_grade_point = 0;  
							foreach($subjects as $row2):
								$student_id = $student['id'];
								$subject_id = $row2['id'];
						?>
							<td style="text-align: center;">
								<?php 
									//$obtained_mark_query = 	$this->crud_model->get_result_marks($class_id, $student_id, $subject_id, $exam_id);
									$obtained_mark_query = $this->db->get_where('marks', array('class_id' => $class_id ,'exam_id' => $exam_id,'subject_id' => $subject_id,'student_id' => $student_id,'school_id' => $school_id,'session' => active_session()));
									if( $obtained_mark_query->num_rows() > 0) {
										$mark_total = $obtained_mark_query->row()->mark_total;
										//echo Hello;
										echo $mark_total;
										//if ($obtained_marks >= 0 && $obtained_marks != '') {
										//	$grade = $this->crud_model->get_grade($obtained_marks);
										//	$total_grade_point += $grade['grade_point'];
										//}
										$total_marks += $mark_total;
									}
								
								?>
							</td>
							<?php endforeach;?>
							<td style="text-align: center;"><input type ="hidden"  id="total_marks-<?php echo $student['id'];?>" name="total_marks_<?php echo $student_id;?>" value="<?php echo $total_marks;?>"><?php echo $total_marks;?></td>
						
						<td style="text-align: center;">
							<?php 
								$this->db->where('class_id' , $class_id);
								$this->db->where('session', $session);
								$this->db->from('subjects');
								$number_of_subjects = $this->db->count_all_results();
								$average_score= ($total_marks / $number_of_subjects);
								$avg_total_marks = (round($average_score,2));
								
							?>
							<?php echo $avg_total_marks;?>
						
							<input type ="hidden"  id="avg_total_marks-<?php echo $student['id'];?>" name="avg_total_marks_<?php echo $student_id;?>" value="<?php echo $avg_total_marks;?>">
							<input type="hidden"  name="total_subject" value ="<?php echo $number_of_subjects;?>">	
						</td>
						</tr>
						
						
							
						

						<?php }?>
							
							
					</tbody>
    </table>
	<center>
					
					<button type="submit"  
						class="btn btn-success entypo-check" style="background-color:#060;color:#fff; margin-left:10px;margin-right:10px" >
						<?php echo get_phrase('Publish_Result');?>
					</button>
												
					
					<a href="<?php echo route('tabulation_sheet_print_view/'.$class_id.'/'.$exam_id);?>" 
						class="btn btn-primary" target="_blank" style="margin-right:10px" >
						<?php echo get_phrase('preview_Result');?>
					</a>
					<a href="<?php echo base_url('superadmin/tabulate');?>" 
						class="btn btn-danger" style="margin-right:30px" >
						<?php echo get_phrase('Cancel');?>
					</a>
				</center>
				
			
  </div>
</div>
</form>
<script type="text/javascript">
initDataTable('basic-datatable');

function publish_student_result(id){
     var class_id = '<?php echo $class_id; ?>';
		 var exam_id = '<?php echo $exam_id; ?>';
         var total_subject = '<?php echo $number_of_subjects; ?>';
         var total_marks = $('#total_marks-' + id).val();
         var avg_total_marks  = $('#avg_total_marks-' + id).val();
		// alert(total_marks);
    if(total_subject != ""){
		
		 $.ajax({
			 type : 'POST',
                url: '<?php echo route('publish_student_result/');?>',
				data : {student_id : id, class_id : class_id, total_marks : total_marks, total_subject : total_subject, exam_id : exam_id, avg_total_marks : avg_total_marks},
               
				success : function(response){
                    $('.feedback').html(response);
                }
			 });

		}else{
            toastr.error('<?php echo get_phrase('required_mark_field'); ?>');
        }
    
    }

</script>
