<?php
$school_id = school_id();
$schools = $this->db->get_where('schools')->result_array();
if (count($schools) > 0): ?>
<table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
  <thead>
    <tr style="background-color: #313a46; color: #ababab;">
      <th><?php echo get_phrase('name'); ?></th>
      <th><?php echo get_phrase('address'); ?></th>
      <th><?php echo get_phrase('phone'); ?></th>
      <th><?php echo get_phrase('options'); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($schools as $school): ?>
      <tr>
        <td>
          <?php echo $school['name']; ?>
          <?php if (school_id() == $school['id']): ?>
              <i class="mdi mdi-check-circle" style="color: #4CAF50;"></i>
          <?php endif; ?>
        </td>
        <td><?php echo $school['address']; ?></td>
        <td><?php echo $school['phone']; ?></td>
        <td>
          <div class="dropdown text-center">
            <button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo site_url('addons/multischool/activate/'.$school['id']); ?>', showAllSchools)"><?php echo get_phrase('active'); ?></a>
              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/multi_school/edit/'.$school['id'])?>', '<?php echo get_phrase('update_school'); ?>');"><?php echo get_phrase('edit'); ?></a>
              <!-- item-->
              <a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo site_url('addons/multischool/delete/'.$school['id']); ?>', showAllSchools)"><?php echo get_phrase('delete'); ?></a>
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
