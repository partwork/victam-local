<div class="container-fluid body-wrapper pl-24vw">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Forums</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Forums</li>
                        </ol>
                    </nav>
                </h4>
                <a href="<?php echo base_url('admin/content-management/forums/addForums'); ?>" class="btn btn-blue float-right f-14 pl-4 pr-4">Add New Forums</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="filter-wrap">
                <div class="status-wrap">
                    <label for="monthFilter">Month</label>
                    <select id="monthFilter" class="form-control" required>
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
                    <label for="yearFilter">Year</label>
                    <select id="yearFilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Year</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                    </select>
                </div>
                <div class="status-wrap">
                    <label for="statusFilter">Status Filter</label>
                    <select id="statusFilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Status</option>
                        <option value="Under Review">Under Review</option>
                        <option value="Published">Published</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>
                <div class="search-wrap">
                    <input type="text" class="form-control" id="search_input" placeholder="Search">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="table-wrapper">
                <table id="forums" class="display table" style="width:100%;table-layout:fixed;">
                    <thead class="thead-dark">
                        <tr>
                            <th class="w-40">Title</th>
                            <th>Created Date</th>
                            <th>Modification</th>
                            <!-- <th>Views</th> -->
                            <th>Likes</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <!--  <?php
                           if(isset($forum_list) && !empty($forum_list)):
                              foreach ($forum_list as $value):
                               $date1 = new DateTime($value->vic_forum_modification_dt);
                                $date2 = new DateTime();

                                $diff = $date2->diff($date1);

                                $hours = $diff->h;
                                $hours = $hours + ($diff->days*24); 
                        ?>
                           <tr>
                            <td class="w-40"><?php echo $value->vic_forumname;?></td>
                            <?php $time =  strtotime($value->vic_created_at) ?>
                            <td><?php echo date('F d, Y', $time); ?></td>
            
                            <?php $u_time =  strtotime($value->vic_forum_modification_dt) ?>
                            <td><?php echo $hours.' hours' ?></td>

                            <td class="text-green"><?php echo $value->fcount;?></td>
                            <td class="text-blue"><?php echo $value->vic_modification_status;?></td>
                            <td>
                                <div class="action-btn-wrap">
                                    <a href="<?php echo base_url('admin/edit_forums/'.$value->idvic_forum);?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a data-id="<?php echo $value->idvic_forum;?>" class="ml-3 delete_forums"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

<!-- Delete News Modal -->
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
                            <button type="button" onclick="delete_content()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                            <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>