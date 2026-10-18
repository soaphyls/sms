<!--title-->
<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="page-title">
            <i class="mdi mdi-book-open-page-variant title_icon"></i> <?php echo get_phrase($page_title); ?>
            <a href="<?= site_url('addons/assignment/my_expired_assignment'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"> <i class="mdi mdi-arrow-left"></i> <?php echo get_phrase('back'); ?></a>
        </h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>
<?php $student_id = $this->session->userdata('user_id'); ?>

<div class="card">
    <div class="card-body assignment_question_content">
        <div class="row">
        	<div class="col-md-12">
        		<h4 class="mb-2 pb-2 pl-0">
					<?php echo get_phrase('your_answers'); ?>
				</h4>
        	</div>
			<div class="col-md-8">
				<div class="row">
					<?php $total_marks = 0; ?>
					<?php foreach($questions->result_array() as $key => $question):
						$question_answer = $this->db->get_where('assignment_answers', array('question_id' => $question['id'], 'student_id' => $student_id, 'status' => 1))->row_array();
						$total_marks += $question['mark'];
					?>
						<div class="col-md-12 bg-light border-bottom pb-2 mb-2">
							<p class="my-1">
								<?php echo get_phrase('question'); ?>: <span class="text-muted"><?php echo $question['question']; ?></span>
								<span class="float-right">
									<?php echo get_phrase('mark'); ?> : 
									<?php if($question['mark'] > 0): ?>
										<?php echo $question['mark']; ?>
									<?php else: ?>
										<?php echo 0; ?>
									<?php endif; ?>
								</span>
							</p>
                            <p class="mb-1"><?php echo get_phrase('answer'); ?> :
                            <?php if($question_answer['id'] <= 0): ?>
                                <span class="badge badge-danger-lighten ml-1"><?php echo get_phrase('there_is_no_answer'); ?></span>
                            <?php endif; ?>
                            	<span class="float-right">
                            		<?php echo get_phrase('obtained_mark') ?> : 
                            		<?php if($question_answer['obtained_mark'] > 0): ?>
										<?php echo $question_answer['obtained_mark']; ?>
									<?php else: ?>
										<?php echo 0; ?>
									<?php endif; ?>
                            	</span>
                            </p>

                            <?php if($question_answer['id'] > 0): ?>
                                <form action="javascript:;" method="POST" enctype="multipart/form-data">
                                    <div class="form-group bg-white p-3">
                                        <?php if($question['question_type'] == 'text'): ?>
                                            <?php echo nl2br($question_answer['answer']); ?>
                                        <?php else: ?>
                                            <a href="<?php echo base_url('uploads/assignment_files/'.$question_answer['answer']); ?>" class="btn btn-primary btn-sm ml-4" download><i class="mdi mdi-download"></i> <?php echo get_phrase('download'); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </form>                                
                            <?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
		            <h5 class="text-center mt-3 mb-0"><?php echo get_phrase('total_marks'); ?></h5>
		            <div class="card-body text-center"><?php echo $total_marks; ?></div>
		        </div>
				<div class="card">
		            <h5 class="text-center mt-3 mb-0"><?php echo get_phrase('total_obtained_marks'); ?></h5>
		            <div class="card-body text-center">
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
		        <div class="card">
		            <h5 class="text-center mt-3 mb-0"><?php echo get_phrase('remark'); ?></h5>
		            <div class="card-body text-center">
		                <?php echo $this->db->get_where('assignment_remarks',array('assignment_id' => $assignment_details['id'], 'student_id' => $student_id))->row('remark'); ?>
		            </div>
		        </div>
			</div>
		</div>
    </div>
</div>