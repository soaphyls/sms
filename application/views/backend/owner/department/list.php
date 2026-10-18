<?php
$school_id = school_id();
$departments = $this->db->get_where('departments', array('school_id' => $school_id))->result_array();
if (count($departments) > 0): ?>
<table id="example" class="table table-bordered dt-responsive nowrap" width="100%">
    <thead>
      <tr style="background-color: #f3f7f9; color: #000;">
		<th><?php echo get_phrase('No.'); ?></th>
			<th><?php echo get_phrase('name'); ?></th>
			<th><?php echo get_phrase('options'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i=1;
		foreach($departments as $department): ?>
			<tr>
				<td><?php echo $i++; ?></td>
				<td><?php echo $department['name']; ?></td>
				<td>
					<div class="dropdown text-center">
						<button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
						<div class="dropdown-menu dropdown-menu-end">
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/department/edit/'.$department['id'])?>', '<?php echo get_phrase('update_department'); ?>');"><?php echo get_phrase('edit'); ?></a>
							<!-- item-->
							<a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo route('department/delete/'.$department['id']); ?>', showAllDepartments)"><?php echo get_phrase('delete'); ?></a>
						</div>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
	<?php include APPPATH.'views/backend/empty.php'; ?>
<?php endif; ?>
