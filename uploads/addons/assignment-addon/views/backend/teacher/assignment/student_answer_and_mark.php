<!--title-->
<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="page-title">
            <i class="mdi mdi-book-open-page-variant title_icon"></i> <?php echo get_phrase($page_title); ?>
            <a href="<?php echo site_url('addons/assignment/students/'.$assignment_details['id'].'/'.$assignment_details['class_id'].'/'.$assignment_details['section_id']); ?>" class="btn btn-outline-primary ml-1 btn-rounded alignToTitle"> <i class="mdi mdi-arrow-left"></i> <?php echo get_phrase('submissions'); ?></a>
        </h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <h5 class="text-center mt-3"><?php echo get_phrase('total_questions'); ?></h5>
            <div class="card-body text-center">
                <?php echo $questions->num_rows(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <h5 class="text-center mt-3"><?php echo get_phrase('total_submited_answers'); ?></h5>
            <div class="card-body text-center">
                <?php echo $this->db->get_where('assignment_answers', array('assignment_id' => $assignment_details['id'], 'student_id' => $student_id, 'status' => 1))->num_rows(); ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <h5 class="text-center mt-3"><?php echo get_phrase('total_obtained_marks'); ?></h5>
            <div class="card-body text-center" id="total_obtained_marks">
                <?php
                    $this->db->select_sum('obtained_mark');
                    $this->db->where('assignment_id', $assignment_details['id']);
                    $this->db->where('student_id', $student_id);
                    $this->db->where('status', 1);
                    $student_answers = $this->db->get('assignment_answers');
                    $student_obtained_marks = $student_answers->row('obtained_mark');
                    if($student_obtained_marks > 0){
                        echo $student_obtained_marks;
                    }else{
                        echo 0;
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body assignment_question_content">
        <div class="row">
            <div class="col-md-12 p-0">
                <h4 class="mb-2 pb-2 pl-0">
                    <?php echo get_phrase('question_answers'); ?>
                </h4>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <?php foreach($questions->result_array() as $key => $question):
                        $question_answer = $this->db->get_where('assignment_answers', array('question_id' => $question['id'], 'student_id' => $student_id, 'status' => 1))->row_array(); ?>
                        <div class="col-md-12 bg-light border-bottom pb-2 mb-2">
                            <p class="my-1">
                                <?php echo get_phrase('question'); ?>: <span class="text-muted"><?php echo $question['question']; ?></span>
                                <span class="float-right"><?php echo get_phrase('mark'); ?> : <?php echo $question['mark']; ?></span>
                            </p>
                            <p class="mb-0"><?php echo get_phrase('answer'); ?> :
                            <?php if($question_answer['id'] <= 0): ?>
                                <span class="badge badge-danger-lighten ml-1"><?php echo get_phrase('there_is_no_answer'); ?></span>
                            <?php endif; ?>
                            </p>

                            <?php if($question_answer['id'] > 0): ?>
                                <form action="javascript:;" method="POST" enctype="multipart/form-data">
                                    <div class="form-group bg-white p-3">
                                        <?php if($question['question_type'] == 'text'): ?>
                                            <?php echo nl2br($question_answer['answer']); ?>
                                        <?php else: ?>
                                            <a href="<?php echo base_url('uploads/assignment_files/'.$question_answer['answer']); ?>" class="btn btn-info btn-sm ml-4" download><i class="mdi mdi-download"></i> <?php echo get_phrase('download'); ?></a>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label><?php echo get_phrase('enter_obtained_mark'); ?></label>
                                        <div class="input-group">
                                            <input type="number" min="0" max="<?php echo $question['mark']; ?>" name="mark_of_question" value="<?php echo $question_answer['obtained_mark']; ?>" id="obtained_mark_<?php echo $question_answer['id']; ?>" class="form-control" placeholder="<?php echo get_phrase('obtained_mark'); ?>">
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary btn-sm border-0" type="button" onclick="save_obtained_mark('<?php echo $question_answer['id']; ?>', '<?php echo $question['mark']; ?>', this)"><span class="px-20"><?php echo get_phrase('save_obtained_mark'); ?></span></button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>                                
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="<?php echo $this->user_model->get_user_image($student_id); ?>" width="80px" class="rounded-circle">
                            </div>
                            <div class="col-md-12">
                                <?php $student_details = $this->user_model->get_all_users($student_id)->row_array(); ?>
                                <?php echo $student_details['name']; ?>
                            </div>
                            <div class="col-md-12 mt-2">
                                <p class="mb-0 pb-0"><?php echo get_phrase('email'); ?> : <?php echo $student_details['email']; ?></p>
                                <p class="pt-0 mt-0"><?php echo get_phrase('phone'); ?> : <?php echo $student_details['phone']; ?></p>
                            </div>
                            <div class="col-md-12 text-left mt-2">
                                <form action="<?= site_url('addons/assignment/update_remark/'.$assignment_details['id'].'/'.$student_id); ?>" method="post">
                                    <label><?php echo get_phrase('remark'); ?></label>
                                    <?php $remark = $this->db->get_where('assignment_remarks', array('assignment_id' => $assignment_details['id'], 'student_id' => $student_id))->row_array(); ?>
                                    <textarea name="remark" rows="4" class="form-control"><?php echo $remark['remark']; ?></textarea>
                                    <button type="submit" class="btn btn-primary mt-2"><?php echo get_phrase('update_remark'); ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    'use strict';

    function save_obtained_mark(answer_id, question_mark, btn){
        var btn_text = $(btn).text();
        //loading start
        $(btn).html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span><?= get_phrase('saving'); ?>..');
        var obtained_mark = $('#obtained_mark_'+answer_id).val();

        if(obtained_mark <= question_mark){
            $.ajax({
                type: 'post',
                url: '<?= site_url('addons/assignment/save_obtained_mark/'); ?>' + answer_id,
                data: {obtained_mark:obtained_mark},                         
                success: function(response){
                    var response = JSON.parse(response);
                    //end loading
                    if(response.status == 1){
                        $.NotificationApp.send("<?php echo get_phrase('congratulations'); ?>!", response.message ,"top-right","rgba(0,0,0,0.2)","success");
                        $(btn).html('<span class="px-20">'+btn_text+'</span>');
                        $(btn).prop("disabled",false);

                        $('#total_obtained_marks').text(response.student_obtained_marks);
                        console.log(response.student_obtained_marks);

                    }else{
                        $.NotificationApp.send("<?php echo get_phrase('oh_snap'); ?>!", '<?php echo get_phrase('something_is_wrong') ?>' ,"top-right","rgba(0,0,0,0.2)","error");
                        $(btn).html('<span class="px-20">'+btn_text+'</span>');
                        $(btn).prop("disabled",false);
                    }
                }
            });
        }else{
            $(btn).html('<span class="px-20">'+btn_text+'</span>');
            $(btn).prop("disabled",false);
            $.NotificationApp.send("<?php echo get_phrase('oh_snap'); ?>!", '<?php echo get_phrase('the_obtained_mark_is_higher_than_the_original_mark') ?>' ,"top-right","rgba(0,0,0,0.2)","error");
        }
    }
</script>