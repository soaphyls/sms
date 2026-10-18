<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<link href="<?php echo base_url(); ?>assets/backend/css/result_style.css" rel="stylesheet" type="text/css" />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;900&display=swap" rel="stylesheet">

<?php include ('tiny.php');?>	
		
	
<div id="print"  class="main-page ">
<div id="tikto">
<div class="background2">
  <p class="bg-text">LURN SUITE</p>
	</div>	</div>	
<div id="tiktok">
<div class="sub-page ">
 
<div class="row">
    <div class="col-3 inner">
     <img src="<?php echo base_url(); ?>uploads/system/logo/logo-dark.png" style="max-height : 120px;">

    </div>
    <div class="col">
	<h3>Lurn Suite Management Systems</h3><p style="font-family:Nunito;font-size:16px; text-align:center"><i>Best School Management suite
      2 Michael Amadi Avenue,</br>Port Harcourt, Rivers State.
	  Email: Info@lurn.com.ng</br>
	  Website:www.lurn.com.ng</br>
	  Phone: +234-9080000700</b>
	  </i></p>
    </div>
	
  </div>

<?php if ($class_g == 1 || $class_g == 2):?>

<table align=center  >
<tr ><td align=left;style="width:500px !important" >
     <table   >
	 <tr><td nowrap><b> Student's Name</b></td><td style="text-align: center; font-size: 120%"><?php echo $this->user_model->get_user_details($student['user_id'], 'name'); ?></td></tr>
	 <tr><td><b>Roll No</b></td><td style="text-align: center;  font-size: 120%"><strong><?php echo $this->db->get_where('students' , array('id' => $student_id))->row()->code;?> </strong> </td></tr>
	  <tr><td><b>Class</b></td><td style="text-align: center;  font-size: 120%"><?php echo $class_name;?>  </td></tr>
	  <tr><td><b>Session</b></td><td style="text-align: center; font-size: 120%"><?php echo $this->db->get_where('sessions' , array( 'id' => $session))->row()->name;?></td></tr>
	   	<tr><td><b>Term</b><td style="text-align: center;  font-size: 120%"><?php echo $exam_name; ?></td></tr>    
	 </table>
</td><td width=400px ;align=right >
<table class="report-card">

	  <tr><td><b>Total Number in Class</b></td><td style="text-align: center; font-size: 120%"><?php
                $this->db->where('class_id' , $class_id);
                $this->db->where('session' , $session);
	            $this->db->from('enrols');
	            $number_of_students = $this->db->count_all_results();
	            echo ($number_of_students);
	        ?> </td></tr>
	  <tr><td><b><?php echo get_phrase('total_marks');?> </b></td><td style="text-align: center;  font-size: 120%"><?php echo $total_marks;?></td></tr>
	   <tr><td ><b><?php echo get_phrase('average_grade_point');?> </td><td style="text-align: center;  font-size: 120%"><?php
                $this->db->where('class_id' , $class_id);
                $this->db->where('session' , $session);
	            $this->db->from('subjects');
	            $number_of_subjects = $this->db->count_all_results();
	            $total_score=($total_marks / $number_of_subjects);
				echo round(($total_score),2);
	        ?></b></td></tr>
	    <tr><td ><b>Percentage Score</b></td><td style="text-align: center;  font-size: 12px; font-weight:bold"><?php echo round(($total_score),0)."%";?>&nbsp;&nbsp;</td></tr>
	     <tr><td ><b>Position in Exam</b></td><td style="text-align: center;  font-size: 16px; font-weight:bold"><?php echo $class_position ;?></td></tr>
	  
		</table></td>
		
		<td style="text-align:center"> <img src="<?php echo $this->user_model->get_user_image($student['user_id']); ?>" class="img-square" width="100"/></td>
     
