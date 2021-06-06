<aside class="side-menu-wrapper big-side-menu w-22vw">

    <?php if($this->session->userdata('usertype') == 'super admin') : ?>
        <div class="side-menu-sub-wrap">
            <h6 class="menu-title h-small-menu">USER MANAGEMENT</h6>
            <ul class="menu-items-wrap">
                <li class="menu-item">
                    <div <?php if ($activePage == "userManagement" || $activePage == "Add User" || $activePage == "Edit User" ) : ?>class="active" <?php endif; ?>>
                    <a href="<?php echo base_url('admin/manage-user') ?>" class="menu-item-link">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/manage_user.png" class="inactive-img">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/manage_user_active.png" class="active-img">
                        <span class="h-small-menu">Manage User</span>
                    </a>
                    </div>
                </li>
            </ul>
        </div>
    <?php endif; ?>
        
    <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'publisher - moderator' || $this->session->userdata('usertype') == 'content moderator') : ?>    
        <div class="side-menu-sub-wrap">
            <h6 class="menu-title h-small-menu">CONTENT MANAGEMENT</h6>
            <ul class="menu-items-wrap">
                <li class="menu-item-drp">
                    <a href="#" class="menu-item-link-dropdown " id="homeMenuItem">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/home.png" class="inactive-img">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/home_active.png" class="active-img">
                        <span class="h-small-menu">Home</span>
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/down-angle-arrow.png" class="down-arrow h-small-menu">
                    </a>
                    <ul class="sub-menu-items-wrap">
                        <li class="sub-menu-item">
                            <div <?php if ($activePage == "news" || $activePage == "Update News" || $activePage == "Add News"  ) : ?>class="active" <?php endif; ?>>
                                <a href="<?php echo base_url('admin/content-management/home/latest-news') ?>" class="sub-menu-item-link">
                                    <span class="h-small-menu">Latest News</span>
                                </a>
                            </div>
                        </li>
                        <li class="sub-menu-item">
                            <div <?php if ($activePage == "interviews" || $activePage == "Add Interviews" || $activePage == "Update Interviews") : ?>class="active" <?php endif; ?>>
                                <a href="<?php echo base_url('admin/content-management/home/latest-interview') ?>" class="sub-menu-item-link">
                                    <span class="h-small-menu">Latest Interviews</span>
                                </a>
                            </div>
                        </li>
                        <li class="sub-menu-item">
                            <div <?php if ($activePage == "banner" || $activePage == "Add Banner" || $activePage == "Update Banner" ) : ?>class="active" <?php endif; ?>>
                                <a href="<?php echo base_url('admin/content-management/home/banners') ?>" class="sub-menu-item-link">
                                    <span class="h-small-menu">Banners</span>
                                </a>
                            </div>
                        </li>
                        <li class="sub-menu-item">
                            <div <?php if ($activePage == "logos" || $activePage == "Update Logo" || $activePage == "Add Logo") : ?>class="active" <?php endif; ?>>
                                <a href="<?php echo base_url('admin/content-management/home/logos') ?>" class="sub-menu-item-link">
                                    <span class="h-small-menu">Logos</span>
                                </a>
                            </div>
                        </li>
                        <li class="sub-menu-item">
                            <div <?php if ($activePage == "videos" || $activePage == "Add Promoted Video" ) : ?>class="active" <?php endif; ?>>
                                <a href="<?php echo base_url('admin/content-management/home/promoted-videos') ?>" class="sub-menu-item-link">
                                    <span class="h-small-menu">Promoted Videos</span>
                                </a>
                            </div>
                        </li>
                        <li class="sub-menu-item">
                            <div <?php if ($activePage == "advertisements" || $activePage == "Add Advertisements" || $activePage == "Update Advertisements" ) : ?>class="active" <?php endif; ?>>
                                <a href="<?php echo base_url('admin/content-management/home/advertisement') ?>" class="sub-menu-item-link">
                                    <span class="h-small-menu">Advertisements</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="menu-item-drp">
                    <a href="#" class="menu-item-link-dropdown" id="marketMenuItem">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/market_info.png" class="inactive-img">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/market_info_active.png" class="active-img">
                        <span class="h-small-menu">Market Information</span>
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/down-angle-arrow.png" class="down-arrow h-small-menu">
                    </a>
                    <ul class="sub-menu-items-wrap">
                        <li class="sub-menu-item">
                            <div <?php if ($activePage == "marketNews" || $activePage == "Add News" || $activePage == "Update News" ) : ?>class="active" <?php endif; ?>>
                                <a href="<?php echo base_url('admin/content-management/market-info/news') ?>" class="sub-menu-item-link">
                                    <span class="h-small-menu">News</span>
                                </a>
                            </div>
                        </li>
                        <li class="sub-menu-item">
                            <div <?php if ($activePage == "marketInterviews" || $activePage == "Add Interviews" || $activePage == "Update Interviews" || $activePage == "addInterviews" ) : ?>class="active" <?php endif; ?>>
                            <a href="<?php echo base_url('admin/content-management/market-info/interviews') ?>" class="sub-menu-item-link">
                                <span class="h-small-menu">Interviews </span>
                            </a>
                            </div>
                        </li>
                        <li class="sub-menu-item">
                            <div <?php if ($activePage == "marketArticles" || $activePage == "Add Articles" || $activePage == "addArticles"   || $activePage == "addArticles"  ) : ?>class="active" <?php endif; ?>>
                            <a href="<?php echo base_url('admin/content-management/market-info/articles') ?>" class="sub-menu-item-link">
                                <span class="h-small-menu">Articles</span>
                            </a>
                            </div>
                        </li>
                        <li class="sub-menu-item">
                        <div <?php if ($activePage == "marketMagazines" || $activePage == "Add Magazines" || $activePage == "addMagazines" ) : ?>class="active" <?php endif; ?>>
                            <a href="<?php echo base_url('admin/content-management/market-info/magazines') ?>" class="sub-menu-item-link">
                                <span class="h-small-menu">Magazines</span>
                            </a>
                        </div>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                <div <?php if ($activePage == "whoIsWho" || $activePage == "Update Company") : ?>class="active" <?php endif; ?>>
                    <a href="<?php echo base_url('admin/content-management/who-is-who/whoIsWho') ?>" class="menu-item-link">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/who_is_who.png" class="inactive-img">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/who_is_who_active.png" class="active-img">
                        <span class="h-small-menu">Who Is Who</span>
                    </a>
                </div>
                </li>
                <li class="menu-item-drp">
                    <a href="#" class="menu-item-link-dropdown" id="resourceMenuItem">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/resource_library.png" class="inactive-img">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/resource_library_active.png" class="active-img">
                        <span class="h-small-menu">Resource Library</span>
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/down-angle-arrow.png" class="down-arrow h-small-menu">
                    </a>
                    <ul class="sub-menu-items-wrap">
                        <li class="sub-menu-item ">
                        <!-- $type == "innovation" -->
                        <!-- <?php if($type){ ?> <?php if ( $type == "innovation" ) : ?>class="active" <?php endif; ?> <?php }?> -->
                        <div <?php if ($activePage == "researchInnovations") : ?>class="active" <?php endif; ?> 
                            <?php if ($activePage == "Edit" || $activePage == "Add" ) : ?> <?php if ( $type == "innovation" ) : ?>class="active" <?php endif; ?> <?php endif; ?> >
                            <a href="<?php echo base_url('admin/content-management/resource-library/researchInnovations') ?>" class="sub-menu-item-link">
                                <span class="h-small-menu">Research & Innovations </span>
                            </a>
                        </div>
                        </li>
                        <li class="sub-menu-item">
                        <div <?php if ($activePage == "caseStudies" || $activePage =="Add Case Studies" ) : ?>class="active" <?php endif; ?>
                            <?php if ($activePage == "Edit" || $activePage == "Add" ) : ?> <?php if ( $type == "case_study" ) : ?>class="active" <?php endif; ?> <?php endif; ?>>
                            <a href="<?php echo base_url('admin/content-management/resource-library/caseStudies') ?>" class="sub-menu-item-link">
                                <span class="h-small-menu">Case Studies </span>
                            </a>
                        </div>
                        </li>
                        <li class="sub-menu-item">
                        <div <?php if ($activePage == "whitePaper" || $activePage =="Add White Paper" ) : ?>class="active" <?php endif; ?>
                            <?php if ($activePage == "Edit" || $activePage == "Add" ) : ?> <?php if ( $type == "whitepapers" ) : ?>class="active" <?php endif; ?> <?php endif; ?>>
                            <a href="<?php echo base_url('admin/content-management/resource-library/whitePaper') ?>" class="sub-menu-item-link">
                                <span class="h-small-menu">White Paper </span>
                            </a>
                        </div>
                        </li>
                        <li class="sub-menu-item">
                        <div <?php if ($activePage == "Publications" ) : ?>class="active" <?php endif; ?>
                            <?php if ($activePage == "Edit" || $activePage == "Add" ) : ?> <?php if ( $type == "publication" ) : ?>class="active" <?php endif; ?> <?php endif; ?>>
                            <a href="<?php echo base_url('admin/content-management/resource-library/publications') ?>" class="sub-menu-item-link">
                                <span class="h-small-menu">Publications </span>
                            </a>
                        </div>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                <div <?php if ($activePage == "events" || $activePage == "Add Events" || $activePage == "Edit Event") : ?>class="active" <?php endif; ?>>
                    <a href="<?php echo base_url('admin/contentmanagement/events/events') ?>" class="menu-item-link">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/events.png" class="inactive-img">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/events_active.png" class="active-img">
                        <span class="h-small-menu">Events</span>
                    </a>
                </div>
                </li>
                <li class="menu-item">
                    <div <?php if ($activePage == "forums" || $activePage == "Add Forums" || $activePage == "Edit Forums" ) : ?>class="active" <?php endif; ?>>
                    <a href="<?php echo base_url('admin/content-management/forums/forums') ?>" class="menu-item-link">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/forums.png" class="inactive-img">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/forums_active.png" class="active-img">
                        <span class="h-small-menu">Forums</span>
                    </a>
                    </div>
                </li>
                <li class="menu-item-drp">
                    <a href="#" class="menu-item-link-dropdown" id='virtualEntertainment'>
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/virtual_entertainment.png" class="inactive-img">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/virtual_entertainment_active.png" class="active-img">
                        <span class="h-small-menu">Virtual Entertainment</span>
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/down-angle-arrow.png" class="down-arrow h-small-menu">
                    </a>
                    <ul class="sub-menu-items-wrap">
                        <li class="sub-menu-item">
                    <div <?php if ($activePage == "video" || $activePage == "Add Video" || $activePage == "Edit Video" ) : ?>class="active" <?php endif; ?>>
                            <a href="<?php echo base_url('admin/content-management/virtual-entertainment/video') ?>" class="sub-menu-item-link">
                                <span class="h-small-menu">Video</span>
                            </a>
                    </div>
                        </li>
                        <!-- <li class="sub-menu-item">
                            <a href="<?php echo base_url('admin') ?>" class="sub-menu-item-link">
                                <span class="h-small-menu">Games</span>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="<?php echo base_url('admin') ?>" class="sub-menu-item-link">
                                <span class="h-small-menu">Meeting Room</span>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="<?php echo base_url('admin') ?>" class="sub-menu-item-link">
                                <span class="h-small-menu">Jokes</span>
                            </a>
                        </li> -->
                    </ul>
                </li>
            </ul>
        </div>
    <?php endif; ?>
    <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'admin') : ?>                        
    <div class="side-menu-sub-wrap">
        <h6 class="menu-title h-small-menu">OTHERS</h6>
        <ul class="menu-items-wrap">
            <li class="menu-item">
                <a href="https://accounts.zoho.com/signin?servicename=ZohoSubscriptions&signupurl=https://www.zoho.com/subscriptions/signup/" target="_blank" class="menu-item-link">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/subscription_management.png" class="inactive-img">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/subscription_management_active.png" class="active-img">
                    <span class="h-small-menu">Subscription Management</span>
                </a>
            </li>
        </ul>
    </div>
    <?php endif; ?>
