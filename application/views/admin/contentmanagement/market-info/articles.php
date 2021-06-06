<div class="container-fluid body-wrapper pl-24vw">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Articles</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Market Information</li>
                            <li class="breadcrumb-item active" aria-current="page">Articles</li>
                        </ol>
                    </nav>
                </h4>
                <a href="<?php echo base_url('admin/content-management/market-info/add-articles') ?>" class="btn btn-blue float-right f-14 pl-4 pr-4">Add New Articles</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="filter-wrap">
                <div class="status-wrap">
                    <label for="artsectorFilter">Industry sector</label>
                    <select id="artsectorFilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Industry sector</option>
                        <option value="processing technology">Processing Technology</option>
                        <option value="ingredients and additives">Ingredients & Additives</option>
                        <option value="rice and flour milling">Rice & Flour Miling</option>
                    </select>
                </div>
                <div class="status-wrap">
                    <label for="statusFilter">Status Filter</label>
                    <select id="artstatusFilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Status</option>
                        <option value="Under Review">Under Review</option>
                        <option value="Published">Published</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>
                <div class="search-wrap">
                    <input type="text" class="form-control" id="artinput_search" placeholder="Search">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="table-wrapper">
                <table id="articles" class="display table" style="width:100%;table-layout:fixed;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sector</th>
                            <th class="big-col">Description</th>
                            <th>Modification</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <!-- <?php
                           if(isset($article_list) && !empty($article_list)):
                                $i=0;
                              foreach ($article_list as $value):
                                  $date1 = new DateTime($value->vic_updated_at);
                                $date2 = new DateTime();

                                $diff = $date2->diff($date1);

                                $hours = $diff->h;
                                $hours = $hours + ($diff->days*24);
                                
                                
                        ?>
                           <tr>
                            <td><?php echo $value->vic_bn_title;?></td>
                            <td><?php echo $value->vic_description;?></td>
                            <td class="text-green"><?php echo $i.' hours';?></td>
                            <td class="text-blue"><?php echo $value->vic_modification_status;?></td>
                            <td>
                                <div class="action-btn-wrap">
                                    <a href="<?php echo base_url('admin/edit_marketing_info/'.$value->idvic_blogs_news);?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a data-id="<?php echo $value->idvic_blogs_news;?>" class="ml-3 delete_mkt_info"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
                            <button type="button" onclick="delete_article()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                            <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>