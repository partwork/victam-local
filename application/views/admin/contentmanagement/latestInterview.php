<div class="container-fluid body-wrapper pl-24vw">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Latest Interviews</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Home</li>
                            <li class="breadcrumb-item active" aria-current="page">Latest Interviews</li>
                        </ol>
                    </nav>
                </h4>
                <a href="<?php echo base_url('admin/content-management/home/latest-interview/add-latest-interview') ?>" class="btn btn-blue float-right f-14 pl-4 pr-4">Add Interviews</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="filter-wrap">
                <div class="status-wrap">
                    <label for="statusFilter">Status Filter</label>
                    <select id="ltnews_statusFilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">InActive</option>
                    </select>
                </div>
                <div class="search-wrap">
                    <input type="text" class="form-control" placeholder="Search" id="ltnews_search_input">
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="list_div">

        <?php if ($content) : ?>
            <?php foreach ($content as $list) :
                $date = ($list->vic_updated_at != '') ? $list->vic_updated_at : $list->vic_bn_createdat;
            ?>
                <div class="col-sm-3 pl-1 pr-3 mb-3">
                    <div class="interviews-card-wrapper w-100">
                        <div class="card">
                            <?php if ($list->vic_bn_youtubeURL != '') : ?>
                                <iframe class="card-img" src="<?php echo  $list->vic_bn_youtubeURL ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                            <?php elseif ($list->vic_blogs_news_video != '') : ?>

                                <video class="card-img" controls>
                                    <source src="<?php echo base_url('upload/interviews/' . $list->vic_blogs_news_video); ?>" type="video/mp4">
                                    <source src="<?php echo base_url('upload/interviews/' . $list->vic_blogs_news_video); ?>" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            <?php endif; ?>
                            <div class="card-body text-center">
                                <h6 class="card-title f-14 text-blue" title="2020 IDMA"><?php echo $list->vic_bn_title; ?></h6>
                                <p class="card-text text-green-light fs-13 mb-2"><?php echo date('Y-m-d', strtotime($date)); ?>
                                    <?php if ($list->vic_modification_status == 'Rejected') {
                                        echo '<span class="text-red f-14">Rejected</span>';
                                    } else if ($list->vic_modification_status == 'Under Review') {
                                        echo '<span class="text-blue f-14">Under Review</span>';
                                    } else {
                                        echo $list->vic_modification_status;
                                    } ?>
                                </p>
                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <a href="<?php echo base_url('admin/content-management/home/latest-news/get-latest-interview/' . $list->idvic_blogs_news) ?>" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
                                    <?php if ($list->vic_bn_status == 'active') : ?>
                                        <a href="javascript:void(0)" class="btn btn-card toggle-text">
                                            <input type="checkbox" id="check<?php echo $list->idvic_blogs_news;?>" class="mr-2" checked="true" onclick="update_status_interview(<?php echo $list->idvic_blogs_news; ?>, 'inactive')">
                                            <label for="check1" class="m-0 text-blue">Active</label></a>
                                    <?php else : ?>
                                        <a href="javascript:void(0)"  class="btn btn-card toggle-text">
                                            <input type="checkbox" id="check<?php echo $list->idvic_blogs_news;?>" class="mr-2" onclick="update_status_interview(<?php echo $list->idvic_blogs_news; ?>, 'active')">
                                            <label for="check1" class="m-0 text-blue">Inactive</label></a>
                                    <?php endif; ?>
                                    <a href="#" data-toggle="modal" data-target="#deleteNewsModal" onclick="content_id(<?php echo $list->idvic_blogs_news; ?>)" class="btn btn-card"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="row" id="result_div" style="display: none;">

    </div>
    <div class="row mt-3">
        <div class="col-sm-12">
            <ul class="pagination justify-content-center">
                <!-- <li class="page-item prev-page disabled mr-2"><a class="page-link" href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li> -->
                <?php echo $links ?>
                <!-- <li class="page-item ml-2"><a class="page-link" href="#">2</a></li>
                <li class="page-item ml-2 mr-2"><a class="page-link" href="#">3</a></li>
                <li class="page-item next-page ml-2"><a class="page-link" href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li> -->
            </ul>
        </div>
    </div>


    <!-- Delete News Modal -->
    <div class="modal fade" id="deleteNewsModal" role="dialog" aria-labelledby="publish" aria-hidden="true">
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

</div>