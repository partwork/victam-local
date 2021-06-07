<?php $this->load->view('shared/header/h_css_js_helpers'); ?>
<?php $plan_id = (isset($_SESSION['plan_id'])) ? $_SESSION['plan_id'] : ''; ?>
<?php $userId = (isset($_SESSION['userId'])) ? $_SESSION['userId'] : ''; 
      $matchmaking = (isset($_SESSION['matchmaking_plan'])) ? $_SESSION['matchmaking_plan'] : '';
?>

<script type="text/javascript">
 $(document).ready(function() {
            
                $(".copy1").clone().appendTo(".nav1");
                $(".copy2").clone().appendTo(".nav2");
            
        });
    </script>
<nav class="navbar navbar-expand-lg p-0 navbar navbar-light light-blue lighten-4">
    <div class="container-fluid p-0">
        <div class="row w-100">
            <div class="col-sm-3 center-align-lable">
                <a class="navbar-brand " href="javascript:void(0)"><img src="<?php echo base_url(); ?>application/assets/shared/img/logo.png" alt="Victam logo" height="125" width="270"></a>
            </div>
             <!-- Collapse button -->
  <button class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1"
    aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i
        class="fas fa-bars fa-1x"></i></span></button>


        <div class="mobPanel" id="navbarSupportedContent1">
<div class="nav1"></div>
<div class="nav2"></div>

        </div>

            <div class="col-sm-9 p-0 copy1">
                <div class="row">
                    <div class="col-sm-12"> 
                        <ul class="list-inline float-right pt-2 ml-auto mb-1">
                            <li class="list-inline-item search-inline-item mr-3"> <input class="search expandSearchBox" type="text" id="searchInput" placeholder="Search" value=""> <i class="fa fa-search search-icon" onclick="search_inputs()"></i> </li>
                            <li class="list-inline-item"> <a href="https://victam.com/admin/subscribe" target="_blank"> <i class="fa fa-envelope fa-icon-social"></i> </a> </li>
                            <li class="list-inline-item"> <a href="https://www.linkedin.com/company/victam-international-b-v-/" target="_blank"> <i class="fa fa-linkedin fa-icon-social"></i></a></li>
                            <li class="list-inline-item"> <a href="https://www.facebook.com/VictamInt/" target="_blank"> <i class="fa fa-facebook-square fa-icon-social"></i> </a> </li>
                            <li class="list-inline-item"> <a href="javascript:vois(0)"> <i class="fa fa-google fa-icon-social"></i> </a> </li>
                            <li class="list-inline-item"> <a href="https://twitter.com/VictamInt" target="_blank"> <i class="fa fa-twitter fa-icon-social"></i> </a> </li>
                            <li class="list-inline-item"> <a href="https://www.youtube.com/user/victaminternational" target="_blank"> <i class="fa fa-youtube-play fa-icon-social"></i> </a> </li>
                            <li class="list-inline-item"> <a href="https://www.instagram.com/victamint/" target="_blank"> <i class="fa fa-instagram fa-icon-social"></i> </a> </li>
                        </ul>
                    </div>
                    <div class="col-sm-12">
                        <ul class="navbar-nav ml-auto float-right small-nav-bar pb-2">
                            <li class="nav-item">
                                <a class="nav-link nav-link-item" href="https://victam.com/" target="_blank">Victam Events </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-item" href="http://victamfoundation.com/" target="_blank">Victam Foundation</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-item" href="https://victam.com/contact-forms" target="_blank">Contact</a>
                            </li>
                            <?php if ($this->session->userdata('userId')) : ?>
                                <li class="nav-item userLi">
                                    <div class="dropdown pr-4">
                                        <button type="button" class="btn dropdown-toggle p-0" data-toggle="dropdown">
                                            <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/profile.png" alt="" height="35" width="35">
                                            <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/down-angle-arrow.png" class="down-arrow">
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-profile p-2">
                                            <a class="dropdown-item p-1" href="<?php echo base_url(); ?>profile_setting">
                                                <div class="p-1"><img src="<?php echo base_url(); ?>application/assets/shared/img/icon/profile.png" alt="" height="20" width="20"> <span class="pl-1">Profile settings</span></div>
                                            </a>
                                            <a class="dropdown-item p-1" href="<?php echo base_url(); ?>subscription">
                                                <div class="p-1"><img src="<?php echo base_url(); ?>application/assets/shared/img/icon/subscribe.png" alt="" height="20" width="20"> <span class="pl-1">Manage Subscription</span></div>
                                            </a>
                                            <a class="dropdown-item p-1" href="<?php echo base_url(); ?>delete-account">
                                                <div class="p-1"><i class="fa fa-cogs mr-2 fs-16" aria-hidden="true"></i><span class="pl-1">Manage Account</span></div>
                                            </a>
                                            <div class="mt-2">
                                                <?php echo form_open_multipart('i/LoginController'); ?>
                                                <input type="text" name="logout" class="display-none" value="true" required />
                                                <input type="text" name="logoutusername" class="display-none" value="jk" required />
                                                <a href="<?php echo base_url('logout') ?>" class="text-deco-none"><button class="p-0 pl-1 pr-1 logout-btn dropdown-item" type="submit" value="Submit">
                                                        <div class="p-1"><img src="<?php echo base_url(); ?>application/assets/shared/img/icon/logout.png" alt="" height="20" width="20"> <span class="pl-1">Logout</span></div>
                                                    </button></a>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php else : ?>
                                <li class="nav-item auth-btn-wrap">
                                    <a class="nav-link" href="<?php echo base_url(); ?>register">
                                        <button type="button" class="btn btn-blue btn-sm pl-4 pr-4">Register</button>
                                    </a>
                                </li>
                                <li class="nav-item auth-btn-wrap">
                                    <a class="nav-link pr-0" href="<?php echo base_url(); ?>login">
                                        <button type="button" class="btn btn-blue-border btn-sm pl-4 pr-4">Sign In</button>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Navigation Bar ------------------------------------------ -->

