<?php
$school_id = school_id();
$check_data = $this->db->get_where('users', array('role' => 'owner'));
if($check_data->num_rows() > 0):?>
<table id="example" class="table table-bordered dt-responsive nowrap" width="100%">
	<thead>
		<tr style="background-color: #f3f7f9; color: #000;">
			<th><?php echo get_phrase('No.'); ?></th>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('email'); ?></th>
            <th><?php echo get_phrase('owner_of'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
		$i=1;
        $owners = $this->db->get_where('users', array('role' => 'owner'))->result_array();
        foreach($owners as $owner){
            ?>
            <tr>
				<td><?php echo $i++; ?></td>
                <td><?php echo $owner['name']; ?></td>
                <td><?php echo $owner['email']; ?></td>
                <td>
                    <?php
                        $school_details = $this->crud_model->get_school_details_by_id($owner['school_id']);
                        echo $school_details['name'];
                     ?>
                     <br><small> <strong><?php echo get_phrase('phone'); ?></strong>: <?php echo $school_details['phone']; ?></small>
                     <br><small> <strong><?php echo get_phrase('address'); ?></strong>: <?php echo $school_details['address']; ?></small>
                </td>
                <td>
                    <div class="dropdown text-center">
                        <button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                        <div class="dropdown-menu dropdown-menu-end">
                              <!-- item-->
							<a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/owner/change_password/'.$user['id'])?>', '<?php echo get_phrase('update_owner'); ?>');"><?php echo get_phrase('change password'); ?></a>
						
							<!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/owner/edit/'.$owner['id']); ?>', '<?php echo get_phrase('update_owner'); ?>')"><?php echo get_phrase('edit'); ?></a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo route('owner/delete/'.$owner['id']); ?>', showAllowners )"><?php echo get_phrase('delete'); ?></a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php else: ?>
    <?php include APPPATH.'views/backend/empty.php'; ?>
<?php endif; ?>
