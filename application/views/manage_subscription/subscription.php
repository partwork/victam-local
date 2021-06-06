<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <img src="<?php echo base_url(); ?>application/assets/shared/img/bottom-left-ellipse.png" class="img-ellipse" />
        <img src="<?php echo base_url(); ?>application/assets/shared/img/bottom-left-ellipse.png" class="img-ellipse2" />
        <div class="row">
            <div class="col-sm-12">
                <h3 class="mt-5 mb-4 text-center">Manage Subscriptions </h3> 
                <div class="subscription-card-wrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- First Table -->
                            <div class="table-wrapper">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Your Subscription</th>
                                            <th>Plan Cost</th>
                                            <th>Renewal Date</th>
                                            <!-- <th></th> -->
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-bb">
                                    <?php 
                                        $planArr = array();
                                        foreach($subscriptions as $sub) : ?>
                                        <?php array_push($planArr,$sub->fk_plan_id); ?>
                                        <tr>
                                            <td><?=$sub->vic_pricingplanname?></td>
                                            <td>€ <?=$sub->vic_pricing_amount?> / <?=$sub->vic_pricing_plan_duration?></td>
                                            <td><?php echo date('d',strtotime($sub->vic_stripe_orders_plan_end_dt)) ?><sup>th</sup> <?php echo date('M Y',strtotime($sub->vic_stripe_orders_plan_end_dt)) ?></td>
                                            
                                            <?php if(isset($sub->vic_stripe_orders_status) && $sub->vic_stripe_orders_status=='live') : ?>
                                            <td class="text-right">
                                                <?php
                                                $subscriptionsDate = date('Y-m-d',strtotime($sub->idvic_stripe_orders));
                                                $today = date('Y-m-d');
                                                if($subscriptionsDate <= $today) : ?>
                                                <a href="cancelSubscription/<?=$sub->idvic_stripe_orders?>"><button type="button" class="btn btn-sm btn-blue">Cancel Membership</button></a>
                                                <?php endif; ?>    
                                            </td>
                                            <?php else :?>
                                            <td class="text-right"><button type="button" class="btn btn-sm btn-danger"><?=$sub->vic_stripe_orders_status?></button></td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>Add-On Plan</th>
                                            <th>Plan Cost</th>
                                            <th>Renewal Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($addon_subscriptions as $sub) : ?>
                                        <?php array_push($planArr,$sub->fk_plan_id); ?>
                                        <tr>
                                            <td><?=$sub->vic_pricingplanname?></td>
                                            <td>€ <?=$sub->vic_pricing_amount?> / <?=$sub->vic_pricing_plan_duration?></td>
                                            <td><?php echo date('d',strtotime($sub->vic_stripe_orders_plan_end_dt)) ?><sup>th</sup> <?php echo date('M Y',strtotime($sub->vic_stripe_orders_plan_end_dt)) ?></td>
                                            <?php if($sub->vic_stripe_orders_status!='cancelled') : ?>
                                            <td class="text-right">
                                            <?php
                                                $subscriptionsDate = date('Y-m-d',strtotime($sub->idvic_stripe_orders));
                                                $today = date('Y-m-d');
                                                if($subscriptionsDate >= $today) : ?>
                                                <a href="e/PricingController/cancelSubscription/<?=$sub->fk_plan_id?>"><button type="button" class="btn btn-sm btn-blue">Cancel Membership</button></a>
                                            <?php endif; ?>  
                                            </td>
                                            <?php else :?>
                                            <td class="text-right"><button type="button" class="btn btn-sm btn-danger">Cancelled</button></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <!-- Change Plan Section -->
                    <div class="change-plan-wrap bg-khaki">
                        <h5>Change Plan</h5>
                        <ul>
                            <?php foreach($plans as $p) : ?>
                            <li class="text-left">
                                <div class="row w-100">
                                    <div class="col-sm-6">
                                    <p><?=$p->vic_pricingplanname?></p>
                                    </div>
                                    <div class="col-sm-3">
                                    <p><?php if ($p->vic_pricing_amount == 0) echo "Free"; else echo "€".$p->vic_pricing_amount."/".$p->vic_pricing_plan_duration; ?></p>
                                    </div>
                                    <div class="col-sm-3 text-right">
                                    <?php
                                    if($p->vic_pricing_amount == 0){
                                        $paymentLink = 'e/PricingController/freePlan';
                                    }else{
                                        $paymentLink = 'e/PricingController/get_hosted_paymentpage/'.$p->idvic_pricing_plans;
                                    }
                                    $disabled='';
                                    if(($this->session->userdata('free_plan') == 'false' && $p->vic_pricing_amount == 0) || in_array($p->idvic_pricing_plans,$planArr)){
                                        $disabled='disabled';
                                    }
                                ?>
                                <p><a href="<?php echo base_url($paymentLink)?>"><button type="button" class="btn btn-blue btn-sm" <?=$disabled?>><?php if($p->vic_pricing_amount == 0) echo "TRY IT NOW"; else echo "BUY NOW";?></button></a></p>
                                    </div>
                                </div>

                               
                               
                               
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="congrats" role="dialog" aria-labelledby="congrats" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" id="closemodal" class="close" >
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body p-5">
                    <div class="text-center">
                    <img class="mb-4" src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                   

                        <div id="basicText">
                        <span>
                        <h3 class="text-red f-14">Thank you for subscribing!</h3>
                        <p class="mb-0">You have successfully subscribed to Victam Portal</p>
                        </span></div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(isset($_GET['payment_success']) && $_GET['payment_success']==1) { ?>
    <script>
        $('#congrats').modal('toggle');
    </script>
<?php } ?>
</body>
<?php if ($this->session->flashdata('flash_success')) { ?>
    <script>
        toastr["success"]("<?= $this->session->flashdata('flash_success') ?>");
    </script>
<?php }
if ($this->session->flashdata('flash_error')) { ?>
    <script>
        toastr["error"]("<?= $this->session->flashdata('flash_error') ?>");
    </script>
<?php } ?>