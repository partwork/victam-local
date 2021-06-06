<div class="container-fluid body-wrapper pl-24vw">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>News</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Market Information</li>
                            <li class="breadcrumb-item active" aria-current="page">News</li>
                        </ol>
                    </nav>
                </h4>
                <a href="<?php echo base_url('admin/content-management/market-info/add-news') ?>" class="btn btn-blue float-right f-14 pl-4 pr-4">Add New News</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="filter-wrap">
                <div class="status-wrap">
                    <label for="sectorFilter">Industry sector</label>
                    <select id="nssectorFilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Industry sector</option>
                        <option value="processing technology">Processing Technology</option>
                        <option value="ingredients and additives">Ingredients & Additives</option>
                        <option value="rice and flour milling">Rice & Flour Miling</option>
                    </select>
                </div>
                <div class="status-wrap">
                    <label for="statusFilter">Status Filter</label>
                    <select id="nsstatusFilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Status</option>
                        <option value="Under Review">Under Review</option>
                        <option value="Published">Published</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>
                <div class="search-wrap">
                    <input type="text" id="nsinput_search" class="form-control" placeholder="Search">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="table-wrapper">
                <table id="News" class="display table" style="width:100%;table-layout:fixed;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sector</th>
                            <th class="big-col">News Headlines</th>
                            <th>Created Date</th>
                            <th>Modification</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

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