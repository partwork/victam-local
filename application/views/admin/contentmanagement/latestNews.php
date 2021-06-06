<div class="container-fluid body-wrapper pl-24vw">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Latest News</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Home</li>
                            <li class="breadcrumb-item active" aria-current="page">Latest News</li>
                        </ol>
                    </nav>
                </h4>
                <a href="<?php echo base_url('admin/content-management/home/latest-news/add-latest-news') ?>" class="btn btn-blue float-right f-14 pl-4 pr-4">Add News</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="filter-wrap">
                <div class="status-wrap">
                    <label for="statusFilter">Status Filter</label>
                    <select id="ls_statusFilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Status</option>
                        <option>Under Review</option>
                        <option>Published</option>
                        <option>Rejected</option>
                    </select>
                </div>
                <div class="search-wrap">
                    <input type="text" class="form-control" placeholder="Search" id="ls_search_input">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="table-wrapper">
                <table id="latestNews" class="display table" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>News Headlines</th>
                            <th>Created Date</th>
                            <th>Modification</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php if ($content) : ?>
                            <?php foreach ($content as $list) : ?>
                                <tr>
                                    <td class="w-50"><?php echo $list->vic_bn_title; ?></td>
                                    <?php $time =  strtotime($list->vic_bn_createdat) ?>
                                    <td><?php echo date('F d, Y', $time); ?></td>
                                    <?php $u_time =  strtotime($list->vic_updated_at) ?>
                                    <td><?php echo date('F d, Y', $u_time); ?></td>
                                        <?php if ($list->vic_modification_status == 'Published') : ?>
                                    <td class="text-green"><?php echo $list->vic_modification_status; ?></td>
                                        <?php elseif ($list->vic_modification_status == 'Under Review') : ?>
                                    <td class="text-blue"><?php echo $list->vic_modification_status; ?></td>
                                        <?php else : ?>
                                    <td class="text-red"><?php echo $list->vic_modification_status; ?></td>
                                        <?php endif; ?>
                                    <td>
                                        <div class="action-btn-wrap">
                                            <a href="<?php echo base_url('admin/content-management/home/latest-news/get-latest-news/' . $list->idvic_blogs_news) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a data-toggle="modal" data-target="#deleteNewsModal"  onclick="delete_content(<?php echo $list->idvic_blogs_news; ?>)" class="ml-3"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?> -->
                    </tbody>
                </table>
            </div>
        </div>
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