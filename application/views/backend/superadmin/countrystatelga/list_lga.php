<?php 
	$lga = $this->db->get('locals')->result_array();
	$local_id = $this->db->get_where('users' , array('id' => $parent_id))->row()->local_id;
	foreach($lga as $row3){
		?>
		<option value="<?php echo $row3['local_id'];?>"
			<?php if($row3['local_id'] == $local_id)echo 'selected';?>>
					<?php echo $row3['local_name'];?>
				</option>
	<?php } ?>