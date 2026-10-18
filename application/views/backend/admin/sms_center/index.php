<!-- start page title -->
<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="page-title">
          <i class="mdi mdi-settings title_icon"></i><?php echo ucfirst(get_phrase($page_title)); ?>
        </h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>
<!-- end page title -->
<div class="row">
  <div class="col-xl-10 offset-xl-1">
    <div class="settings_content">
      <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3 mt-2 mt-sm-0">
                  <div class="nav flex-column nav-pills" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active show" id="v-pills-home-tab2" data-toggle="pill" href="#v-pills-home2" role="tab" aria-controls="v-pills-home2"
                    aria-selected="true">
                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block"><?php echo get_phrase('active_sms_gateway'); ?></span>
                  </a>
                  <a class="nav-link" id="v-pills-twillio-tab2" data-toggle="pill" href="#v-pills-twillio" role="tab" aria-controls="v-pills-twillio"
                  aria-selected="false">
                  <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                  <span class="d-none d-lg-block">Twillio <?php echo get_phrase('settings'); ?></span>
                </a>
                <a class="nav-link" id="v-pills-msg91-tab2" data-toggle="pill" href="#v-pills-msg91" role="tab" aria-controls="v-pills-msg91"
                aria-selected="false">
                <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                <span class="d-none d-lg-block">MSG91 <?php echo get_phrase('settings'); ?></span>
              </a>
            </div>
          </div>
          <div class="col-sm-9">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade active show" id="v-pills-home2" role="tabpanel" aria-labelledby="v-pills-home-tab2">
                <p class="mb-0">
                  <div class="mt-3">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="none" name="active_sms_gateway" class="custom-control-input" onchange="activateSMSGateway(this.value)" value="none" <?php if (get_sms('active_sms_service') == 'none'): ?>checked<?php endif; ?>>
                      <label class="custom-control-label" for="none"><?php echo get_phrase('none'); ?></label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="twillio" name="active_sms_gateway" class="custom-control-input" onchange="activateSMSGateway(this.value)" value="twillio" <?php if (get_sms('active_sms_service') == 'twillio'): ?>checked<?php endif; ?>>
                      <label class="custom-control-label" for="twillio">Twillio</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" id="msg91" name="active_sms_gateway" class="custom-control-input" onchange="activateSMSGateway(this.value)" value="msg91" <?php if (get_sms('active_sms_service') == 'msg91'): ?>checked<?php endif; ?>>
                      <label class="custom-control-label" for="msg91">MSG91</label>
                    </div>
                  </div>
                </p>
              </div>
              <div class="tab-pane fade" id="v-pills-twillio" role="tabpanel" aria-labelledby="v-pills-twillio-tab2">
                <p class="mb-0">
                  <form method="POST" class="d-block smsForm ajaxForm" action="<?php echo site_url('addons/sms_center/update'); ?>">
                    <input type="hidden" name="sms_gateway" value="twillio">
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="twillio_sid">Twillio SID</label>
                        <input type="text" class="form-control" id="twillio_sid" name = "twillio_sid" value="<?php echo get_sms('twillio_sid'); ?>">
                        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_twillio_sid'); ?></small>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="twillio_sid">Twillio <?php echo get_phrase('token'); ?></label>
                        <input type="text" class="form-control" id="twillio_token" name = "twillio_token" value="<?php echo get_sms('twillio_token'); ?>">
                        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_twillio_token'); ?></small>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="twillio_from">Twillio <?php echo get_phrase('sender_phone_number'); ?></label>
                        <input type="text" class="form-control" id="twillio_from" name = "twillio_from" value="<?php echo get_sms('twillio_from'); ?>">
                        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_twillio_from'); ?></small>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-md-6">
                        <div class="form-group mt-2">
                          <button class="btn btn-block btn-primary" type="submit" onclick="updateSmsInfo()"><?php echo get_phrase('update_sms_settings'); ?></button>
                        </div>
                      </div>
                    </div>
                  </form>
                </p>
              </div>
              <div class="tab-pane fade" id="v-pills-msg91" role="tabpanel" aria-labelledby="v-pills-msg91-tab2">
                <p class="mb-0">
                  <form method="POST" class="d-block smsForm ajaxForm" action="<?php echo site_url('addons/sms_center/update'); ?>">
                    <input type="hidden" name="sms_gateway" value="msg91">
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="msg91_authentication_key">MSG91 <?php echo get_phrase('authentication_key'); ?></label>
                        <input type="text" class="form-control" id="msg91_authentication_key" name = "msg91_authentication_key" value="<?php echo get_sms('msg91_authentication_key'); ?>">
                        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_msg91_authentication_key'); ?></small>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="msg91_sender_id">MSG91 <?php echo get_phrase('sender_ID'); ?></label>
                        <input type="text" class="form-control" id="msg91_sender_id" name = "msg91_sender_id" value="<?php echo get_sms('msg91_sender_id'); ?>">
                        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_msg91_sender_ID'); ?></small>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="msg91_route">MSG91 <?php echo get_phrase('route'); ?></label>
                        <input type="text" class="form-control" id="msg91_route" name = "msg91_route" value="<?php echo get_sms('msg91_route'); ?>">
                        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_msg91_route'); ?></small>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="msg91_country_code">MSG91 <?php echo get_phrase('country_code'); ?></label>
                        <input type="text" class="form-control" id="msg91_country_code" name = "msg91_country_code" value="<?php echo get_sms('msg91_country_code'); ?>">
                        <small id="" class="form-text text-muted"><?php echo get_phrase('provide_msg91_country_code'); ?></small>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-md-6">
                        <div class="form-group mt-2">
                          <button class="btn btn-block btn-primary" type="submit" onclick="updateSmsInfo()"><?php echo get_phrase('update_sms_settings'); ?></button>
                        </div>
                      </div>
                    </div>
                  </form>
                </p>
              </div>
            </div> <!-- end tabcontent-->
          </div> <!-- end col-->

          <!-- end col-->
        </div> <!-- end row-->

      </div> <!-- end card-body-->
    </div> <!-- end card-->
  </div>
</div>

</div>
</div>
</div>
<script>

$(".ajaxForm").submit(function(e) {
  var form = $(this);
  ajaxSubmit(e, form, doNothing);
});


function doNothing() {

}

function activateSMSGateway(activSmsGateway) {
  $.ajax({
    type : "post",
    url: "<?php echo site_url('addons/sms_center/active_gateway'); ?>",
    data : {activSmsGateway : activSmsGateway},
    dataType: 'json',
    success: function(response){
      if (response.status) {
        toastr.success(response.notification);
      }else{
        toastr.error(response.notification);
      }
    }
  });
}

function updateSmsInfo() {
  $(".smsForm").validate({});
  $(".smsForm").submit(function(e) {
    var form = $(this);
    ajaxSubmit(e, form, reload);
  });
}
</script>
