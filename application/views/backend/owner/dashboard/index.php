                        <div class="row">
                            <div class="col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent"> Fees Rev</h5>
                                                <h3 class="my-2 py-1">₦9184</h3>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 3.27%</span>
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <div id="campaign-sent-chart" data-colors="#536de6"></div>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
        
                            <div class="col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">Visitors</h5>
                                                <h3 class="my-2 py-1">3,254</h3>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 5.38%</span>
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <div id="new-leads-chart" data-colors="#10c469"></div>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->

                            <div class="col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Deals">Classes</h5>
                                                <h3 class="my-2 py-1">861</h3>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <div id="deals-chart" data-colors="#ff4d4d"></div>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->

                            <div class="col-lg-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Booked Revenue">Books Sales</h5>
                                                <h3 class="my-2 py-1">₦8250</h3>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 11.7%</span>
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-end">
                                                    <div id="booked-revenue-chart" data-colors="#10c469"></div>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

<div class="row ">
  <div class="col-xl-12">
    <div class="row">
      <div class="col-xl-12">
        <div class="row">
          <div class="col-xl-3">
                                <div class="card bg-primary widget-flat text-white" id="teacher" style="on" >
                                    <div class="card-body"><i class="mdi mdi-human-male-female title_icon text-white fa-2x" ></i>
										 <?php echo get_phrase('Number of Students'); ?> 
										<h2 class="mt-1 text-center">
										  <?php
										  $current_session_students = $this->user_model->get_session_wise_student();
										  echo $current_session_students->num_rows();
										  ?>
										</h2></div>
										<div class="card-footer bg-primary d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?php echo route('student'); ?>"><?php echo get_phrase('total_number_of_student'); ?></a>
                                        <div class="small text-white"><i class="fa fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

          <div class="col-lg-3">
            <div class="card widget-flat bg-success  text-white mb-4" id="teacher" style="on"  >
              <div class="card-body"><i class="mdi mdi-account-multiple-outline title_icon text-white fa-2x" ></i>
				 <?php echo get_phrase('Number of Teachers'); ?> 
				<h2 class="mt-1 text-center">
				  <?php
                  $teachers = $this->user_model->get_teachers();
                  echo $teachers->num_rows();
                  ?>
				</h2></div> <!-- end card-body-->
               	<div class="card-footer bg-success  d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="<?php echo route('teacher'); ?>"><?php echo get_phrase('Number_of_teacher'); ?></a>                  
                 <div class="small text-white"><i class="fa fa-angle-right"></i></div>
                  </div>
              
            </div> <!-- end card-->
          </div> <!-- end col-->
        

      <!--  <div class="row"> -->
	  <div class="col-lg-3">
            <div class="card widget-flat bg-warning mb-4 text-white" id="teacher" style="on"  >
              <div class="card-body"><i class="mdi mdi mdi-account-multiple text-white fa-2x" ></i>
				 <?php echo get_phrase('Number of Parents'); ?> 
				<h2 class="mt-1 text-center">
				  <?php
                  $parents = $this->user_model->get_parents();
                  echo $parents->num_rows();
                  ?>
				</h2></div> <!-- end card-body-->
               	<div class="card-footer bg-warning d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="<?php echo route('parent'); ?>"><?php echo get_phrase('total_number_of_parent'); ?></a>                  
                 <div class="small text-white"><i class="fa fa-angle-right"></i></div>
                  </div>
              
            </div> <!-- end card-->
          </div>
	<!--  <div class="row"> -->
	  <div class="col-lg-3">
            <div class="card widget-flat bg-danger mb-4 text-white" id="attendance" style="on"  >
              <div class="card-body"><i class="mdi mdi-marker-check text-white fa-2x" ></i>
				 <?php echo get_phrase("Today's Attendance"); ?> 
				<h2 class="mt-1 text-center">
				  <?php echo $this->crud_model->get_todays_attendance(); ?>
				</h2></div> <!-- end card-body-->
               	<div class="card-footer bg-danger d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="<?php echo route('attendance'); ?>"><?php echo get_phrase('attendance_today'); ?></a>                  
                 <div class="small text-white"><i class="fa fa-angle-right"></i></div>
                  </div>
              
            </div> <!-- end card-->
          </div>
	 
	        </div>
      </div> <!-- end col -->
      </div>
  </div><!-- end col-->
