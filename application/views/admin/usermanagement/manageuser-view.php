
<div class="container-fluid body-wrapper pl-24vw">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Manage User</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Manage User</li>
                        </ol>
                    </nav>
                </h4>
                <a href="<?php echo base_url('admin/manage-user/add-user') ?>" class="btn btn-blue float-right f-14 pl-4 pr-4">Add User</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="filter-wrap">
                <div class="status-wrap">
                    <label for="statusFilter">Status Filter</label>
                    <select id="statusFilter" class="form-control ">
                        <option selected disabled> Select Status </option>
                        <option value="active">Active</option>
                        <option value="inactive">InActive</option>
                    </select>
                </div>
                <div class="search-wrap">
                    <input type="text" class="form-control search_input" placeholder="Search">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="table-wrapper">
                <table id="manageUser" class="display table" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>User Role</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Company Email</th>
                            <th>Mobile Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
<!-- 
                        <?php
                        if (isset($list) && $list != NULL) :
                            foreach ($list->result() as $row) :
                                $status = ($row->vic_user_status == 'active') ? 'checked' : '';
                        ?>
                                <tr>
                                    <td><?php echo $row->vic_user_role; ?></td>
                                    <td><?php echo $row->vic_user_firstname; ?></td>
                                    <td><?php echo $row->vic_user_lastname; ?></td>
                                    <td><?php echo $row->user_email; ?></td>
                                    <td><?php echo $row->user_mobile; ?></td>
                                    <td><label class="switch">
                                            <input data-id="<?php echo $row->iduser_details; ?>" class="status_btn" type="checkbox" <?php echo  $status; ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="action-btn-wrap">
                                            <a href="<?php echo base_url('admin/user_edit_page/' . $row->iduser_details); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a href="#" class="ml-3 user_delete_btn" data-toggle="modal" data-target="#deleteUserModal" onclick="content_id(<?php echo $row->iduser_details; ?>)" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
<div class="modal fade" id="deleteUserModal" role="dialog" aria-labelledby="publish" aria-hidden="true">
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
                        <button type="button" onclick="delete_user()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                        <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
