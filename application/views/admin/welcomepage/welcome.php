<div class="container-fluid body-wrapper pl-24vw">
    <div class="row">
        <div class="col-sm-12">
            <div class="welcome-card-wrapper">
                <div class="welcome-background-wrapper" style="background: url('<?php echo base_url(); ?>application/assets/shared/img/admin/welcome.png');">
                    <div class="welcome-content-wrap">
                        <h3 class="welcome-title">Welcome to the <?php echo $this->session->userdata('usertype');  ?> panel</h3>
                        <p class="welcome-msg text-light-blue f-14">From here you can edit content of the user portal.</p>
                        <p class="tips-title">Tips :</p>
                        <ul class="welcome-tips-wrapper text-light-blue f-14">
                            <li>Side menu is based on the user portal main menu.</li>
                            <li>Please make a selection from the side menu and
                                start editing the user portal content <span class="note-text"><br/>(Note - Your
                                    changes will directly reflect the user portal).</span></li>
                            <li>You can collapse the side menu from toggle icon
                                i.e. located on top menu bar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>