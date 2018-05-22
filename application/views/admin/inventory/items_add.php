<?php
    if (isset($dataArr)) {
        $form_action = site_url('inventory/items/edit/' . base64_encode($dataArr['id']));
    } else {
        $form_action = site_url('inventory/items/add');
    }
?>

<div class="page-header page-header-default">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('dashboard'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('inventory/items') ?>">Items</a></li>
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
            <form method="post" action="<?php echo $form_action; ?>" class="form-horizontal" id="add_item_form" enctype="multipart/form-data" >
                <div class="panel panel-body login-form">
                    <?php $this->load->view('alert_view'); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Image</label>
                                        <div class="col-md-7">
                                            <div class="media no-margin-top">
                                                <div class="media-left" id="image_preview_div">
                                                    <?php
                                                        if (isset($dataArr) && $dataArr['image'] && file_exists(ITEMS_IMAGE_PATH.'/'.$dataArr['image'])) {
                                                            $required = '';
                                                            ?>
                                                            <img src="<?php echo ITEMS_IMAGE_PATH.'/'.$dataArr['image'] ?>" style="width: 58px; height: 58px; border-radius: 2px;" alt="">
                                                            <?php
                                                        } else {
                                                            $required = 'required';
                                                            ?>
                                                        <img src="assets/images/placeholder.jpg" style="width: 58px; height: 58px; border-radius: 2px;" alt="">
                                                    <?php } ?>
                                                </div>
                                                <div class="media-body">
                                                    <input type="file" name="image_link" id="image_link" class="file-styled" onchange="readURL(this);">
                                                    <span class="help-block">Accepted formats: png, jpg. Max file size 2Mb</span>
                                                </div>
                                            </div>
                                            <?php
                                            if (isset($menu_item_image_validation))
                                                echo '<label id="image_link-error" class="validation-error-label" for="image_link">' . $item_image_validation . '</label>';
                                            ?>
                                        </div>  
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label required">Item Part No :</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="txt_item_part" id="txt_item_part" style="text-transform: uppercase;" value="<?php echo (isset($dataArr)) ? $dataArr['part_no'] : set_value('txt_item_part'); ?>">
                                            <?php echo '<label id="txt_item_part_error2" class="validation-error-label" for="txt_item_part">' . form_error('txt_item_part') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label required">Internal Part No :</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="txt_internal_part" id="txt_internal_part" style="text-transform: uppercase;" value="<?php echo (isset($dataArr)) ? $dataArr['internal_part_no'] : set_value('txt_internal_part'); ?>">
                                            <?php echo '<label id="txt_internal_part_error2" class="validation-error-label" for="txt_internal_part">' . form_error('txt_internal_part') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback select_form_group">
                                        <label class="col-md-4 col-xs-12 control-label required">Department :</label>
                                        <div class="col-md-7 col-xs-10">        
                                            <select class="select select-size-sm" data-placeholder="Select a Department..." id="txt_department" name="txt_department" required <?php if (empty($dept_Arr)) { echo 'disabled'; } ?>>
                                                <option></option>
                                                <?php foreach($dept_Arr as $k => $v){ 
                                                        if(isset($dataArr)){
                                                            if($dataArr['department_id']==$v['id']){
                                                                $selected = 'selected';
                                                            }else{
                                                                $selected = '';
                                                            }
                                                        }else{
                                                            $selected = '';
                                                        }
                                                ?>
                                                    <option value="<?php echo $v['id']; ?>" <?php echo $selected; ?>><?php echo $v['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php echo '<label id="txt_department_error2" class="validation-error-label" for="txt_department">' . form_error('txt_department') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group has-feedback select_form_group">
                                        <label class="col-md-4 col-xs-12 control-label required">Preferred Vendor :</label>
                                        <div class="col-md-7 col-xs-10">        
                                            <select class="select select-size-sm" data-placeholder="Select a Preferred Vendor..." id="txt_pref_vendor" name="txt_pref_vendor" required <?php if (empty($vendor_Arr)) { echo 'disabled'; } ?>>
                                                <option></option>
                                                <?php 
                                                    foreach($vendor_Arr as $k => $v){
                                                        if(isset($dataArr)){
                                                            if($dataArr['preferred_vendor']==$v['id']){
                                                                $selected = 'selected';
                                                            }else{
                                                                $selected = '';
                                                            }
                                                        }else{
                                                            $selected = '';
                                                        }
                                                    ?>
                                                        <option value="<?php echo $v['id']; ?>" <?php echo $selected; ?>><?php echo $v['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php echo '<label id="txt_pref_vendor_error2" class="validation-error-label" for="txt_pref_vendor">' . form_error('txt_pref_vendor') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label required">Preferred Vendor Part No :</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="txt_pref_vendor_part" id="txt_pref_vendor_part" value="<?php echo (isset($dataArr)) ? $dataArr['preferred_vendor_part'] : set_value('txt_pref_vendor_part'); ?>">
                                            <?php echo '<label id="txt_pref_vendor_part_error2" class="validation-error-label" for="txt_pref_vendor_part">' . form_error('txt_pref_vendor_part') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label required">Preferred Vendor Cost New :</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="txt_pref_vendor_cost_new" id="txt_pref_vendor_cost_new" value="<?php echo (isset($dataArr)) ? $dataArr['preferred_vendor_cost_new'] : set_value('txt_pref_vendor_cost_new'); ?>" onkeypress="return validateFloatKeyPress(this, event);">
                                            <?php echo '<label id="txt_pref_vendor_cost_new_error2" class="validation-error-label" for="txt_pref_vendor_cost_new">' . form_error('txt_pref_vendor_cost_new') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label required">Preferred Vendor Cost Refurbished :</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="txt_pref_vendor_cost_refurbished" id="txt_pref_vendor_cost_refurbished" value="<?php echo (isset($dataArr)) ? $dataArr['preferred_vendor_cost_refurbished'] : set_value('txt_pref_vendor_cost_refurbished'); ?>" onkeypress="return validateFloatKeyPress(this, event);">
                                            <?php echo '<label id="txt_pref_vendor_cost_REFURBIshed_error2" class="validation-error-label" for="txt_pref_vendor_cost_refurbished">' . form_error('txt_pref_vendor_cost_refurbished') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group has-feedback select_form_group">
                                        <label class="col-md-4 col-xs-12 control-label">Secondary Vendor :</label>
                                        <div class="col-md-7 col-xs-10">        
                                            <select class="select select-size-sm" data-placeholder="Select a Secondary Vendor..." id="txt_sec_vendor" name="txt_sec_vendor" <?php if (empty($vendor_Arr)) { echo 'disabled'; } ?>>
                                                <option></option>
                                                <?php 
                                                    foreach($vendor_Arr as $k => $v){
                                                        if(isset($dataArr)){
                                                            if($dataArr['secondary_vendor']==$v['id']){
                                                                $selected = 'selected';
                                                            }else{
                                                                $selected = '';
                                                            }
                                                        }else{
                                                            $selected = '';
                                                        }
                                                    ?>
                                                    <option value="<?php echo $v['id']; ?>" <?php echo $selected; ?>><?php echo $v['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php echo '<label id="txt_sec_vendor_error2" class="validation-error-label" for="txt_sec_vendor">' . form_error('txt_sec_vendor') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">Secondary Vendor Part No :</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="txt_sec_vendor_part" id="txt_sec_vendor_part" value="<?php echo (isset($dataArr)) ? $dataArr['secondary_vendor_part'] : set_value('txt_sec_vendor_part'); ?>">
                                            <?php echo '<label id="txt_sec_vendor_part_error2" class="validation-error-label" for="txt_sec_vendor_part">' . form_error('txt_sec_vendor_part') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">Secondary Vendor Cost New :</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="txt_sec_vendor_cost_new" id="txt_sec_vendor_cost_new" value="<?php echo (isset($dataArr)) ? $dataArr['secondary_vendor_cost_new'] : set_value('txt_sec_vendor_cost_new'); ?>" onkeypress="return validateFloatKeyPress(this, event);">
                                            <?php echo '<label id="txt_sec_vendor_cost_new_error2" class="validation-error-label" for="txt_sec_vendor_cost_new">' . form_error('txt_sec_vendor_cost_new') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">Secondary Vendor Cost Refurbished :</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="txt_sec_vendor_cost_refurbished" id="txt_sec_vendor_cost_refurbished" value="<?php echo (isset($dataArr)) ? $dataArr['secondary_vendor_cost_refurbished'] : set_value('txt_sec_vendor_cost_refurbished'); ?>" onkeypress="return validateFloatKeyPress(this, event);">
                                            <?php echo '<label id="txt_sec_vendor_cost_refurbished_error2" class="validation-error-label" for="txt_sec_vendor_cost_refurbished">' . form_error('txt_sec_vendor_cost_refurbished') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">Part Location :</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="txt_part_location" id="txt_part_location" value="<?php echo (isset($dataArr)) ? $dataArr['part_location'] : set_value('txt_part_location'); ?>">
                                            <?php echo '<label id="txt_part_location_error2" class="validation-error-label" for="txt_part_location">' . form_error('txt_part_location') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group has-feedback" style="margin-bottom:15px">
                                        <label class="col-md-4 control-label required">Item Description :</label>
                                        <div class="col-md-7">
                                            <textarea class="form-control" name="txt_item_description" id="txt_item_description" rows="4"><?php echo (isset($dataArr)) ? $dataArr['description'] : set_value('txt_item_description'); ?></textarea>
                                            <?php echo '<label id="txt_item_description_error2" class="validation-error-label" for="txt_item_description">' . form_error('txt_item_description') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label required">New Unit Cost :</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="txt_new_unit_cost" id="txt_new_unit_cost" value="<?php echo (isset($dataArr)) ? $dataArr['new_unit_cost'] : set_value('txt_new_unit_cost'); ?>">
                                            <?php echo '<label id="txt_new_unit_cost_error2" class="validation-error-label" for="txt_new_unit_cost">' . form_error('txt_new_unit_cost') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label required">Refurbished Unit Cost :</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="txt_ref_unit_cost" id="txt_ref_unit_cost" value="<?php echo (isset($dataArr)) ? $dataArr['refurbished_unit_cost'] : set_value('txt_ref_unit_cost'); ?>">
                                            <?php echo '<label id="txt_ref_unit_cost_error2" class="validation-error-label" for="txt_ref_unit_cost">' . form_error('txt_ref_unit_cost') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">New Retail Price :</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="txt_retial_price" id="txt_retial_price" value="<?php echo (isset($dataArr)) ? $dataArr['new_retail_price'] : set_value('txt_retial_price'); ?>">
                                            <?php echo '<label id="txt_retial_price_error2" class="validation-error-label" for="txt_retial_price">' . form_error('txt_retial_price') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">Refurbished Retail Price :</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="txt_ref_retial_price" id="txt_ref_retial_price" value="<?php echo (isset($dataArr)) ? $dataArr['refurbished_retail_price'] : set_value('txt_ref_retial_price'); ?>">
                                            <?php echo '<label id="txt_ref_retial_price_error2" class="validation-error-label" for="txt_ref_retial_price">' . form_error('txt_ref_retial_price') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">MSRP :</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="txt_msrp" id="txt_msrp" value="<?php echo (isset($dataArr)) ? $dataArr['msrp'] : set_value('txt_msrp'); ?>">
                                            <?php echo '<label id="txt_msrp_error2" class="validation-error-label" for="txt_msrp">' . form_error('txt_msrp') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">New In-Stock :</label>
                                        <div class="col-md-7">
                                            <input type="text" value="<?php echo (isset($dataArr)) ? $dataArr['qty_on_hand'] : 0; ?>" class="touchspin-empty" name="txt_in_stock" id="txt_in_stock">
                                            <?php echo '<label id="txt_in_stock_error2" class="validation-error-label" for="txt_in_stock">' . form_error('txt_in_stock') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label class="col-md-4 control-label">Refurbished In-Stock :</label>
                                        <div class="col-md-7">
                                            <input type="text" value="<?php echo (isset($dataArr)) ? $dataArr['qty_on_order'] : 0; ?>" class="touchspin-empty" name="txt_in_order" id="txt_in_order">
                                            <?php echo '<label id="txt_in_order_error2" class="validation-error-label" for="txt_in_order">' . form_error('txt_in_order') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn bg-teal custom_save_button">Save</button>
                            <button type="button" class="btn btn-default custom_cancel_button" onclick="if (history.length > 2) {
                                window.history.back()
                            } else {
                                window.location.href = '/product/transponder';
                            }">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php $this->load->view('Templates/footer.php'); ?>
</div>

<script type="text/javascript" src="assets/js/custom_pages/items.js"></script>
<style>
    .modal-open{ padding-right:3px !important; }
</style>