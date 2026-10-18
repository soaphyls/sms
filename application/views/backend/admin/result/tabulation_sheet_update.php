<style>
.btn-secondary {
    color: #343a40;
    background-color: #f3f7f9;
    border-color: #fff;
}
.btn-group-vertical>.btn, .btn-group>.btn {
    position: relative;
    flex: none;
}

.btn-light {
    box-shadow: 0 0 0 rgb(243 247 249 / 50%);
}

.btn-secondary {
    -webkit-box-shadow: 0px 0px 0px 0px rgb(108 117 125 / 50%);
    box-shadow: 0px 0px 0px 0px rgb(108 117 125 / 50%);
}
</style>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo get_phrase('select_class_exam') ?></h3>
    </div>
    <div class="panel-body">
    	<div class="row">
			<div class="col-md-12">
				<?php echo form_open(site_url('admin/publish_insert'));?>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label"><?php echo get_phrase('class');?></label>
							<select name="class_id" class="form-control selectboxit" id = 'class_id'>
		                        <option value=""><?php echo get_phrase('select_a_class');?></option>
		                        <?php 
		                        $classes = $this->db->get('class')->result_array();
		                        foreach($classes as $row):
		                        ?>
		                            <option value="<?php echo $row['class_id'];?>"
		                            	<?php if ($class_id == $row['class_id']) echo 'selected';?>>
		                            		<?php echo $row['name'];?>
		                            </option>
		                        <?php
		                        endforeach;
		                        ?>
		                    </select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						<label class="control-label"><?php echo get_phrase('exam');?></label>
							<select name="exam_id" class="form-control selectboxit" id = 'exam_id'>
		                        <option value=""><?php echo get_phrase('select_an_exam');?></option>
		                        <?php 
		                        $exams = $this->db->get_where('exam' , array('year' => $running_year))->result_array();
		                        foreach($exams as $row):
		                        ?>
		                            <option value="<?php echo $row['exam_id'];?>"
		                            	<?php if ($exam_id == $row['exam_id']) echo 'selected';?>>
		                            		<?php echo $row['name'];?>
		                            </option>
		                        <?php
		                        endforeach;
		                        ?>
		                    </select>
						</div>
					</div>
					<input type="hidden" name="operation" value="selection">
					<div class="col-md-4" style="margin-top: 20px;">
						<button type="submit" id = 'submit' class="btn btn-info"><?php echo get_phrase('Load_Result');?></button>
						
					</div>
				<?php echo form_close();?>
			</div>
		</div>
    </div>
</div>

		


<div class="row">
<?php echo form_open(site_url('admin/validate_publish'));?>
	<div class="col-md-4"></div>
	<div class="col-md-4" style="text-align: center;">
		<div class="tile-stats tile-white">
		<div class="icon"><i class="entypo-docs"></i></div>
			<h3 style="color: #696969;">
				<?php
					$exam_name  = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name; 
					$class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name; 
					echo get_phrase('tabulation_sheet');
				?>
			</h3>
			<h4 style="color: #696969;">
				<?php echo get_phrase('class') . ' ' . $class_name;?> : <?php echo $exam_name;?>
			</h4>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>


