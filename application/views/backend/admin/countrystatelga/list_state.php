<?php 
		$state = $this->db->get('state')->result_array();
		$state_id = $this->db->get_where('users' , array('id' => $parent_id))->row()->state_id;
		
	foreach($state as $row3){
		?>
		<option value="<?php echo $row3['state_id'];?>"
			<?php if($row3['state_id'] == $state_id)echo 'selected';?>>
					<?php echo $row3['state_name'];?>
				</option>
	<?php } ?>