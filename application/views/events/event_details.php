<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <section class="pb-5 pl-5 single-event-details">
            <section class="pl-3 pr-5">
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-sm btn-blue btn-back-event float-right mb-3  mt-3 pl-4 pr-4">Back</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <h4><?= $event->vic_eventtitle ?></h4>
                        <?php if($event->vic_eventfrequency == 'Custom') $eventDate = date('d F Y', strtotime($event->vic_eventstartdate)).' - '.date('d F Y', strtotime($event->vic_eventenddate)); 
                        else if(date('Y-m-d', strtotime($event->vic_date)) >= date('Y-m-d')) $eventDate = date('d F Y', strtotime($event->vic_date));
                        else $eventDate =  date('d F Y') ?>
                        <p class="single-event-title"><?= $event->vic_eventtype ?> Event | <?=$eventDate?> | <?php echo $event->vic_eventtime ?></p>
                    </div>
                    <div class="col-sm-4 text-right d-flex justify-content-end">
                        <div class="dropdown">
                            <?php 
                                if($event->vic_registration_url !=null && $event->vic_registration_url!=""){
                                    $url=$event->vic_registration_url;
                                }else{
                                    $url=$event->vic_event_website_url;
                                }
                            ?>
                            <a href="javascript:void(0);" onclick="update_registration_count('<?= $url ?>', '<?= $evntId ?>')">
                                <button type="button" class="btn btn-involved pl-3 pr-3 m-1">Register</button>
                            </a>
                        </div>
                        <div class="dropdown">
                            <button type="button" class="btn btn-involved pl-3 pr-3 m-1" data-toggle="dropdown">
                                Download
                            </button>
                            <div class="dropdown-menu dropdown-menu-1">
                                <div class="dropdown-item-1 p-3">
                                    <h6>Conclusion Report</h6>
                                    <p class="f-14 mb-1">Please visit the page to download the final reports of
                                        IDMA and VICTAM exhibitions.</p>
                                    <a href="<?php echo base_url() ?>events/conclusion_report/<?= $evntId ?>"><span class="badge badge-blue">More</span></a>
                                </div>
                                <div class="dropdown-item-2 p-3">
                                    <h6>Logo - Ads - Banners</h6>
                                    <p class="f-14 mb-1">Visit the page to download banners, advertisements,
                                        and logos about the exhibition.</p>
                                        <a href="<?php echo base_url() ?>events/logo_ads_banner/<?= $evntId ?>"><span class="badge badge-blue">More</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <a href="<?php echo base_url(); ?>events/contact/<?= $evntId ?>" target="_blank">
                                <button type="button" class="btn btn-involved pl-3 pr-3 m-1">Contact</button>
                            </a>
                        </div>

                    </div>
                </div>
                <h4>About the event</h4>
                <p class="f-14"><?php if($event->vic_eventdesc==null || $event->vic_eventdesc==""){
                                                        echo "No description here";
                                                    }else{ echo $event->vic_eventdesc; }?></p>

                <h4>Organizer</h4>
                <p class="f-14"><?= $event->vic_organizer ?></p>
                <div class="row">
                    <div class="col-sm-6 pr-5">
                        <div class="d-flex mb-2">
                            <h4>Video gallery</h4>
                            <?php $videogallery = explode(",",$event->vic_video);
                                if(count($videogallery) > 3 ):
                            ?>
                            <a href="<?php echo base_url() ?>events/video_gallery/<?= $evntId ?>" class="text-blue see-more">See More</a>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php 
                            if($event->vic_video != null) :
                            $videogallery = explode(",",$event->vic_video); 
                            foreach($videogallery as $k=>$vg) : 
                            if($k < 3) {
                            ?>
                            <div class="col-sm-4">
                                <iframe width="100%" height="150px" src="<?php echo base_url() ."upload/event/video/". $vg ?>" frameborder="0" class="w-100" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <?php } endforeach; endif;?>
                        </div>
                    </div>
                    <div class="col-sm-6 pr-5">
                        <div class="d-flex mb-2">
                            <h4>Photo gallery</h4>
                            <?php $imagegallery = explode(",",$event->vic_photos); 
                                if(count($imagegallery) > 3 ):
                            ?>
                            <a href="<?php echo base_url() ?>events/photo_gallery/<?= $evntId ?>" class="text-blue see-more">See More</a>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <?php 
                            if($event->vic_photos != null) :
                            $imagegallery = explode(",",$event->vic_photos); 
                            foreach($imagegallery as $a=>$mg) : 
                                if($a <= 2){
                            ?>
                            <div class="col-sm-4">
                                <a href="#">
                                    <img class="photo" src="<?php echo base_url() ."upload/event/".$mg; ?>">
                                </a>
                            </div>
                            <?php } endforeach;endif; ?>
                        </div>
                    </div>
                </div>

            </section>
        </section>

        <section class="mt-5">
            <?php $this->load->view('shared/footer/footer'); ?>
        </section>

    </div>
</body>