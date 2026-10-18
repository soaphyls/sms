<?php
    $enrols = $this->db->get_where('enrols', array('class_id' => $class_id, 'section_id' => $section_id, 'school_id' => $school_id, 'session' => active_session()));

    $this->db->distinct();
    $this->db->select('student_id');
    $this->db->where('assignment_id', $assignment_details['id']);
    $total_participant_students = $this->db->get('assignment_answers');
?>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h5><?php echo get_phrase('percentage_of_submission'); ?></h5>
                <?php $percentage = ($total_participant_students->num_rows() / $enrols->num_rows()) * 100; ?>
                <p><?php echo round($percentage, 2).'% '; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h5><?php echo get_phrase('total_submitted'); ?></h5>
                <p><?php echo $total_participant_students->num_rows(); ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h5><?php echo get_phrase('total_student'); ?></h5>
                <p>
                    <?php echo $enrols->num_rows(); ?>
                </p>
            </div>
        </div>
    </div>
</div>


<div class="table-responsive-sm">
    <table class="table table-light mb-0">
        <thead class="table-dark">
            <tr>
                <th class="text-center"><?php echo get_phrase('photo'); ?></th>
                <th class="text-center"><?php echo get_phrase('name'); ?></th>
                <th class="text-center"><?php echo get_phrase('submission_status'); ?></th>
                <th class="text-center"><?php echo get_phrase('action'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($enrols->result_array() as $enroll){
            $student = $this->db->get_where('students', array('id' => $enroll['student_id']))->row_array();
            $user_details = $this->db->get_where('users', array('id' => $student['user_id']))->row_array();
            $student_assignment = $this->db->get_where('assignment_answers', array('assignment_id' => $assignment_details['id'], 'student_id' => $student['user_id'], 'status' => '1'));
            ?>
            <tr>
                <td class="text-center"><img src="<?php echo $this->user_model->get_user_image($student['user_id']); ?>" width="60" class="rounded-circle"></td>
                <td class="text-center"><?php echo $user_details['name']; ?></td>
                <td class="text-center">
                    <?php if($student_assignment->num_rows() > 0){ ?>
                        <span class="badge badge-success-lighten"><?php echo get_phrase('yes'); ?></span>
                    <?php }else{ ?>
                        <span class="badge badge-danger-lighten"><?php echo get_phrase('no'); ?></span>
                    <?php } ?>
                </td>
                <td class="text-center">
                    <a href="<?= site_url('addons/assignment/answer_and_mark/'.$assignment_details['id'].'/'.$student['user_id']); ?>" class="btn btn-outline-info btn-sm">
                        <i class="mdi mdi-eye-outline"></i>
                        <?php echo get_phrase('review'); ?>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>