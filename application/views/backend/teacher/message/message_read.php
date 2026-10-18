<?php
    $message_thread_details = $this->db->get_where('message_thread', array('message_thread_code' => $current_message_thread_code))->row_array();
    $first_sender = $message_thread_details['sender'];
?>

                        <div class="col-xxl-6 col-xl-12 order-xl-2">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="conversation-list" data-simplebar style="max-height: 537px">
                                           
									<?php
															$messages =	$this->db->get_where('message' , array('message_thread_code' => $current_message_thread_code))->result_array();
															foreach ($messages as $row):
																	
															   // $sender_details = $this->user_model->get_user_details($row['sender'])->row_array();
																$sender_id   =	$row['sender'];

																$data['message_thread_code'] = $current_message_thread_code;
															?>
										   <li class="clearfix">
                                                <div class="chat-avatar">
										<a href="#">
							            <img src="<?php echo $this->user_model->get_user_image($sender_id);?>" alt="image" class="mr-3 d-none d-sm-block avatar-sm rounded-circle" style="height: 40px; width: 40px;">
							        </a>
		                        </div>
		                        <div class="conversation-text">
		                            <div class="ctext-wrap">
		                                <i>
				                    		<?php echo $this->db->get_where('users' , array('id' => $sender_id))->row()->name;?>
				                		</i>
		                                <p> <?php echo $row['message'];?> </p>
		                            </div>
                                    <small class="message_sending_time"><?php echo date("d M, Y" , $row['timestamp']);?></small>
		                        </div>  
                                            </li>
											<?php endforeach;?>
                                        </ul>

                                        <div class="row">
                                            <div class="col">
                                                <div class="mt-2 bg-light p-3 rounded">
                                                    <form method="post" action="<?php echo site_url('teacher/message/send_reply/'.$current_message_thread_code); ?>" class="needs-validation" novalidate name="chat-form" id="chat-form">
                                                        <div class="row">
                                                            <div class="col mb-2 mb-sm-0">
                                                                <input type="text" class="form-control border-0" placeholder="Enter your text" required="" name="message">
                                                                <div class="invalid-feedback">
                                                                    Please enter your messsage
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-auto">
                                                                <div class="btn-group">
                                                                    <a href="#" class="btn btn-light"><i class="uil uil-paperclip"></i></a>
                                                                    <a href="#" class="btn btn-light"> <i class='uil uil-smile'></i> </a>
                                                                    <div class="d-grid">
                                                                        <button type="submit" class="btn btn-success chat-send"><i class='uil uil-message'></i></button>
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row-->
                                                    </form>
                                                </div> 
                                            </div> <!-- end col-->
                                        </div>
                                        <!-- end row -->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div>
    