</tr></table>
	<h2 align="center" style="text-transform: uppercase;">TERMLY ACADEMIC REPORT FOR <?php echo $this->user_model->get_user_details($student['user_id'], 'name'); ?></h2>

	<table  class="report-card" style=" border-collapse:collapse;border: 1px solid #ccc; margin-top: 5px;background:url(../uploads/logo.png)"  align=center>
       <thead>
        <tr class ="rowheader" >
            <td style="text-align: center;width:5px">SN</td>
			<td style="text-align: left;width:100px">Subject</td>
            <td style="text-align: center">C.A <br>30%</td>
			<td style="text-align: center">Exams <br>70%</td>
			<td style="text-align: center">Total mark</td>
			<td style="text-align: center">POS</td>
			<td style="text-align: center">Grade</td>
            <td style="text-align: center">Lowest mark</td>
            <td style="text-align: center">Highest mark</td>
            <td style="text-align: center">Teacher's Remark</td>
        </tr>
    </thead>
    <tbody>
        <?php $count=1;
            $total_marks = 0;
            $total_grade_point = 0;
            $subjects = $this->db->get_where('subjects' , array(
                    'class_id' => $class_id , 'session' => $session
            ))->result_array();
            foreach ($subjects as $row9):
			
        ?>
            <tr><td style="text-align: center;"><?php echo $count++;?></td>
                <td style="text-align: left;width:130px"><?php echo $row9['name'];?></td>
                
                    <?php 
					$subject_id = $row9['id'];
                        $obtained_mark_query = $this->db->get_where('marks' , array(
                                                    'subject_id' => $row9['id'],
                                                        'exam_id' => $exam_id,
                                                            'class_id' => $class_id,
                                                                'student_id' => $student_id ,
                                                                    'session' => $session = active_session()
                                               
                                                ));
                        if($obtained_mark_query->num_rows() > 0){
                            $marks = $obtained_mark_query->result_array();
                            foreach ($marks as $row4) { 
							$section_id = $row4['section_id'];
							$markx = $row4['mark_total'];
							?>
						<td style="text-align: center"><?php        echo $row4['CA'];?></td>
						<td style="text-align: center"><?php        echo $row4['mark_obtained'];?></td>
						<td style="text-align: center"><b><?php        echo $row4['mark_total'];?></b></td>
							
                        
							
							<?php
                                $total_marks += $row4['mark_total'];
                            }
                        } else echo "";
                    ?>
					
					<td style="text-align: center;">
                    <?php
					if($obtained_mark_query->num_rows() > 0){
                        $pos = $this->crud_model->get_position_in_subject( $exam_id , $class_id , $section_id, $subject_id, $markx );
						echo $pos;
					  
                        } else echo "N/A";
                    ?>
                </td>
				<td style="text-align: center;">
                    <?php
					if($obtained_mark_query->num_rows() > 0){
                        if ($row4['mark_total'] >= 0 || $row4['mark_total'] != '') {
                            $grade = get_grade($row4['mark_total']);
                            echo $grade['name'];
                            $total_grade_point += $grade['grade_point'];
                        }
						 } else echo "N/A";
                    ?>
                </td>
                <td style="text-align: center;">
                    <?php
					 if($obtained_mark_query->num_rows() > 0){
                    $lowest_mark = get_lowest_marks( $exam_id , $class_id , $subject_id );
                    echo $lowest_mark;
					  
                        } else echo "N/A";
                    ?>
                </td>
				<td style="text-align: center;">
                    <?php
					 if($obtained_mark_query->num_rows() > 0){
                    $highest_mark = get_highest_marks( $exam_id , $class_id , $subject_id );
                    echo $highest_mark;
					  
                        } else echo "N/A";
                    ?>
                </td>
				
                
                <td style="text-align: center"><?php if($obtained_mark_query->num_rows() > 0){ echo $row4['comment'];}else echo "N/A";?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
	<tfoot>
	<tr><td colspan = "4" style="text-align:right"><b>Marks Obtained</b></td><td colspan = "6"  style="font-size:14px; text-align:left "><b><?php echo $total_marks;?></b></td></tr>
	</tfoot>
   </table >
   
   <table class="lastable2 report-card" >
   <thead>
         <tr>
            <td >KEY TO GRADE:</td>
			<td align=center>A <br>70 - 100</td>
            <td align=center >B<br>60 - 69</td>
            <td align=center >C<br>50 - 59</td>
            <td align=center >D<br>40 - 49</td>
			<td align=center >E<br>30 - 39</td>
			<td align=center >F<br>0 - 29</td>
        </tr>
		</thead>
       </table>
   <br>
   <table class="report-cardz" style="width:850px;font-size:12px;padding-bottom:5px" align=center>
	 <tr><td>Form Teacher</td><td><img src="<?php echo base_url(); ?>uploads/sign1.png" style="max-height : 80px;">&nbsp;</td><td>ICT Head</td><td><img src="<?php echo base_url(); ?>uploads/sign3.jpg" style="max-height : 50px;"></td><td>Principal</td><td><img src="<?php echo base_url(); ?>uploads/sign2.png" style="max-height : 50px;"></td></tr>
	   
	 </table>
