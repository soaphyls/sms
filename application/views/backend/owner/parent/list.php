<?php
$school_id = school_id();
$check_data = $this->db->get_where('users', array('school_id' => $school_id, 'role' => 'parent'));
if($check_data->num_rows() > 0):?>
<table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
	<thead>
		<tr style="background-color: #313a46; color: #ababab;">
			<th><?php echo get_phrase('No.'); ?></th>
			<th><?php echo get_phrase('name'); ?></th>
			<th><?php echo get_phrase('photo'); ?></th>
			<th><?php echo get_phrase('email'); ?></th>
			<th><?php echo get_phrase('options'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i=1;
		$users = $this->db->get_where('users', array('school_id' => $school_id, 'role' => 'parent'))->result_array();
		foreach($users as $user){
			?>
			<tr>
				<td><?php echo $i++; ?></td>
				<td><?php echo $user['name']; ?></td>
				<td><img class="rounded-circle" width="50" height="50" src="<?php echo $this->user_model->get_user_image_parent($user['id']); ?>"></td>
               	<td><?php echo $user['email']; ?></td>
				<td>
					<div class="dropdown text-center">
						<button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
						<div class="dropdown-menu dropdown-menu-end">
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/parent/edit/'.$user['id'])?>', '<?php echo get_phrase('update_parent'); ?>');"><?php echo get_phrase('edit'); ?></a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/parent/change_password/'.$user['id'])?>', '<?php echo get_phrase('update_parent'); ?>');"><?php echo get_phrase('change password'); ?></a>
							
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo route('parent/delete/'.$user['id']); ?>', showAllParents )"><?php echo get_phrase('delete'); ?></a>
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