<nav class="navbar navbar-expand-lg main-navbar copy2">
    <ul class="navbar-nav nav-justified-items w-100 nav-ui">
        <li class="nav-item "><a class="nav-link nav-link-item-1 p-0" href="<?php echo base_url(); ?>">
                <span <?php if ($activePage == "home") : ?>class="active-main" <?php endif; ?>>Home</span> </a>
        </li>
        <li class="nav-item nav-item-dropdown">
            <a class="nav-link nav-link-item-1 p-0" href="javascript:void(0)" onclick="check_login_user( 'mrkt_info' , <?php echo $this->session->userdata('userId'); ?> )" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span <?php if ($activePage == "marketInfo") : ?>class="active-main" <?php endif; ?>>Market Information</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="mrktInfoNavbarDrpdnLink">
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="mrktIn_menu_clickHandel( 'news'  , <?php echo $this->session->userdata('userId'); ?> )">  <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/group_231.png" class="mr-3" height="16" width="15"> News</a>
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="mrktIn_menu_clickHandel( 'interview'  , <?php echo $this->session->userdata('userId'); ?> )"> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/group_228.png" class="mr-3" height="16" width="15"> Interviews</a>
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="mrktIn_menu_clickHandel( 'articles'  , <?php echo $this->session->userdata('userId'); ?> )"> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/group_230.png" class="mr-3" height="16" width="15"> Articles</a>
            </div>
        </li>
        <li class="nav-item nav-item-dropdown">
            <a class="nav-link nav-link-item-1 p-0 " id="whoiswhoNavbarDrpdnLink" href="javascript:void(0)" onclick="check_login_user( 'whoiswho' , <?php echo $this->session->userdata('userId'); ?> )">
                <span <?php if ($activePage == "whoIsWho") : ?>class="active-main" <?php endif; ?>>Who Is Who</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="whoiswhoNavbarDrpdnLink">
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="directory_clickHandel( '<?php echo $plan_id ?>', '<?php echo $userId ?>' )"> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/CompanyDirectory.png" class="mr-3" height="20" width="16"> Company Directory</a>
            </div>
        </li>
        <li class="nav-item nav-item-dropdown">
            <a class="nav-link nav-link-item-1 p-0" id="resourceLibraryNavbarDrpdnLink" href="javascript:void(0)" onclick="check_login_user( 'resourceLibrary' , <?php echo $this->session->userdata('userId'); ?> )">
                <span <?php if ($activePage == "resourceLibrary") : ?>class="active-main" <?php endif; ?>>Resource Library</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="resourceLibraryNavbarDrpdnLink">
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="resource_menu_clickHandel( 'research'  , <?php echo $this->session->userdata('userId'); ?> )"> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/Research_Innovation.png" class="mr-3" height="16" width="15"> Research & Innovation</a>
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="resource_menu_clickHandel( 'caseStudies'  , <?php echo $this->session->userdata('userId'); ?> )"> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/Case_Studies.png" class="mr-3" height="16" width="15"> Case Studies</a>
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="resource_menu_clickHandel( 'whitepapers'  , <?php echo $this->session->userdata('userId'); ?> )"> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/Publications.png" class="mr-3" height="16" width="15"> Whitepapers</a>
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="resource_menu_clickHandel( 'publications'  , <?php echo $this->session->userdata('userId'); ?> )"> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/Whitepapers.png" class="mr-3" height="16" width="15"> Publications</a>
            </div>
        </li>
        <li class="nav-item nav-item-dropdown">
            <a class="nav-link nav-link-item-1 p-0 " href="javascript:void(0)" onclick="check_login_user( 'events' , <?php echo $this->session->userdata('userId'); ?> )" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span <?php if ($activePage == "events") : ?>class="active-main" <?php endif; ?>>Events</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="eventsNavbarDrpdnLink">
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="events_menu_click_handel( 'calender' , '<?php echo $plan_id ?>', '<?php echo $userId ?>' )"> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/group_234.png" class="mr-3" height="15" width="15"> Event Calendar</a>
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="events_menu_click_handel( 'online' , '<?php echo $plan_id ?>', '<?php echo $userId ?>' )"> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/group_235.png" class="mr-3" height="15" width="15"> Online Events</a>
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="events_menu_click_handel( 'onsite' , '<?php echo $plan_id ?>', '<?php echo $userId ?>' )"> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/group_235.png" class="mr-3" height="15" width="15"> Onsite Events</a>
            </div>
        </li>
        <li class="nav-item nav-item-dropdown">
            <a class="nav-link nav-link-item-1 p-0" id="matchmakingNavbarDrpdnLink" href="javascript:void(0)" onclick="check_login_user( 'matchmaking' , <?php echo $this->session->userdata('userId'); ?> )">
                <span <?php if ($activePage == "matchmaking" ) : ?>class="active-main" <?php endif; ?>>Matchmaking</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="matchmakingNavbarDrpdnLink">
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="match_making_clickHandel( 'suppliers'  , '<?php echo $plan_id ?>', '<?php echo $userId ?>', '<?php echo $matchmaking ?>')"> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/find_suppliers.png" class="mr-3" height="16" width="15">Find Suppliers</a>
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="match_making_clickHandel( 'buyers'  , '<?php echo $plan_id ?>', '<?php echo $userId ?>', '<?php echo $matchmaking ?>')"> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/find_buyers.png" class="mr-3" height="16" width="15">Find Buyers</a>
            </div>
        </li>
        <li class="nav-item nav-item-dropdown">
            <a class="nav-link nav-link-item-1 p-0" href="javascript:void(0)" id="jobsNavbarDrpdnLink" onclick="check_login_user( 'jobs' , <?php echo $this->session->userdata('userId'); ?> )" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span <?php if ($activePage == "jobs") : ?>class="active-main" <?php endif; ?>>Jobs</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="jobsNavbarDrpdnLink">
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="job_menu_clickHandel( 'vacancies', '<?php echo $plan_id ?>', '<?php echo $userId ?>', '<?php echo $this->session->userdata('job_plan')?>' )"> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/group_233.png" class="mr-3" height="16" width="15"> Vacancies</a>
                <a class="dropdown-item mr-2" href="javascript:void(0)" onclick="job_menu_clickHandel( 'placeJob', '<?php echo $plan_id ?>', '<?php echo $userId ?>', '<?php echo $this->session->userdata('job_plan')?>' )"> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/group_232.png" class="mr-3" height="16" width="15"> Place a Job</a>
            </div>
        </li>
        <li class="nav-item ">
            <a class="nav-link nav-link-item-1 p-0" href="javascript:void(0)" onclick="check_login_user( 'forums' , <?php echo $this->session->userdata('userId'); ?> )">
                <span <?php if ($activePage == "forums") : ?>class="active-main" <?php endif; ?>>Forums</span></a>

        </li>
        <li class="nav-item nav-item-dropdown">
            <a class="nav-link nav-link-item-1 p-0" href="javascript:void(0)" onclick="check_login_user( 'entertainment' , <?php echo $this->session->userdata('userId'); ?> )" id="vrtulNavbarDrpdnLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span <?php if ($activePage == "virtualEntertainment") : ?>class="active-main" <?php endif; ?>>Virtual Entertainment</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="vrtulNavbarDrpdnLink">
                <a class="dropdown-item" href="javascript:void(0)" onclick="check_login_user( 'entertainment_video' , <?php echo $this->session->userdata('userId'); ?> )">Videos</a>
            </div>
        </li>
    </ul>
</nav>

<!-- <?php print_r($this->session->userdata('userId')); ?> -->

