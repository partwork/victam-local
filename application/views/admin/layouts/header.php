<link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/admin/layouts/layouts.css">
<input type="hidden" value="<?php echo base_url(); ?>" id="ajax_url">
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <a class="navbar-brand" href="<?php echo base_url('admin') ?>">
        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto ml-10r menu-close-wrap">
            <li class="nav-item">
                <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-close.png" class="menu-close-icon">
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link notification-bell" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                    <span class="badge badge-red" id="unread-count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right notify-drp-menu" aria-labelledby="navbarDropdown">
                    <div class="notify-drp-header">
                        <h4 class="n-heading mb-0">Notifications</h4>
                    </div>
                    <div class="notify-drp-body">
                        <a class="dropdown-item" href="#" id="loading">
                            <p class="m-0" style="width:100%;">Loading....</p>
                        </a>
                    </div>
                    <div class="notify-drp-footer">
                        <button type="button" class="btn nf-heading mb-0"><i class="fa fa-times" aria-hidden="true"></i></button>
                    </div>
                    
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/profile.png" class="user-icon">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/down-angle-arrow.png" class="down-arrow">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item text-capitalize" href="#"> <?php echo $this->session->userdata('usertype'); ?> </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:vois(0)"> <?php echo $this->session->userdata('email'); ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url('changePassword') ?>"> Change Password </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url('logout?session-out') ?>">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script src="<?php echo base_url(); ?>application/assets/admin/layouts/layouts.js"></script>