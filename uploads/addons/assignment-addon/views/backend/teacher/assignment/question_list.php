<?php
$school_id = school_id();
$questions = $this->db->get_where('assignment_questions', array('assignment_id' => $assignment_details['id']))->result_array();
if (count($questions) > 0): ?>
<table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
    <thead>
        <tr class="bg-dark text-muted">
            <th><?php echo get_phrase('question'); ?></th>
            <th><?php echo get_phrase('question_type'); ?></th>
            <th><?php echo get_phrase('mark'); ?></th>
            <th><?php echo get_phrase('action'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($questions as $question): ?>
            <tr>
                <td><?php echo $question['question']; ?></td>
                <td><span class="badge badge-info-lighten"><?php echo $question['question_type']; ?></span></td>
                <td><b><?php echo $question['mark']; ?></b></td>
                <td>
                    <div class="dropdown text-center">
                        <button type="button" class="btn btn-sm btn-icon btn-rounded btn-outline-secondary dropdown-btn dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="javascript:void(0);" class="dropdown-item" onclick="rightModal('<?php echo site_url('modal/popup/assignment/edit_question/'.$question['id'])?>', '<?php echo get_phrase('edit_assignment'); ?>');"><?php echo get_phrase('edit'); ?></a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item" onclick="confirmModal('<?php echo site_url('addons/assignment/questions/delete/'.$question['id']); ?>', showAssignmentQuestion)"><?php echo get_phrase('delete'); ?></a>
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
