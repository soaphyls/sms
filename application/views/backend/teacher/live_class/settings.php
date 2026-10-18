<?php
    $settings_data = $this->live_class_model->get_live_class_settings();
 ?>

<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-video title_icon"></i> <?php echo get_phrase($page_title); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-md-center">
    <div class="col-xl-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" class="col-12 live-class-settings-form" action="<?php echo site_url('addons/live_class/update_settings'); ?>" id = "live-class-settings-form">
                    <div class="col-12">

                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label" for="zoom_api_key"><?php echo get_phrase('zoom_api_key') ; ?></label>
                            <div class="col-md-9">
                                <input type="text" id="zoom_api_key" name="zoom_api_key" class="form-control"  value="<?php echo $settings_data['zoom_api_key']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label" for="zoom_secret_key"><?php echo get_phrase('zoom_secret_key') ; ?></label>
                            <div class="col-md-9">
                                <input type="text" id="zoom_secret_key" name="zoom_secret_key" class="form-control"  value="<?php echo $settings_data['zoom_secret_key']; ?>" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-secondary col-xl-4 col-lg-6 col-md-12 col-sm-12"><?php echo get_phrase('update_live_class_settings') ; ?></button>
                        </div>
                    </div>
                </form>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div>
    <div class="col-xl-6 col-sm-12">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"><?php echo get_phrase('how_to_get_zoom_api_key'); ?> ?</h4>
            <p>1. Go to your zoom accout. <a href="https://zoom.us/signin">https://zoom.us/signin</a></p>
            <img src="<?php echo base_url('assets/global/zoom/signin.png'); ?>" width="80%">

            <p class="pt-3">2. Go to the App Marketplace and Generate your API and Secret key. <a href="https://marketplace.zoom.us/develop/create">https://marketplace.zoom.us/develop/create</a></p>
            <img src="<?php echo base_url('assets/global/zoom/choosen_app.png'); ?>" width="80%">

            <p class="pt-3">3. Now, enter some information.</p>
            <img src="<?php echo base_url('assets/global/zoom/configure_app.png'); ?>" width="80%">

            <p class="pt-3">4. Click the <b>App Credentials</b> button to get your API key and Secret key.</p>
            <img src="<?php echo base_url('assets/global/zoom/api_key.png'); ?>" width="80%">
        </div>
    </div>
</div>