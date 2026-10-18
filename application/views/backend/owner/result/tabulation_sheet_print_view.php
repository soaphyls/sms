<!DOCTYPE html>
<html lang="en" class="light">
      <head>
        <meta charset="utf-8">
           <title>Result sheets</title>
           
       
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">   
  
  </head>
	<style type="text/css">
	body {
  font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
  margin: 15px;
  padding: 15px;
  color: #333;
  background-color: #fff;
}
.row {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
      flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px; }
  
  .justify-content-center {
  -webkit-box-pack: center !important;
      -ms-flex-pack: center !important;
          justify-content: center !important; }
		  
	.my_style{
  	font-weight:bold;
  	color:#B51454;	  
		  
	</style>
<body >
<?php
$school_id = school_id();
$session = active_session();
?>

<div class="row justify-content-center" >
  <div class="col-md-12">

    <table id="my-datatable" class="cell-border order-column"  width="100%">
      <thead>
        <tr style="background-color:#313a46; color:#eee;">
		<td>No.</td>
          <td style="text-align: center;" >
		  
		  
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
						$i=1;
						$enrols = $this->db->get_where('enrols', array('class_id' => $class_id, 'school_id' => $school_id, 'session' => $session))->result_array();
						foreach($enrols as $enroll){
						$student = $this->db->get_where('students', array('id' => $enroll['student_id']))->row_array();
         				?>
						<tr>
						<td><?php echo $i++;?></td>
							<td style="text-align: center;" >
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
						
						<td style="text-align: center;" class="my_style">
							<?php 
								$this->db->where('class_id' , $class_id);
								$this->db->where('session', $session);
								$this->db->from('subjects');
								$number_of_subjects = $this->db->count_all_results();
								$average_score= ($total_marks / $number_of_subjects);
								$avg_total_marks = (round($average_score,2));
								
							?>
							<?php echo $avg_total_marks;?>
						
							</td>
						</tr>
						
						
							
						

						<?php }?>
							
							
					</tbody>
    </table>
	<center>
					
					<a href="<?php echo base_url('superadmin/tabulate');?>" 
						class="btn btn-danger" style="margin-right:30px" >
						<?php echo get_phrase('Cancel');?>
					</a>
				</center>
				
			<div style="height:50px"></div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<!-- Buttons -->
    <link href="https://nightly.datatables.net/buttons/css/buttons.dataTables.css?_=c6b24f8a56e04fcee6105a02f4027462.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/buttons/js/dataTables.buttons.js?_=c6b24f8a56e04fcee6105a02f4027462"></script>


	<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>



<script type="text/javascript">
$(document).ready( function () {
  $('#my-datatable').DataTable({
     dom: 'Bfrtip',
        buttons: [
              'excel', 'pdf', 'print'
        ]
        
  });
  
  
} );
</script>


</body>

</html>
