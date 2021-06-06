<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <input type="hidden" id="reqpage" value="Add your events form">

        <?php $this->load->view('shared/header/header'); ?>

        <section class="pb-5 pl-5  event-calender ">
            <div class="row">
                <div class="col-sm-9">
                    <div class="pl-3 mt-4">
                        <h4>EVENT CALENDAR</h4>
                        <div class="row">
                            <div class="col">
                                <div class="search-input-width">
                                    <div class="form-group">
                                        <input type="text" id="search" class="form-control form-control-custom pr-5" placeholder="Search for event by keywords">
                                        <i class="fa fa-search news-search-icon" id="search1"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group row">
                                    <label for="DisplaySector" class="col-sm-2 col-form-label select-industry-label pl-0 text-right">Display</label>
                                    <div class="col-sm-10 pl-3">
                                        <select class="form-control text-light-grey" id="sector" name="sector">
                                            <option value="AllSectors" class="selected-option" selected>All Sectors</option>
                                            <?php foreach ($sectors as $sector) : ?>
                                                <option value="<?= $sector->vic_bn_sector_name ?>" <?php if ($sector->vic_bn_sector_name == $findSector) echo "selected"; ?>><?= $sector->vic_bn_sector_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group row">
                                    <label for="DisplaySector" class="col-sm-2 col-form-label select-industry-label pl-0 text-right">Type</label>
                                    <div class="col-sm-10 pl-2">
                                        <select class="form-control text-light-grey" id="event_type">
                                            <option value="AllEvents" class="selected-option" selected>All events</option>
                                            <option value="online" <?php if($type == 'online') echo "selected"; ?>>Online events</option>
                                            <option value="onsite" <?php if($type == 'onsite') echo "selected"; ?>>Onsite events</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row event-section ml-1">
                        <div class="col-sm-5 pl-0 pr-0">
                            <div id="container" class="calendar-container"></div>
                        </div>
                        <div class="col-sm-7 pl-0 pr-0">
                            <div class="d-flex event-title-section">
                                <h5 class="event-title">Events</h5>
                                <a href="<?php echo base_url(); ?>events/add-event">
                                    <button class="btn btn-blue btn-add-event btn-sm pr-3 pl-3">Add Event</button>
                                </a>
                            </div>
                            <!-- list-events -->
                            <div class="p-4 list-events" id="accordion">
                                <?php $month = array();
                                foreach ($events as $k => $event) : ?>
                                    <?php 
                                        if(date('Y-m-d', strtotime($event->vic_date)) >= date('Y-m-d'))
                                            $m = date('m', strtotime($event->vic_date));
                                        else
                                            $m = date('m');
                                        if (!in_array($m, $month)) {
                                            array_push($month, $m);
                                            if(date('Y-m-d', strtotime($event->vic_date)) >= date('Y-m-d')){ ?>
                                                <p class="mb-0 event-date mt-3"><?= date('F Y', strtotime($event->vic_date)) ?></p>
                                            <?php }else{ ?>
                                                <p class="mb-0 event-date mt-3"><?= date('F Y') ?></p>
                                            <?php }
                                        }
                                    ?>

                                    <div class="card mt-2 mb-2 event-card">
                                        <div id="">
                                            <div class="event-calender-info">
                                                <a href="<?php echo base_url();?>events/event-details/<?= $event->idvic_events ?>" class="ongoing-event-title"> <span class="ongoing-event-date"><?php if($event->vic_eventfrequency == 'Custom') echo date('d M', strtotime($event->vic_eventstartdate)).' - '.date('d M', strtotime($event->vic_eventenddate)); else echo date('d/m') ?></span> <span class="ongoing-event-name"><?= $event->vic_eventtitle ?></span> </a>
                                                <span class="ongoing-event-time"><?= $event->vic_eventtype ?> Event | <?= $event->vic_eventtime ?> </span>
                                                <span class="plus-icon float-right" data-toggle="collapse" data-target="#collapse<?= $k ?>" aria-expanded="<?php if ($k == 0) echo 'true' ?>" aria-controls="collapse<?= $k ?>"> 
                                                    <i class="fa fa-plus plus-icon"></i> 
                                                    <i class="fa fa-minus plus-icon"></i> 
                                                </span>
                                            </div>

                                            <div id="collapse<?= $k ?>" class="collapse <?php if ($k == 0) echo 'show' ?>" data-parent="#accordion">
                                                <div class="p-3 event-details f-14">
                                                    <?php if($event->vic_eventdesc==null || $event->vic_eventdesc==""){
                                                        echo "No description here";
                                                    }else{
                                                        echo strlen($event->vic_eventdesc) > 250 ? substr($event->vic_eventdesc, 0, 250) . "..." : $event->vic_eventdesc;
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3" id="advertisment-list">
                </div>
            </div>
        </section>


        <!-- <section class="pb-5 pl-5 single-event-details display-none">
            <section class="pl-3 pr-5">
                <div class="row mt-4">
                    <div class="col-sm-8">
                        <h4 class="text-title-small fw-500 mb-1">2020 VICTAM</h4>
                        <p class="single-event-title">Exhibition | 9th December 2020 | 3:00 - 7:00 ICT</p>
                    </div>
                    <div class="col-sm-4 text-right d-flex">
                        <div class="dropdown">
                            <button type="button" class="btn btn-involved pl-3 pr-3 m-1">Register</button>
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
                                    <a href="<?php echo base_url(); ?>events/conclusion_report" class="badge badge-blue">More</a>
                                </div>
                                <div class="dropdown-item-2 p-3">
                                    <h6>Logo - Ads - Banners</h6>
                                    <p class="f-14 mb-1">Visit the page to download banners, advertisements,
                                        and logos about the exhibition.</p>
                                    <a href="<?php echo base_url(); ?>events/logo_ads_banner" class="badge badge-blue">More</a>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <a href="<?php echo base_url(); ?>events/contact" class="btn btn-involved pl-3 pr-3 m-1">Contact</a>
                        </div>
                        <div class="dropdown">
                            <button type="button" class="btn btn-blue btn-back-event pl-3 pr-3 m-1 ml-5">Back</button>
                        </div>
                    </div>
                </div>
                <h4 class="text-title-small fw-500 mb-2 mt-4">About the event</h4>
                <p class="f-14 text-title-small">VICTAM International is by far the world’s largest dedicated event for the animal feed processing industries. Co-located with VICTAM International is GRAPAS International, the event for the grain, flour,
                    and rice processing industries. The exhibition is a ‘one-stop’ show for the decision-makers within these industries. Each visitor will be able to find what they are looking for, all under one roof over three
                    days. The event also focuses on a series of high-quality industry conferences and business matchmaking with colleagues and clients.</p>
                <h4 class="text-title-small fw-500 mb-2 mt-5">Organizer</h4>
                <p class="f-14 text-title-small">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                <div class="row">
                    <div class="col-sm-6 pr-5 mt-5">
                        <div class="d-flex mb-2 align-items-center">
                            <h4 class="text-title-small fw-500 mb-2">Video gallery</h4>
                            <a href="<?php echo base_url(); ?>events/video_gallery" class="text-blue see-more f-14 mb-2">See More</a>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <iframe width="100%" height="150px" src="https://www.youtube.com/embed/30xKASi5j80" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="col-sm-4">
                                <iframe width="100%" height="150px" src="https://www.youtube.com/embed/OmtJ3opTHQM" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="col-sm-4">
                                <iframe width="100%" height="150px" src="https://www.youtube.com/embed/N14-Y0JK_xg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 pr-5 mt-5">
                        <div class="d-flex mb-2 align-items-center">
                            <h4 class="text-title-small fw-500 mb-2">Photo gallery</h4>
                            <a href="<?php echo base_url(); ?>events/photo_gallery" class="text-blue see-more f-14 mb-2">See More</a>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <a href="#">
                                    <img class="photo" src="<?php echo base_url(); ?>application/assets/shared/img/photos/1.png">
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="#">
                                    <img class="photo" src="<?php echo base_url(); ?>application/assets/shared/img/photos/2.png">
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <a href="#">
                                    <img class="photo" src="<?php echo base_url(); ?>application/assets/shared/img/photos/3.png">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section> -->
        <section class="mt-5">
            <?php $this->load->view('shared/footer/footer'); ?>
        </section>
        <!-- Chatbot -->
        <?php $this->load->view('shared/chatbot/chatbot'); ?>

    </div>
</body>