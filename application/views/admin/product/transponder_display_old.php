<div class="page-header page-header-default">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('dashboard'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Product</li>
            <li class="active">Transponder</li>
        </ul>
    </div>
</div>

<div class="content">
	<div class="container-detached">
		<div class="content-detached">
			<div class="row">
				<div class="col-md-12 text-right">
					<a href="<?php echo site_url('product/transponder/add'); ?>" class="btn bg-teal-400 btn-labeled custom_add_button"><b><i class="icon-plus-circle2"></i></b> Add Transponder</a>
				</div>
			</div>
			<br>
			<div class="navbar navbar-default navbar-xs navbar-component">

				<ul class="nav navbar-nav no-border visible-xs-block">
					<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
				</ul>

				<div class="navbar-collapse collapse" id="navbar-filter">
					<!-- <p class="navbar-text">Filter:</p>
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-time-asc position-left"></i> By date <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Show all</a></li>
								<li class="divider"></li>
								<li><a href="#">Today</a></li>
								<li><a href="#">Yesterday</a></li>
								<li><a href="#">This week</a></li>
								<li><a href="#">This month</a></li>
								<li><a href="#">This year</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i> By status <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Show all</a></li>
								<li class="divider"></li>
								<li><a href="#">Open</a></li>
								<li><a href="#">On hold</a></li>
								<li><a href="#">Resolved</a></li>
								<li><a href="#">Closed</a></li>
								<li><a href="#">Dublicate</a></li>
								<li><a href="#">Invalid</a></li>
								<li><a href="#">Wontfix</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-numeric-asc position-left"></i> By priority <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Show all</a></li>
								<li class="divider"></li>
								<li><a href="#">Highest</a></li>
								<li><a href="#">High</a></li>
								<li><a href="#">Normal</a></li>
								<li><a href="#">Low</a></li>
							</ul>
						</li>
					</ul>
 -->
					<div class="navbar-right">
						<p class="navbar-text">Sorting:</p>
						<ul class="nav navbar-nav">
							<li class="active"><a href="#"><i class="icon-sort-alpha-asc position-left"></i> Asc</a></li>
							<li><a href="#"><i class="icon-sort-alpha-desc position-left"></i> Desc</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /invoice grid options -->

			<div class="row">
				<?php foreach($transponderArr->result_array() as $k => $v){ ?>
					<div class="col-md-6">
						<div class="panel invoice-grid">
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-6">
										<h6 class="text-semibold no-margin-top"><?php echo $v['make_name']; ?></h6>
										<ul class="list list-unstyled">
											<li>Model: <span class="text-semibold"><?php echo $v['model_name']; ?></span></li>
											<!-- <li>Invoice #: &nbsp;0028</li>
											<li>Issued on: <span class="text-semibold">2015/01/25</span></li> -->
										</ul>
									</div>

									<div class="col-sm-6">
										<h6 class="text-semibold text-right no-margin-top"><?php echo $v['year_name']; ?></h6>
										<ul class="list list-unstyled text-right">
											<li class="dropdown">
												Status: &nbsp;
												<?php if($v['status']=='active'){ ?>
													<span class="label bg-success-400">Active</span>
												<?php } else if($v['status']=='active'){ ?>
													<span class="label bg-danger-400">Inacitve</span>
												<?php } ?>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="panel-footer panel-footer-condensed">
								<div class="heading-elements">
									<span class="heading-text">
										<?php if($v['status']=='active'){ ?>
											<span class="status-mark border-success position-left"></span>
										<?php } else if($v['status']=='block'){ ?>
											<span class="status-mark border-danger position-left"></span>
										<?php } ?>
										Last Edited : <span class="text-semibold"><?php echo date('Y/m/d',strtotime($v['modified_date'])); ?></span>
									</span>

									<ul class="list-inline list-inline-condensed heading-text pull-right">
										<!-- <li><a href="#" class="text-default" data-toggle="modal" data-target="#invoice"><i class="icon-eye8"></i></a></li> -->
										<li class="dropdown">
											<a href="#" class="text-default dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<!-- <li><a href="#"><i class="icon-printer"></i> Print invoice</a></li>
												<li><a href="#"><i class="icon-file-download"></i> Download invoice</a></li>
												<li class="divider"></li> -->
												<li><a href="<?php echo site_url('product/transponder/edit/'.base64_encode($v['id'])); ?>"><i class="icon-file-plus"></i> Edit</a></li>
												<li><a href="<?php echo site_url('product/transponder/delete/'.base64_encode($v['id'])); ?>"><i class="icon-cross2"></i> Remove</a></li>
											</ul>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<!-- /invoice grid -->


			<!-- Pagination -->
			<div class="text-center content-group-lg pt-20">
				<ul class="pagination">
					<!-- <li class="disabled"><a href="#"><i class="icon-arrow-small-left"></i></a></li>
					<li class="active"><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#"><i class="icon-arrow-small-right"></i></a></li> -->
					<?php echo $pagination_links; ?>
				</ul>
			</div>
			<!-- /pagination -->


            <!-- Modal with invoice -->
			<div id="invoice" class="modal fade">
				<div class="modal-dialog modal-full">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h5 class="modal-title">Invoice #49029</h5>
						</div>

						<div class="panel-body no-padding-bottom">
							<div class="row">
								<div class="col-md-6 content-group">
									<img src="assets/images/logo_demo.png" class="content-group mt-10" alt="" style="width: 120px;">
		 							<ul class="list-condensed list-unstyled">
										<li>2269 Elba Lane</li>
										<li>Paris, France</li>
										<li>888-555-2311</li>
									</ul>
								</div>

								<div class="col-md-6 content-group">
									<div class="invoice-details">
										<h5 class="text-uppercase text-semibold">Invoice #49029</h5>
										<ul class="list-condensed list-unstyled">
											<li>Date: <span class="text-semibold">January 12, 2015</span></li>
											<li>Due date: <span class="text-semibold">May 12, 2015</span></li>
										</ul>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6 col-lg-9 content-group">
									<span class="text-muted">Invoice To:</span>
		 							<ul class="list-condensed list-unstyled">
										<li><h5>Rebecca Manes</h5></li>
										<li><span class="text-semibold">Normand axis LTD</span></li>
										<li>3 Goodman Street</li>
										<li>London E1 8BF</li>
										<li>United Kingdom</li>
										<li>888-555-2311</li>
										<li><a href="#">rebecca@normandaxis.ltd</a></li>
									</ul>
								</div>

								<div class="col-md-6 col-lg-3 content-group">
									<span class="text-muted">Payment Details:</span>
									<ul class="list-condensed list-unstyled invoice-payment-details">
										<li><h5>Total Due: <span class="text-right text-semibold">$8,750</span></h5></li>
										<li>Bank name: <span class="text-semibold">Profit Bank Europe</span></li>
										<li>Country: <span>United Kingdom</span></li>
										<li>City: <span>London E1 8BF</span></li>
										<li>Address: <span>3 Goodman Street</span></li>
										<li>IBAN: <span class="text-semibold">KFH37784028476740</span></li>
										<li>SWIFT code: <span class="text-semibold">BPT4E</span></li>
									</ul>
								</div>
							</div>
						</div>

						<div class="table-responsive">
						    <table class="table table-lg">
						        <thead>
						            <tr>
						                <th>Description</th>
						                <th class="col-sm-1">Rate</th>
						                <th class="col-sm-1">Hours</th>
						                <th class="col-sm-1">Total</th>
						            </tr>
						        </thead>
						        <tbody>
						            <tr>
						                <td>
						                	<h6 class="no-margin">Create UI design model</h6>
						                	<span class="text-muted">One morning, when Gregor Samsa woke from troubled.</span>
					                	</td>
						                <td>$70</td>
						                <td>57</td>
						                <td><span class="text-semibold">$3,990</span></td>
						            </tr>
						            <tr>
						                <td>
						                	<h6 class="no-margin">Support tickets list doesn't support commas</h6>
						                	<span class="text-muted">I'd have gone up to the boss and told him just what i think.</span>
					                	</td>
						                <td>$70</td>
						                <td>12</td>
						                <td><span class="text-semibold">$840</span></td>
						            </tr>
						            <tr>
						                <td>
						                	<h6 class="no-margin">Fix website issues on mobile</h6>
						                	<span class="text-muted">I am so happy, my dear friend, so absorbed in the exquisite.</span>
					                	</td>
						                <td>$70</td>
						                <td>31</td>
						                <td><span class="text-semibold">$2,170</span></td>
						            </tr>
						        </tbody>
						    </table>
						</div>

						<div class="panel-body">
							<div class="row invoice-payment">
								<div class="col-sm-7">
									<div class="content-group">
										<h6>Authorized person</h6>
										<div class="mb-15 mt-15">
											<img src="assets/images/signature.png" class="display-block" style="width: 150px;" alt="">
										</div>

										<ul class="list-condensed list-unstyled text-muted">
											<li>Eugene Kopyov</li>
											<li>2269 Elba Lane</li>
											<li>Paris, France</li>
											<li>888-555-2311</li>
										</ul>
									</div>
								</div>

								<div class="col-sm-5">
									<div class="content-group">
										<h6>Total due</h6>
										<div class="table-responsive no-border">
											<table class="table">
												<tbody>
													<tr>
														<th>Subtotal:</th>
														<td class="text-right">$7,000</td>
													</tr>
													<tr>
														<th>Tax: <span class="text-regular">(25%)</span></th>
														<td class="text-right">$1,750</td>
													</tr>
													<tr>
														<th>Total:</th>
														<td class="text-right text-primary"><h5 class="text-semibold">$8,750</h5></td>
													</tr>
												</tbody>
											</table>
										</div>

										<div class="text-right">
											<button type="button" class="btn btn-primary btn-labeled"><b><i class="icon-printer"></i></b> Print invoice</button>
										</div>
									</div>
								</div>
							</div>

							<h6>Other information</h6>
							<p class="text-muted">Thank you for using Limitless. This invoice can be paid via PayPal, Bank transfer, Skrill or Payoneer. Payment is due within 30 days from the date of delivery. Late payment is possible, but with with a fee of 10% per month. Company registered in England and Wales #6893003, registered office: 3 Goodman Street, London E1 8BF, United Kingdom. Phone number: 888-555-2311</p>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- /modal with invoice -->

		</div>
	</div>
	<!-- /detached content -->
	<?php $this->load->view('Templates/footer'); ?>
</div>