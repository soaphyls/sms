<?php
$school_id = school_id();
$session = active_session();
include('result_tiny.php');
?>
<div class="row justify-content-center">
  <div class="col-md-12">

    <table id="basic-datatable" class="table cell-border dt-responsive nowrap" width="100%">
      <thead>
        <tr style="background-color:#313a46; color:#eee;">
		<td style="width:5%;">No.</td>
          <td style="text-align: center;min-width:20px">
		  
		  
						<?php echo get_phrase('students');?>  
						</td>
						<?php 
							$subjects = $this->db->get_where('subjects' , array('class_id' => $class_id ,'session' => $session ))->result_array();
							foreach($subjects as $row):
							
						?>
							
						<?php endforeach;?>
						<td style="text-align: center;min-width:10px"><?php echo get_phrase('total');?></td>
						<td style="text-align: right;min-width:10px"><?php echo get_phrase('average');?></td>
						<td style="text-align: center;min-width:20px"><?php echo get_phrase('Pass/Fail');?></td>
						<td style="text-align: center;min-width:10px"><?php echo get_phrase('Action');?></td>
       
        </tr>
      </thead>
	  
      <tbody>
	 
						<?php
						$i=1;
						$enrols = $this->db->get_where('enrols', array('class_id' => $class_id, 'school_id' => $school_id, 'session' => $session))->result_array();
						foreach($enrols as $enroll){
						$student = $this->db->get_where('students', array('id' => $enroll['student_id']))->row_array();
         				$class_id_g = $this->db->get_where('primary_marks', array('id' => $enroll['class_id_g']))->row_array();
         				
						?>
						<tr>
						 <td><?php echo $i++; ?></td>
							<td>
							<?php echo $this->user_model->get_user_details($student['user_id'], 'name'); ?>
							</td>
						<?php
							$total_marks = 0;
							$total_grade_point = 0;  
							foreach($subjects as $row2):
								$student_id = $student['id'];
								$subject_id = $row2['id'];
								$class_g = $class_id_g[id];
								
						?>
							
								<?php 
									//$obtained_mark_query = 	$this->crud_model->get_result_marks($class_id, $student_id, $subject_id, $exam_id);
									$obtained_mark_query = $this->db->get_where('marks', array('class_id' => $class_id ,'exam_id' => $exam_id,'subject_id' => $subject_id,'student_id' => $student_id,'school_id' => $school_id,'session' => active_session()));
									if( $obtained_mark_query->num_rows() > 0) {
										$mark_total = $obtained_mark_query->row()->mark_total;
										//echo Hello;
										//echo $mark_total;
										//if ($obtained_marks >= 0 && $obtained_marks != '') {
										//	$grade = $this->crud_model->get_grade($obtained_marks);
										//	$total_grade_point += $grade['grade_point'];
										//}
										$total_marks += $mark_total;
									}
								
								?>
							
							<?php endforeach;?>
							
							<td style="text-align: center;"><input type ="hidden"  id="total_marks-<?php echo $student['id'];?>" name="total_marks_<?php echo $student_id;?>" value="<?php echo $total_marks;?>"><?php echo $total_marks;?></td>
						
						<td style="text-align: right;">
							<?php 
								$this->db->where('class_id' , $class_id);
								$this->db->where('session', $session);
								$this->db->from('subjects');
								$number_of_subjects = $this->db->count_all_results();
								$average_score= ($total_marks / $number_of_subjects);
								$avg_total_marks = (round($average_score,2));
								
							?>
							<?php echo $avg_total_marks;?>
							<?php $class_total+= $avg_total_marks;
							
							
							?>
							
							</td>
							<td> <!-- .progress-md -->
							
<div class="progress progress-sm">
    <div class="progress-bar bg-<?php echo $avg_total_marks >=$class_avg? 'success':'danger';?>" role="progressbar" style="width: <?php echo $avg_total_marks;?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
</div></td>
							<td style="text-align: right; min-width:10px"><a href="<?php echo route('view_students_results/'.$class_id.'/'.$exam_id.'/'.$student_id.'/'.$class_g.'/'.$class_avg);?>" 
						class="btn btn-success" target="_blank" style="margin-right:3px" >
                                        View 
                                    </a></td>
						
						</tr>
						
						<?php }?>
						
						
					</tbody>
    </table>
	<center>
					<a href="<?php echo base_url('superadmin/check_result');?>" 
						class="btn btn-danger" style="margin-right:30px" >
						<?php echo get_phrase('Cancel');?>
					</a>
				</center>
				
			
  </div>
</div>

<script type="text/javascript">

$(document).ready(function() {
    $('#basic-datatable').DataTable({
	
	 'columnDefs': [ {
        'targets': [0,1,2,4], // column index (start from 0)
        'orderable': false, // set orderable false for selected columns
     }]
	
	});
} );

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
