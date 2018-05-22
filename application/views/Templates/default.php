<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="<?php echo base_url(); ?>">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $title; ?></title>
		<?php
            $class = $this->router->fetch_class();
            $action = $this->router->fetch_method();
        ?>
		<!-- Global stylesheets -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
		<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
		<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="assets/css/core.css" rel="stylesheet" type="text/css">
		<link href="assets/css/components.css" rel="stylesheet" type="text/css">
		<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
		<link href="assets/css/custom_pav.css" rel="stylesheet" type="text/css">
		<!-- /global stylesheets -->
		<link rel="icon" href="assets/images/favicon.png" type="image/png">
		<script type="text/javascript">
            var site_url = "<?php echo site_url() ?>";
            var base_url = "<?php echo base_url() ?>";
            var domain = "<?php echo MY_DOMAIN_NAME ?>";
            var currentDate = new Date();
            var currentOffset = (currentDate.getTimezoneOffset() * -1 ) * 60;
            document.cookie="currentOffset="+currentOffset;
        </script>

		<!-- Core JS files -->
		<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
		<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
		<!-- /core JS files -->

		<!-- Theme JS files -->
		<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>
		<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
		<script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
        <script type="text/javascript" src="assets/js/plugins/forms/styling/switch.min.js"></script>
		<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
		<script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
		<script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
		<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
		<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
		<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
		<script type="text/javascript" src="assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
		<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/plugins/forms/validation/validate.min.js"></script>
		<script type="text/javascript" src="assets/js/plugins/forms/inputs/touchspin.min.js"></script>
		<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
		<script type="text/javascript" src="assets/js/plugins/media/fancybox.min.js"></script>
		<!-- <script type="text/javascript" src="assets/js/pages/gallery_library.js"></script> -->

		<script type="text/javascript" src="assets/js/core/app.js"></script>

		<script type="text/javascript" src="assets/js/pages/form_select2.js"></script>
		<script type="text/javascript" src="assets/js/pages/invoice_grid.js"></script>
		<script type="text/javascript" src="assets/js/pages/form_layouts.js"></script>
		<script type="text/javascript" src="assets/js/pages/form_multiselect.js"></script>

		<script>
			$(function(){
                Pace.on('start', function() {
                    $('#custom_loading').show();
                });
                Pace.on('done', function() {
                    $('#custom_loading').hide();
                });
                // Lightbox
			    $('[data-popup="lightbox"]').fancybox({
			        padding: 3
			    });
            })
		</script>
		<!-- <script type="text/javascript" src="assets/js/pages/dashboard.js"></script> -->
		<!-- /theme JS files -->

	</head>
	<body>
		<!-- Main navbar -->
		<div class="navbar navbar-inverse">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo site_url('/'); ?>" style="letter-spacing: 3px;font-weight: 500;font-size: 16px;line-height:2">
					<?php echo 'Always Reliable Keys'; ?>
				</a>

				<ul class="nav navbar-nav visible-xs-block">
					<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
				</ul>
			</div>

			<div class="navbar-collapse collapse" id="navbar-mobile">
				<ul class="nav navbar-nav">
					<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown dropdown-user">
						<a class="dropdown-toggle" data-toggle="dropdown">
							<img src="assets/images/placeholder.jpg" alt="">
							<span><?php echo strtoupper(checkLogin('U')); ?></span>
							<i class="caret"></i>
						</a>

						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="<?php echo site_url('profile'); ?>"><i class="icon-cog5"></i> Account Settings</a></li>
							<li><a href="<?php echo site_url('logout'); ?>"><i class="icon-switch2"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<!-- /main navbar -->

		<!-- Page container -->
		<div class="page-container">
			<div class="page-content">
				<div class="sidebar sidebar-main">
					<div class="sidebar-content">
						<div class="sidebar-user">
							<div class="category-content">
								<div class="media">
									<a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
									<div class="media-body">
										<span class="media-heading text-semibold"><?php echo strtoupper(checkLogin('U')); ?></span>
									</div>

									<div class="media-right media-middle">
										<ul class="icons-list">
											<li>
												<a href="#"><i class="icon-cog3"></i></a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="sidebar-category sidebar-category-visible">
							<div class="category-content no-padding">
								<ul class="navigation navigation-main navigation-accordion">
									<li class="<?php echo ($class == 'dashboard') ? 'active' : '' ?>"><a href="<?php echo site_url('dashboard'); ?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
									<li class="<?php echo ($class == 'product' && ($action == 'display_transponder' || $action == 'add_transponder' || $action == 'edit_transponder')) ? 'active' : ''; ?>"><a href="<?php echo site_url('product/transponder'); ?>"><i class="icon-meter2"></i> <span>Application Data</span></a></li>
									<?php if(checkLogin('R')==1){ $temp_array = array('display_transponder','add_transponder','edit_transponder'); ?>
										<li class="<?php echo ($class == 'product' && !in_array($action, $temp_array)) ? 'active' : ''; ?>">
	                                        <a href="#" class="has-ul"><i class="icon-user-lock"></i><span>Administration</span></a>
	                                        <ul class="hidden-ul" style="<?php echo ($class == 'product' && !in_array($action, $temp_array)) ? 'display:block' : ''; ?>">
	                                            <li class="<?php echo ($class == 'product' && ($action == 'manage_make')) ? 'active' : ''; ?>"><a href="<?php echo site_url('product/make'); ?>"><i class="icon-car"></i>Make</a></li>
	                                            <li class="<?php echo ($class == 'product' && ($action == 'manage_model')) ? 'active' : ''; ?>"><a href="<?php echo site_url('product/model'); ?>"><i class="icon-road"></i>Model</a></li>
	                                            <li class="<?php echo ($class == 'product' && ($action == 'manage_year')) ? 'active' : ''; ?>"><a href="<?php echo site_url('product/year'); ?>"><i class="icon-calendar22"></i>Year</a></li>
	                                        </ul>
	                                    </li>
	                             	<?php } ?>
	                             	<?php if(checkLogin('R')==1 || checkLogin('R')==3){ ?>
	                                    <li class="<?php echo ($class == 'inventory') ? 'active' : ''; ?>">
	                                        <a href="#" class="has-ul"><i class="icon-books"></i><span>Inventory</span></a>
	                                        <ul class="hidden-ul" style="<?php echo ($class == 'inventory') ? 'display:block' : ''; ?>">
	                                            <li class="<?php echo ($class == 'inventory' && ($action == 'display_items' || $action == 'add_items' || $action == 'edit_items')) ? 'active' : ''; ?>"><a href="<?php echo site_url('inventory/items'); ?>"><i class="icon-car"></i>Manage Items</a></li>
	                                            <li class="<?php echo ($class == 'inventory' && ($action == 'display_departments' || $action == 'add_departments' || $action == 'edit_departments')) ? 'active' : ''; ?>"><a href="<?php echo site_url('inventory/departments'); ?>"><i class="icon-car"></i>Manage Departments</a></li>
	                                            <li class="<?php echo ($class == 'inventory' && ($action == 'display_vendors' || $action == 'add_vendors' || $action == 'edit_vendors')) ? 'active' : ''; ?>"><a href="<?php echo site_url('inventory/vendors'); ?>"><i class="icon-car"></i>Manage Vendors</a></li>
	                                        </ul>
	                                    </li>
	                                <?php } ?>
	                                <?php if(checkLogin('R')==1){ ?>
										<li class="<?php echo ($class == 'staff' && ($action == 'display_staff' || $action == 'add_staff' || $action == 'edit_staff' || $action == 'view_staff')) ? 'active' : ''; ?>"><a href="<?php echo site_url('staff'); ?>"><i class="icon-users2"></i> <span>Staff Members</span></a></li>
                                	<?php } ?>
	                                <li class="<?php echo ($class == 'reports') ? 'active' : ''; ?>">
                                        <a href="#" class="has-ul"><i class="icon-file-stats"></i><span>Application Look-up</span></a>
                                        <ul class="hidden-ul" style="<?php echo ($class == 'reports') ? 'display:block' : ''; ?>">
                                            <li class="<?php echo ($class == 'reports' && ($action == 'get_transponder_report')) ? 'active' : ''; ?>"><a href="<?php echo site_url('reports/transponder'); ?>">Transponder</a></li>
                                        </ul>
                                    </li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="content-wrapper">
					<div id="custom_loading" class="hide">
	                    <div id="loading-center">
			                <svg version="1.1" id="L7" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
			 					<path fill="#009688" d="M31.6,3.5C5.9,13.6-6.6,42.7,3.5,68.4c10.1,25.7,39.2,38.3,64.9,28.1l-3.1-7.9c-21.3,8.4-45.4-2-53.8-23.3c-8.4-21.3,2-45.4,23.3-53.8L31.6,3.5z">
			      					<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="2s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
			  					</path>
			 					<path fill="#26A69A" d="M42.3,39.6c5.7-4.3,13.9-3.1,18.1,2.7c4.3,5.7,3.1,13.9-2.7,18.1l4.1,5.5c8.8-6.5,10.6-19,4.1-27.7c-6.5-8.8-19-10.6-27.7-4.1L42.3,39.6z">
			      					<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="-360 50 50" repeatCount="indefinite" />
			  					</path>
			 					<path fill="#74afa9" d="M82,35.7C74.1,18,53.4,10.1,35.7,18S10.1,46.6,18,64.3l7.6-3.4c-6-13.5,0-29.3,13.5-35.3s29.3,0,35.3,13.5L82,35.7z">
			      					<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="2s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
			  					</path>
							</svg>
			            </div>
	                </div>
					<?php echo $body; ?>
				</div>
			</div>
		</div>
		<!--/Page container-->