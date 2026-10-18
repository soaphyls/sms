<?php 
		$country = $this->db->get('country')->result_array();
		$country_id = $this->db->get_where('users' , array('id' => $parent_id))->row()->country_id;
		foreach($country as $row3){
			?>
			<option value="<?php echo $row3['country_id'];?>"
				<?php if($row3['country_id'] == $country_id)echo 'selected';?>>
						<?php echo $row3['country_name'];?>
					</option>
		<?php } ?>