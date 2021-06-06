<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>
        
        <div id="demo" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/events-onsight-off.png" height="200">
                    <div class="carousel-caption" style="bottom: 20px;">
                        <div class="carousel-caption">
                            <h1 class="carousel-title">ONSITE EVENTS</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pl-5">
        <section class="pl-3 pt-3 mt-3">
            <h4 class="mb-3 text-title-small">ONGOING EVENTS</h4>
            <p class="ongoing-event-month"><?= date('F Y') ?></p>

            <div id="accordion">
                <?php foreach($events as $k=>$event) : ?>
                <?php $date=date('Y-m-d');
                    if(date('Y-m-d',strtotime($event->vic_date)) >= $date) $eventDate = date('d/m',strtotime($event->vic_date));
                    else $eventDate = date('d/m',strtotime($date))
                ?>
                    <div class="card mt-2 mb-2 ml-3 mr-4 event-card">
                        <div id="januaryOne">
                            <div class="event-calender-info" data-toggle="collapse" data-target="#collapse<?=$k?>" aria-expanded="<?php if ($k == 0) echo 'false' ?>" aria-controls="collapse<?= $k ?>">
                                <a href="<?php echo base_url()?>events/event-details/<?= $event->idvic_events ?>"> <span class="ongoing-event-date"><?=$eventDate?> -</span> <span class="ongoing-event-name"><?=$event->vic_eventtitle?></span> </a>
                                <span class="ongoing-event-time"><?=$event->vic_eventtype?> Event | <?=$event->vic_eventtime?></span>
                                <span class="plus-icon float-right"> 
                                    <i class="fa fa-plus plus-icon"></i> 
                                    <i class="fa fa-minus plus-icon"></i>
                                </span>
                            </div>
                            <div id="collapse<?=$k?>" class="collapse " aria-labelledby="januaryOne" data-parent="#accordion">
                                <div class="pl-3 pr-3 pt-2 pb-2 event-details f-14">
                                <?=$event->vic_eventdesc?>
                                </div>
                            </div>
                        </div>
                    </div>    
                <?php endforeach; ?>
            </div>
        </section>
    </section>

    <section class="pl-5">
        <div class="row pr-5">
            <div class="col-sm-12">
                <section class="pt-5 pb-5 pl-4 pr-4">
                    <h4 class="text-title-small">UPCOMING EVENTS</h4>
                    <h6 class="text-title-small up-event-date"><?= date('F Y') ?></h6>
                    <div class="owl-carousel owl-carousel-events2">
                        <?php foreach ($upcoming_events as $event) : ?>
                            <div class="event-item-wrap">
                                <img class="interview-img"  src="<?php echo base_url() .'upload/event/' . $event->vic_logo; ?>" style="width: 100%;">
                                    <div class="text-center">
                                        <a href="<?php echo base_url()?>events/event-details/<?= $event->idvic_events ?>" target="_blank" title="<?= $event->vic_eventtitle ?>"><h6 class="text-danger pt-2 f-14 e-title"><?= $event->vic_eventtitle ?></h6></a>
                                        <div class="text-blue f-14"><?= $event->vic_companyname ?></div>
                                        <diV class="event-name" title="<?= $event->vic_eventtitle ?>"><?= $event->vic_eventtitle ?></diV>
                                        <diV class="event-name"><?= $event->vic_eventtype ?></diV>
                                        <?php $date=date('Y-m-d', strtotime('+1 day'));
                                                            if(date('Y-m-d',strtotime($event->vic_date)) >= $date) $eventDate = date('d M Y',strtotime($event->vic_date));
                                                            else $eventDate = date('d M Y',strtotime($date))
                                                        ?>
                                        <div class="event-date pb-1"><?=$eventDate?></div>
                                    </div>
                                    <a onclick="update_registration_count('<?= $event->vic_event_website_url ?>', '<?= $event->idvic_events ?>')" href="javascript:void(0);" class="btn btn-blue form-control btn-sm">Register</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <section class="img-section pt-5 pb-5 pl-4 pr-4 ">
        <div id="eventBanner" class="row"></div>
    </section>

    <section class="company-logo-section">
        <div class="owl-carousel owl-carousel-logo">
            <?php if ($company_logo) : ?>
                <?php foreach ($company_logo as $logo) : ?>
                    <a href="<?php echo $logo->vic_logo_url; ?>" target="_blank"><img src="<?php echo base_url('upload/company/' . $logo->vic_logo_image_path); ?>" class="img-fluid partners-logo"></a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <?php $this->load->view('shared/footer/footer'); ?>

    <!-- Chatbot -->
    <?php $this->load->view('shared/chatbot/chatbot'); ?>

</body>