<?php
$school_id = school_id();
$session = active_session();
?>	
	

<?php
	$class_name		 	= 	$this->db->get_where('classes' , array('id' => $class_id,'school_id'=> $school_id))->row()->name;
	$exam_name  		= 	$this->db->get_where('exams' , array('id' => $exam_id,'school_id'=> $school_id))->row()->name;
    //$system_name        =   $this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
    $session = active_session();
	
	$student = $this->db->get_where('students', array('id' => $student_id))->row_array(); 
	$class_id_g		 	= 	$this->db->get_where('class_group' , array('school_id'=> $school_id))->row()->id;

	?>
               
		 
<?php		
 $total_marks = 0;
            $total_grade_point = 0;
            $subjects = $this->db->get_where('subjects' , array(
                    'class_id' => $class_id , 'session' => $session
            ))->result_array();
            foreach ($subjects as $row3):
			
        ?>
    <?php 
                        $obtained_mark_query = $this->db->get_where('marks' , array(
                                                    'subject_id' => $row3['id'],
                                                        'exam_id' => $exam_id,
                                                            'class_id' => $class_id,
                                                                'student_id' => $student_id ,
                                                                    'session' => $session = active_session()
                                                ));
                        if($obtained_mark_query->num_rows() > 0){
                            $marks = $obtained_mark_query->result_array();
                            foreach ($marks as $row4) {
                               // echo $row4['mark_obtained'];
                                $total_marks += $row4['mark_total'];
                            }
                        }
                    ?>
               
               
                                
               
                    <?php
                        if ($row4['mark_obtained'] >= 0 || $row4['mark_obtained'] != '') {
                            $grade = get_grade($row4['mark_obtained']);
                          //  echo $grade['name'];
                            $total_grade_point += $grade['grade_point'];
                        }
                    ?>
                
        <?php endforeach;?>
		
	<?php $class_position = $this->crud_model->get_position_student_position($session, $class_id, $student_id); ?> 
	
<?php 
$punct = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->punct;
$neatn = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->neatn;
$polite = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->polite;
$honesty = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->honesty;
$self = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->self;
$initia = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->initia;
$respon = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->respon;
$obedie = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->obedie;
$hardwr = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->hardwr;
$fluncy = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->fluncy;
$games = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->games;
$sports = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->sports;
$gymnast = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->gymnast;
$painting = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->painting;
$music = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->music;
$craft = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->craft;
$tools = 	$this->db->get_where('primary_marks' , array('class_id'=> $class_id,'student_id'=>$student_id,'exam_id'=>$exam_id))->row()->tools;





?>	
	