<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white ">
	<!-- <link href="https://cdn.alloyui.com/3.0.1/aui-css/css/bootstrap.min.css" rel="stylesheet"> -->
	<div class="page-wrapper">
		<!-- BEGIN HEADER -->
		<?php include "template/leftmenu.php"; ?>
		<!-- END HEADER -->

		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper full-content-wrapper">
			<!-- BEGIN CONTENT BODY -->
			<div class="page-content" style="margin-left: 0;">
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<a href="<?php echo base_url("dashboard"); ?>">Home</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span>Bedroom/Desk/Movers List</span>
						</li>
					</ul>
				</div>


				<div id="default-values-div">
					<a class="toggleAnchor" id='anchorBedroomDesk' data-toggle="collapse" href="#collapseBedroomDesk" role="button" aria-expanded="false" aria-controls="collapseBedroomDesk">
						<div class="people-wrapper">
							<div class="mid-center">
								<h3 class="bedroom-title">Bedroom/Desk Rules 
									<button class="toToggle" id="packing-collapse-button" type="button" data-toggle="" data-target="#" data-tocollapse="packing-accordion">
										<i class="fa fa-arrow-circle-down toggleArrow" style="font-size:24px;float: right;"></i>
									</button>
								</h3>

							</div>
						</div>
					</a>
					<div >
						<div class="row no-margin bedroom-frm border-1solid collapse" id="collapseBedroomDesk">
							<div class="col-md-6 text-center" style="border-right: 1px #578ebe solid;">
								<h4 class="sub-rule-title">Bedrooms</h4>
								<div class="row">
									<div class="col-md-3 col-xs-3">
										<label class="rule-label">No. of Bedrooms</label>
									</div>
									<div class="col-md-2 col-xs-2">
									</div>
									<div class="col-md-3 col-xs-3">
										<label class="rule-label">No. of Movers</label>
									</div>
									<div class="col-md-4 col-xs-4">
										<label class="rule-label">Actions</label>
									</div>
								</div>
								<div id="bedroom-container">
									<?php 
									$listcounter=1;
									foreach ($BedroomMoversList as $row) {
										if($row['bm_no_of_bedrooms']!='0'){
											?>
											<form id='bedroom-form-<?php echo $listcounter ?>' name="bedroom-form-<?php echo $listcounter ?>" class='bedroom-form'>
												<div id='bedroom-row-<?php echo $listcounter ?>' class="bedroom-row row">
													<input type="hidden" name="ruleType" id="ruleType" value="bedroom">
													<input type="hidden" name="ruleId" id="<?php echo $row['bm_id'] ?>" value='<?php echo $row['bm_id'] ?>'>
													<input type="submit" name="sbtn" class='submit-form' style="display: none">
													<div class="col-md-3 col-xs-3">
														<input type="text" class="form-control text-center" name="bedroom" id="bedroom" value="<?php echo $row['bm_no_of_bedrooms']; ?>">
													</div>
													<div class="col-md-2 col-xs-2">
														<select class="form-control" name='sign' id='sign'>
															<?php
															$signArr=array('<=','>=','==');
															foreach ($signArr as $signRow) {
																?>
																<option value="<?php echo $signRow ?>" <?php echo $row['sign'] == $signRow?'selected':'' ?>><?php echo $signRow ?></option>
																<?php
															}
															?>
														</select>
													</div>
													<div class="col-md-3 col-xs-3">
														<input type="text" class="form-control text-center" name="movers" id="movers" value="<?php echo $row['bm_no_of_movers'];?>">
													</div>
													<div class="col-md-4 col-xs-4">
														<a class="update-rule" title="Update" data-ruletype='bedroom' data-id='<?php echo $row['bm_id']; ?>'>
															<i class="fa fa-save fa-lg"></i>
														</a>
														<a class="delete-pricelist" title="Delete" data-ruletype='bedroom' data-id='<?php echo $row['bm_id']; ?>'>
															<i class="fa fa-trash fa-lg"></i>
														</a>
													</div>
												</div>
											</form>
											<?php
											$listcounter++;
										}
									}
									?>
								</div>
								<div class="row add-price-row text-center">
									<button type="button" class="add-new add-new-bedroom" onclick="cloneRow('bedroom')" >Add New</button>
								</div>
							</div>
							<div class="col-md-6 text-center">
								<h4 class="sub-rule-title">Desks</h4>
								<div class="row">
									<div class="col-md-3 col-xs-3">
										<label class="rule-label">No. of Desks</label>
									</div>
									<div class="col-md-2 col-xs-2">
									</div>
									<div class="col-md-3 col-xs-3">
										<label class="rule-label">No. of Movers</label>
									</div>
									<div class="col-md-4 col-xs-4">
										<label class="rule-label">Actions</label>
									</div>
								</div>
								<div id="desk-container">
									<?php 
									$listcounter=1;
									foreach ($BedroomMoversList as $row) {
										if($row['bm_no_of_desks']!='0'){
											?>
											<form id='desk-form-<?php echo $listcounter ?>' name="desk-form-<?php echo $listcounter ?>" class='desk-form'>
												<div id='desk-row-<?php echo $listcounter ?>' class="desk-row row">
													<input type="hidden" name="ruleType" id="ruleType" value="desk">
													<input type="hidden" name="ruleId" id="<?php echo $row['bm_id'] ?>" value='<?php echo $row['bm_id'] ?>'>
													<input type="submit" name="sbtn" class='submit-form' style="display: none">
													<div class="col-md-3 col-xs-3">
														<input type="text" class="form-control text-center" name="desk" id="desk" value="<?php echo $row['bm_no_of_desks']; ?>">
													</div>
													<div class="col-md-2 col-xs-2">
														<select class="form-control" name='sign' id='sign'>
															<?php
															$signArr=array('<=','>=','==');
															foreach ($signArr as $signRow) {
																?>
																<option value="<?php echo $signRow ?>" <?php echo $row['sign'] == $signRow?'selected':'' ?>><?php echo $signRow ?></option>
																<?php
															}
															?>
														</select>
													</div>
													<div class="col-md-3 col-xs-3">
														<input type="text" class="form-control text-center" name="movers" id="movers" value="<?php echo $row['bm_no_of_movers'];?>">
													</div>
													<div class="col-md-4 col-xs-4">
														<a class="update-rule" title="Update" data-ruletype='desk' data-id='<?php echo $row['bm_id']; ?>'>
															<i class="fa fa-save fa-lg"></i>
														</a>
														<a class="delete-pricelist" title="Delete" data-ruletype='desk' data-id='<?php echo $row['bm_id']; ?>'>
															<i class="fa fa-trash fa-lg"></i>
														</a>
													</div>
												</div>
											</form>
											<?php
											$listcounter++;
										}
									}
									?>
								</div>
								<div class="row add-price-row text-center">
									<button type="button" class="add-new-bedroom" onclick="cloneRow('desk')" >Add New</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="movers-truck-div">
					<a class="toggleAnchor" data-toggle="collapse" href="#collapseMovers" role="button" aria-expanded="false" aria-controls="collapseMovers">
						<div class="people-wrapper">
							<div class="mid-center">
								<h3 class="bedroom-title">Movers Rules 
									<button class="toToggle" id="packing-collapse-button" type="button" data-toggle="" data-target="#" data-tocollapse="packing-accordion">
										<i class="fa fa-arrow-circle-up toggleArrow" style="font-size:24px;float: right;"></i>
									</button>
								</h3>
							</div>
						</div>
					</a>
					<div >
						<div class="row bedroom-frm no-margin border-1solid collapse" id="collapseMovers">
							<div class="col-md-3 text-center">
							</div>
							<div class="col-md-6 text-center">
								<h4 class="sub-rule-title">Movers and Trucks</h4>
								<div class="row">
									<div class="col-md-3 col-xs-3">
										<label class="rule-label">No. of Movers</label>
									</div>
									<div class="col-md-2 col-xs-3">
									</div>
									<div class="col-md-3 col-xs-3">
										<label class="rule-label">No. of Trucks</label>
									</div>
									<div class="col-md-4 col-xs-3">
										<label class="rule-label">Actions</label>
									</div>
								</div>
								<div id="mover-container">
									<?php 
									$listcounter=1;
									foreach ($MoversTrucksList as $row) {
										?>
										<form id='mover-form-<?php echo $listcounter ?>' name="mover-form-<?php echo $listcounter ?>" class='mover-form'>
											<div id='mover-row-<?php echo $listcounter ?>' class="mover-row row">
												<input type="hidden" name="ruleType" id="ruleType" value="mover">
												<input type="hidden" name="ruleId" id="<?php echo $row['mt_id'] ?>" value='<?php echo $row['mt_id'] ?>'>
												<input type="submit" name="sbtn" class='submit-form' style="display: none">
												<div class="col-md-3 col-xs-3">
													<input type="text" class="form-control text-center" name="mover" id="mover" value="<?php echo $row['mt_no_of_movers']; ?>">
												</div>
												<div class="col-md-2 col-xs-3">
													<select class="form-control" name='sign' id='sign'>
														<?php
														$signArr=array('<=','>=','==');
														foreach ($signArr as $signRow) {
															?>
															<option value="<?php echo $signRow ?>" <?php echo $row['sign'] == $signRow?'selected':'' ?>><?php echo $signRow ?></option>
															<?php
														}
														?>
													</select>
												</div>
												<div class="col-md-3 col-xs-3">
													<input type="text" class="form-control text-center" name="truck" id="truck" value="<?php echo $row['mt_no_of_trucks'];?>">
												</div>
												<div class="col-md-4 col-xs-3">
													<a class="update-rule" title="Update" data-ruletype='mover' data-id='<?php echo $row['mt_id']; ?>'>
														<i class="fa fa-save fa-lg"></i>
													</a>
													<a class="delete-pricelist" title="Delete" data-ruletype='mover' data-id='<?php echo $row['mt_id']; ?>'>
														<i class="fa fa-trash fa-lg"></i>
													</a>
												</div>
											</div>
										</form>
										<?php
										$listcounter++;
									}
									?>
								</div>
								<div class="row add-price-row text-center">
									<button type="button" class="add-new-bedroom" onclick="cloneRow('mover')" >Add New</button>
								</div>
							</div>
							<div class="col-md-3 text-center">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- duplicate bedrooms start-->
	<form id='bedroom-form-' name="bedroom-form-" class="bedroom-form bedroom-duplicate" style="display: none;">
		<div id='bedroom-row-' class="bedroom-row row">
			<input type="hidden" name="ruleType" id="ruleType" value="bedroom">
			<input type="hidden" name="ruleId" class='ruleId' id="" value="">
			<input type="submit" name="sbtn" class='submit-form' style="display: none">
			<div class="col-md-3 col-xs-3">
				<input type="text" class="form-control text-center" name="bedroom" id="bedroom" value="">
			</div>
			<div class="col-md-2 col-xs-2">
				<select class="form-control" name='sign' id='sign'>
					<option value="<="><=</option>
					<option value=">=">>=</option>
					<option value="==">==</option>
				</select>
			</div>
			<div class="col-md-3 col-xs-3">
				<input type="text" class="form-control text-center" name="movers" id="movers" value="">
			</div>
			<div class="col-md-4 col-xs-4">
				<a class="update-rule" title="Add" data-ruletype='bedroom' data-id=''>
					<i class="fa fa-check fa-lg"></i>
				</a>
				<a class="delete-pricelist" title="Delete" data-ruletype='bedroom' data-id=''>
					<i class="fa fa-trash fa-lg"></i>
				</a>
			</div>
		</div>
	</form>
	<!-- duplicate bedrooms end-->


	<!-- duplicate desks start-->
	<form id='desk-form-' name="desk-form-" class="desk-form desk-duplicate" style="display: none;">
		<div id='desk-row-' class="desk-row row">
			<input type="hidden" name="ruleType" id="ruleType" value="desk">
			<input type="hidden" name="ruleId" class='ruleId' id="" value="">
			<input type="submit" name="sbtn" class='submit-form' style="display: none">
			<div class="col-md-3 col-xs-3">
				<input type="text" class="form-control text-center" name="desk" id="desk" value="">
			</div>
			<div class="col-md-2 col-xs-2">
				<select class="form-control" name='sign' id='sign'>
					<option value="<="><=</option>
					<option value=">=">>=</option>
					<option value="==">==</option>
				</select>
			</div>
			<div class="col-md-3 col-xs-3">
				<input type="text" class="form-control text-center" name="movers" id="movers" value="">
			</div>
			<div class="col-md-4 col-xs-4">
				<a class="update-rule" title="Add" data-ruletype='desk' data-id=''>
					<i class="fa fa-check fa-lg"></i>
				</a>
				<a class="delete-pricelist" title="Delete" data-ruletype='desk' data-id=''>
					<i class="fa fa-trash fa-lg"></i>
				</a>
			</div>
		</div>
	</form>
	<!-- duplicate desks end-->


	<!-- duplicate mover truck start-->
	<form id='mover-form-' name="mover-form-" class='mover-form mover-duplicate' style="display: none;">
		<div id='mover-row-' class="mover-row row">
			<input type="hidden" name="ruleType" id="ruleType" value="mover">
			<input type="hidden" name="ruleId" class='ruleId' id="" value=''>
			<input type="submit" name="sbtn" class='submit-form' style="display: none">
			<div class="col-md-3 col-xs-3">
				<input type="text" class="form-control text-center" name="mover" id="mover" value="">
			</div>
			<div class="col-md-2 col-xs-3">
				<select class="form-control" name='sign' id='sign'>
					<option value="<="><=</option>
					<option value=">=">>=</option>
					<option value="==">==</option>
				</select>
			</div>
			<div class="col-md-3 col-xs-3">
				<input type="text" class="form-control text-center" name="truck" id="truck" value="">
			</div>
			<div class="col-md-4 col-xs-3">
				<a class="update-rule" title="Add" data-ruletype='mover' data-id=''>
					<i class="fa fa-check fa-lg"></i>
				</a>
				<a class="delete-pricelist" title="Delete" data-ruletype='mover' data-id=''>
					<i class="fa fa-trash fa-lg"></i>
				</a>
			</div>
		</div>
	</form>
	<!-- duplicate mover truck end-->


</body>