<?php $subjects = $this->db->get_where('subjects' , array('class_id' => $class_id ,'session' => $session ))->result_array();
							foreach($subjects as $row):
							
						?>
							
						<?php endforeach;?>
		
	 
						<?php
						$x=1;
						$enrols = $this->db->get_where('enrols', array('class_id' => $class_id, 'school_id' => $school_id, 'session' => $session))->result_array();
						foreach($enrols as $enroll){
						$student = $this->db->get_where('students', array('id' => $enroll['student_id']))->row_array();
         				$class_id_g = $this->db->get_where('primary_marks', array('id' => $enroll['class_id_g']))->row_array();
         				
						?>
						
						<?php  $x++; ?>
							
							<?php  $this->user_model->get_user_details($student['user_id'], 'name'); ?>
							
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
							
						<input type ="hidden"  id="total_marks-<?php $student['id'];?>" name="total_marks_<?php  $student_id;?>" value="<?php  $total_marks;?>"><?php $total_marks;?>
						
					
							<?php 
								$this->db->where('class_id' , $class_id);
								$this->db->where('session', $session);
								$this->db->from('subjects');
								$number_of_subjects = $this->db->count_all_results();
								$average_score= ($total_marks / $number_of_subjects);
								$avg_total_marksz = (round($average_score,2));
								
							?>
							
							<?php $class_totalz+= $avg_total_marksz;
							
							
							?>
							
							
					
						<?php }?>
					<?php  $class_avg = $class_totalz/count($student) ;?>	