</aside>

<!-- Small Menu -->
<aside class="side-menu-wrapper small-side-menu w-6vw m-left-10">
    <div class="side-menu-sub-wrap text-center">
        <ul class="menu-items-wrap m-0">
            <li class="menu-item">
                <a href="#" class="menu-item-link">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/manage_user.png" class="inactive-img">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/manage_user_active.png" class="active-img">
                </a>
            </li>
        </ul>
    </div>

    <div class="side-menu-sub-wrap text-center">
        <ul class="menu-items-wrap m-0">
            <li class="menu-item-drp">
                <a href="#" class="menu-item-link-dropdown home-menu">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/home.png" class="inactive-img">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/home_active.png" class="active-img">
                </a>

            </li>
            <li class="menu-item-drp">
                <a href="#" class="menu-item-link-dropdown mi-menu">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/market_info.png" class="inactive-img">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/market_info_active.png" class="active-img">
                </a>

            </li>
            <li class="menu-item">
                <a href="<?php echo base_url('admin/content-management/who-is-who/whoIsWho') ?>" class="menu-item-link">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/who_is_who.png" class="inactive-img">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/who_is_who_active.png" class="active-img">
                </a>
            </li>
            <li class="menu-item-drp">
                <a href="#" class="menu-item-link-dropdown rl-menu">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/resource_library.png" class="inactive-img">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/resource_library_active.png" class="active-img">
                </a>

            </li>
            <li class="menu-item">
                <a href="#" class="menu-item-link">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/events.png" class="inactive-img">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/events_active.png" class="active-img">
                </a>
            </li>
            <li class="menu-item">
                <a href="<?php echo base_url('admin/content-management/forums/forums') ?>" class="menu-item-link">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/forums.png" class="inactive-img">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/forums_active.png" class="active-img">
                </a>
            </li>
            <li class="menu-item-drp">
                <a href="#" class="menu-item-link-dropdown ve-menu">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/virtual_entertainment.png" class="inactive-img">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/virtual_entertainment_active.png" class="active-img">
                </a>

            </li>
        </ul>
    </div>

    <div class="side-menu-sub-wrap text-center">
        <ul class="menu-items-wrap m-0">
            <li class="menu-item">
                <a href="#" class="menu-item-link">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/subscription_management.png" class="inactive-img">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/menu-icons/subscription_management_active.png" class="active-img">
                </a>
            </li>
        </ul>
    </div>
    
