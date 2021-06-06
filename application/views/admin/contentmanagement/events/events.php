<script src="<?php echo base_url(); ?>application/assets/admin/contentmanagement/events.js"></script>

<div class="container-fluid body-wrapper pl-24vw">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Events</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Events</li>
                        </ol>
                    </nav>
                </h4>
                <a href="<?php echo base_url('admin/contentmanagement/events/addEvents') ?>" class="btn btn-blue float-right f-14 pl-4 pr-4">Add New Events</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="filter-wrap">
                <div class="status-wrap">
                    <label for="monthfilter">Month</label>
                    <select id="evn_monthfilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="status-wrap">
                    <label for="yearfilter">Year</label>
                    <select id="evn_yearfilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Year</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                    </select>
                </div>
                <div class="status-wrap">
                    <label for="statusFilter">Status Filter</label>
                    <select id="evn_statusFilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Status</option>
                        <option value="Under Review">Under Review</option>
                        <option value="Published">Published</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>
                <div class="search-wrap">
                    <input type="text" class="form-control" id="evn_search_input" placeholder="Search">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="table-wrapper">
                <table id="events" class="display table" style="width:100%;table-layout:fixed;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Event Type</th>
                            <th>Event Date</th>
                            <th>Time</th>
                            <th>Modification</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <!-- <?php
                           if(isset($event_list) && !empty($event_list)):
                            foreach ($event_list as $value):
                               
                                $date1 = new DateTime($value->vic_modification_at);
                                $date2 = new DateTime();

                                $diff = $date2->diff($date1);

                                $hours = $diff->h;
                                $hours = $hours + ($diff->days*24);
                        ?>
                           <tr>
                            <td><?php echo $value->vic_eventtitle;?></td>
                            <td><?php echo $value->vic_eventtype;?></td>
                            <td><?php echo date('Y-m-d',strtotime($value->vic_date));?></td>
                            <td><?php echo $value->vic_eventtime;?></td>
                            <td class="text-green"><?php echo $hours.' hours';?></td>
                            <td class="text-blue"><?php echo $value->vic_modification_status;?></td>
                            <td>
                                <div class="action-btn-wrap">
                                    <a href="<?php echo base_url('admin/editEvents/'.$value->idvic_events);?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a data-id="<?php echo $value->idvic_events;?>" class="delete_event ml-3"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php
                             endforeach;
                           endif;
                        ?> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete  Modal -->
<div class="modal fade" id="deleteModal" role="dialog" aria-labelledby="publish" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                        <p class="pt-3 modal-center-text fs-20">Confirm Delete </p>
                        <div class="text-center">
                            <button type="button" onclick="delete_event()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                            <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>