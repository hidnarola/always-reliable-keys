<?php
    if (isset($dataArr)) {
        $form_action = site_url('inventory/vendors/edit/' . base64_encode($dataArr['id']));
    } else {
        $form_action = site_url('inventory/vendors/add');
    }
?>

<div class="page-header page-header-default">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('dashboard'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('inventory/vendors') ?>">Vendors</a></li>
            <li class="active">
                <?php
                if (isset($dataArr))
                    echo "Edit";
                else
                    echo "Add";
                ?>
            </li>
        </ul>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="<?php echo $form_action; ?>" id="add_vendor_form">
                <div class="panel panel-body login-form">
                    <?php $this->load->view('alert_view'); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-material has-feedback">
                                <label class="required">Vendor/Shop Name</label>
                                <input type="text" class="form-control" name="txt_name" id="txt_name" placeholder="Vendor/Shop Name" value="<?php echo (isset($dataArr)) ? $dataArr['name'] : set_value('txt_name'); ?>">
                                <?php echo '<label id="txt_name_error2" class="validation-error-label" for="txt_name">' . form_error('txt_name') . '</label>'; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-material has-feedback">
                                <label class="required">Contact Pesron</label>
                                <input type="text" class="form-control" name="txt_contact_person" id="txt_contact_person" placeholder="Contact Person" value="<?php echo (isset($dataArr)) ? $dataArr['contact_person'] : set_value('txt_contact_person'); ?>">
                                <?php echo '<label id="txt_contact_person_error2" class="validation-error-label" for="txt_contact_person">' . form_error('txt_contact_person') . '</label>'; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-group-material has-feedback">
                                <label class="required">Contact No.</label>
                                <input type="text" class="form-control" name="txt_contact_no" id="txt_contact_no" placeholder="Contact No." value="<?php echo (isset($dataArr)) ? $dataArr['contact_no'] : set_value('txt_contact_no'); ?>">
                                <?php echo '<label id="txt_contact_no_error2" class="validation-error-label" for="txt_contact_no">' . form_error('txt_contact_no') . '</label>'; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-material has-feedback">
                                <label class="required">Description</label>
                                <textarea class="form-control" name="txt_desc" id="txt_desc" placeholder="Department Description"><?php echo (isset($dataArr)) ? $dataArr['description'] : set_value('txt_desc'); ?></textarea>
                                <?php echo '<label id="txt_desc_error2" class="validation-error-label" for="txt_desc">' . form_error('txt_desc') . '</label>'; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <button type="submit" class="btn bg-blue custom_save_button">Save</button>
                                <button type="button" class="btn btn-default custom_cancel_button" onclick="if (history.length > 2) {
                                    window.history.back()
                                } else {
                                    window.location.href = '/inventory/vendors';
                                }">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <?php $this->load->view('Templates/footer.php'); ?>
    <!-- /footer -->
</div>
<script type="text/javascript" src="assets/js/custom_pages/vendor.js"></script>