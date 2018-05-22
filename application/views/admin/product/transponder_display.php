<div class="page-header page-header-default">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('dashboard'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Product</li>
            <li class="active">Application data</li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $this->load->view('alert_view'); ?>
            <div class="panel panel-flat">
                <table class="table datatable-basic">
                    <thead>
                        <tr>
                            <th style="width:5%"></th>
                            <th style="width:5%">Status</th>
                            <th>Company</th>
                            <th>Model / Year</th>
                            <th>Notes</th>
                            <th>Last Edited</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <?php $this->load->view('Templates/footer'); ?>
</div>

<!-- Bulk Edit modal -->
<div id="bulk_edit_modal" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-teal-400 custom_modal_header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title text-center">Edit Records</h6>
            </div>
            <div class="modal-body panel-body" id="bulk_edit_body">
                <code>Bulk Edit allows you to apply same value to multiple records.</code><br><br>
                <form action="<?php echo site_url('product/transponder/bulk_edit'); ?>" method="post" class="form-horizontal" id="bulk_edit_form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback select_form_group">
                                <div class="col-md-8">
                                    <select class="select select-size-sm" id="txt_column_name" name="txt_column_name" required>
                                        <option value="">Select column to edit--</option>
                                        <?php foreach($columns_Arr as $k => $v){ ?>
                                            <option id="<?php echo $v; ?>" value="<?php echo $v; ?>">
                                                <?php 
                                                    if($v=='iico'){ 
                                                        echo 'IIco';
                                                    }else{
                                                        echo ucwords(str_replace('_',' ',$v)); 
                                                    }
                                                ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-xxs" id="tbl_bulk_new_data">
                                    <thead></thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="txt_app_id" id="txt_app_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-teal-400 btn_submit_bulk">Apply</button>
            </div>
        </div>
    </div>
</div>

<!-- View modal -->
<div id="transponder_view_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-teal-400 custom_modal_header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title text-center">Transponder Details</h6>
            </div>
            <div class="modal-body panel-body custom_scrollbar" id="transponder_view_body" style="height: 500px;overflow: hidden;overflow-y: scroll;"></div>
        </div>
    </div>
</div>
<script>
    var user_type = '<?php echo checkLogin('R'); ?>';
</script>
<script type="text/javascript" src="assets/js/custom_pages/transponder.js"></script>
<style>
    .dataTables_length{ float:left; }
    .modal-open{ padding-right:3px !important; }
</style>