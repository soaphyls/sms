<?php
    $settings_data = $this->live_class_model->get_live_class_settings();
 ?>

<div class="row justify-content-md-center">
    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12">
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
                            <button type="submit" class="btn btn-secondary col-xl-4 col-lg-6 col-md-12 col-sm-12" onclick="updateLiveClassSettings()"><?php echo get_phrase('update_live_class_settings') ; ?></button>
                        </div>
                    </div>
                </form>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div>
</div>