<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo get_phrase('Result_sheet') ?></h3>
    </div>
    <div class="panel-body">
    	<div class="row">
			<div class="col-md-12">
				<table id="example" class="table table-bordered dt-responsive nowrap" width="100%">
				<thead>
		<tr style="background-color: #f3f7f9; color: #000;">

						<td style="text-align: center;">
							<?php echo get_phrase('students');?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('subjects');?> <i class="entypo-right-thin"></i>
						</td>
						<?php 
							$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
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
						
						$students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
						foreach($students as $row):
					?>
						<tr>
							<td style="text-align: center;">
								<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
							</td>
						<?php
							$total_marks = 0;
							$total_grade_point = 0;  
							foreach($subjects as $row2):
						?>
							<td style="text-align: center;">
								<?php 
									$obtained_mark_query = 	$this->db->get_where('mark' , array(
															'class_id' => $class_id , 
																'exam_id' => $exam_id , 
																	'subject_id' => $row2['subject_id'] , 
																		'student_id' => $row['student_id'],
																			'year' => $running_year
														));
									if ( $obtained_mark_query->num_rows() > 0) {
										$obtained_marks = $obtained_mark_query->row()->mark_obtained;
										echo $obtained_marks;
										//if ($obtained_marks >= 0 && $obtained_marks != '') {
										//	$grade = $this->crud_model->get_grade($obtained_marks);
										//	$total_grade_point += $grade['grade_point'];
										//}
										$total_marks += $obtained_marks;
									}
									

								?>
							</td>
						<?php endforeach;?>
						<td style="text-align: center;"><input type ="hidden"  name="total_marks_<?php echo $row['student_id'];?>" value="<?php echo $total_marks;?>"><?php echo $total_marks;?></td>
						<td style="text-align: center;">
							<?php 
								$this->db->where('class_id' , $class_id);
								$this->db->where('year' , $running_year);
								$this->db->from('subject');
								$total_subject = $this->db->count_all_results();
								$average_score= ($total_marks / $total_subject);
								$avg_total_marks = (round($average_score,2));
							?>
							<?php echo $avg_total_marks;?>
							<input type ="hidden"  name="avg_total_marks_<?php echo $row['student_id'];?>" value="<?php echo $avg_total_marks;?>">
							<input type="hidden"  name="total_subject" value ="<?php echo $total_subject;?>">	
						</td>
						</tr>
						
						
							
						

					<?php endforeach;?>
							<input type="hidden"  name="exam_id"  value =" <?php echo $exam_id;?>">
							<input type="hidden"  name="class_id" value ="<?php echo $class_id;?>">
							
					</tbody>
				</table>
			
				<center>
					<a href="<?php echo site_url('admin/tabulation_sheet_print_view/'.$class_id.'/'.$exam_id);?>" 
						class="btn btn-primary" target="_blank" style="margin-right:30px" >
						<?php echo get_phrase('print_Result');?>
					</a>
					<button type="submit"  
						class="btn btn-success entypo-check" style="background-color:#060;color:#fff; margin-left:10px;margin-right:10px">
						<?php echo get_phrase('publish_Result');?>
					</button>
					
					<a href="<?php echo site_url('admin/Pending/'.$class_id.'/'.$exam_id);?>" 
						class="btn btn entypo-check" 
						 style="background-color:#c00;color:#fff; margin-left:30px"
						<?php //$checkme = $this->db->get_where('exam','exam_id',$exam_id,array('Result_status'=>null));if($checkme==0){ echo 'disabled';} else {echo 'disabled=False';}
						?>>
						
						<?php echo get_phrase('Pending');?>
					</a>
					
				</center>
				<?php echo form_close();?>
			</div>
		</div>
    </div>
</div>
		






<?php// endif;?>
<?php //endif;?>

<script type="text/javascript">
	var class_id = '';
	var exam_id  = '';
	jQuery(document).ready(function($) {
		$('#submit').attr('disabled', 'disabled');
		
	});
	function check_validation(){
		if(class_id !== '' && exam_id !== ''){
			$('#submit').removeAttr('disabled');
		}
		else{
			$('#submit').attr('disabled', 'disabled');	
		}
	}
	$('#class_id').change(function() {
		class_id = $('#class_id').val();
		check_validation();
	});
	$('#exam_id').change(function() {
		exam_id = $('#exam_id').val();
		check_validation();
	});
	
		function checkme(){
			
			$.ajax({
            url: '<?php echo site_url('admin/checkpending/');?>' + exam_id ,
            success: function(response)
            {
                $('#checkme').attr('disabled', 'disabled');
            }
        });
		}

$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: true,
        buttons: [
            {
			"extend": "copyHtml5",
			"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
			"className": "btn btn-white btn-primary btn-bold"
		  },
		  {
			"extend": "csvHtml5",
			"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
			"className": "btn btn-white btn-primary btn-bold"
		  },
		  {
			"extend": "excelHtml5",
			"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
			"className": "btn btn-white btn-primary btn-bold"
		  },
		  {
			"extend": "pdfHtml5",
			"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
			"className": "btn btn-white btn-primary btn-bold"
		  },
		  {
			"extend": "print",
			"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
			"className": "btn btn-white btn-primary btn-bold",
			autoPrint: true,
			message: 'This is a table for admin'
		  }	
            
			]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );		
</script>