</aside>

<!-- Small Sub menus -->
<!-- Home -->
<ul class="small-sub-menu-items-wrap home-sub-menu">
    <li class="sub-menu-item">
        <a href="<?php echo base_url('admin/content-management/home/latest-news') ?>" class="sub-menu-item-link">
            <span>Latest News</span>
        </a>
    </li>
    <li class="sub-menu-item">
        <a href="<?php echo base_url('admin/content-management/home/latest-interview') ?>" class="sub-menu-item-link">
            <span>Latest Interviews</span>
        </a>
    </li>
    <li class="sub-menu-item">
        <a href="<?php echo base_url('admin/content-management/home/banners') ?>" class="sub-menu-item-link">
            <span>Banners</span>
        </a>
    </li>
    <li class="sub-menu-item">
        <a href="<?php echo base_url('admin/content-management/home/logos') ?>" class="sub-menu-item-link">
            <span>Logos</span>
        </a>
    </li>
    <li class="sub-menu-item">
        <a href="<?php echo base_url('admin/content-management/home/promoted-videos') ?>" class="sub-menu-item-link">
            <span>Promoted Videos</span>
        </a>
    </li>
    <li class="sub-menu-item">
        <a href="<?php echo base_url('admin/content-management/home/advertisement') ?>" class="sub-menu-item-link">
            <span>Advertisements</span>
        </a>
    </li>
