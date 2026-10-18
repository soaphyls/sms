<!-- Topbar Start -->
<div class="navbar-custom topnav-navbar topnav-navbar-dark">
    <div class="container-fluid">

        <!-- LOGO -->
        <a href="<?php echo site_url($this->session->userdata('role')); ?>" class="topnav-logo" style = "min-width: unset;">
            <span class="topnav-logo-lg">
                <img src="<?php echo $this->settings_model->get_logo_light(); ?>" alt="" height="50">
            </span>
            <span class="topnav-logo-sm">
                <img src="<?php echo $this->settings_model->get_logo_light('small'); ?>" alt="" height="50">
            </span>
        </a>

        <ul class="list-unstyled topbar-menu float-end mb-0">

          <?php if ($this->session->userdata('user_type') == 'superadmin'||'admin'): ?>
              <li class="dropdown notification-list topbar-dropdown d-none d-lg-block">
                  <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" onclick="getLanguageList()">
                      <i class="mdi mdi-blur noti-icon"></i> <?php echo ucfirst(get_settings('language')); ?>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

                      <!-- item-->
                      <div class="dropdown-item noti-title">
                          <h5 class="m-0">
                              <?php echo get_phrase('language'); ?>
                          </h5>
                      </div>

                      <div class="slimscroll" id="language-list" style="min-height: 150px;">

                      </div>
                  </div>
              </li>
          <?php endif; ?>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                    <span class="account-user-avatar">
                       <?php
							if($user_type == 'parent'){;?>
							<img src="<?php echo $this->user_model->get_user_image_parent($this->session->userdata('user_id')); ?>" alt="user-image" height="42" class="rounded-circle shadow-sm">
							<?php
							} elseif($user_type == 'teacher'){?>
							<img src="<?php echo $this->user_model->get_user_image_teachers($this->session->userdata('user_id')); ?>" alt="user-image" height="42" class="rounded-circle shadow-sm">
							<?php
							} else{ ?>
								 <img src="<?php echo $this->user_model->get_user_image($this->session->userdata('user_id')); ?>" alt="user-image" height="42" class="rounded-circle shadow-sm">
							<?php	
							};?>
                    </span>
                    <span>
                        <span class="account-user-name"><?php echo $user_name; ?></span>
                        <?php if (strtolower($this->db->get_where('users', array('id' => $user_id))->row('role')) == 'admin'): ?>
                            <span class="account-position"><?php echo get_phrase('admin'); ?></span>
                        <?php else: ?>
                            <span class="account-position"><?php echo ucfirst($this->db->get_where('users', array('id' => $user_id))->row('role')); ?></span>
                        <?php endif; ?>

                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0"><?php echo get_phrase('Welcome!'); ?> !</h6>
                    </div>

                    <!-- item-->
                    <a href="<?php echo route('profile'); ?>" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-circle me-1"></i>
                        <span><?php echo get_phrase('my_account'); ?></span>
                    </a>
                    <?php if ($this->session->userdata('user_type') == 'superadmin'): ?>
                        <!-- item-->
                        <a href="<?php echo route('system_settings'); ?>" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-edit me-1"></i>
                            <span><?php echo get_phrase('settings'); ?></span>
                        </a>
                    <?php endif; ?>

                    <?php if ($this->session->userdata('user_type') == 'superadmin' || $this->session->userdata('user_type') == 'admin'): ?>
                        <!-- item-->
                        <a href="#" target="_blank" class="dropdown-item notify-item">
                            <i class="mdi mdi-lifebuoy me-1"></i>
                            <span><?php echo get_phrase('support'); ?></span>
                        </a>
                    <?php endif; ?>

                    <!-- item-->
                    <a href="<?php echo site_url('login/logout'); ?>" class="dropdown-item notify-item">
                        <i class="mdi mdi-logout me-1"></i>
                        <span><?php echo get_phrase('logout'); ?></span>
                    </a>

                </div>
            </li>

        </ul>
        <div class="app-search dropdown pt-1 mt-2">
            <h4 style="color: #fff; float: left;" class="d-none d-md-inline-block"> <?php echo get_settings('system_name'); ?></h4>
             </div>
        <a class="button-menu-mobile disable-btn">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
    </div>
</div>
<!-- end Topbar -->


<script type="text/javascript">
function getLanguageList() {
    $.ajax({
        url: "<?php echo route('language/dropdown'); ?>",
        success: function(response){
            $('#language-list').html(response);
        }
    });
}
</script>
