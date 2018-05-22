<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered" data-alert="" data-all="189">
            <tbody>
                <?php if($viewArr['image']!='' || $viewArr['image']!=NULL){ ?>
                <tr><td><b>Image</b></td><td><a href="<?php echo base_url().ITEMS_IMAGE_PATH.'/'.$viewArr['image']; ?>" data-popup="lightbox"><img src="<?php echo base_url().ITEMS_IMAGE_PATH.'/'.$viewArr['image']; ?>" style="width: 10%;"></a></td></tr>
                <?php } ?>
                <tr class="alpha-teal"><td><b>Part No</b></td><td><?php echo $viewArr['part_no']; ?></td></tr>
                <tr><td><b>Internal Part No</b></td><td><?php echo $viewArr['internal_part_no']; ?></td></tr>
                <tr class="alpha-teal"><td><b>Description</b></td><td><?php echo $viewArr['description']; ?></td></tr>
                <tr><td><b>Department</b></td><td><?php echo $viewArr['dept_name']; ?></td></tr>
                <tr class="alpha-teal"><td><b>Preferred Vendor</b></td><td><?php echo $viewArr['v1_name']; ?></td></tr>
                <tr><td><b>Preferred Vendor Part No</b></td><td><?php echo $viewArr['preferred_vendor_part']; ?></td></tr>
                <tr class="alpha-teal"><td><b>Preferred Vendor Cost New</b></td><td><?php echo $viewArr['preferred_vendor_cost_new']; ?></td></tr>
                <tr><td><b>Preferred Vendor Cost Refurbished</b></td><td><?php echo $viewArr['preferred_vendor_cost_refurbished']; ?></td></tr>
                <tr class="alpha-teal"><td><b>Secondary Vendor</b></td><td><?php echo ($viewArr['v2_name']!='') ? $viewArr['v2_name'] : 'N/A'; ?></td></tr>
                <tr><td><b>Secondary Vendor Part No</b></td><td><?php echo ($viewArr['secondary_vendor_part']!='') ? $viewArr['secondary_vendor_part'] : 'N/A'; ?></td></tr>
                <tr class="alpha-teal"><td><b>Secondary Vendor Cost New</b></td><td><?php echo $viewArr['secondary_vendor_cost_new']; ?></td></tr>
                <tr><td><b>Secondary Vendor Cost Refurbished</b></td><td><?php echo $viewArr['secondary_vendor_cost_refurbished']; ?></td></tr>
                <tr class="alpha-teal"><td><b>Part Location</b></td><td><?php echo $viewArr['part_location']; ?></td></tr>
                <tr><td><b>New Retail Price</b></td><td><?php echo $viewArr['new_retail_price']; ?></td></tr>
                <tr class="alpha-teal"><td><b>Refurbished Retail Price</b></td><td><?php echo $viewArr['refurbished_retail_price']; ?></td></tr>
                <tr><td><b>MSRP</b></td><td><?php echo $viewArr['msrp']; ?></td></tr>
                <tr class="alpha-teal"><td><b>Qty In Stock</b></td><td><?php echo $viewArr['qty_on_hand']; ?></td></tr>
                <tr><td><b>Qty On Order</b></td><td><?php echo $viewArr['qty_on_order']; ?></td></tr>
            </tbody>
        </table>
    </div>
</div>