</ul>

<!-- Market Information -->
<ul class="small-sub-menu-items-wrap mi-sub-menu">
    <li class="sub-menu-item">
        <a href="<?php echo base_url('admin/content-management/market-info/news') ?>" class="sub-menu-item-link">
            <span>News</span>
        </a>
    </li>
    <li class="sub-menu-item">
        <a href="<?php echo base_url('admin/content-management/market-info/interviews') ?>" class="sub-menu-item-link">
            <span>Interviews</span>
        </a>
    </li>
    <li class="sub-menu-item">
        <a href="<?php echo base_url('admin/content-management/market-info/articles') ?>" class="sub-menu-item-link">
            <span>Articles</span>
        </a>
    </li>
    <li class="sub-menu-item">
        <a href="<?php echo base_url('admin/content-management/market-info/magazines') ?>" class="sub-menu-item-link">
            <span>Magazines</span>
        </a>
    </li>
</ul>

<!-- Resource Library -->
<ul class="small-sub-menu-items-wrap rl-sub-menu">
    <li class="sub-menu-item active">
        <a href="<?php echo base_url('admin/content-management/resource-library/researchInnovations') ?>" class="sub-menu-item-link">
            <span>Research & Innovations</span>
        </a>
    </li>
    <li class="sub-menu-item">
        <a href="<?php echo base_url('admin/content-management/resource-library/caseStudies') ?>" class="sub-menu-item-link">
            <span>Case Studies</span>
        </a>
    </li>
    <li class="sub-menu-item">
        <a href="<?php echo base_url('admin/content-management/resource-library/whitePaper') ?>" class="sub-menu-item-link">
            <span>White Paper</span>
        </a>
    </li>
    <li class="sub-menu-item">
        <a href="<?php echo base_url('admin/content-management/resource-library/publications') ?>" class="sub-menu-item-link">
            <span>Publications</span>
        </a>
    </li>
</ul>

<!-- Virtual Entertainment -->
<ul class="small-sub-menu-items-wrap ve-sub-menu">
    <li class="sub-menu-item">
        <a href="<?php echo base_url('admin/content-management/virtual-entertainment/video') ?>" class="sub-menu-item-link">
            <span>Video</span>
        </a>
    </li>
    <li class="sub-menu-item">
        <a href="#" class="sub-menu-item-link">
            <span>Games</span>
        </a>
    </li>
    <li class="sub-menu-item">
        <a href="#" class="sub-menu-item-link">
            <span>Meeting Room</span>
        </a>
    </li>
    <li class="sub-menu-item">
        <a href="#" class="sub-menu-item-link">
            <span>Jokes</span>
        </a>
    </li>
</ul>