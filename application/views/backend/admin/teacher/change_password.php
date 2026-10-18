<div class="h-50">
    <div class="row align-items-center h-50">
<div class="col-xl-12 col-lg-12">
     
                <h4 class="header-title"><?php echo get_phrase('change_password') ; ?></h4>
                <form method="POST" class="col-12 changePasswordAjaxForm" action="<?php echo route('profile/update_password2') ; ?>" id = "changePasswordAjaxForm" enctype="multipart/form-data">
                    
                          <div class="form-group row mb-12">
                            <label class="col-md-5 col-form-label" for="new_password"> <?php echo get_phrase('new_password') ; ?></label>
                            <div class="col-md-7">
                                <input type="password" id="new_password" name="new_password" class="form-control"  value="" required>
                            </div>
                        </div>
							<br>
                        <div class="form-group row mb-6">
                            <label class="col-md-5 col-form-label" for="confirm_password"> <?php echo get_phrase('confirm_password') ; ?></label>
                            <div class="col-md-7">
							<input type="hidden"  name="user_id" class="form-control"  value="<?php echo $param1 ; ?>">
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control"  value="" required>
                            </div>
                        </div>
						<br>
                        <div class="text-center ">
                            <button type="submit" class="row mb-6 btn btn-success col-xl-10 col-lg-10 col-md-10 " onclick="changePassword()"><?php echo get_phrase('change_password') ; ?></button>
                        </div>
                   
                </form>


    </div>
	 </div> <!-- end card -->
    </div>