<div class="row no-print">
                <div class="col-xs-12 text-right" style="margin-top:10px">
                    <button class="btn btn-primary hide-print " onclick="document.execCommand('print');"><i class="entypo-pencil"></i>Print Result </button>
                </div>
            </div>
   <!-- soap code removed from here -->
   
   <?php ;?>
<?php else:?>


<table align=center  class="report-card" >
<tr ><td align=left; width=400px >
     <table class="report-card">
	 <tr><td><b> Student's Name</b></td><td style="text-align: center; font-size: 120%"><?php echo $this->user_model->get_user_details($student['user_id'], 'name'); ?></td></tr>
	 <tr><td><b>Roll No</b></td><td style="text-align: center;  font-size: 120%"><strong><?php echo $this->db->get_where('students' , array('id' => $student_id))->row()->code;?> </strong> </td></tr>
	  <tr><td><b>Class</b></td><td style="text-align: center;  font-size: 120%"><?php echo $class_name;?>  </td></tr>
	  <tr><td><b>Session</b></td><td style="text-align: center; font-size: 120%"><?php echo $this->db->get_where('sessions' , array( 'id' => $session))->row()->name;?></td></tr>
	   	<tr><td><b>Term</b><td style="text-align: center;  font-size: 120%"><?php echo $exam_name; ?></td></tr>    
	 </table>
</td><td width=400px ;align=right >
<table class="report-card">

	  <tr><td><b>Total Number in Class</b></td><td style="text-align: center; font-size: 120%"><?php
                $this->db->where('class_id' , $class_id);
                $this->db->where('session' , $session);
	            $this->db->from('enrols');
	            $number_of_students = $this->db->count_all_results();
	            echo ($number_of_students);
	        ?> </td></tr>
	  <tr><td><b><?php echo get_phrase('total_marks');?> </b></td><td style="text-align: center;  font-size: 120%"><?php echo $total_marks;?></td></tr>
	   <tr><td ><b><?php echo get_phrase('average_grade_point');?> </td><td style="text-align: center;  font-size: 120%"><?php
                $this->db->where('class_id' , $class_id);
                $this->db->where('session' , $session);
	            $this->db->from('subjects');
	            $number_of_subjects = $this->db->count_all_results();
	            $total_score=($total_marks / $number_of_subjects);
				echo round(($total_score),2);
	        ?></b></td></tr>
	    <tr><td ><b>Percentage Score</b></td><td style="text-align: center;  font-size: 12px; font-weight:bold"><?php echo round(($total_score),0)."%";?>&nbsp;&nbsp;</td></tr>
	     <tr><td ><b>Position in Exam</b></td><td style="text-align: center;  font-size: 16px; font-weight:bold"><?php echo $class_position ;?></td></tr>
	  
		</table></td>
		
		<td style="text-align:center"> <img src="<?php echo $this->user_model->get_user_image($student['user_id']); ?>" class="img-square" width="100"/></td>
     