</div>


              
				<div class="row">
				
				
				<div class="row">
                            <div class="col-xl-5 col-lg-6">
							
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                            </div>
                                        </div>
                                        <h4 class="header-title mb-3">Performing Students</h4>

                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>User</th>
                                                        <th>T.Sc</th>
                                                        <th>A.Sc</th>
                                                        <th>A.C</th>
                                                        <th>Awd</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 fw-normal">Raphael Amaechi</h5>
                                                            <span class="text-muted font-13">Prim 5</span>
                                                        </td>
                                                        <td>487</td>
                                                        <td>61.73</td>
                                                        <td>53.2</td>
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-trophy-variant-outline text-warning "  ></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 fw-normal">Hassan Ahmed</h5>
                                                            <span class="text-muted font-13">Prim 6</span>
                                                        </td>
                                                        <td>635</td>
                                                        <td>67.9</td>
                                                        <td>53.5</td>
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-trophy-variant-outline text-warning " ></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 fw-normal">Peter Edet</h5>
                                                            <span class="text-muted font-13">JSS1</span>
                                                        </td>
                                                        <td>865</td>
                                                        <td>88</td>
                                                        <td>62</td>
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-trophy-variant-outline text-warning "  ></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 fw-normal">Ebere Obinna</h5>
                                                            <span class="text-muted font-13">JSS2</span>
                                                        </td>
                                                        <td>543</td>
                                                        <td>63.8</td>
                                                        <td>59.4</td>
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-trophy-variant-outline text-warning " ></i></a>
                                                        </td>
                                                    </tr>
													<tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 fw-normal">Nelson Emeka</h5>
                                                            <span class="text-muted font-13">JSS3</span>
                                                        </td>
                                                        <td>653</td>
                                                        <td>68.5</td>
                                                        <td>54.3</td>
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-trophy-variant-outline text-warning " ></i></a>
                                                        </td>
                                                    </tr>
													<tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 fw-normal">Mary Akinola</h5>
                                                            <span class="text-muted font-13">SS1</span>
                                                        </td>
                                                        <td>753</td>
                                                        <td>89.6</td>
                                                        <td>73.1</td>
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-trophy-variant-outline text-warning "  ></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 fw-normal">Ekiko Effiong</h5>
                                                            <span class="text-muted font-13">SS2</span>
                                                        </td>
                                                        <td>458</td>
                                                        <td>76.4</td>
                                                        <td>66.2</td>
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon "> <i class="mdi mdi-trophy-variant-outline text-warning "  ></i></a>
                                                        </td>
                                                    </tr>
													<tr>
                                                        <td>
                                                            <h5 class="font-15 mb-1 fw-normal">Smauel Wike</h5>
                                                            <span class="text-muted font-13">SS3</span>
                                                        </td>
                                                        <td>558</td>
                                                        <td>80.4</td>
                                                        <td>76.2</td>
                                                        <td class="table-action">
                                                            <a href="javascript: void(0);" class="action-icon "> <i class="mdi mdi-trophy-variant-outline text-warning "  ></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                          
                            </div> <!-- end col -->

                             <div class="col-xl-7 col-lg-6">
                                <div class="card card-h-100">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                            </div>
                                        </div>
                                        <h4 class="header-title mb-3">School Population Projections Vs Actuals</h4>

                                        <div dir="ltr">
                                            <div id="high-performing-product" class="apex-charts" data-colors="#536de6,#e3eaef"></div>
                                        </div>
										<br>
                                         <h4 class="header-title">Primary School Population</h4>
                                        <div dir="ltr">
                                            <div id="simple-pie" class="apex-charts" data-colors="#35b8e0,#6c757d,#10c469,#ff5b5b,#e3eaef"></div>
                                        </div>   
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                          
                        </div>
						





<div class="row">
  <div class="col-xl-12">
    <div class="row">
      <div class="col-xl-8">
        <div class="card">
          <div class="card-body">
            <h4 class="header-title mb-3"><?php echo get_phrase('accounts_of'); ?> <?php echo date('F'); ?> <a href="<?php echo route('invoice'); ?>" style="color: #6c757d"><i class = "mdi mdi-export"></i></a></h4>
            <?php include 'invoice.php'; ?>
          </div>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="card">
          <div class="card-body">
            <h4 class="header-title mb-3"> <?php echo get_phrase('expense_of'); ?> <?php echo date('F'); ?> <a href="<?php echo route('expense'); ?>" style="color: #6c757d"><i class = "mdi mdi-export"></i></a></h4>
            <?php include 'expense.php'; ?>
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
</div>

<script>
$(document).ready(function() {
  initDataTable("expense-datatable");
});

$(".widget-flat").mouseenter(function() {
  var id = $(this).attr('id');
  $('#'+id+'_list').show();
}).mouseleave(function() {
  var id = $(this).attr('id');
  $('#'+id+'_list').hide();
});
</script>
