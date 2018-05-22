<div class="page-header page-header-default">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('dashboard'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Product</li>
            <li class="active">Model</li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="row">
        <?php $this->load->view('alert_view'); ?>
        <div class="col-md-5" id="model_form_row">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Manage Model</h5>
                </div>
                <div class="panel-body">
                    <form method="post" class="form-validate-jquery" id="add_model_form" name="add_model_form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="required">Make List</label>
                                    <select data-placeholder="Select a Company..." class="select-size-sm" id="txt_make_name" name="txt_make_name">
                                        <option></option>
                                        <?php foreach($companyArr as $k => $v){ ?>
                                            <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-group-material has-feedback">
                                    <label class="required">Name </label>
                                    <input type="text" class="form-control" name="txt_model_name" id="txt_model_name" required="required" placeholder="Enter Name">
                                    <input type="hidden" name="txt_model_id" id="txt_model_id">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn bg-teal custom_save_button">Save</button>
                                <button type="button" class="btn btn-default custom_cancel_button" onclick="cancel_click()">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="bulk_upload_div">
                        <div class="content-divider text-muted form-group" style="margin-bottom:0px"><span>OR</span></div>
                        <form method="post" class="form-validate-jquery" id="bulk_model_form" name="bulk_model_form" action="<?php echo site_url('product/model_bulk_add'); ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>From here you can do bulk upload</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="uploader" id="uniform-upload_csv">
                                        <input type="file" class="file-styled-primary" name="upload_csv" id="upload_csv">
                                        <span class="filename" style="user-select: none;">No file selected</span>
                                        <span class="action btn bg-teal" style="user-select: none;">Choose File</span>
                                    </div>
                                    <code><a href="<?php echo MODEL_DUMMY_CSV; ?>" style="text-align: left">Click Here</a> , to get a CSV format.</code>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn bg-teal" style="border-radius: 2px">Upload<i class="icon-arrow-up13 position-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">List of Model</h5>
                </div>
                <table class="table datatable-basic">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Make</th>
                            <th>Last Edited</th>
                            <th style="width:25%">Action</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <?php $this->load->view('Templates/footer'); ?>
</div>
<script>
    remoteURL = site_url + "product/checkUnique_Model_Name";
    <?php if (isset($dataArr)) { ?>
        var model_id = '<?php echo $dataArr['id'] ?>';
        remoteURL = site_url + "product/checkUnique_Model_Name/" + model_id;
    <?php } ?>
</script>
<script type="text/javascript" src="assets/js/custom_pages/model.js"></script>