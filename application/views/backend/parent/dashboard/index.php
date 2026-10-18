<?php $student_lists = $this->user_model->get_student_list_of_logged_in_parent(); ?>
<!-- start page title -->
<div class="row ">
<div class="col-xl-12">
    <div class="card">
      <div style="-webkit-box-flex: 1;-ms-flex: 1 1 auto;flex: 1 1 auto; padding: 0.5rem;background-image: linear-gradient(to left, #7c32ff 0%, #c738d8 50%, #7c32ff 100%); border-radius: 3px;">
        <h4 class="page-title text-white"> <i class="mdi mdi-view-dashboard title_icon text-white"></i> <?php echo get_phrase('welcome'); ?> back  <?php echo $user_details['name']; ?></h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div> <!--end col-->
</div>
<!-- end page title -->

<div class="row ">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-8">
              <div class="row">
                  <div class="col-lg-6 text-white">
				  <div class="card bg-primary widget-flat text-white" id="teacher" style="on" >
                                    <div class="card-body">
										<div class="float-right">
										  <i class="mdi mdi-account-multiple widget-icon"></i>
										</div>
										<h5 class="text-white font-weight-normal mt-0" title="Number of Student"> <i class="mdi mdi-account-group title_icon text-white" ></i>  <?php echo get_phrase('students'); ?> </h5>
										<h3 class="mt-3 mb-3">
										  <?php
										  $current_session_students = $this->user_model->get_session_wise_student();
											echo count ($student_lists);
										  ?>
										</h3></div>
										<div class="card-footer bg-primary d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#"><?php echo get_phrase('total_number_of_student'); ?></a>
                                        <div class="small text-white"><i class="fa fa-angle-right"></i></div>
                                    </div>
                                </div>
                       <!-- end card-->
                  </div> <!-- end col-->

                  <div class="col-lg-6">
				  <div class="card bg-warning widget-flat text-white" id="teacher" style="on" >
                                    <div class="card-body">
										<div class="float-right">
										  <i class="mdi mdi-account-multiple widget-icon"></i>
										</div>
										<h5 class="text-white font-weight-normal mt-0" title="Number of Student"> <i class="mdi mdi-account-group title_icon text-white" ></i>  <?php echo get_phrase('Teachers'); ?> </h5>
										<h3 class="mt-3 mb-3">
										  <?php
										  $teachers = $this->user_model->get_teachers();
											echo $teachers->num_rows();
										  ?>
										</h3></div>
										<div class="card-footer bg-warning d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#"><?php echo get_phrase('total_number_of_teacher'); ?></a>
                                        <div class="small text-white"><i class="fa fa-angle-right"></i></div>
                                    </div>
                                </div>
                       <!-- end card-->
                  </div> <!-- end col-->
              </div> <!-- end row -->
 






 
			
			
            </div> <!-- end col -->
            <div class="col-xl-4">
                <div class="card widget-flat bg-danger mb-4 text-white" id="attendance" style="on"  >
              <div class="card-body">
                <div class="float-right">
                  <i class="mdi mdi-account-single widget-icon"></i>
                </div>
                <h5 class="text-white font-weight-normal mt-0" title="attendance"> <i class="mdi mdi-account-group title_icon"></i><?php echo get_phrase('todays_attendance'); ?> </h5>
                <h3 class="mt-3 mb-3">
                  <?php echo $this->crud_model->get_todays_attendance(); ?>
                </h3></div> <!-- end card-body-->
               	<div class="card-footer bg-danger d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="<?php echo route('attendance'); ?>"><?php echo get_phrase('attendance_today'); ?></a>                  
                 <div class="small text-white"><i class="fa fa-angle-right"></i></div>
                  </div>
              
            </div> 
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo get_phrase('recent_events'); ?><a href="<?php echo route('event_calendar'); ?>" style="color: #6c757d;"><i class = "mdi mdi-export"></i></a></h4>
                        <?php include 'event.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col-->
</div>

<script>


$(".widget-flat").mouseenter(function() {
    var id = $(this).attr('id');
    $('#'+id+'_list').show();
}).mouseleave(function() {
    var id = $(this).attr('id');
    $('#'+id+'_list').hide();
});
</script>
