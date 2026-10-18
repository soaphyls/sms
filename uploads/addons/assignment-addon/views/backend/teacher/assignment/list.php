<?php
$school_id = school_id();
if(isset($selected_class_id) && $selected_class_id != ''){
    $this->db->where('class_id', $selected_class_id);
}
if(isset($selected_section_id) && $selected_section_id != ''){
    $this->db->where('section_id', $selected_section_id);
}
if(isset($selected_subject_id) && $selected_subject_id != ''){
    $this->db->where('subject_id', $selected_subject_id);
}
if($assignment_type == 'published'){
    $this->db->where('status', 1);
}
if($assignment_type == 'pending'){
    $this->db->where('status', 0);
}
if($assignment_type == 'expired'){
    $this->db->where('deadline <', strtotime(date('m/d/Y')));
}else{
    $this->db->where('deadline >=', strtotime(date('m/d/Y')));
}
$this->db->where('school_id', $school_id);
$assignments = $this->db->get('assignments')->result_array();
if (count($assignments) > 0): ?>
<table id="basic-datatable" class="table table-striped dt-responsive nowrap py-0 my-0" width="100%">
    <thead>
        <tr class="bg-dark text-muted">
            <th><?php echo get_phrase('title'); ?></th>
            <th><?php echo get_phrase('class'); ?></th>
            <th><?php echo get_phrase('subject'); ?></th>
            <th><?php echo get_phrase('deadline'); ?></th>
            <th><?php echo get_phrase('submissions'); ?></th>
            <th><?php echo get_phrase('action'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($assignments as $assignment): ?>
            <tr>
                <td><?php echo $assignment['title']; ?></td>
                <td>
                    <?php $class = $this->crud_model->get_classes($assignment['class_id'])->row_array(); ?>
                    <?php echo get_phrase('class') ?> : <?php echo $class['name']; ?>
                    <br>
                    <?php echo get_phrase('section') ?> : <?php echo $section = $this->crud_model->get_section_details_by_id('section', $assignment['section_id'])->row('name'); ?>
                </td>
                <td>
                    <?php $subject = $this->crud_model->get_subject_by_id($assignment['subject_id']); ?>
                    <?php echo $subject['name']; ?>
                </td>
                <td>
                    <?php echo date('d M Y', $assignment['deadline']); ?><br>
                    <?php if($assignment['status'] == 1 && $assignment['deadline'] >= strtotime(date('m/d/Y'))): ?>
                        <span class="badge badge-success-lighten"><?php echo get_phrase('published'); ?></span>
                    <?php elseif($assignment['deadline'] >= strtotime(date('m/d/Y'))): ?>
                        <span class="badge badge-secondary-lighten"><?php echo get_phrase('drafted'); ?></span>
                    <?php else: ?>
                        <span class="badge badge-danger-lighten"><?php echo get_phrase('expired'); ?></span>
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <?php $total_enroled_students = $this->db->get_where('enrols', array('class_id' => $assignment['class_id'], 'section_id' => $assignment['section_id'], 'school_id' => $school_id, 'session' => active_session())); ?>
                    <?php
						$this->db->distinct();
						$this->db->select('student_id');
						$this->db->where('assignment_id', $assignment['id']);
						$total_participant_students = $this->db->get('assignment_answers');
                        echo $total_participant_students->num_rows().' '. get_phrase('students');

                        $percentage = ($total_participant_students->num_rows() / $total_enroled_students->num_rows()) * 100;
					?>
                    <br>
                    <span class="badge badge-info-lighten"><?php echo round($percentage, 2).'% '.get_phrase('submissions'); ?></span>
                </td>
                <td>
                    <div class="dropdown text-center">
                        <button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <?php if($assignment['deadline'] >= strtotime(date('m/d/Y'))): ?>
                                <?php if($assignment['status'] == 0): ?>
                                    <a href="javascript:;" onclick="confirmModal('<?php echo site_url('addons/assignment/publish/'.$assignment['id']); ?>', showAssignments)" class="dropdown-item"><?php echo get_phrase('publish_assignment'); ?></a>
                                <?php else: ?>
                                    <a href="<?php echo site_url('addons/assignment/pending/'.$assignment['id']); ?>" class="dropdown-item"><?php echo get_phrase('mark_as_draft'); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <!-- item-->
                            <a href="<?= site_url('addons/assignment/questions/'.$assignment['id']); ?>" class="dropdown-item"><?php echo get_phrase('questions'); ?></a>

                            <a href="<?= site_url('addons/assignment/students/'.$assignment['id'].'/'.$assignment['class_id'].'/'.$assignment['section_id']); ?>" class="dropdown-item"><?php echo get_phrase('submissions'); ?></a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/assignment/edit/'.$assignment['id'])?>', '<?php echo get_phrase('edit_assignment'); ?>');"><?php echo get_phrase('edit'); ?></a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo site_url('addons/assignment/index/delete/'.$assignment['id']); ?>', showAssignments)"><?php echo get_phrase('delete'); ?></a>
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
