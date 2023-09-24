<?php require_once 'includes/header.php';?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>Sales Staff Settlement
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">

				<form class="form-horizontal" action="php_action/getSetReport.php" method="post"
					id="getOrderReportForm" autocomplete="off">
					<div class="form-group">
						<label for="startDate" class="col-sm-2 control-label">Start Date</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="startDate" name="startDate"
								placeholder="Start Date" style="width:25%;"/>
						</div>
					</div>
					<div class="form-group">
						<label for="endDate" class="col-sm-2 control-label">End Date</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="endDate" name="endDate"
								placeholder="End Date"  style="width:25%;"/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-success" id="generateReportBtn"> <i
									class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
						</div>
					</div>
				</form>

				<table class="table table-bordered table-striped table-hover datatable datatable-Customer"
					id="manageReportTable">
					<thead>
						<tr>
							<th>Cashier</th>
							<th>Cash</th>
							<th>E-Wallet</th>
							<th>Bank</th>
							<th>Credit Card</th>
							<th>Time In</th>
							<th>Time Out</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
							<th style="text-align:right">Total:</th>
							<th></th><th></th><th></th><th></th> <!-- This will be populated by JavaScript -->
							<th style="text-align:right">Grand Total:</th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
			<!-- /panel-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
</div>
<!-- /row -->

<script src="custom/js/settlement.js"></script>

<?php require_once 'includes/footer.php'; ?>