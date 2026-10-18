<?php
  $school_id = school_id();
?>
<table id="example" class="table table-bordered dt-responsive nowrap" width="100%">
	<thead>
	<tr style="background-color: #f3f7f9; color: #000;">
	  <th><?php echo get_phrase('No.'); ?></th>
      <th><?php echo get_phrase('code'); ?></th>
      <th><?php echo get_phrase('photo'); ?></th>
      <th><?php echo get_phrase('name'); ?></th>
      <th><?php echo get_phrase('options'); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php
	$i=1;
    $enrols = $this->db->get_where('enrols', array('class_id' => $class_id, 'school_id' => $school_id, 'session' => active_session()))->result_array();
    foreach($enrols as $enroll){
      $student = $this->db->get_where('students', array('id' => $enroll['student_id']))->row_array();
      ?>
      <tr>
		<td><?php echo $i++; ?></td>
        <td><?php echo $student['code']; ?></td>
        <td>
          <img class="rounded-circle" width="50" height="50" src="<?php echo $this->user_model->get_user_image($student['user_id']); ?>">
        </td>
        <td><?php echo $this->user_model->get_user_details($student['user_id'], 'name'); ?></td>
        <td>
          <div class="dropdown text-center">
  					<button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
  					<div class="dropdown-menu dropdown-menu-right">
              <!-- item-->
              <?php if(addon_status('id-card')):?>
                <a href="javascript:void(0);" class="dropdown-item" onclick="largeModal('<?php echo site_url('modal/popup/student/id_card/'.$student['id'])?>', '<?php echo $this->db->get_where('schools', array('id' => $school_id))->row('name'); ?>')"><?php echo get_phrase('generate_id_card'); ?></a>
              <?php endif;?>
              <!-- item-->
  						<a href="javascript:void(0);" class="dropdown-item"  onclick="largeModal('<?php echo site_url('modal/popup/student/profile/'.$student['id'])?>', '<?php echo $this->db->get_where('schools', array('id' => $school_id))->row('name'); ?>')"><?php echo get_phrase('profile'); ?></a>
  						<!-- item-->
  						<a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/student/update2/'.$student['id'])?>', '<?php echo get_phrase('update_student'); ?>');"><?php echo get_phrase('edit'); ?></a>	<!-- item-->
						<!-- item-->
						<a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/student/change_password/'.$user['id'])?>', '<?php echo get_phrase('update_student'); ?>');"><?php echo get_phrase('change password'); ?></a>
				       <!-- item -->
					  <a href="javascript:;" class="dropdown-item" onclick="confirmModal('<?php echo route('student/delete/'.$student['id'].'/'.$student['user_id']); ?>', showAllStudents)"><?php echo get_phrase('delete'); ?></a>
							</div>
  				</div>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>


<script>
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