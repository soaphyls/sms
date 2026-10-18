<?php
//if($user_type == 'student'){
	//$student_id = $this->session->userdata('user_id');
	//$class_id = $this->db->get_where('enrols', array('student_id' => $student_id, 'school_id' => $school_id, 'session' => active_session()))->row()->class_id;
    
	//$ebooks = $this->ebook_model->get_student_ebooks($class_id)->result_array();

	//} else{ 
		$ebooks = $this->ebook_model->get_ebooks()->result_array();
	//};
	?>
	
	<?php echo $class_id;?>
<?php if (count($ebooks) > 0): ?>
  <div class="table-responsive-sm">
    <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
      <thead class="thead-dark">
        <tr>
		  <th><?php echo get_phrase('SN'); ?></th>
          <th><?php echo get_phrase('book_name'); ?></th>
          <th><?php echo get_phrase('Class'); ?></th>
		  <th><?php echo get_phrase('author'); ?></th>
          <th><?php echo get_phrase('cover_image'); ?></th>
          
          <th style="text-align:center"><?php echo get_phrase('option'); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php $count = 1; foreach ($ebooks as $obj): ?>
          <tr>
			<td><?php echo $count++; ?></td> 
            <td> <?php echo $obj['name']; ?> </td>
            <td> <?php echo $obj['class_id']; ?> </td>
			<td> <?php echo $obj['author']; ?> </td>
            <td> <img src="<?php echo base_url().'uploads'; ?>/book_cover/<?php echo $obj['cover_image']; ?>" alt="" width="100" /> </td>
            <td>
			
			<div class="dropdown text-center">
      										
						<a  href="javascript:void(0);"  onclick="largeModal('<?php echo site_url('addons/ebooks/read_doc/'.$obj['file_name']); ?>','<?php echo $obj['']; ?>' );"  class="btn btn-danger btn-xs"><i class="mdi mdi-book-open"></i> <?php echo get_phrase('read'); ?> </a>
						<?php if($obj['file_name']){ ?>
						<a target="_blank" href="<?php echo base_url().'uploads'; ?>/ebook/<?php echo $obj['file_name']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-download"></i> <?php echo get_phrase('download'); ?> </a>
						
					<?php } ?>
						                         
						                        
					
      				</div>
              
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <?php include APPPATH.'views/backend/empty.php'; ?>
<?php endif; ?>
<script type="text/javascript">
         
    function get_book_modal(ebook_id){
         
        $('.fn_book_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('ebook/get_single_ebook'); ?>",
          data   : {ebook_id : ebook_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_book_data').html(response);
             }
          }
       });
    }
</script>