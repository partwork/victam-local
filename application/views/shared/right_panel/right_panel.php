<?php $this->load->view('shared/right_panel/rp_css_js_helpers'); ?>
<?php $plan_id = (isset($_SESSION['plan_id'])) ? $_SESSION['plan_id'] : ''; ?>
<?php $userId = (isset($_SESSION['userId'])) ? $_SESSION['userId'] : '';
$matchmaking = (isset($_SESSION['matchmaking_plan'])) ? $_SESSION['matchmaking_plan'] : '';
?>

<section class="right-panel mb-3">
    <div class="ad-btn-wrap">
        <button type="button" onclick="involved_click_handel( 'advertise', '<?php echo $plan_id ?>', '<?php echo $userId ?>' )" class="btn btn-advertise btn-sm l-arrow"> <i class="fa fa-hand-o-right r-arrow" aria-hidden="true"></i> Advertise With Us!</button>
    </div>

    <h6 class="pt-3 right-panel-title">Promoted Video</h6>
    <div id="promotedVideo" class="carousel slide" data-ride="carousel" style="overflow:hidden">
        <div class="carousel-inner" id="promotedv">
        </div>
    </div>


    <h6 class="pt-3 right-panel-title">Get Involved</h6>

    <button type="button" onclick="involved_click_handel( 'listCompany', '<?php echo $plan_id ?>', '<?php echo $userId ?>' )" class="btn btn-involved btn-sm">List your Company!</button>
    <button type="button" onclick="involved_click_handel( 'startForum','<?php echo $plan_id ?>', '<?php echo $userId ?>' )" class="btn btn-involved btn-sm mt-2">Start a Forum</button>
    <button type="button" onclick="involved_click_handel( 'writeForUs', '<?php echo $plan_id ?>', '<?php echo $userId ?>' )" class="btn btn-involved btn-sm mt-2">Write for Us</button>


    <h6 class="pt-3 right-panel-title">Find Supplier or Client</h6>

    <button type="button" onclick="match_making_clickHandel( 'others'  , '<?php echo $plan_id ?>', '<?php echo $userId ?>','<?php echo $matchmaking ?>')" class="btn btn-involved btn-sm">Start Matchmaking</button>
    <button type="button" onclick="directory_clickHandel( '<?php echo $plan_id ?>', '<?php echo $userId ?>' )" class="btn btn-involved btn-sm mt-2">Company Directory</button>

    <h6 class="pt-3 right-panel-title">Top Rated Events</h6>
    <div class="card rated-card">
        <div id="topRatedEvents"></div>
    </div>

    <h6 class="pt-3 right-panel-title">Upcoming Events</h6>
    <div class="card rated-card">
        <div id="upcomingEvents5"></div>
    </div>

</section>