</tr></table>

<div class="row">
 <div class="col-8 no-gap">

	<table  class="report-card" style=" border-collapse:collapse;border: 1px solid #ccc; margin-top: 5px;background:url(../uploads/logo.png)"  align=center>
       <thead>
        <tr class ="rowheader" >
           	<td style="text-align: left;width:100px">SUBJECT</td>
            <td style="text-align: center">C.A <br>30%</td>
			<td style="text-align: center">Exams <br>70%</td>
			<td style="text-align: center">Total mark</td>
			<td style="text-align: center">POS</td>
			<td style="text-align: center">Grade</td>
            <td style="text-align: center">Lowest mark</td>
            <td style="text-align: center">Highest mark</td>
            <td style="text-align: center">Teacher's Remark</td>
        </tr>
    </thead>
    <tbody>
        <?php $count=1;
            $total_marks = 0;
            $total_grade_point = 0;
            $subjects = $this->db->get_where('subjects' , array(
                    'class_id' => $class_id , 'session' => $session
            ))->result_array();
            foreach ($subjects as $row9):
			
        ?>
            <tr>
                <td style="text-align: left;width:130px"><?php echo $row9['name'];?></td>
                
                    <?php 
					$subject_id = $row9['id'];
                        $obtained_mark_query = $this->db->get_where('marks' , array(
                                                    'subject_id' => $row9['id'],
                                                        'exam_id' => $exam_id,
                                                            'class_id' => $class_id,
                                                                'student_id' => $student_id ,
                                                                    'session' => $session = active_session()
                                               
                                                ));
                        if($obtained_mark_query->num_rows() > 0){
                            $marks = $obtained_mark_query->result_array();
                            foreach ($marks as $row4) { 
							$section_id = $row4['section_id'];
							$markx = $row4['mark_total'];
							?>
						<td style="text-align: center"><?php        echo $row4['CA'];?></td>
						<td style="text-align: center"><?php        echo $row4['mark_obtained'];?></td>
						<td style="text-align: center"><b><?php        echo $row4['mark_total'];?></b></td>
							
                        
							
							<?php
                                $total_marks += $row4['mark_total'];
                            }
                        } else echo "";
                    ?>
					
					<td style="text-align: center;">
                    <?php
					if($obtained_mark_query->num_rows() > 0){
                        $pos = $this->crud_model->get_position_in_subject( $exam_id , $class_id , $section_id, $subject_id, $markx );
						echo $pos;
					  
                        } else echo "N/A";
                    ?>
                </td>
				<td style="text-align: center;">
                    <?php
					if($obtained_mark_query->num_rows() > 0){
                        if ($row4['mark_total'] >= 0 || $row4['mark_total'] != '') {
                            $grade = get_grade($row4['mark_total']);
                            echo $grade['name'];
                            $total_grade_point += $grade['grade_point'];
                        }
						 } else echo "N/A";
                    ?>
                </td>
                <td style="text-align: center;">
                    <?php
					 if($obtained_mark_query->num_rows() > 0){
                    $lowest_mark = get_lowest_marks( $exam_id , $class_id , $subject_id );
                    echo $lowest_mark;
					  
                        } else echo "N/A";
                    ?>
                </td>
				<td style="text-align: center;">
                    <?php
					 if($obtained_mark_query->num_rows() > 0){
                    $highest_mark = get_highest_marks( $exam_id , $class_id , $subject_id );
                    echo $highest_mark;
					  
                        } else echo "N/A";
                    ?>
                </td>
				
                
                <td style="text-align: center"><?php if($obtained_mark_query->num_rows() > 0){ echo $row4['comment'];}else echo "N/A";?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
	<tfoot>
	<tr><td colspan = "3" style="text-align:right"><b>Marks Obtained</b></td><td colspan = "6"  style="font-size:14px; text-align:left "><b><?php echo $total_marks;?></b></td></tr>
	</tfoot>
   </table >
   
   	 </div>

	 
	<div class="col-4">
	<table  class="report-card"  style=" border-collapse:collapse;border: 1px solid #ccc; margin-top: 5px;">
	<thead>

	<tr><td>BEHAVIOUR</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>
	</thead>
	<tbody>
	<tr><td>Punctuality</td><td><?php echo $punct==1 ? "||||": '&nbsp';?></td><td><?php echo $punct==2 ? "||||": '&nbsp';?></td><td><?php echo $punct==3 ? "||||": '&nbsp';?></td><td><?php echo $punct==4 ? "||||": '&nbsp';?></td><td><?php echo $punct==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Neatness</td><td><?php echo $neatn==1 ? "||||": '&nbsp';?></td><td><?php echo $neatn==2 ? "||||": '&nbsp';?></td><td><?php echo $neatn==3 ? "||||": '&nbsp';?></td><td><?php echo $neatn==4 ? "||||": '&nbsp';?></td><td><?php echo $neatn==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Politeness</td><td><?php echo $polite==1 ? "||||": '&nbsp';?></td><td><?php echo $polite==2 ? "||||": '&nbsp';?></td><td><?php echo $polite==3 ? "||||": '&nbsp';?></td><td><?php echo $polite==4 ? "||||": '&nbsp';?></td><td><?php echo $polite==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Honesty</td><td><?php echo $honesty==1 ? "||||": '&nbsp';?></td><td><?php echo $honesty==2 ? "||||": '&nbsp';?></td><td><?php echo $honesty==3 ? "||||": '&nbsp';?></td><td><?php echo $honesty==4 ? "||||": '&nbsp';?></td><td><?php echo $honesty==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Self Control</td><td><?php echo $self==1 ? "||||": '&nbsp';?></td><td><?php echo $self==2 ? "||||": '&nbsp';?></td><td><?php echo $self==3 ? "||||": '&nbsp';?></td><td><?php echo $self==4 ? "||||": '&nbsp';?></td><td><?php echo $self==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Initiative</td><td><?php echo $initia==1 ? "||||": '&nbsp';?></td><td><?php echo $initia==2 ? "||||": '&nbsp';?></td><td><?php echo $initia==3 ? "||||": '&nbsp';?></td><td><?php echo $initia==4 ? "||||": '&nbsp';?></td><td><?php echo $initia==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Responsibility</td><td><?php echo $respon==1 ? "||||": '&nbsp';?></td><td><?php echo $respon==2 ? "||||": '&nbsp';?></td><td><?php echo $respon==3 ? "||||": '&nbsp';?></td><td><?php echo $respon==4 ? "||||": '&nbsp';?></td><td><?php echo $respon==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Obedience</td><td><?php echo $obedie==1 ? "||||": '&nbsp';?></td><td><?php echo $obedie==2 ? "||||": '&nbsp';?></td><td><?php echo $obedie==3 ? "||||": '&nbsp';?></td><td><?php echo $obedie==4 ? "||||": '&nbsp';?></td><td><?php echo $obedie==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td colspan="6">&nbsp;</td></tr>
	<tr><td>PSYCHOMOTOR</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>
	<tr><td>Handwriting</td><td><?php echo $hardwr==1 ? "||||": '&nbsp';?></td><td><?php echo $hardwr==2 ? "||||": '&nbsp';?></td><td><?php echo $hardwr==3 ? "||||": '&nbsp';?></td><td><?php echo $hardwr==4 ? "||||": '&nbsp';?></td><td><?php echo $hardwr==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Fluency</td><td><?php echo $fluncy==1 ? "||||": '&nbsp';?></td><td><?php echo $fluncy==2 ? "||||": '&nbsp';?></td><td><?php echo $fluncy==3 ? "||||": '&nbsp';?></td><td><?php echo $fluncy==4 ? "||||": '&nbsp';?></td><td><?php echo $fluncy==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Games</td><td><?php echo $games==1 ? "||||": '&nbsp';?></td><td><?php echo $games==2 ? "||||": '&nbsp';?></td><td><?php echo $games==3 ? "||||": '&nbsp';?></td><td><?php echo $games==4 ? "||||": '&nbsp';?></td><td><?php echo $games==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Sports</td><td><?php echo $sports==1 ? "||||": '&nbsp';?></td><td><?php echo $sports==2 ? "||||": '&nbsp';?></td><td><?php echo $sports==3 ? "||||": '&nbsp';?></td><td><?php echo $sports==4 ? "||||": '&nbsp';?></td><td><?php echo $sports==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Gymnastics</td><td><?php echo $gymnast==1 ? "||||": '&nbsp';?></td><td><?php echo $gymnast==2 ? "||||": '&nbsp';?></td><td><?php echo $gymnast==3 ? "||||": '&nbsp';?></td><td><?php echo $gymnast==4 ? "||||": '&nbsp';?></td><td><?php echo $gymnast==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Crafts</td><td><?php echo $craft==1 ? "||||": '&nbsp';?></td><td><?php echo $craft==2 ? "||||": '&nbsp';?></td><td><?php echo $craft==3 ? "||||": '&nbsp';?></td><td><?php echo $craft==4 ? "||||": '&nbsp';?></td><td><?php echo $craft==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Music</td><td><?php echo $music==1 ? "||||": '&nbsp';?></td><td><?php echo $music==2 ? "||||": '&nbsp';?></td><td><?php echo $music==3 ? "||||": '&nbsp';?></td><td><?php echo $music==4 ? "||||": '&nbsp';?></td><td><?php echo $music==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Painting</td><td><?php echo $painting==1 ? "||||": '&nbsp';?></td><td><?php echo $painting==2 ? "||||": '&nbsp';?></td><td><?php echo $painting==3 ? "||||": '&nbsp';?></td><td><?php echo $painting==4 ? "||||": '&nbsp';?></td><td><?php echo $painting==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td>Handling Tools</td><td><?php echo $tools==1 ? "||||": '&nbsp';?></td><td><?php echo $tools==2 ? "||||": '&nbsp';?></td><td><?php echo $tools==3 ? "||||": '&nbsp';?></td><td><?php echo $tools==4 ? "||||": '&nbsp';?></td><td><?php echo $tools==5 ? "||||": '&nbsp';?></td></tr>
	<tr><td colspan="6">&nbsp;</td></tr>
	</tbody>
	</table>
	</div>	
   
   
   <div class="col">
   <table class="lastable2 report-card" >
   <thead>
         <tr>
            <td >KEY TO GRADE:</td>
			<td align=center>A <br>70 - 100</td>
            <td align=center >B<br>60 - 69</td>
            <td align=center >C<br>50 - 59</td>
            <td align=center >D<br>40 - 49</td>
			<td align=center >E<br>30 - 39</td>
			<td align=center >F<br>0 - 29</td>
        </tr>
		</thead>
       </table>
	   </div>
   <br>
   <table class="report-cardz" style="width:850px;font-size:12px;padding-bottom:5px; margin-bottom:5px" align=center>
	 <tr><td>Form Teacher</td><td><img src="<?php echo base_url(); ?>uploads/sign1.png" style="height : 70px;">&nbsp;</td><td>ICT Head</td><td><img src="<?php echo base_url(); ?>uploads/sign3.jpg" style="max-height : 50px;"></td><td>Principal</td><td><img src="<?php echo base_url(); ?>uploads/sign2.png" style="max-height : 50px;"></td></tr>
	   
	 </table>
<div class="row no-print">
                <div class="col-xs-12 text-right" style="margin-top:10px">
                    <button class="btn btn-primary hide-print " onclick="document.execCommand('print');"><i class="entypo-pencil"></i>Print Result </button>
                </div>
            </div>

			
	</div>			
			
<?php endif;?>
</div>
</div>
</div>



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>